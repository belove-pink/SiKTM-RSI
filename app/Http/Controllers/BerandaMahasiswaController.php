<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BerandaMahasiswaController extends Controller
{
    // Menampilkan halaman beranda mahasiswa
    public function index()
    {
        // Mengambil ID pengguna dari session login
        $idPengguna = session('idPengguna');

        // Memastikan pengguna sudah login
        if (!$idPengguna) {
            return redirect('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Mengambil data mahasiswa yang sedang login
        $mahasiswa = DB::table('Pengguna')
            ->join(
                'Mahasiswa',
                'Pengguna.idPengguna',
                '=',
                'Mahasiswa.idPengguna'
            )
            ->where('Pengguna.idPengguna', $idPengguna)
            ->where('Pengguna.peran', 'Mahasiswa')
            ->select(
                'Pengguna.idPengguna',
                'Pengguna.nim',
                'Pengguna.nama'
            )
            ->first();

        // Memastikan data mahasiswa tersedia
        if (!$mahasiswa) {
            return redirect('/login')
                ->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        // Mengambil pengajuan KTM terbaru
        $pengajuanTerbaru = DB::table('PengajuanKTM')
            ->where('idPengguna', $idPengguna)
            ->orderByDesc('tanggalPengajuan')
            ->orderByDesc('idPengajuan')
            ->first();

        // Mengambil riwayat pengajuan selain pengajuan terbaru
        $queryRiwayat = DB::table('PengajuanKTM')
            ->where('idPengguna', $idPengguna);

        if ($pengajuanTerbaru) {
            $queryRiwayat->where(
                'idPengajuan',
                '!=',
                $pengajuanTerbaru->idPengajuan
            );
        }

        $riwayatPengajuan = $queryRiwayat
            ->orderByDesc('tanggalPengajuan')
            ->orderByDesc('idPengajuan')
            ->get();

        // Mengirim data ke halaman beranda
        return view('beranda-mahasiswa', compact(
            'mahasiswa',
            'pengajuanTerbaru',
            'riwayatPengajuan'
        ));
    }
}