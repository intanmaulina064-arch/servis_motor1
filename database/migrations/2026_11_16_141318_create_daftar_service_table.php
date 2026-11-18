<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daftar_service', function (Blueprint $table) {
    $table->string('id_servis_pelanggan', 20)->primary();
    $table->string('no_plat_kendaraan', 15);
    $table->string('id_pelanggan', 20);
    $table->text('keluhan_kendaraan');
    $table->date('tanggal_servis');
    $table->timestamps();

    $table->foreign('no_plat_kendaraan')
        ->references('no_plat_kendaraan')
        ->on('kendaraan')
        ->restrictOnDelete();

    $table->foreign('id_pelanggan')
        ->references('id_pelanggan')
        ->on('pelanggan')
        ->restrictOnDelete();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_service');
    }
};
