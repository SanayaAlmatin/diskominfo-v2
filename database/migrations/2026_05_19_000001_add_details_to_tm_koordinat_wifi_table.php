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
        Schema::table('tm_koordinat_wifi', function (Blueprint $table) {
            $table->text('keterangan')->nullable()->after('longitude');
            $table->string('kecepatan')->nullable()->after('keterangan');
            $table->string('ssid')->nullable()->after('kecepatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tm_koordinat_wifi', function (Blueprint $table) {
            $table->dropColumn(['keterangan', 'kecepatan', 'ssid']);
        });
    }
};
