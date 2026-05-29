<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TmLowongan;
use App\Models\TmNews;
use App\Models\TmPageVisit;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'kunjungan_hari_ini' => TmPageVisit::whereDate('created_at', today())->count(),
            'total_berita'       => TmNews::whereNotNull('published_at')->count(),
            'kegiatan_aktif'     => TmLowongan::where('status', 'buka')->count(),
            'total_pengguna'     => User::count(),
        ];

        // Visitor trend: 30 hari terakhir
        $visitorRaw = TmPageVisit::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(29)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        $visitorDates = collect();
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $visitorDates->put($date, $visitorRaw->get($date, 0));
        }

        $visitorChart = [
            'dates'  => $visitorDates->keys()->values(),
            'totals' => $visitorDates->values(),
        ];

        // Top 5 berita terbanyak dibaca
        $topBerita = TmNews::orderByDesc('view_count')
            ->limit(5)
            ->get(['title', 'view_count']);

        // Kegiatan per bulan: 6 bulan terakhir
        $kegiatanRaw = TmLowongan::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as bulan, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $kegiatanMonths = collect();
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('Y-m');
            $kegiatanMonths->put($month, $kegiatanRaw->get($month, 0));
        }

        $kegiatanChart = [
            'months' => $kegiatanMonths->keys()->map(fn ($m) => Carbon::parse($m . '-01')->isoFormat('MMM Y')),
            'totals' => $kegiatanMonths->values(),
        ];

        // Fetch pending berita for verifikator
        $pendingBerita = collect();
        if (auth()->user()?->hasRole('verifikator')) {
            $pendingBerita = TmNews::with('author')->where('status', 2)->latest()->get();
        }

        return view('admin.dashboard.index', compact('stats', 'visitorChart', 'topBerita', 'kegiatanChart', 'pendingBerita'));
    }
}
