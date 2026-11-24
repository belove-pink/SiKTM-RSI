<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KontrolRekap extends Controller
{
    // Method utama menampilkan rekapitulasi KTM (ZN-PC07)
    // Admin Fakultas melihat fakultasnya sendiri, Admin Rektorat melihat semua fakultas
    public function tampilkanRekapitulasi(Request $request)
    {
        // Ambil akun admin dari sesi login
        $idPengguna = session('idPengguna');

        $admin = $idPengguna
            ? DB::table('Pengguna')->where('idPengguna', $idPengguna)->first()
            : null;

        if (!$admin) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $rektorat = $admin->peran === 'AdminRektorat';

        if (!$rektorat && $admin->peran !== 'AdminFakultas') {
            abort(403, 'Halaman ini hanya untuk admin.');
        }

        if (!$rektorat && !$admin->idFakultas) {
            abort(403, 'Akun admin fakultas belum terhubung ke fakultas.');
        }

        // null = semua fakultas (Admin Rektorat)
        $idFakultas = $rektorat ? null : $admin->idFakultas;

        // Baca kata kunci dan filter
        $kataKunci = trim((string) $request->input('kataKunci', ''));
        $prodi     = $request->input('prodi');
        $angkatan  = $request->input('angkatan');
        $status    = $request->input('status');

        // Ambil rekap sesuai filter
        if ($prodi || $angkatan || $status || $kataKunci !== '') {
            $dataRekap = $this->filterRekap($idFakultas, $status, $angkatan, $prodi, $kataKunci);
        } else {
            $dataRekap = $this->ambilRekap($idFakultas);
        }

        // Jika data tidak ditemukan, tampilkan pesan di halaman yang sama
        $dataRekap['pesan'] = empty($dataRekap['daftar'])
            ? 'Data rekap tidak ditemukan'
            : null;

        // Daftar prodi untuk dropdown filter
        $dataRekap['daftarProdi'] = DB::table('ProgramStudi')
            ->when($idFakultas, fn ($q) => $q->where('idFakultas', $idFakultas))
            ->orderBy('namaProdi')
            ->get();

        $dataRekap['namaAdmin']      = $admin->nama;
        $dataRekap['adalahRektorat'] = $rektorat;

        return view('rekap-ktm', $dataRekap);
    }

    // Mengambil rekap tanpa filter
    public function ambilRekap($idFakultas)
    {
        return $this->filterRekap($idFakultas, null, null, null, null);
    }

    // Mengambil rekap dengan filter ($idFakultas null = semua fakultas)
    public function filterRekap($idFakultas, $status, $angkatan, $prodi, $kataKunci = null)
    {
        // Ambil mahasiswa sesuai filter fakultas, angkatan, prodi, dan kata kunci NIM
        $daftarMahasiswa = DB::table('Mahasiswa')
            ->join('Pengguna', 'Mahasiswa.idPengguna', '=', 'Pengguna.idPengguna')
            ->join('ProgramStudi', 'Mahasiswa.idProdi', '=', 'ProgramStudi.idProdi')
            ->where('Pengguna.peran', 'Mahasiswa')
            ->when($idFakultas, fn ($q) => $q->where('ProgramStudi.idFakultas', $idFakultas))
            ->when($angkatan, fn ($q) => $q->where('Mahasiswa.angkatan', $angkatan))
            ->when($prodi, fn ($q) => $q->where('Mahasiswa.idProdi', $prodi))
            ->when($kataKunci, fn ($q) => $q->where('Pengguna.nim', 'like', "%{$kataKunci}%"))
            ->select('Mahasiswa.idPengguna', 'Pengguna.nim', 'ProgramStudi.namaProdi')
            ->orderBy('Pengguna.nim')
            ->get();

        // Ambil pengajuan terbaru tiap mahasiswa (yang paling akhir menimpa yang lama)
        $pengajuanTerbaru = DB::table('PengajuanKTM')
            ->whereIn('idPengguna', $daftarMahasiswa->pluck('idPengguna'))
            ->orderBy('idPengajuan')
            ->get()
            ->keyBy('idPengguna');

        // Jika ada filter status, sisakan mahasiswa dengan kategori yang sama
        if ($status) {
            $daftarMahasiswa = $daftarMahasiswa->filter(
                fn ($m) => $this->kategoriKTM(
                    $pengajuanTerbaru->get($m->idPengguna)->status ?? null
                ) === $status
            );
        }

        return $this->hitungRekap($daftarMahasiswa, $pengajuanTerbaru);
    }

    // Menghitung total, jumlah per kategori, dan persentase
    public function hitungRekap($daftarMahasiswa, $pengajuanTerbaru)
    {
        $belum  = 0;
        $proses = 0;
        $sudah  = 0;
        $daftar = [];

        foreach ($daftarMahasiswa as $m) {
            $pengajuan = $pengajuanTerbaru->get($m->idPengguna);
            $kategori  = $this->kategoriKTM($pengajuan->status ?? null);

            if ($kategori === 'Sudah Memiliki KTM') {
                $sudah++;
            } elseif ($kategori === 'Sedang Diproses') {
                $proses++;
            } else {
                $belum++;
            }

            $daftar[] = [
                'nim'         => $m->nim,
                'prodi'       => $m->namaProdi,
                'status'      => $kategori,
                'idPengajuan' => $pengajuan->idPengajuan ?? null,
            ];
        }

        $total = count($daftar);

        return [
            'total'      => $total,
            'belum'      => $belum,
            'proses'     => $proses,
            'sudah'      => $sudah,
            'persentase' => $total > 0 ? round($sudah / $total * 100, 1) : 0,
            'daftar'     => $daftar,
        ];
    }

    // Mengelompokkan status pengajuan menjadi kategori rekap
    private function kategoriKTM($status)
    {
        if ($status === 'Diterima') {
            return 'Sudah Memiliki KTM';
        }

        if ($status === 'Diajukan' || $status === 'Diverifikasi') {
            return 'Sedang Diproses';
        }

        // Belum ada pengajuan atau pengajuan ditolak
        return 'Belum Mengajukan';
    }
}