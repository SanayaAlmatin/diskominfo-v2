<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tm_lowongan', function (Blueprint $table) {
            $table->enum('jenis', ['pekerjaan', 'magang', 'program', 'kompetisi'])->default('pekerjaan')->after('posisi');
            $table->text('deskripsi')->nullable()->after('jenis');
            $table->json('tags')->nullable()->after('deskripsi');
            $table->string('lokasi', 150)->nullable()->after('tags');
            $table->string('tipe_kerja', 100)->nullable()->after('lokasi');
            $table->date('tanggal_tutup')->nullable()->after('tipe_kerja');
            $table->string('link_daftar')->nullable()->after('tanggal_tutup');
        });
    }

    public function down(): void
    {
        Schema::table('tm_lowongan', function (Blueprint $table) {
            $table->dropColumn(['jenis', 'deskripsi', 'tags', 'lokasi', 'tipe_kerja', 'tanggal_tutup', 'link_daftar']);
        });
    }
};
