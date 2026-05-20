<?php

use App\Support\WifiCoordinateNormalizer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tm_koordinat_wifi')) {
            return;
        }

        DB::table('tm_koordinat_wifi')
            ->select(['id', 'latitude', 'longitude'])
            ->orderBy('id')
            ->chunkById(200, function ($rows): void {
                foreach ($rows as $row) {
                    $coordinates = WifiCoordinateNormalizer::normalizeForStorage($row->latitude, $row->longitude);

                    if ($coordinates === null) {
                        continue;
                    }

                    if ($coordinates['latitude'] === $row->latitude && $coordinates['longitude'] === $row->longitude) {
                        continue;
                    }

                    DB::table('tm_koordinat_wifi')
                        ->where('id', $row->id)
                        ->update($coordinates);
                }
            });
    }

    public function down(): void
    {
    }
};
