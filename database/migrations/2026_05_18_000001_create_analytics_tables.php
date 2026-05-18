<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tm_lowongan', function (Blueprint $table) {
            $table->id();
            $table->string('posisi');
            $table->enum('status', ['buka', 'tutup'])->default('buka');
            $table->timestamps();
        });

        Schema::create('tm_page_visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45);
            $table->string('page');
            $table->timestamp('created_at')->nullable()->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tm_page_visits');
        Schema::dropIfExists('tm_lowongan');
    }
};
