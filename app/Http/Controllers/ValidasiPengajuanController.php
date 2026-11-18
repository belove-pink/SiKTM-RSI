<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanKTM;
use App\Models\Pengguna;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;

class ValidasiPengajuanController extends Controller
{
    // Mengecek pengajuan KTM aktif melalui jalur Bank berdasarkan NIM
    public function cariPengajuanAktif($nim)
    {
        return PengajuanKTM::where('nim', $nim)
            ->where('jalur', 'Bank')
            ->whereIn('status', ['Diajukan', 'Diverifikasi'])
            ->exists();
    }

    // Memvalidasi dan menyimpan pengajuan KTM mahasiswa
    public function validasiPengajuanGanda(Request $request)
    {
        $idPengguna = session('idPengguna');

        if (!$idPengguna) {
            return redirect('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Validasi data dan file yang diunggah mahasiswa
        $validated = $request->validate([
            'nim' => 'required|string|max:20',
            'jalur' => 'required|in:Rektorat,Bank',
            'pas_foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'dokumen_pendukung' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120'
        ]);

        $nim = $validated['nim'];
        $jalur = $validated['jalur'];

        $pengguna = Pengguna::find($idPengguna);

        if (
            !$pengguna ||
            $pengguna->nim !== $nim ||
            $pengguna->peran !== 'Mahasiswa'
        ) {
            return back()->with(
                'error',
                'Data mahasiswa tidak sesuai dengan akun yang sedang login.'
            );
        }

        $mahasiswa = Mahasiswa::where('idPengguna', $idPengguna)
            ->exists();

        if (!$mahasiswa) {
            return back()->with(
                'error',
                'Data mahasiswa belum terdaftar.'
            );
        }

        // Pengecekan pengajuan Bank aktif
        if (
            $jalur === 'Rektorat' &&
            $this->cariPengajuanAktif($nim)
        ) {
            return back()->with(
                'error',
                'Anda masih memiliki pengajuan KTM aktif melalui jalur Bank.'
            );
        }

        // Menyimpan file ke storage
        $pathPasFoto = $request->file('pas_foto')
            ->store('dokumen/pas-foto', 'public');

        $pathDokumenPendukung = $request->file('dokumen_pendukung')
            ->store('dokumen/pendukung', 'public');

        // Menyimpan data pengajuan ke database
        PengajuanKTM::create([
            'idPengguna' => $idPengguna,
            'nim' => $nim,
            'jalur' => $jalur,
            'dokumen' => null,
            'pas_foto' => $pathPasFoto,
            'dokumen_pendukung' => $pathDokumenPendukung,
            'status' => 'Diajukan',
            'catatan' => null,
            'tanggalPengajuan' => now()->toDateString()
        ]);

        return back()->with(
            'success',
            'Pengajuan KTM berhasil disimpan.'
        );
    }

    // Mengambil data pengajuan untuk Admin Rektorat
    public function teruskanKeAdminRektorat($idPengajuan)
    {
        $redirect = $this->pastikanAdminRektorat();

        if ($redirect) {
            return $redirect;
        }

        return PengajuanKTM::findOrFail($idPengajuan);
    }

    // Menampilkan halaman verifikasi pengajuan KTM
    public function halamanVerifikasi($idPengajuan)
    {
        $redirect = $this->pastikanAdminRektorat();

        if ($redirect) {
            return $redirect;
        }

        $pengajuan = DB::table('PengajuanKTM')
            ->join(
                'Pengguna',
                'PengajuanKTM.idPengguna',
                '=',
                'Pengguna.idPengguna'
            )
            ->join(
                'Mahasiswa',
                'PengajuanKTM.idPengguna',
                '=',
                'Mahasiswa.idPengguna'
            )
            ->join(
                'ProgramStudi',
                'Mahasiswa.idProdi',
                '=',
                'ProgramStudi.idProdi'
            )
            ->join(
                'Fakultas',
                'ProgramStudi.idFakultas',
                '=',
                'Fakultas.idFakultas'
            )
            ->where('PengajuanKTM.idPengajuan', $idPengajuan)
            ->select(
                'PengajuanKTM.*',
                'Pengguna.nama',
                'ProgramStudi.namaProdi',
                'Fakultas.namaFakultas'
            )
            ->first();

        if (!$pengajuan) {
            abort(404);
        }

        // Cek pengajuan Bank aktif dengan NIM yang sama
        $pengajuanAktifBank = PengajuanKTM::where(
                'nim',
                $pengajuan->nim
            )
            ->where('jalur', 'Bank')
            ->whereIn('status', ['Diajukan', 'Diverifikasi'])
            ->where('idPengajuan', '!=', $idPengajuan)
            ->exists();

        $validasiLolos = !(
            $pengajuan->jalur === 'Rektorat' &&
            $pengajuanAktifBank
        );

        return view('verifikasi-pengajuan', compact(
            'pengajuan',
            'validasiLolos',
            'pengajuanAktifBank'
        ));
    }

    // Menyimpan keputusan verifikasi Admin Rektorat
    public function simpanKeputusan(Request $request, $idPengajuan)
    {
        $redirect = $this->pastikanAdminRektorat();

        if ($redirect) {
            return $redirect;
        }

        $pengajuan = PengajuanKTM::findOrFail($idPengajuan);

        if (!in_array($pengajuan->status, ['Diajukan', 'Diverifikasi'])) {
            return back()->with(
                'error',
                'Pengajuan ini sudah memiliki keputusan akhir.'
            );
        }

        $validated = $request->validate([
            'keputusan' => 'required|in:Diterima,Diverifikasi,Ditolak',
            'catatan' => 'nullable|string|max:1000'
        ]);

        // Validasi ulang untuk mencegah pengajuan ganda disetujui
        $pengajuanAktifBank = $pengajuan->jalur === 'Rektorat'
            && $this->cariPengajuanAktifSelain(
                $pengajuan->nim,
                $pengajuan->idPengajuan
            );

        if (
            $validated['keputusan'] === 'Diterima' &&
            $pengajuanAktifBank
        ) {
            return back()->with(
                'error',
                'Pengajuan tidak dapat disetujui karena ditemukan pengajuan aktif melalui jalur Bank.'
            );
        }

        if (
            in_array($validated['keputusan'], ['Diverifikasi', 'Ditolak']) &&
            empty(trim($validated['catatan'] ?? ''))
        ) {
            return back()->withErrors([
                'catatan' => 'Catatan wajib diisi jika data tidak lengkap atau pengajuan ditolak.'
            ])->withInput();
        }

        // Simpan keputusan dan catatan admin
        $pengajuan->update([
            'status' => $validated['keputusan'],
            'catatan' => $validated['catatan'] ?? null
        ]);

        return back()->with(
            'success',
            'Keputusan verifikasi berhasil disimpan.'
        );
    }

    // Mengecek pengajuan Bank aktif selain pengajuan yang sedang diverifikasi
    private function cariPengajuanAktifSelain($nim, $idPengajuan)
    {
        return PengajuanKTM::where('nim', $nim)
            ->where('jalur', 'Bank')
            ->whereIn('status', ['Diajukan', 'Diverifikasi'])
            ->where('idPengajuan', '!=', $idPengajuan)
            ->exists();
    }

    // Memastikan pengguna yang mengakses merupakan Admin Rektorat
    private function pastikanAdminRektorat()
    {
        $idPengguna = session('idPengguna');

        if (!$idPengguna) {
            return redirect('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $pengguna = Pengguna::find($idPengguna);

        if (!$pengguna || $pengguna->peran !== 'AdminRektorat') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return null;
    }
}
