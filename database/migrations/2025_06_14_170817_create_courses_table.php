<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method creates the 'courses' table with fields necessary
     * to store course-related information such as title, description,
     * category, media (thumbnail and video), SEO-friendly slug, difficulty level,
     * and publication status.
     *
     * @return void
     */

    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('video_url')->nullable();
            $table->string('slug')->unique();
            $table->string('level')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
