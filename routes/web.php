
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


// ======================================
// PREVIEW 1: PENGAJUAN LOLOS VALIDASI
// ======================================

Route::get('/preview-disetujui', function () {
    return view('verifikasi-pengajuan', [
        'pengajuan' => (object) [
            'idPengajuan' => 1,
            'nim' => '262600000001',
            'nama' => 'Mahasiswa Dummy',
            'namaProdi' => 'Sistem Informasi',
            'namaFakultas' => 'Fakultas Ilmu Komputer',
            'jalur' => 'Rektorat',
            'tanggalPengajuan' => '2026-11-18',
            'status' => 'Diajukan',
            'pas_foto' => null,
            'dokumen_pendukung' => null,
        ],
        'validasiLolos' => true,
        'pengajuanAktifBank' => false,
    ]);
});


// ======================================
// PREVIEW 2: PENGAJUAN GANDA
// ======================================

Route::get('/preview-pengajuan-ganda', function () {
    return view('verifikasi-pengajuan', [
        'pengajuan' => (object) [
            'idPengajuan' => 2,
            'nim' => '262600000001',
            'nama' => 'Mahasiswa Dummy',
            'namaProdi' => 'Sistem Informasi',
            'namaFakultas' => 'Fakultas Ilmu Komputer',
            'jalur' => 'Rektorat',
            'tanggalPengajuan' => '2026-11-18',
            'status' => 'Diajukan',
            'pas_foto' => null,
            'dokumen_pendukung' => null,
        ],
        'validasiLolos' => false,
        'pengajuanAktifBank' => true,
    ]);
});
