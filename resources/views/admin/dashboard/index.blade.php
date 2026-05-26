@extends('admin.layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="space-y-6">

        {{-- Welcome banner --}}
        @php
            $words    = explode(' ', auth()->user()->nama);
            $initials = strtoupper(substr($words[0], 0, 1)) . (isset($words[1]) ? strtoupper(substr($words[1], 0, 1)) : '');
            $cmsRole  = auth()->user()->getCmsRole();
            $roleBadge = match($cmsRole) {
                'super-admin' => ['label' => 'Super Admin', 'color' => '#FFC107'],
                'admin'       => ['label' => 'Admin',       'color' => '#10B981'],
                default       => ['label' => 'Guest',       'color' => '#6B7280'],
            };
        @endphp
        <div class="rounded-xl overflow-hidden relative text-white" style="background: linear-gradient(135deg, #0F2044, #1a3460);">
            {{-- Dot pattern overlay --}}
            <svg class="absolute inset-0 w-full h-full pointer-events-none" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="banner-dots" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <circle cx="2" cy="2" r="1.5" fill="white" opacity="0.08"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#banner-dots)"/>
            </svg>

            {{-- Decorative circles (kanan, desktop only) --}}
            <div class="hidden md:block absolute right-0 top-0 bottom-0 w-48 pointer-events-none overflow-hidden">
                <div class="absolute rounded-full" style="width:180px;height:180px;background:rgba(255,193,7,0.10);right:-40px;top:50%;transform:translateY(-50%);"></div>
                <div class="absolute rounded-full" style="width:110px;height:110px;background:rgba(255,255,255,0.05);right:20px;top:50%;transform:translateY(-50%);"></div>
                <div class="absolute rounded-full" style="width:55px;height:55px;background:rgba(255,193,7,0.18);right:50px;top:50%;transform:translateY(-50%);"></div>
            </div>

            {{-- Content --}}
            <div class="relative z-10 flex items-center gap-4 p-6">
                <div class="w-14 h-14 rounded-full flex items-center justify-center font-bold text-lg flex-shrink-0"
                     style="background:#FFC107;color:#0F2044;">
                    {{ $initials }}
                </div>
                <div>
                    <p class="text-xs text-blue-300 mb-0.5">Selamat Datang,</p>
                    <h2 class="text-xl font-bold leading-tight">{{ auth()->user()->nama }}</h2>
                    <p class="text-blue-300 text-xs mt-1">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
                    <span class="inline-flex items-center gap-1.5 mt-2 px-2.5 py-0.5 rounded-full text-xs font-semibold"
                          style="background:{{ $roleBadge['color'] }}22;color:{{ $roleBadge['color'] }};border:1px solid {{ $roleBadge['color'] }}44;">
                        <span class="w-1.5 h-1.5 rounded-full" style="background:{{ $roleBadge['color'] }};"></span>
                        {{ $roleBadge['label'] }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Stats cards --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
                $cards = [
                    [
                        'label' => 'Kunjungan Hari Ini',
                        'value' => $stats['kunjungan_hari_ini'],
                        'icon'  => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z',
                        'color' => '#0F2044',
                    ],
                    [
                        'label' => 'Berita Dipublikasi',
                        'value' => $stats['total_berita'],
                        'icon'  => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z',
                        'color' => '#10B981',
                    ],
                    [
                        'label' => 'Lowongan Aktif',
                        'value' => $stats['lowongan_aktif'],
                        'icon'  => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                        'color' => '#F59E0B',
                    ],
                    [
                        'label' => 'Total Pengguna',
                        'value' => $stats['total_pengguna'],
                        'icon'  => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                        'color' => '#EF4444',
                    ],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0"
                            style="background: {{ $card['color'] }}18;">
                            <svg class="w-5 h-5" fill="none" stroke="{{ $card['color'] }}" viewBox="0 0 24 24"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($card['value']) }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $card['label'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- Charts row 1: Visitor trend + Top berita --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Visitor trend chart --}}
            <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-semibold text-gray-800 mb-4">Kunjungan Portal — 30 Hari Terakhir</h3>
                <div id="chart-visitor"></div>
            </div>

            {{-- Top 5 berita --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-semibold text-gray-800 mb-4">Top 5 Berita Terbanyak Dibaca</h3>
                @if ($topBerita->isEmpty())
                    <p class="text-sm text-gray-400 text-center py-8">Belum ada data berita.</p>
                @else
                    <div id="chart-top-berita"></div>
                @endif
            </div>
        </div>

        {{-- Charts row 2: Lowongan per bulan --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-semibold text-gray-800 mb-4">Lowongan Pekerjaan — 6 Bulan Terakhir</h3>
            <div id="chart-lowongan"></div>
        </div>

        {{-- Quick links --}}
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Akses Cepat</p>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                @php
                    $links = [
                        [
                            'label' => 'Galeri Foto',
                            'sub'   => 'Konten Portal',
                            'route' => 'admin.foto.index',
                            'color' => '#4F46E5',
                            'icon'  => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
                        ],
                        [
                            'label' => 'Visi & Misi',
                            'sub'   => 'Profil Instansi',
                            'route' => 'admin.visi-misi.create',
                            'color' => '#10B981',
                            'icon'  => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                        ],
                        [
                            'label' => 'SOTK',
                            'sub'   => 'Struktur Organisasi',
                            'route' => 'admin.struktur-organisasi.create',
                            'color' => '#F59E0B',
                            'icon'  => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
                        ],
                        [
                            'label' => 'Statistik TIK',
                            'sub'   => 'Infrastruktur TIK',
                            'route' => 'admin.infrastruktur-tik.create',
                            'color' => '#3B82F6',
                            'icon'  => 'M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2',
                        ],
                        [
                            'label' => 'Bidang Statistik',
                            'sub'   => 'Data Statistik',
                            'route' => 'admin.statistik.create',
                            'color' => '#8B5CF6',
                            'icon'  => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                        ],
                    ];
                @endphp

                @foreach ($links as $link)
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route($link['route']) }}"
                           class="group flex items-center gap-3 bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-200"
                           style="border-left: 4px solid {{ $link['color'] }};">
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0"
                                 style="background: {{ $link['color'] }}15;">
                                <svg class="w-5 h-5" fill="none" stroke="{{ $link['color'] }}" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $link['icon'] }}" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-semibold text-gray-800 truncate">{{ $link['label'] }}</p>
                                <p class="text-xs text-gray-400 truncate">{{ $link['sub'] }}</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-300 group-hover:text-gray-500 group-hover:translate-x-0.5 transition-all flex-shrink-0"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    @endif
                @endforeach

                @if (auth()->user()->isSuperAdmin())
                    <a href="{{ route('admin.users.create') }}"
                       class="group flex items-center gap-3 bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-200"
                       style="border-left: 4px solid #EF4444;">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0"
                             style="background: #EF444415;">
                            <svg class="w-5 h-5" fill="none" stroke="#EF4444" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-semibold text-gray-800 truncate">Pengguna</p>
                            <p class="text-xs text-gray-400 truncate">Manajemen User</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-300 group-hover:text-gray-500 group-hover:translate-x-0.5 transition-all flex-shrink-0"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @endif
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // ── Visitor trend (area chart) ──────────────────────────────────────
            const visitorData = @json($visitorChart);

            new ApexCharts(document.querySelector('#chart-visitor'), {
                chart: {
                    type: 'area',
                    height: 280,
                    toolbar: { show: false },
                    zoom: { enabled: false },
                },
                series: [{ name: 'Kunjungan', data: visitorData.totals }],
                xaxis: {
                    categories: visitorData.dates,
                    tickAmount: 6,
                    labels: {
                        formatter: (val) => {
                            const d = new Date(val);
                            return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
                        },
                        style: { fontSize: '11px' },
                    },
                },
                yaxis: { labels: { style: { fontSize: '11px' } } },
                colors: ['#0F2044'],
                fill: {
                    type: 'gradient',
                    gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.05, stops: [0, 100] },
                },
                stroke: { curve: 'smooth', width: 2 },
                dataLabels: { enabled: false },
                tooltip: { x: { format: 'dd MMM yyyy' } },
                grid: { borderColor: '#f3f4f6' },
            }).render();

            // ── Top 5 berita (horizontal bar) ──────────────────────────────────
            @if ($topBerita->isNotEmpty())
            const beritaData = @json($topBerita);

            new ApexCharts(document.querySelector('#chart-top-berita'), {
                chart: {
                    type: 'bar',
                    height: 280,
                    toolbar: { show: false },
                },
                title: {
                    text: '(dalam ribuan)',
                    align: 'right',
                    style: { fontSize: '11px', fontWeight: 400, color: '#9CA3AF' },
                },
                plotOptions: {
                    bar: { horizontal: true, borderRadius: 4, barHeight: '60%' },
                },
                series: [{
                    name: 'Pembacaan',
                    data: beritaData.map(b => b.view_count),
                }],
                xaxis: {
                    categories: beritaData.map(b => b.title.length > 30 ? b.title.substring(0, 30) + '…' : b.title),
                    labels: {
                        style: { fontSize: '11px' },
                        formatter: (val) => val >= 1000 ? (val / 1000).toFixed(0) : val,
                    },
                    tickAmount: 4,
                },
                colors: ['#10B981'],
                dataLabels: { enabled: false },
                grid: { borderColor: '#f3f4f6' },
                tooltip: {
                    y: { formatter: (val) => val.toLocaleString('id-ID') + ' pembacaan' },
                },
            }).render();
            @endif

            // ── Lowongan per bulan (bar chart) ─────────────────────────────────
            const lowonganData = @json($lowonganChart);

            new ApexCharts(document.querySelector('#chart-lowongan'), {
                chart: {
                    type: 'bar',
                    height: 220,
                    toolbar: { show: false },
                },
                plotOptions: {
                    bar: { borderRadius: 4, columnWidth: '45%' },
                },
                series: [{ name: 'Lowongan', data: lowonganData.totals }],
                xaxis: {
                    categories: lowonganData.months,
                    labels: { style: { fontSize: '12px' } },
                },
                yaxis: {
                    min: 0,
                    tickAmount: 5,
                    labels: { style: { fontSize: '11px' } },
                },
                colors: ['#F59E0B'],
                dataLabels: { enabled: true, style: { fontSize: '12px', colors: ['#374151'] } },
                grid: { borderColor: '#f3f4f6' },
                tooltip: {
                    y: { formatter: (val) => val + ' lowongan' },
                },
            }).render();
        });
    </script>
@endsection
