<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TmBidangStatistik;
use App\Models\TmInfoBanner;
use App\Models\TmSejarah;
use App\Models\TmSotk;
use App\Models\TmTikStats;
use App\Models\TmVisiMisi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'banners'   => TmInfoBanner::count(),
            'visi_misi' => TmVisiMisi::count(),
            'sotk'      => TmSotk::count(),
            'tik_stats' => TmTikStats::count(),
            'bidang'    => TmBidangStatistik::count(),
            'users'     => User::count(),
        ];

        return view('admin.dashboard.index', compact('stats'));
    }
}
