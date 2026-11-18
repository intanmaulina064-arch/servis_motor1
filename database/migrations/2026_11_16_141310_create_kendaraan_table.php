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
       Schema::create('kendaraan', function (Blueprint $table) {
    $table->string('no_plat_kendaraan', 15)->primary();
    $table->string('id_pelanggan', 20);
    $table->enum('jenis_kendaraan', [
        'Matic',
        'Manual Transmisi'
    ]);
    $table->string('no_stnk', 30);
    $table->year('tahun_pembuatan');
    $table->string('nama_pemilik', 100);
    $table->string('warna_kendaraan', 50);
    $table->timestamps();

    $table->foreign('id_pelanggan')
        ->references('id_pelanggan')
        ->on('pelanggan')
        ->cascadeOnUpdate()
        ->restrictOnDelete();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
