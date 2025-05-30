<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('training_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_form_id');
            $table->string('name'); // Nama customer
            $table->string('email');
            $table->text('answers'); // Jawaban form dalam format JSON
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Status persetujuan
            $table->timestamp('registered_at')->useCurrent();
            $table->timestamps();

            $table->foreign('training_form_id')->references('id')->on('training_forms')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_registrations');
    }
};
