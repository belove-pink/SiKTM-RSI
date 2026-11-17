<?php

use App\Http\Controllers\DaftarPengajuanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Daftar Pengajuan KTM (Admin Fakultas dan Admin Rektorat)
Route::get('/daftar-pengajuan', [DaftarPengajuanController::class, 'index'])->name('daftar-pengajuan');