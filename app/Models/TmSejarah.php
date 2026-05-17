<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmSejarah extends Model
{
    protected $table = 'tm_sejarah';

    public $incrementing = true;

    protected $fillable = ['content', 'gambar'];
}
