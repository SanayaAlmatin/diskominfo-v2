<?php

namespace Tests\Feature;

use App\Models\TmKoordinatWifi;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class WifiLocationControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        if (!Schema::hasTable('tm_koordinat_wifi')) {
            Schema::create('tm_koordinat_wifi', function (Blueprint $table): void {
                $table->id();
                $table->string('n_wilayah')->nullable();
                $table->string('latitude')->nullable();
                $table->string('longitude')->nullable();
                $table->text('keterangan')->nullable();
                $table->string('kecepatan')->nullable();
                $table->string('ssid')->nullable();
                $table->timestamps();
            });
        }
    }

    public function test_it_returns_normalized_wifi_locations_inside_the_requested_bounds(): void
    {
        TmKoordinatWifi::create([
            'n_wilayah' => 'Taman Kota',
            'latitude' => '-63.277340',
            'longitude' => '106.682478',
            'keterangan' => 'Dekat gerbang utama',
            'kecepatan' => '50 Mbps',
            'ssid' => 'Tangsel Free Wifi',
        ]);

        $response = $this->getJson(route('wifi.locations', [
            'north' => -6.0,
            'south' => -6.4,
            'east' => 106.8,
            'west' => 106.6,
            'zoom' => 13,
        ]));

        $response
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment([
                'n_wilayah' => 'Taman Kota',
                'latitude' => -6.327734,
                'longitude' => 106.682478,
            ]);
    }
}
