<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tm_jenis_lowongan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('warna', 50)->default('bg-gray-50 text-gray-700 border-gray-200');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tm_jenis_lowongan');
    }
};
