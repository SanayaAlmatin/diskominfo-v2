<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmLowongan extends Model
{
    protected $table = 'tm_lowongan';

    protected $fillable = ['posisi', 'status'];
}
