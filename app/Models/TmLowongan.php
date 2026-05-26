<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmLowongan extends Model
{
    protected $table = 'tm_lowongan';

    protected $fillable = [
        'posisi', 'id_jenis', 'deskripsi', 'tags',
        'lokasi', 'tipe_kerja', 'tanggal_tutup', 'link_daftar', 'gambar', 'status',
    ];

    protected $casts = [
        'tags'          => 'array',
        'tanggal_tutup' => 'date',
    ];

    public function jenis_lowongan()
    {
        return $this->belongsTo(TmJenisLowongan::class, 'id_jenis');
    }

    public function scopeBuka($query)
    {
        return $query->where('status', 'buka');
    }
}
