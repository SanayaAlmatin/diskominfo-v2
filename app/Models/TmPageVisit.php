<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmPageVisit extends Model
{
    protected $table = 'tm_page_visits';

    public $timestamps = false;

    protected $fillable = ['ip_address', 'page', 'created_at'];
}
