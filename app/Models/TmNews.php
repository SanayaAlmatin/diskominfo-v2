<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TmNews extends Model
{
    use SoftDeletes;

    protected $table = 'tm_news';

    protected $fillable = [
        'title', 'subtitle', 'excerpt', 'slug', 'content',
        'category_id', 'is_headline', 'view_count', 'status',
        'author_id', 'published_at', 'date', 'description_image',
        'meta_title', 'meta_description',
    ];

    protected $casts = ['published_at' => 'datetime', 'is_headline' => 'boolean'];

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')->where('status', 'published');
    }
}
