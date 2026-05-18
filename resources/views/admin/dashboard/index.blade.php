@extends('admin.layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="space-y-6">

        {{-- Welcome banner --}}
        <div class="rounded-xl p-6 text-white" style="background: linear-gradient(135deg, #0F2044, #1a3460);">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold">Selamat Datang, {{ auth()->user()->nama }}!</h2>
                    <p class="text-blue-300 text-sm mt-1">CMS Portal Diskominfo Tangerang Selatan —
                        {{ now()->isoFormat('dddd, D MMMM Y') }}</p>
                </div>
                <div class="hidden md:block">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center"
                        style="background: rgba(255,193,7,0.2);">
                        <svg class="w-8 h-8" style="color: #FFC107;" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.357l4-2a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stats cards --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @php
                $cards = [
                    [
                        'label' => 'Banner',
                        'value' => $stats['banners'],
                        'icon' =>
                            'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
                        'color' => '#4F46E5',
                    ],
                    [
                        'label' => 'Visi & Misi',
                        'value' => $stats['visi_misi'],
                        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                        'color' => '#10B981',
                    ],
                    [
                        'label' => 'SOTK',
                        'value' => $stats['sotk'],
                        'icon' => 'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5z',
                        'color' => '#F59E0B',
                    ],
                    [
                        'label' => 'Statistik TIK',
                        'value' => $stats['tik_stats'],
                        'icon' =>
                            'M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2',
                        'color' => '#3B82F6',
                    ],
                    [
                        'label' => 'Bidang Statistik',
                        'value' => $stats['bidang'],
                        'icon' =>
                            'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                        'color' => '#8B5CF6',
                    ],
                    [
                        'label' => 'Pengguna',
                        'value' => $stats['users'],
                        'icon' =>
                            'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                        'color' => '#EF4444',
                    ],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0"
                            style="background: {{ $card['color'] }}15;">
                            <svg class="w-5 h-5" fill="none" stroke="{{ $card['color'] }}" viewBox="0 0 24 24"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">{{ $card['value'] }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $card['label'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- Quick links --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-800">Akses Cepat</h3>
            </div>
            <div class="p-6 grid grid-cols-2 md:grid-cols-3 gap-3">
                @php
                    $links = [
                        ['label' => 'Tambah Banner', 'route' => 'admin.program-vacancy.create', 'color' => '#0F2044'],
                        ['label' => 'Tambah Visi/Misi', 'route' => 'admin.visi-misi.create', 'color' => '#0F2044'],
                        ['label' => 'Tambah SOTK', 'route' => 'admin.struktur-organisasi.create', 'color' => '#0F2044'],
                        [
                            'label' => 'Tambah Stat TIK',
                            'route' => 'admin.infrastruktur-tik.create',
                            'color' => '#0F2044',
                        ],
                        ['label' => 'Tambah Bidang', 'route' => 'admin.statistik.create', 'color' => '#0F2044'],
                    ];
                @endphp
                @foreach ($links as $link)
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route($link['route']) }}"
                            class="flex items-center gap-2 px-4 py-3 rounded-lg text-sm font-medium text-white hover:opacity-90 transition-all"
                            style="background-color: {{ $link['color'] }};">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            {{ $link['label'] }}
                        </a>
                    @endif
                @endforeach
                @if (auth()->user()->isSuperAdmin())
                    <a href="{{ route('admin.users.create') }}"
                        class="flex items-center gap-2 px-4 py-3 rounded-lg text-sm font-medium text-white hover:opacity-90 transition-all"
                        style="background-color: #EF4444;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Tambah Pengguna
                    </a>
                @endif
            </div>
        </div>

    </div>
@endsection
