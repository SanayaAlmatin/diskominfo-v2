<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmFooterSetting extends Model
{
    protected $table = 'tm_footer_settings';

    protected $fillable = [
        'nama_organisasi',
        'deskripsi',
        'alamat',
        'telepon',
        'email',
        'instagram_url',
        'tiktok_url',
        'twitter_url',
        'facebook_url',
        'youtube_url',
        'maps_embed_url',
        'privacy_policy_url',
        'terms_url',
        'sitemap_url',
        'copyright_text',
    ];

    public static function getSettings(): self
    {
        return static::firstOrCreate([], [
            'nama_organisasi' => 'Kominfo Tangsel',
            'deskripsi'       => 'Dinas Komunikasi dan Informatika Kota Tangerang Selatan — mendorong transformasi digital demi layanan publik yang cerdas, terbuka, dan terpercaya.',
            'alamat'          => "Jl. Maruga No. 1, Serua, Ciputat,\nKota Tangerang Selatan,\nBanten 15414",
            'telepon'         => '(021) 538 8833',
            'email'           => 'diskominfo@tangselkota.go.id',
            'copyright_text'  => 'South Tangerang City Government — Dinas Komunikasi dan Informatika. All rights reserved.',
        ]);
    }
}
