<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Halaman Bantuan (FAQ)
class BantuanController extends Controller
{
    public function index()
    {
        // Nama di header: hanya tampil kalau sudah login (halaman ini tetap bisa dibuka tanpa login)
        $user = null;
        try {
            if (session('idPengguna')) {
                $user = DB::table('Pengguna')->where('idPengguna', session('idPengguna'))->first();
            }
        } catch (\Throwable $e) {
            $user = null; // tabel belum dimigrasi
        }

        $urlBeranda = match ($user->peran ?? null) {
            'AdminFakultas' => url('/dashboard-admin-fakultas'),
            'AdminRektorat' => url('/dashboard-admin-rektorat'),
            default         => Route::has('beranda') ? route('beranda') : url('/dashboard-mahasiswa'),
        };

        // Daftar FAQ: menambah atau mengubah pertanyaan cukup di sini
        $faq = [
            [
                'tanya' => 'Bagaimana cara mengajukan KTM baru?',
                'jawab' => 'Klik Ajukan KTM di Beranda, isi data dirimu, unggah foto dan dokumen yang diminta, lalu kirim. Kamu bisa memantau statusnya di halaman Riwayat.',
            ],
            [
                'tanya' => 'KTM saya hilang. Dokumen apa yang perlu disiapkan?',
                'jawab' => 'Siapkan pas foto 3x4 dan surat kehilangan. Unggah keduanya saat mengisi form pengajuan.',
            ],
            [
                'tanya' => 'Berapa lama proses pengajuan?',
                'jawab' => 'Admin Rektorat akan memeriksa dokumenmu. Kamu mendapat notifikasi maksimal 2x24 jam bila data tidak lengkap. Status terbarunya bisa dipantau kapan saja di halaman Status Pengajuan.',
            ],
        ];

        return view('bantuan', [
            'nama'       => $user->nama ?? null,
            'urlBeranda' => $urlBeranda,
            'urlKontak'  => Route::has('kontak-kemahasiswaan') ? route('kontak-kemahasiswaan') : '#',
            'faq'        => $faq,
        ]);
    }
}