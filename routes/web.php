<?php

use App\Http\Controllers\TrackStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Track Status Pengajuan KTM (AN-UC04)
Route::get('/status-pengajuan', [TrackStatusController::class, 'index'])->name('status-pengajuan');
Route::post('/status-pengajuan', [TrackStatusController::class, 'kirimNIM'])->name('status-pengajuan.kirim');