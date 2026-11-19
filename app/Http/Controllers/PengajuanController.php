<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{
    // Halaman konfirmasi pengajuan berhasil (UI Pengajuan Terkirim)
    public function terkirim()
    {
        $idPengguna = session('idPengguna');
        if (!$idPengguna) {
            return redirect('/login')->with('error', 'Silakan masuk terlebih dahulu');
        }

        $pengguna = DB::table('Pengguna')->where('idPengguna', $idPengguna)->first();

        // Pengajuan terbaru milik mahasiswa ini
        $pengajuan = DB::table('PengajuanKTM')
            ->where('idPengguna', $idPengguna)
            ->orderByDesc('idPengajuan')
            ->first();

        if (!$pengajuan) {
            return redirect('/beranda-mahasiswa')->with('error', 'Belum ada pengajuan');
        }

        return view('pengajuan-terkirim', [
            'namaMahasiswa' => $pengguna->nama ?? null,
            'alasan'        => session('alasan', 'KTM baru'),
            'jalur'         => $pengajuan->jalur,
            'tanggal'       => Carbon::parse($pengajuan->tanggalPengajuan)
                                    ->locale('id')->translatedFormat('d F Y'),
        ]);
    }
}