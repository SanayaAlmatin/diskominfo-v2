<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmFileBidangStatistik extends Model
{
    protected $table = 'tm_file_bidang_statistik';

    public $timestamps = false;

    protected $fillable = ['deskripsi', 'file', 'id_bidang', 'type', 'd_entry', 'd_update', 'size'];

    public function bidang()
    {
        return $this->belongsTo(TmBidangStatistik::class, 'id_bidang');
    }
}
