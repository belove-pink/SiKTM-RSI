<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KontrolRekap extends Controller
{
    // Method utama menampilkan rekapitulasi KTM (ZN-PC07)
    public function tampilkanRekapitulasi(Request $request)
    {
        // Ambil fakultas admin dari sesi login
        $idFakultas = session('idFakultas');

        // Baca kata kunci dan filter
        $kataKunci = $request->input('kataKunci');
        $prodi = $request->input('prodi');
        $angkatan = $request->input('angkatan');
        $status = $request->input('status');

        // Ambil rekap sesuai filter
        if ($prodi || $angkatan || $status) {
            $dataRekap = $this->filterRekap(
                $idFakultas,
                $status,
                $angkatan,
                $prodi
            );
        } else {
            $dataRekap = $this->ambilRekap($idFakultas);
        }

        // Saring daftar berdasarkan kata kunci NIM
        if ($kataKunci) {
            $dataRekap['daftar'] = array_filter(
                $dataRekap['daftar'],
                function ($baris) use ($kataKunci) {
                    return stripos($baris['nim'], $kataKunci) !== false;
                }
            );
        }

        // Jika data tidak ditemukan, tampilkan pesan
        if (empty($dataRekap['daftar'])) {
            return back()->with('error', 'Data rekap tidak ditemukan');
        }

        return view('rekap-ktm', $dataRekap);
    }

    // Mengambil rekap satu fakultas tanpa filter
    public function ambilRekap($idFakultas)
    {
        return $this->filterRekap($idFakultas, null, null, null);
    }

    // Mengambil rekap satu fakultas dengan filter
    public function filterRekap($idFakultas, $status, $angkatan, $prodi)
    {
        // Ambil mahasiswa fakultas sesuai filter angkatan dan prodi
        $daftarMahasiswa = DB::table('Mahasiswa')
            ->join('Pengguna', 'Mahasiswa.idPengguna', '=', 'Pengguna.idPengguna')
            ->join('ProgramStudi', 'Mahasiswa.idProdi', '=', 'ProgramStudi.idProdi')
            ->where('Pengguna.idFakultas', $idFakultas)
            ->when($angkatan, fn ($q) => $q->where('Mahasiswa.angkatan', $angkatan))
            ->when($prodi, fn ($q) => $q->where('Mahasiswa.idProdi', $prodi))
            ->select('Mahasiswa.idPengguna', 'Pengguna.nim', 'ProgramStudi.namaProdi')
            ->get();

        // Ambil status pengajuan terbaru tiap mahasiswa
        $daftarStatus = DB::table('PengajuanKTM')
            ->whereIn('idPengguna', $daftarMahasiswa->pluck('idPengguna'))
            ->orderBy('idPengajuan')
            ->pluck('status', 'idPengguna');

        // Jika ada filter status, sisakan mahasiswa dengan kategori yang sama
        if ($status) {
            $daftarMahasiswa = $daftarMahasiswa->filter(
                fn ($m) => $this->kategoriKTM(
                    $daftarStatus->get($m->idPengguna)
                ) === $status
            );
        }

        return $this->hitungRekap($daftarMahasiswa, $daftarStatus);
    }

    // Menghitung total, jumlah per kategori, dan persentase
    public function hitungRekap($daftarMahasiswa, $daftarStatus)
    {
        $belum = 0;
        $proses = 0;
        $sudah = 0;
        $daftar = [];

        foreach ($daftarMahasiswa as $m) {
            $kategori = $this->kategoriKTM(
                $daftarStatus->get($m->idPengguna)
            );

            if ($kategori === 'Sudah Memiliki KTM') {
                $sudah++;
            } elseif ($kategori === 'Sedang Diproses') {
                $proses++;
            } else {
                $belum++;
            }

            $daftar[] = [
                'nim' => $m->nim,
                'prodi' => $m->namaProdi,
                'status' => $kategori
            ];
        }

        $total = count($daftar);

        return [
            'total' => $total,
            'belum' => $belum,
            'proses' => $proses,
            'sudah' => $sudah,
            'persentase' => $total > 0 ? round($sudah / $total * 100, 1) : 0,
            'daftar' => $daftar,
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
