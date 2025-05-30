<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('training_form_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_form_id');
            $table->string('field_name'); // Nama field (contoh: "Nama Lengkap", "Email", dll)
            $table->enum('field_type', ['text', 'textarea', 'email', 'phone', 'file']); // Tipe field
            $table->text('field_description')->nullable(); // Deskripsi/placeholder field
            $table->boolean('is_required')->default(false); // Apakah field wajib diisi
            $table->integer('field_order')->default(0); // Urutan field dalam form
            $table->timestamps();

            $table->foreign('training_form_id')->references('id')->on('training_forms')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_form_fields');
    }
};
