<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class TmNews extends Model
{
    use SoftDeletes;

    protected $table = 'tm_news';

    protected $fillable = [
        'title', 'subtitle', 'excerpt', 'slug', 'content',
        'category_id', 'is_headline', 'view_count', 'status',
        'author_id', 'published_at', 'date', 'description_image', 'image_caption',
        'meta_title', 'meta_description',
    ];

    protected $casts = ['published_at' => 'datetime', 'is_headline' => 'boolean'];

    /**
     * Scope: hanya berita yang sudah dipublikasi.
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')->where('status', 1);
    }

    /**
     * Accessor: URL gambar deskripsi (description_image).
     */
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->description_image) {
            return null;
        }

        return Storage::disk('public')->url($this->description_image);
    }

    public function category()
    {
        return $this->belongsTo(TmCategory::class, 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'verifikator_id');
    }

    public function tags()
    {
        return $this->belongsToMany(TmTag::class, 'tr_news_tags', 'news_id', 'tag_id');
    }

    public function images()
    {
        return $this->hasMany(TrNewsImage::class, 'news_id');
    }
}
