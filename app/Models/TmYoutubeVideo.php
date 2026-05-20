<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmYoutubeVideo extends Model
{
    protected $table = 'tm_youtube_videos';

    protected $fillable = [
        'youtube_id',
        'title',
        'description',
        'channel_name',
        'published_at',
        'duration',
        'thumbnail_url',
        'view_count',
        'is_featured',
        'is_active',
        'synced_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'synced_at' => 'datetime',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public static function getFeaturedVideo()
    {
        return self::where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->first();
    }

    public static function getRecentVideos($limit = 6)
    {
        return self::where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getYoutubeUrl()
    {
        return "https://www.youtube.com/watch?v={$this->youtube_id}";
    }
}
