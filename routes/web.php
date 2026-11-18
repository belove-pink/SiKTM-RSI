<?php

use App\Http\Controllers\BantuanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Bantuan (FAQ)
Route::get('/bantuan', [BantuanController::class, 'index'])->name('bantuan');