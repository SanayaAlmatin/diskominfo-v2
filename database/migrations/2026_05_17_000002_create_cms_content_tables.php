<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tm_visi_misi', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['visi', 'misi'])->index();
            $table->text('konten');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('tm_sotk', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->string('nama_sotk');
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->boolean('is_current')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('tm_tik_stats', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->string('label');
            $table->string('nilai');
            $table->string('satuan')->nullable();
            $table->string('icon')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tm_tik_stats');
        Schema::dropIfExists('tm_sotk');
        Schema::dropIfExists('tm_visi_misi');
    }
};
