<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Halaman Kontak Kemahasiswaan
class KontakController extends Controller
{
    // Data kontak: GANTI dengan data Kemahasiswaan yang sebenarnya
    private const KONTAK = [
        'gedung'  => '[Nama gedung Kemahasiswaan]',
        'kota'    => 'Universitas Brawijaya, Malang',
        'hari'    => 'Senin sampai Jumat',
        'jam'     => '08.00 sampai 15.00 WIB',
        'email'   => 'kemahasiswaan@example.com',
        'telepon' => '[nomor telepon]',
    ];

    public function index()
    {
        // Nama dan NIM hanya tersedia kalau sudah login (halaman tetap bisa dibuka tanpa login)
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

        // Isi email yang sudah terisi otomatis
        $email  = self::KONTAK['email'];
        $subjek = 'Pertanyaan seputar KTM';
        $isi    = "Halo Kemahasiswaan,\n\n[Tulis pertanyaan atau kendalamu di sini]\n";
        if ($user) {
            $isi .= "\nNama: {$user->nama}\nNIM: {$user->nim}";
        }

        $mailto = 'mailto:' . $email
            . '?subject=' . rawurlencode($subjek)
            . '&body=' . rawurlencode($isi);

        $gmail = 'https://mail.google.com/mail/?view=cm&fs=1'
            . '&to=' . rawurlencode($email)
            . '&su=' . rawurlencode($subjek)
            . '&body=' . rawurlencode($isi);

        return view('kontak-kemahasiswaan', [
            'nama'       => $user->nama ?? null,
            'urlBeranda' => $urlBeranda,
            'urlBantuan' => Route::has('bantuan') ? route('bantuan') : '#',
            'kontak'     => self::KONTAK,
            'mailto'     => $mailto,
            'gmail'      => $gmail,
        ]);
    }
}