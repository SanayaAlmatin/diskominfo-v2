<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmTikStats extends Model
{
    protected $table = 'tm_tik_stats';

    protected $fillable = ['kategori', 'label', 'nilai', 'satuan', 'icon', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
