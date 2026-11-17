<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaMahasiswaController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [AuthController::class, 'login']);

// Status pengajuan
Route::get('/status-pengajuan', function () {
    return view('status-pengajuan');
});

// Beranda mahasiswa
Route::get('/beranda-mahasiswa', [
    BerandaMahasiswaController::class,
    'index'
])->name('beranda.mahasiswa');