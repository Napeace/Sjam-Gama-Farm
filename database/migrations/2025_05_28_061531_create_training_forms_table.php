<?php

// Migration 1: create_training_forms_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('training_forms', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul pelatihan
            $table->text('description')->nullable(); // Deskripsi pelatihan
            $table->integer('max_quota'); // Kuota maksimal peserta
            $table->integer('current_quota')->default(0); // Kuota saat ini (yang sudah daftar)
            $table->date('training_date'); // Tanggal pelatihan
            $table->time('training_time')->nullable(); // Waktu pelatihan
            $table->text('location')->nullable(); // Lokasi pelatihan
            $table->text('location_url')->nullable(); // Link Google Maps
            $table->decimal('price', 10, 2)->default(0); // Harga pelatihan (0 = gratis)
            $table->boolean('is_active')->default(true); // Status aktif/nonaktif
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_forms');
    }
};
