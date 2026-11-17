<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaMahasiswaController;
use App\Http\Controllers\BerandaAdminFakultasController;
use App\Http\Controllers\BerandaAdminRektoratController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Beranda mahasiswa
Route::get('/beranda-mahasiswa', [
    BerandaMahasiswaController::class,
    'index'
])->name('beranda.mahasiswa');

// Beranda Admin Fakultas
Route::get('/beranda-admin-fakultas', [
    BerandaAdminFakultasController::class,
    'index'
])->name('beranda.admin.fakultas');

// Beranda Admin Rektorat
Route::get('/beranda-admin-rektorat', [
    BerandaAdminRektoratController::class,
    'index'
])->name('beranda.admin.rektorat');