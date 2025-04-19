<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->id(); // id_artikel
            $table->string('judul');
            $table->text('isi');
            $table->string('gambar')->nullable(); // nama file gambar
            $table->date('tanggal_publikasi')->nullable();
            $table->string('kategori'); // hanya untuk informasi
            $table->unsignedBigInteger('user_id'); // relasi ke mitra
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};
