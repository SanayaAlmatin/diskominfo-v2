<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmVisiMisi extends Model
{
    protected $table = 'tm_visi_misi';

    protected $fillable = ['tipe', 'konten', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeVisi($query)
    {
        return $query->where('tipe', 'visi')->where('is_active', true);
    }

    public function scopeMisi($query)
    {
        return $query->where('tipe', 'misi')->where('is_active', true)->orderBy('sort_order');
    }
}
