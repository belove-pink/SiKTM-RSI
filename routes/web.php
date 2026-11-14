<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaMahasiswaController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Beranda mahasiswa
Route::get('/beranda-mahasiswa', [
    BerandaMahasiswaController::class,
    'index'
])->name('beranda.mahasiswa');