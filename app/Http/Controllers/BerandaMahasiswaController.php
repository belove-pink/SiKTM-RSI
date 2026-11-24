<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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

        // Menentukan kolom nim ada di tabel mana (Pengguna atau Mahasiswa)
        $kolomSelect = [
            'Pengguna.idPengguna',
            'Pengguna.nama',
            'Pengguna.peran',
        ];

        if (Schema::hasColumn('Pengguna', 'nim')) {
            $kolomSelect[] = 'Pengguna.nim';
        } elseif (Schema::hasColumn('Mahasiswa', 'nim')) {
            $kolomSelect[] = 'Mahasiswa.nim';
        }

        // Mengambil data mahasiswa yang sedang login
        // leftJoin: tetap ketemu walau baris di tabel Mahasiswa belum ada
        $mahasiswa = DB::table('Pengguna')
            ->leftJoin(
                'Mahasiswa',
                'Pengguna.idPengguna',
                '=',
                'Mahasiswa.idPengguna'
            )
            ->where('Pengguna.idPengguna', $idPengguna)
            ->whereRaw('LOWER(TRIM("Pengguna"."peran")) = ?', ['mahasiswa'])
            ->select($kolomSelect)
            ->first();

        // Memastikan data mahasiswa tersedia
        if (!$mahasiswa) {
            // Hapus session supaya tidak terjadi loop redirect
            session()->forget('idPengguna');

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