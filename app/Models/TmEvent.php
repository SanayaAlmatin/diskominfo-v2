<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmEvent extends Model
{
    use HasFactory;

    protected $table = 'tm_events';

    protected $fillable = [
        'label',
        'name',
        'start_date',
        'end_date',
        'time',
        'location',
        'latitude',
        'longitude',
        'event_url',
        'website',
        'image',
        'description',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_active' => 'boolean',
    ];
}
