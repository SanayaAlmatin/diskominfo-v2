<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmInfoBanner extends Model
{
    protected $table = 'tm_info_banner';

    protected $fillable = ['description', 'image', 'link_url', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    use \Illuminate\Database\Eloquent\SoftDeletes;
}
