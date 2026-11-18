<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiwayatPengajuanController;

Route::get('/', function () {
    return view('welcome');
});

// Halaman Riwayat Pengajuan
Route::get('/preview-riwayat-pengajuan', [
    RiwayatPengajuanController::class,
    'index'
])->name('riwayat.pengajuan');