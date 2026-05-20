<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tm_youtube_videos', function (Blueprint $table) {
            $table->id();
            $table->string('youtube_id')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('channel_name')->default('Diskominfo Tangsel Official');
            $table->timestamp('published_at');
            $table->string('duration')->default('N/A');
            $table->string('thumbnail_url')->nullable();
            $table->integer('view_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamp('synced_at')->nullable();
            $table->timestamps();

            $table->index('published_at');
            $table->index('is_active');
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tm_youtube_videos');
    }
};
