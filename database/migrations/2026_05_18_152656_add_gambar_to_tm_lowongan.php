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
        Schema::table('tm_lowongan', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('link_daftar');
        });
    }

    public function down(): void
    {
        Schema::table('tm_lowongan', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
};
