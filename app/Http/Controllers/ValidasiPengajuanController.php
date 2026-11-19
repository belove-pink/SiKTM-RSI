<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanKTM;
use App\Models\Pengguna;
use App\Models\Mahasiswa;

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


    // Memvalidasi dan menyimpan pengajuan KTM
    public function validasiPengajuanGanda(Request $request)
    {
        // Memastikan pengguna sudah login
        $idPengguna = session('idPengguna');

        if (!$idPengguna) {
            return redirect('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Memvalidasi input formulir
        $validated = $request->validate([
            'nim' => 'required|string|max:20',
            'jalur' => 'required|in:Rektorat,Bank',
            'dokumen' => 'required|string|max:255'
        ]);

        $nim = $validated['nim'];
        $jalur = $validated['jalur'];
        $dokumen = $validated['dokumen'];

        // Mengambil data pengguna yang sedang login
        $pengguna = Pengguna::find($idPengguna);

        // Memastikan akun merupakan mahasiswa dan NIM sesuai
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

        // Memastikan data mahasiswa tersedia di tabel Mahasiswa
        $mahasiswa = Mahasiswa::where('idPengguna', $idPengguna)
            ->exists();

        if (!$mahasiswa) {
            return back()->with(
                'error',
                'Data mahasiswa belum terdaftar.'
            );
        }

        // Mengecek pengajuan Bank yang masih aktif
        $pengajuanAktif = $this->cariPengajuanAktif($nim);

        // Menolak pengajuan Rektorat jika masih ada pengajuan Bank aktif
        if ($jalur === 'Rektorat' && $pengajuanAktif) {
            return back()->with(
                'error',
                'Anda masih memiliki pengajuan KTM aktif melalui jalur Bank.'
            );
        }

        // Menyimpan pengajuan KTM ke database
        $pengajuan = PengajuanKTM::create([
            'idPengguna' => $idPengguna,
            'nim' => $nim,
            'jalur' => $jalur,
            'dokumen' => $dokumen,
            'status' => 'Diajukan',
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

        $pengajuan = PengajuanKTM::findOrFail($idPengajuan);

        // Mengecek apakah terdapat pengajuan Bank aktif lainnya
        $pengajuanAktifBank = PengajuanKTM::where('nim', $pengajuan->nim)
            ->where('jalur', 'Bank')
            ->whereIn('status', ['Diajukan', 'Diverifikasi'])
            ->where('idPengajuan', '!=', $idPengajuan)
            ->exists();

        // Menentukan hasil validasi pengajuan
        $validasiLolos = !(
            $pengajuan->jalur === 'Rektorat' && $pengajuanAktifBank
        );

        return view('verifikasi-pengajuan', compact(
            'pengajuan',
            'validasiLolos'
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

        // Memvalidasi keputusan Admin Rektorat
        $validated = $request->validate([
            'keputusan' => 'required|in:Diterima,Ditolak'
        ]);

        // Mengubah status pengajuan sesuai keputusan
        $pengajuan->update([
            'status' => $validated['keputusan']
        ]);

        return back()->with(
            'success',
            'Keputusan verifikasi berhasil disimpan.'
        );
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