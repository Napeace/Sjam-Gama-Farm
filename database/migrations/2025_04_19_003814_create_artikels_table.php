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
            $table->id();
            $table->string('judul', 255);
            $table->string('slug')->unique(); // URL-friendly version of title
            $table->longText('isi'); // Using longText for potentially long articles
            $table->string('gambar')->nullable(); // path to image file
            $table->string('thumbnail')->nullable(); // path to thumbnail image
            $table->date('tanggal_publikasi')->nullable();
            $table->boolean('is_published')->default(false); // Publication status
            $table->string('kategori')->index(); // Adding index for faster queries
            $table->unsignedBigInteger('user_id');
            $table->integer('view_count')->default(0); // For tracking article popularity
            $table->timestamps();

            // Add indexes for columns commonly used in WHERE clauses
            $table->index('tanggal_publikasi');
            $table->index('is_published');
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
