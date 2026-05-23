<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmTag extends Model
{
    protected $table = 'tm_tags';

    protected $fillable = [
        'n_tag',
    ];

    public function news()
    {
        return $this->belongsToMany(TmNews::class, 'tr_news_tags', 'tag_id', 'news_id');
    }
}
