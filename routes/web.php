
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\DaftarServiceController;
use App\Http\Controllers\DataServiceController;
use App\Http\Controllers\PembayaranServiceController;

// HALAMAN UTAMA
Route::get('/', function () {
    return redirect()->route('pelanggan.index');
});

// WEB PELANGGAN
Route::resource('pelanggan', PelangganController::class);

// WEB KENDARAAN
Route::resource('kendaraan', KendaraanController::class);

// WEB DAFTAR SERVICE
Route::resource('daftar-service', DaftarServiceController::class);

// WEB DATA SERVICE
Route::resource('data-service', DataServiceController::class);

// WEB PEMBAYARAN
Route::resource('pembayaran', PembayaranServiceController::class);
