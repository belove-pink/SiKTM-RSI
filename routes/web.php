<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaMahasiswaController;
use App\Models\Pengguna;
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

// Dashboard admin rektorat
Route::get('/dashboard-admin-rektorat', function () {
    $akun = Pengguna::find(session('idPengguna'));

    if (!$akun) {
        return redirect('/login');
    }

    if ($akun->peran !== 'AdminRektorat') {
        abort(403);
    }

    return view('beranda-admin-rektorat', [
        'admin' => $akun
    ]);
});

// Dashboard admin fakultas
Route::get('/dashboard-admin-fakultas', function () {
    $akun = Pengguna::find(session('idPengguna'));

    if (!$akun) {
        return redirect('/login');
    }

    if ($akun->peran !== 'AdminFakultas') {
        abort(403);
    }

    return view('beranda-admin-fakultas', [
        'admin' => $akun
    ]);
});


// Status pengajuan
Route::get('/status-pengajuan', function () {
    return view('status-pengajuan');
});

// Beranda mahasiswa
Route::get('/beranda-mahasiswa', [
    BerandaMahasiswaController::class,
    'index'
])->name('beranda.mahasiswa');