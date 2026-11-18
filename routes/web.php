<?php

use App\Http\Controllers\KontakController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Kontak Kemahasiswaan
Route::get('/kontak-kemahasiswaan', [KontakController::class, 'index'])->name('kontak-kemahasiswaan');