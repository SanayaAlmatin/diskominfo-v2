<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmSotk extends Model
{
    protected $table = 'tm_sotk';

    protected $fillable = ['tahun', 'nama_sotk', 'deskripsi', 'gambar', 'is_current', 'sort_order'];

    protected $casts = ['is_current' => 'boolean'];
}
