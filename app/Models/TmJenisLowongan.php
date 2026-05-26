<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmJenisLowongan extends Model
{
    protected $table = 'tm_jenis_lowongan';

    protected $fillable = [
        'nama', 'warna'
    ];

    public function lowongan()
    {
        return $this->hasMany(TmLowongan::class, 'id_jenis');
    }
}
