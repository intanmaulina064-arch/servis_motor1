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
     Schema::create('data_service', function (Blueprint $table) {
    $table->id('id_data_service');
    $table->string('id_servis_pelanggan', 20);
    $table->text('estimasi_service');
    $table->string('nama_mekanik', 100);
    $table->text('sparepart_pengganti')->nullable();
    $table->timestamps();

    $table->foreign('id_servis_pelanggan')
        ->references('id_servis_pelanggan')
        ->on('daftar_service')
        ->restrictOnDelete();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_service');
    }
};
