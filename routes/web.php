<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/beranda-mahasiswa', function () {
    return view('beranda-mahasiswa');
});