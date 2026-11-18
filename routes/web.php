<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\DaftarServiceController;
use App\Http\Controllers\DataServiceController;
use App\Http\Controllers\PembayaranServiceController;

Route::get('/', function () {
    return redirect()->route('pelanggan.index');
});

Route::resource('pelanggan', PelangganController::class);

Route::resource('kendaraan', KendaraanController::class);

Route::resource(
    'daftar-service',
    DaftarServiceController::class
);

Route::resource(
    'data-service',
    DataServiceController::class
);

Route::resource(
    'pembayaran',
    PembayaranServiceController::class
);