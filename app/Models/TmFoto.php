<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmFoto extends Model
{
    protected $table = 'tm_fotos';

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'category',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }
}
