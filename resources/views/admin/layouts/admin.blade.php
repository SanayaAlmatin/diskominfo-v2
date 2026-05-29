<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CMS') — Kominfo Tangsel</title>
    <link rel="icon" href="{{ asset('Images/logo-kominfo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Google Material Symbols Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@400,1&display=swap"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        [x-cloak] { display: none !important; }

        :root {
            --navy: #0665D0;
            --navy-dark: #0552A8;
            --navy-light: #1A75E8;
            --yellow: #FFC107;
            --yellow-dark: #e5ac00;
        }

        /* Theme overrides for buttons */
        .bg-blue-600,
        [style*="background-color: #1a56db"],
        [style*="background-color: #0F2044"] {
            background-color: var(--navy) !important;
        }
        .hover\:bg-blue-700:hover,
        [style*="background-color: #1a56db"]:hover,
        [style*="background-color: #0F2044"]:hover {
            background-color: var(--navy-dark) !important;
        }
        .text-blue-600 {
            color: var(--navy) !important;
        }

        .sidebar-nav a.active,
        .sidebar-nav a:hover {
            background-color: rgba(255, 193, 7, 0.15);
            color: #FFC107;
        }

        .sidebar-nav a.active {
            border-left: 3px solid #FFC107;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 3px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.12);
            border-radius: 3px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        /* Hide sidebar on mobile before Alpine.js initializes */
        @media (max-width: 1023px) {
            [x-cloak] {
                display: none !important;
            }
        }



        /* ── Lightbox ── */
        #img-lightbox {
            backdrop-filter: blur(4px);
        }

        #img-lightbox img {
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);
            animation: lb-in .18s ease;
        }

        @keyframes lb-in {
            from {
                opacity: 0;
                transform: scale(.94);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .lb-thumb {
            cursor: zoom-in;
            transition: opacity .15s ease, transform .15s ease;
        }

        .lb-thumb:hover {
            opacity: .85;
            transform: scale(1.04);
        }

        /* ── Mobile responsiveness ── */


        /* ── Custom Pagination Styling (Laravel Default) ── */
        nav[role="navigation"] .shadow-sm.rounded-md {
            box-shadow: none !important;
        }
        nav[role="navigation"] .shadow-sm.rounded-md > * {
            margin: 0 0.15rem !important;
        }
        nav[role="navigation"] .shadow-sm.rounded-md > a,
        nav[role="navigation"] .shadow-sm.rounded-md > span > span {
            padding: 0.35rem 0.75rem !important;
            border-radius: 0.375rem !important;
            border: 1px solid #e5e7eb !important;
            font-size: 0.875rem !important;
            color: #4b5563 !important;
            background: #fff !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-width: 2rem !important;
            height: 2.2rem !important;
        }
        nav[role="navigation"] .shadow-sm.rounded-md > a:hover {
            background: #f9fafb !important;
            color: #1f2937 !important;
        }
        /* Active page indicator */
        nav[role="navigation"] .shadow-sm.rounded-md > span[aria-current="page"] > span {
            background-color: #2563eb !important;
            color: #ffffff !important;
            border-color: #2563eb !important;
            font-weight: 600 !important;
        }
        /* Fix SVG sizes */
        nav[role="navigation"] .shadow-sm.rounded-md svg {
            width: 1.25rem;
            height: 1.25rem;
        }
    </style>
</head>

<body class="h-full bg-gray-50 font-sans" data-start-alpine="true" x-data="{ sidebarOpen: false, desktopSidebarOpen: true }">

    <!-- Mobile sidebar overlay -->
    <div x-cloak x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-black/50 lg:hidden"
        @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <aside class="fixed inset-y-0 left-0 z-50 w-64 flex flex-col transition-transform duration-300"
        :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen, 'lg:translate-x-0': desktopSidebarOpen, 'lg:-translate-x-full': !desktopSidebarOpen}" style="background-color: var(--navy);" x-cloak>

        <!-- Logo -->
        <div class="flex items-start lg:items-center justify-between gap-3 px-6 py-5 border-b border-white/10">
            <div class="flex flex-col lg:flex-row items-start lg:items-center gap-2 lg:gap-3">
                <img src="{{ asset('Images/logo-kominfo.png') }}" class="h-10 w-auto object-contain" alt="Logo">
                <div>
                    <p class="text-white font-bold text-sm leading-tight">CMS Kominfo</p>
                    <p class="text-blue-300 text-xs">Tangerang Selatan</p>
                </div>
            </div>
            <!-- Close button (mobile only) -->
            <button @click="sidebarOpen = false"
                class="lg:hidden p-1.5 rounded-lg text-blue-300 hover:text-white hover:bg-white/10 transition-colors flex-shrink-0 mt-1 lg:mt-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 py-4 overflow-y-auto sidebar-nav">
            <div class="px-3 mb-2">
                <p class="text-blue-400 text-xs font-semibold uppercase tracking-wider px-3 mb-1">Menu Utama</p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Dashboard</span>
            </a>

            @if (!auth()->user()?->hasRole('verifikator'))
            <div class="px-3 mt-4 mb-2">
                <p class="text-blue-400 text-xs font-semibold uppercase tracking-wider px-3 mb-1">Konten Navbar</p>
            </div>

            <a href="{{ route('admin.sekilas.index') }}"
                class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.sekilas.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                <span>Sekilas Kominfo</span>
            </a>

            <a href="{{ route('admin.visi-misi.index') }}"
                class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.visi-misi.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Visi & Misi</span>
            </a>

            <a href="{{ route('admin.struktur-organisasi.index') }}"
                class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.struktur-organisasi.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                </svg>
                <span>Struktur Organisasi</span>
            </a>


            <a href="{{ route('admin.infrastruktur-tik.index') }}"
                class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.infrastruktur-tik.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                </svg>
                <span>Infrastruktur TIK</span>
            </a>

            <a href="{{ route('admin.statistik.index') }}"
                class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.statistik.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span>Statistik Layanan</span>
            </a>
            @endif

            <div class="px-3 mt-4 mb-2">
                <p class="text-blue-400 text-xs font-semibold uppercase tracking-wider px-3 mb-1">Konten Website</p>
            </div>

            <div x-data="{ open: {{ request()->routeIs('admin.berita.*', 'admin.kategori.*', 'admin.tags.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-6 py-2.5 text-blue-100 text-sm transition-all hover:bg-white/10 hover:text-yellow-400 {{ request()->routeIs('admin.berita.*', 'admin.kategori.*', 'admin.tags.*') ? 'text-yellow-400 bg-white/10' : '' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Manajemen Artikel</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-cloak x-show="open" x-transition.opacity class="bg-black/20 py-1">
                    <a href="{{ route('admin.berita.index') }}"
                        class="flex items-center gap-3 pl-14 pr-6 py-2 text-blue-100 text-sm transition-all
                              {{ request()->routeIs('admin.berita.index') ? 'active' : '' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Kelola Artikel</span>
                        @php
                            $sidebarPendingCount = \App\Models\TmNews::where('status', 2)->count();
                        @endphp
                        @if($sidebarPendingCount > 0)
                            <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">{{ $sidebarPendingCount }}</span>
                        @endif
                    </a>
                    @if (auth()->user()?->hasRole('admin'))
                    <a href="{{ route('admin.berita.create') }}"
                        class="flex items-center gap-3 pl-14 pr-6 py-2 text-blue-100 text-sm transition-all
                              {{ request()->routeIs('admin.berita.create') ? 'active' : '' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Buat Artikel Baru</span>
                    </a>
                    @endif
                    <a href="{{ route('admin.kategori.index') }}"
                        class="flex items-center gap-3 pl-14 pr-6 py-2 text-blue-100 text-sm transition-all
                              {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                        </svg>
                        <span>Kategori</span>
                    </a>
                    <a href="{{ route('admin.tags.index') }}"
                        class="flex items-center gap-3 pl-14 pr-6 py-2 text-blue-100 text-sm transition-all
                              {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span>Tag</span>
                    </a>
                </div>
            </div>


            @if (!auth()->user()?->hasRole('verifikator'))
            <a href="{{ route('admin.wifi.index') }}"
                class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.wifi.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Titik WiFi</span>
            </a>

            <div x-data="{ open: {{ request()->routeIs('admin.lowongan.*', 'admin.jenis-lowongan.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-6 py-2.5 text-blue-100 text-sm transition-all hover:bg-white/10 hover:text-yellow-400 {{ request()->routeIs('admin.lowongan.*', 'admin.jenis-lowongan.*') ? 'text-yellow-400 bg-white/10' : '' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Manajemen Kegiatan</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-cloak x-show="open" x-transition.opacity class="bg-black/20 py-1">
                    <a href="{{ route('admin.lowongan.index') }}"
                        class="flex items-center gap-3 pl-14 pr-6 py-2 text-blue-100 text-sm transition-all
                              {{ request()->routeIs('admin.lowongan.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span>Kelola Kegiatan</span>
                    </a>
                    <a href="{{ route('admin.jenis-lowongan.index') }}"
                        class="flex items-center gap-3 pl-14 pr-6 py-2 text-blue-100 text-sm transition-all
                              {{ request()->routeIs('admin.jenis-lowongan.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                        </svg>
                        <span>Manajemen Jenis</span>
                    </a>
                </div>
            </div>

            <a href="{{ route('admin.events.index') }}"
                class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Kelola Event</span>
            </a>

            <a href="{{ route('admin.foto.index') }}"
                class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.foto.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Galeri Foto</span>
            </a>

            <a href="{{ route('admin.aplikasi.index') }}"
                class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.aplikasi.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span>Aplikasi Portal</span>
            </a>

            <div class="px-3 mt-4 mb-2">
                <p class="text-blue-400 text-xs font-semibold uppercase tracking-wider px-3 mb-1">Konten Footer</p>
            </div>

            <a href="{{ route('admin.footer.identitas') }}"
                class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.footer.identitas*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span>Identitas Footer</span>
            </a>

            <a href="{{ route('admin.footer.sosmed') }}"
                class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.footer.sosmed*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                </svg>
                <span>Media Sosial & Peta</span>
            </a>

            <a href="{{ route('admin.footer.kontak') }}"
                class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.footer.kontak*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <span>Kontak</span>
            </a>

            <a href="{{ route('admin.footer.portals.index') }}"
                class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.footer.portals*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                </svg>
                <span>Portal Terkait</span>
            </a>

            <a href="{{ route('admin.footer.utilitas') }}"
                class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.footer.utilitas*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Link Utilitas</span>
            </a>
            @endif

            @if (auth()->user()?->isSuperAdmin())
                <div class="px-3 mt-4 mb-2">
                    <p class="text-blue-400 text-xs font-semibold uppercase tracking-wider px-3 mb-1">Administrasi</p>
                </div>

                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Manajemen Pengguna</span>
                </a>
            @endif
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3 flex-1 min-w-0 group cursor-pointer">
                    <div class="w-9 h-9 rounded-full bg-blue-500 flex items-center justify-center flex-shrink-0 overflow-hidden shadow-sm border border-white/10 group-hover:border-white/30 transition-colors">
                        @if (auth()->user()?->profile_photo_url)
                            <img src="{{ auth()->user()->profile_photo_url }}" class="w-full h-full object-cover" alt="Profile">
                        @else
                            <span class="text-white text-xs font-bold">{{ auth()->user()?->initials }}</span>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white text-sm font-semibold truncate group-hover:text-yellow-400 transition-colors">{{ auth()->user()?->nama }}</p>
                        <p class="text-blue-300 text-xs truncate">{{ auth()->user()?->getCmsRole() }}</p>
                    </div>
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" id="logout-form">
                    @csrf
                    <button type="button" onclick="confirmLogout(document.getElementById('logout-form'))"
                        class="text-blue-400 hover:text-red-400 transition-colors p-2" title="Logout">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main content -->
    <div class="flex flex-col min-h-screen transition-all duration-300" :class="desktopSidebarOpen ? 'lg:pl-64' : 'lg:pl-0'">

        <!-- Top bar -->
        <header class="sticky top-0 z-30 bg-white border-b border-gray-200 shadow-sm">
            <div class="flex items-center justify-between px-4 h-14">
                <div class="flex items-center gap-2">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <button @click="desktopSidebarOpen = !desktopSidebarOpen"
                        class="hidden lg:block p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">
                        <!-- Ikon Sidebar untuk Desktop -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 4v16" />
                        </svg>
                    </button>

                    <div class="hidden lg:block ml-2">
                        <h1 class="text-sm font-semibold text-gray-700">@yield('page-title', 'Dashboard')</h1>
                    </div>
                </div>

                <div class="flex items-center gap-4 ml-auto">
                    
                    <!-- Date & Time -->
                    <div class="hidden md:flex items-center gap-2 bg-gray-50 hover:bg-gray-100 transition-colors px-3 py-1.5 rounded-xl border border-gray-100">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <div class="text-[13px] font-medium text-gray-700 flex items-center gap-1.5" x-data="{ time: '{{ \Carbon\Carbon::now()->format('H:i') }}' }" x-init="setInterval(() => { let d = new Date(); time = String(d.getHours()).padStart(2, '0') + ':' + String(d.getMinutes()).padStart(2, '0') }, 1000)">
                            <span>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</span>
                            <span class="text-gray-300">|</span>
                            <span x-text="time"></span>
                        </div>
                    </div>

                    @php
                        $pendingArticlesCount = \App\Models\TmNews::where('status', 2)->count();
                    @endphp

                    <!-- Notifications Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false" class="relative p-2 text-gray-500 hover:bg-gray-100 rounded-full transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            @if($pendingArticlesCount > 0)
                                <span class="absolute top-0.5 right-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[9px] font-bold text-white ring-2 ring-white">
                                    {{ $pendingArticlesCount > 9 ? '9+' : $pendingArticlesCount }}
                                </span>
                            @endif
                        </button>

                        <div x-show="open" x-transition.opacity.duration.200ms x-cloak
                            class="absolute right-0 mt-3 w-80 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50">
                            <div class="px-4 py-3 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                                <h3 class="text-base font-bold text-gray-800">Notifikasi</h3>
                                <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingArticlesCount }}</span>
                            </div>
                            <div class="max-h-80 overflow-y-auto">
                                @if($pendingArticlesCount > 0)
                                <a href="{{ route('admin.berita.index', ['status' => 'Menunggu Validasi']) }}" class="flex items-start gap-4 p-4 hover:bg-gray-50 transition-colors border-b border-gray-50">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-500 relative">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                        <!-- clock overlay in bottom right -->
                                        <div class="absolute -bottom-1 -right-1 bg-orange-100 rounded-full p-0.5">
                                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="9" stroke-width="2"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7v5l3 3"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0 pt-0.5">
                                        <p class="text-sm font-bold text-gray-800">Artikel Pending</p>
                                        <p class="text-[13px] text-gray-500 mt-0.5 leading-snug">{{ $pendingArticlesCount }} artikel menunggu verifikasi</p>
                                    </div>
                                    <div class="flex-shrink-0 mt-2">
                                        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-orange-500 text-xs font-bold text-white">
                                            {{ $pendingArticlesCount > 9 ? '9+' : $pendingArticlesCount }}
                                        </span>
                                    </div>
                                </a>
                                @else
                                <div class="p-6 text-center">
                                    <div class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-500">Tidak ada notifikasi saat ini.</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- User Profile Dropdown -->
                    <div x-data="{ open: false }" class="relative ml-1">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 hover:bg-gray-50 rounded-lg p-1 pr-2 transition-colors">
                            <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center flex-shrink-0 overflow-hidden shadow-sm text-white font-bold text-sm">
                                @if (auth()->user()?->profile_photo_url)
                                    <img src="{{ auth()->user()->profile_photo_url }}" class="w-full h-full object-cover" alt="Profile">
                                @else
                                    {{ auth()->user()?->initials }}
                                @endif
                            </div>
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-bold text-gray-800 leading-tight">{{ auth()->user()?->nama }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()?->getCmsRole() }}</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition.opacity.duration.200ms x-cloak
                            class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50">
                            <!-- Header -->
                            <div class="bg-blue-600 p-4 flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0 overflow-hidden text-white font-bold text-lg border border-white/20">
                                    @if (auth()->user()?->profile_photo_url)
                                        <img src="{{ auth()->user()->profile_photo_url }}" class="w-full h-full object-cover" alt="Profile">
                                    @else
                                        {{ auth()->user()?->initials }}
                                    @endif
                                </div>
                                <div class="text-left text-white min-w-0">
                                    <p class="text-base font-bold truncate">{{ auth()->user()?->nama }}</p>
                                    <p class="text-sm text-blue-100 truncate">{{ auth()->user()?->getCmsRole() }}</p>
                                </div>
                            </div>
                            
                            <!-- Menu Items -->
                            <div class="py-2">
                                <a href="{{ url('/') }}" target="_blank" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    Portal Kominfo
                                </a>
                                
                                <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profil Saya
                                </a>



                                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    Two-Factor Auth
                                </a>

                                <div class="h-px bg-gray-100 my-1"></div>

                                <form method="POST" action="{{ route('admin.logout') }}" id="topbar-logout-form">
                                    @csrf
                                    <button type="button" onclick="confirmLogout(document.getElementById('topbar-logout-form'))" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page content -->
        <main class="flex-1 p-4 sm:p-6">

            {{-- Flash messages dihandle via SweetAlert (lihat @stack scripts di bawah) --}}

            @yield('content')
        </main>

        <footer class="py-3 px-6 border-t border-gray-200 bg-white">
            <p class="text-xs text-gray-400 text-center">CMS Portal Kominfo Tangerang Selatan &copy;
                {{ date('Y') }}</p>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('scripts')

    {{-- SweetAlert flash messages --}}
    @if (session('success'))
        <script>
            window.__flashSuccess = @json(session('success'));
        </script>
    @endif
    @if (session('error'))
        <script>
            window.__flashError = @json(session('error'));
        </script>
    @endif

    <!-- ── Image Lightbox ── -->
    <div id="img-lightbox" class="hidden fixed inset-0 z-[9999] flex items-center justify-center bg-black/80 p-4"
        onclick="closeLightbox()">
        <button onclick="event.stopPropagation(); closeLightbox()"
            class="absolute top-4 right-5 text-white/70 hover:text-white transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img id="img-lightbox-img" src="" alt="Preview"
            class="max-h-[88vh] max-w-[88vw] object-contain rounded-2xl" onclick="event.stopPropagation()">
    </div>
    <script>
        function openLightbox(src) {
            document.getElementById('img-lightbox-img').src = src;
            document.getElementById('img-lightbox').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('img-lightbox').classList.add('hidden');
            document.body.style.overflow = '';
        }
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeLightbox();
        });
    </script>
</body>

</html>
