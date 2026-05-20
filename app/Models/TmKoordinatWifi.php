<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TmKoordinatWifi extends Model
{
    use HasFactory;

    protected $table = 'tm_koordinat_wifi';

    protected $fillable = [
        'n_wilayah',
        'latitude',
        'longitude',
        'keterangan',
        'kecepatan',
        'ssid',
    ];

    public function scopeWithCoordinates(Builder $query): Builder
    {
        return $query
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('latitude', '!=', '')
            ->where('longitude', '!=', '');
    }
}
