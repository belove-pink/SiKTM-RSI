<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BerandaAdminRektoratController extends Controller
{
    public function index()
    {
        $idPengguna = session('idPengguna');

        if (!$idPengguna) {
            return redirect('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Memastikan pengguna adalah Admin Rektorat
        $admin = DB::table('Pengguna')
            ->where('idPengguna', $idPengguna)
            ->where('peran', 'AdminRektorat')
            ->first();

        if (!$admin) {
            return redirect('/login')
                ->with('error', 'Akun Admin Rektorat tidak ditemukan.');
        }

        // Total seluruh pengajuan KTM
        $totalPengajuan = DB::table('PengajuanKTM')->count();

        // Pengajuan yang sedang diproses
        $sedangDiproses = DB::table('PengajuanKTM')
            ->whereIn('status', ['Diajukan', 'Diverifikasi'])
            ->count();

        // Pengajuan yang diterima
        $diterima = DB::table('PengajuanKTM')
            ->where('status', 'Diterima')
            ->count();

        // Dua pengajuan terbaru
        $pengajuanTerbaru = DB::table('PengajuanKTM')
            ->join(
                'Pengguna',
                'PengajuanKTM.idPengguna',
                '=',
                'Pengguna.idPengguna'
            )
            ->select(
                'PengajuanKTM.idPengajuan',
                'PengajuanKTM.nim',
                'Pengguna.nama',
                'PengajuanKTM.jalur',
                'PengajuanKTM.status',
                'PengajuanKTM.tanggalPengajuan'
            )
            ->orderByDesc('PengajuanKTM.tanggalPengajuan')
            ->orderByDesc('PengajuanKTM.idPengajuan')
            ->limit(2)
            ->get();

        return view('beranda-admin-rektorat', compact(
            'admin',
            'totalPengajuan',
            'sedangDiproses',
            'diterima',
            'pengajuanTerbaru'
        ));
    }
}
