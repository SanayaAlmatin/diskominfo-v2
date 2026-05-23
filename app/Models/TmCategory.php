<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmCategory extends Model
{
    protected $table = 'tm_categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function news()
    {
        return $this->hasMany(TmNews::class, 'category_id');
    }
}
