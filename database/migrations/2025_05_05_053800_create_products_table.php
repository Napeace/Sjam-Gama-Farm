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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('tipe_produk', ['SAYUR', 'ALAT'])->default('SAYUR');
            $table->text('deskripsi');
            $table->decimal('harga', 10, 2);
            $table->string('status_booking')->default('MENERIMA'); // MENERIMA or FULL BOOKED
            $table->string('status_stok')->default('TERSEDIA'); // TERSEDIA or TIDAK TERSEDIA
            $table->integer('stok')->nullable(); // Untuk produk alat
            $table->date('tanggal_tanam')->nullable();
            $table->date('prediksi_panen')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
