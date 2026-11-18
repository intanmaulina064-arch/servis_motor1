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
       Schema::create('pembayaran_service', function (Blueprint $table) {
    $table->id('id_pembayaran');
    $table->string('id_servis_pelanggan', 20);
    $table->decimal('jumlah_biaya_servis', 12, 2);
    $table->enum('jenis_pembayaran', [
        'Tunai',
        'Non Tunai'
    ])->nullable();
    $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('pembayaran_service');
    }
};
