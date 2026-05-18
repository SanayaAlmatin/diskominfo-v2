<?php

namespace App\Http\Controllers;

use App\Models\TmInfoBanner;
use App\Models\TmNews;

class HomeController extends Controller
{
    public function index()
    {
        $latestNews  = TmNews::published()->latest('published_at')->take(3)->get();
        $popularNews = TmNews::published()->orderByDesc('view_count')->take(5)->get();
        $banners     = TmInfoBanner::where('is_active', true)->latest()->get();

        return view('welcome', compact('latestNews', 'popularNews', 'banners'));
    }
}
