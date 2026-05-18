<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tm_sejarah')) {
            Schema::create('tm_sejarah', function (Blueprint $table) {
                $table->id();
                $table->longText('content');
                $table->string('gambar')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('tm_info_banner')) {
            Schema::create('tm_info_banner', function (Blueprint $table) {
                $table->id();
                $table->string('description');
                $table->string('image')->nullable();
                $table->string('link_url')->nullable();
                $table->boolean('is_active')->default(true);
                $table->softDeletes();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('tm_bidang_statistik')) {
            Schema::create('tm_bidang_statistik', function (Blueprint $table) {
                $table->id();
                $table->string('n_bidang');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('tm_file_bidang_statistik')) {
            Schema::create('tm_file_bidang_statistik', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_bidang')->constrained('tm_bidang_statistik')->onDelete('cascade');
                $table->string('deskripsi');
                $table->string('file');
                $table->string('type', 20)->nullable();
                $table->date('d_entry')->nullable();
                $table->date('d_update')->nullable();
                $table->unsignedBigInteger('size')->nullable();
            });
        }

        if (!Schema::hasTable('tm_news')) {
            Schema::create('tm_news', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->longText('content')->nullable();
                $table->string('description_image')->nullable();
                $table->unsignedInteger('view_count')->default(0);
                $table->enum('status', ['draft', 'published'])->default('draft');
                $table->timestamp('published_at')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tm_news');
        Schema::dropIfExists('tm_file_bidang_statistik');
        Schema::dropIfExists('tm_bidang_statistik');
        Schema::dropIfExists('tm_info_banner');
        Schema::dropIfExists('tm_sejarah');
    }
};
