
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ValidasiPengajuanController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Halaman login
Route::get('/login', function () {
    return view('login');
});

// Proses login
Route::post('/login', [AuthController::class, 'login']);

// Mengecek pengajuan KTM aktif berdasarkan NIM
Route::get('/pengajuan-ktm/cek/{nim}', [
    ValidasiPengajuanController::class,
    'cariPengajuanAktif'
]);

// Memvalidasi dan menyimpan pengajuan KTM
Route::post('/pengajuan-ktm', [
    ValidasiPengajuanController::class,
    'validasiPengajuanGanda'
]);

// Halaman verifikasi pengajuan KTM
Route::get('/pengajuan-ktm/verifikasi/{idPengajuan}', [
    ValidasiPengajuanController::class,
    'halamanVerifikasi'
])->name('pengajuan-ktm.verifikasi');

// Menyimpan keputusan verifikasi
Route::post('/pengajuan-ktm/verifikasi/{idPengajuan}', [
    ValidasiPengajuanController::class,
    'simpanKeputusan'
])->name('pengajuan-ktm.keputusan');

// Preview tampilan UI-07 tanpa database
Route::get('/verifikasi-ktm', function () {
    return view('verifikasi-pengajuan', [
        'pengajuan' => (object) [
            'idPengajuan' => 1,
            'nim' => '245150200111001',
            'jalur' => 'Rektorat',
            'tanggalPengajuan' => '2026-11-12',
            'status' => 'Diajukan',
            'dokumen' => 'Surat Pengajuan KTM.pdf',
            'mahasiswa' => (object) [
                'nama' => 'Contoh Mahasiswa'
            ]
        ],
        'validasiLolos' => true
    ]);
});
