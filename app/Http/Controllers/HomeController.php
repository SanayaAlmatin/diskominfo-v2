<?php

namespace App\Http\Controllers;

use App\Models\TmInfoBanner;
use App\Models\TmKoordinatWifi;
use App\Models\TmLowongan;
use App\Models\TmNews;
use App\Models\TmPortalApp;

class HomeController extends Controller
{
    public function index()
    {
        $latestNews  = TmNews::published()->latest('published_at')->take(3)->get();
        $popularNews = TmNews::published()->orderByDesc('view_count')->take(5)->get();
        $banners     = TmInfoBanner::where('is_active', true)->latest()->get();
        $lowongan    = TmLowongan::buka()->orderBy('tanggal_tutup')->latest()->take(6)->get();
        $wifiTotal   = TmKoordinatWifi::count();

        $featuredApps = TmPortalApp::active()->featured()->orderBy('sort_order')->take(4)->get();
        $apps         = TmPortalApp::active()->orderBy('sort_order')->take(10)->get();

        return view('welcome', compact('latestNews', 'popularNews', 'banners', 'lowongan', 'wifiTotal', 'featuredApps', 'apps'));
    }
}
