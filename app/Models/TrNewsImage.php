<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrNewsImage extends Model
{
    protected $table = 'tr_news_images';

    protected $fillable = [
        'news_id',
        'image',
    ];
}
