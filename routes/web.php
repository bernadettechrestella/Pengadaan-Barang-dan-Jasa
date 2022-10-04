<?php

use App\Http\Controllers\Home;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Suplier;
use App\Http\Controllers\Registrasi;
use Illuminate\Support\Facades\Route;

//mengambil data dari controller untuk di lempar ke view

//home
Route::get('/', [Home::class, 'index']);

//regis/sign up suplier
Route::get('/registrasi', [Registrasi::class, 'index']);
Route::post('/simpanRegis', [Registrasi::class, 'registrasi']);
//login suplier
Route::get('/loginSuplier', [Suplier::class, 'index']);
Route::post('/masukSuplier', [Suplier::class, 'masukSuplier']);
//logout suplier
Route::get('/logoutSuplier', [Suplier::class, 'keluarSuplier']);

//login admin
Route::get('/loginAdmin', [Admin::class, 'index']);
Route::post('/masukAdmin', [Admin::class, 'masukAdmin']);
