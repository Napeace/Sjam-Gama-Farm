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
        Schema::create('training_videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('youtube_url');
            $table->string('youtube_video_id')->nullable(); // untuk menyimpan ID video YouTube

            $table->unsignedBigInteger('mitra_id')->nullable(); // jika video dibuat oleh mitra tertentu
            $table->boolean('is_active')->default(true);
            $table->string('thumbnail_url')->nullable(); // thumbnail dari YouTube
            $table->integer('view_count')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_videos');
    }
};
