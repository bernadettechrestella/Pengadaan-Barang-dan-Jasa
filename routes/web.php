<?php

use App\Http\Controllers\Home;
use App\Http\Controllers\Registrasi;
use App\Http\Controllers\Suplier;
use Illuminate\Support\Facades\Route;

//mengambil data dari controller untuk di lempar ke view

Route::get('/', [Home::class, 'index']);

Route::get('/registrasi', [Registrasi::class, 'index']);

// Route::post('/simpanRegis', 'Registrasi@registrasi');

Route::post('/simpanRegis', [Registrasi::class, 'registrasi']);

Route::get('/loginSuplier', [Suplier::class, 'index']);

Route::post('/masukSuplier', [Suplier::class, 'masukSuplier']);
