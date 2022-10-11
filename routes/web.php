<?php

use App\Http\Controllers\Home;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Suplier;
use App\Http\Controllers\Pengajuan;
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
//logout admin
Route::get('/logoutAdmin', [Admin::class, 'keluarAdmin']);
//list Admin
Route::get('/listAdmin', [Admin::class, 'listAdmin']);
Route::post('/tambahAdmin', [Admin::class, 'tambahAdmin'])->name('tambahAdmin');
Route::post('/ubahAdmin', [Admin::class, 'ubahAdmin']);

//list pengajuan
Route::get('/pengajuan', [Pengajuan::class, 'index']);
