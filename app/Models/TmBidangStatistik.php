<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmBidangStatistik extends Model
{
    protected $table = 'tm_bidang_statistik';

    protected $fillable = ['n_bidang'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function files()
    {
        return $this->hasMany(TmFileBidangStatistik::class, 'id_bidang');
    }
}
