<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tm_koordinat_wifi', function (Blueprint $table) {
            // Portal API: speeds up IS NOT NULL / != '' pre-filter on bounds query
            $table->index(['latitude', 'longitude'], 'idx_wifi_coords');

            // CMS search: speeds up WHERE n_wilayah LIKE '%term%' (prefix portion)
            $table->index('n_wilayah', 'idx_wifi_n_wilayah');

            // CMS search: speeds up WHERE ssid LIKE '%term%' (prefix portion)
            $table->index('ssid', 'idx_wifi_ssid');
        });
    }

    public function down(): void
    {
        Schema::table('tm_koordinat_wifi', function (Blueprint $table) {
            $table->dropIndex('idx_wifi_coords');
            $table->dropIndex('idx_wifi_n_wilayah');
            $table->dropIndex('idx_wifi_ssid');
        });
    }
};
