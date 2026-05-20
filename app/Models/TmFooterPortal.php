<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmFooterPortal extends Model
{
    protected $table = 'tm_footer_portals';

    protected $fillable = [
        'label',
        'url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('label');
    }
}
