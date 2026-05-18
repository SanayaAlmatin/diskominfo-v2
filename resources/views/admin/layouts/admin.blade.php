<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CMS') — Diskominfo Tangsel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    @stack('styles')
    <style>
        :root {
            --navy: #0F2044;
            --navy-dark: #091529;
            --navy-light: #1a3460;
            --yellow: #FFC107;
            --yellow-dark: #e5ac00;
        }

        .sidebar-nav a.active,
        .sidebar-nav a:hover {
            background-color: rgba(255, 193, 7, 0.15);
            color: #FFC107;
        }

        .sidebar-nav a.active {
            border-left: 3px solid #FFC107;
        }

        /* Hide sidebar on mobile before Alpine.js initializes */
        @media (max-width: 1023px) {
            [x-cloak] {
                display: none !important;
            }
        }

        div.dt-container,
        div.dt-container input,
        div.dt-container select,
        div.dt-container button {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Remove default row margins */
        div.dt-container div.dt-layout-row {
            margin: 0 !important;
        }

        /* ── Top bar: length + search ── */
        div.dt-container div.dt-layout-row:first-child {
            padding: 14px 20px;
            background: #F8FAFC;
            border-bottom: 1px solid #E2E8F0;
            border-radius: 12px 12px 0 0;
        }

        /* ── Table row: bottom rounding + horizontal scroll ── */
        div.dt-container div.dt-layout-row.dt-layout-table {
            border-radius: 0 0 12px 12px;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
        }

        /* ── Bottom bar: info only (pagination moved outside card) ── */
        div.dt-container div.dt-layout-row:last-child {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            flex-wrap: wrap;
            gap: 12px;
            padding: 10px 20px 0 20px;
            background: transparent;
            border-top: none;
        }

        div.dt-container div.dt-layout-row:last-child .dt-layout-cell {
            padding: 0 !important;
        }

        div.dt-container .dt-info {
            padding-left: 0;
        }

        /* ── External pagination container ── */
        [id^="dt-paging-"] {
            display: flex;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 4px;
            margin-top: 10px;
        }

        /* Label text */
        div.dt-container .dt-length,
        div.dt-container .dt-search {
            font-size: 13px;
            font-weight: 500;
            color: #64748B;
            letter-spacing: 0.01em;
        }

        /* Search input */
        div.dt-container .dt-search input {
            border: 1.5px solid #E2E8F0 !important;
            border-radius: 10px !important;
            padding: 7px 12px !important;
            font-size: 13px !important;
            outline: none;
            color: #0F172A;
            background: #FFFFFF;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
            transition: border-color .2s ease, box-shadow .2s ease;
            margin-left: 8px;
            width: 220px;
        }

        /* Length select */
        div.dt-container .dt-length select,
        div.dt-container select.dt-input {
            border: 1.5px solid #E2E8F0 !important;
            border-radius: 10px !important;
            padding: 6px 10px !important;
            font-size: 13px !important;
            outline: none;
            color: #0F172A;
            background: #FFFFFF;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
            transition: border-color .2s ease, box-shadow .2s ease;
            margin: 0 6px;
            cursor: pointer;
        }

        /* Focus — indigo ring */
        div.dt-container .dt-search input:focus,
        div.dt-container .dt-length select:focus,
        div.dt-container select.dt-input:focus {
            border-color: #4F46E5 !important;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.14),
                0 1px 3px rgba(15, 23, 42, 0.04) !important;
        }

        /* Info text */
        div.dt-container .dt-info {
            font-size: 12px;
            font-weight: 500;
            color: #94A3B8;
            letter-spacing: 0.01em;
        }

        /* ── Pagination buttons ── */
        div.dt-container .dt-paging .dt-paging-button {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            height: 32px;
            border-radius: 8px !important;
            padding: 0 10px !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            border: 1.5px solid #E2E8F0 !important;
            margin: 0 5px !important;
            color: #64748B !important;
            background: #FFFFFF !important;
            transition: all .2s ease !important;
            cursor: pointer;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04) !important;
            text-decoration: none !important;
            vertical-align: middle;
        }

        /* Active page — indigo→violet gradient + colored shadow */
        div.dt-container .dt-paging .dt-paging-button.current,
        div.dt-container .dt-paging .dt-paging-button.current:hover {
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%) !important;
            color: #FFFFFF !important;
            border-color: transparent !important;
            box-shadow: 0 4px 14px 0 rgba(79, 70, 229, 0.45) !important;
            transform: translateY(-1px);
        }

        /* Hover — indigo tint */
        div.dt-container .dt-paging .dt-paging-button:hover:not(.current):not(.disabled) {
            background: #EEF2FF !important;
            color: #4F46E5 !important;
            border-color: #C7D2FE !important;
            box-shadow: 0 2px 8px rgba(79, 70, 229, 0.12) !important;
            transform: translateY(-1px);
        }

        /* Disabled */
        div.dt-container .dt-paging .dt-paging-button.disabled,
        div.dt-container .dt-paging .dt-paging-button.disabled:hover,
        div.dt-container .dt-paging .dt-paging-button.disabled:active {
            color: #CBD5E1 !important;
            background: #F8FAFC !important;
            border-color: #F1F5F9 !important;
            box-shadow: none !important;
            cursor: not-allowed;
            transform: none !important;
        }

        /* ── Table header ── */
        table.dataTable thead th,
        table.dataTable thead td {
            border-bottom: 1.5px solid #E2E8F0 !important;
        }

        table.dataTable.no-footer {
            border-bottom: none !important;
        }

        /* Sort arrows — indigo when active */
        table.dataTable thead th.dt-ordering-asc span.dt-column-order::before,
        table.dataTable thead th.dt-ordering-desc span.dt-column-order::after {
            color: #4F46E5;
            opacity: 1 !important;
        }

        /* Dim sort arrows on inactive orderable columns */
        table.dataTable thead th.dt-orderable-asc span.dt-column-order,
        table.dataTable thead th.dt-orderable-desc span.dt-column-order {
            opacity: 0.3;
            transition: opacity .2s ease;
        }

        table.dataTable thead th:hover span.dt-column-order {
            opacity: 0.55;
        }

        /* Row hover — subtle indigo tint */
        table.dataTable tbody tr:hover>* {
            box-shadow: inset 0 0 0 9999px rgba(79, 70, 229, 0.028) !important;
        }

        /* ── Row & cell spacing ── */
        table.dataTable thead th,
        table.dataTable thead td {
            padding-top: 14px !important;
            padding-bottom: 14px !important;
            padding-left: 16px !important;
            padding-right: 16px !important;
        }

        table.dataTable tbody td {
            padding-top: 14px !important;
            padding-bottom: 14px !important;
            padding-left: 16px !important;
            padding-right: 16px !important;
            vertical-align: middle;
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
        @media (max-width: 640px) {

            /* Fix 2a — top bar stacks vertically */
            div.dt-container div.dt-layout-row:first-child {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 10px;
                padding: 12px 16px;
            }

            /* Fix 2b — search input fills width */
            div.dt-container .dt-search input {
                width: 100% !important;
                min-width: unset !important;
                margin-left: 0;
            }

            div.dt-container .dt-search {
                width: 100%;
            }

            /* Fix 2c — bottom bar (info) on mobile */
            div.dt-container div.dt-layout-row:last-child {
                justify-content: flex-start !important;
                padding: 8px 16px 0 16px;
            }

            /* Fix 2d — top bar horizontal padding reduced */
            div.dt-container div.dt-layout-row:first-child {
                padding-left: 16px;
                padding-right: 16px;
            }

            /* Fix 2e — external pagination container centered on mobile */
            [id^="dt-paging-"] {
                justify-content: center;
                margin-top: 8px;
            }

            /* Smaller pagination buttons on mobile */
            div.dt-container .dt-paging .dt-paging-button {
                min-width: 28px !important;
                height: 28px !important;
                padding: 0 8px !important;
                font-size: 12px !important;
                margin: 0 3px !important;
            }
        }
    </style>
</head>

<body class="h-full bg-gray-50 font-sans" x-data="{ sidebarOpen: false }">

    <!-- Mobile sidebar overlay -->
    <div x-cloak x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-black/50 lg:hidden"
        @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <aside class="fixed inset-y-0 left-0 z-50 w-64 flex flex-col transition-transform duration-300 lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" style="background-color: var(--navy);" x-cloak>

        <!-- Logo -->
        <div class="flex items-center justify-between gap-3 px-6 py-5 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0"
                    style="background-color: var(--yellow);">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.357l4-2a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zm5.99 7.176A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                    </svg>
                </div>
                <div>
                    <p class="text-white font-bold text-sm leading-tight">CMS Diskominfo</p>
                    <p class="text-blue-300 text-xs">Tangerang Selatan</p>
                </div>
            </div>
            <!-- Close button (mobile only) -->
            <button @click="sidebarOpen = false"
                class="lg:hidden p-1.5 rounded-lg text-blue-300 hover:text-white hover:bg-white/10 transition-colors flex-shrink-0">
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

            <div class="px-3 mt-4 mb-2">
                <p class="text-blue-400 text-xs font-semibold uppercase tracking-wider px-3 mb-1">Konten Profil</p>
            </div>

            <a href="{{ route('admin.sekilas.index') }}"
                class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.sekilas.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                <span>Sekilas Diskominfo</span>
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

            <div class="px-3 mt-4 mb-2">
                <p class="text-blue-400 text-xs font-semibold uppercase tracking-wider px-3 mb-1">Unit Kerja</p>
            </div>

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

            <div class="px-3 mt-4 mb-2">
                <p class="text-blue-400 text-xs font-semibold uppercase tracking-wider px-3 mb-1">Konten Halaman</p>
            </div>

            <a href="{{ route('admin.program-vacancy.index') }}"
                class="flex items-center gap-3 px-6 py-2.5 text-blue-100 text-sm transition-all
                      {{ request()->routeIs('admin.program-vacancy.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span>Program & Lowongan</span>
            </a>

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
                <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center flex-shrink-0">
                    @if (auth()->user()?->avatar)
                        <img src="{{ auth()->user()->avatar }}" class="w-8 h-8 rounded-full object-cover"
                            alt="">
                    @else
                        <span
                            class="text-white text-xs font-bold">{{ strtoupper(substr(auth()->user()?->nama ?? 'U', 0, 1)) }}</span>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-white text-sm font-medium truncate">{{ auth()->user()?->nama }}</p>
                    <p class="text-blue-400 text-xs truncate">{{ auth()->user()?->getCmsRole() }}</p>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}" id="logout-form">
                    @csrf
                    <button type="button" onclick="confirmLogout(document.getElementById('logout-form'))"
                        class="text-blue-400 hover:text-red-400 transition-colors" title="Logout">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main content -->
    <div class="lg:pl-64 flex flex-col min-h-screen">

        <!-- Top bar -->
        <header class="sticky top-0 z-30 bg-white border-b border-gray-200 shadow-sm">
            <div class="flex items-center justify-between px-4 h-14">
                <button @click="sidebarOpen = !sidebarOpen"
                    class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="hidden lg:block">
                    <h1 class="text-sm font-semibold text-gray-700">@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center gap-3 ml-auto">
                    <a href="{{ url('/') }}" target="_blank"
                        class="flex items-center gap-1.5 text-xs text-gray-500 hover:text-blue-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        <span class="hidden sm:inline">Lihat Website</span>
                    </a>
                    <span class="hidden sm:inline text-gray-300">|</span>
                    <span
                        class="hidden sm:inline text-xs text-gray-500 font-medium">{{ auth()->user()?->nama }}</span>
                </div>
            </div>
        </header>

        <!-- Page content -->
        <main class="flex-1 p-4 sm:p-6">

            {{-- Flash messages dihandle via SweetAlert (lihat @stack scripts di bawah) --}}

            @yield('content')
        </main>

        <footer class="py-3 px-6 border-t border-gray-200 bg-white">
            <p class="text-xs text-gray-400 text-center">CMS Portal Diskominfo Tangerang Selatan &copy;
                {{ date('Y') }}</p>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        // Global DataTables defaults — Bahasa Indonesia
        $.extend(true, $.fn.dataTable.defaults, {
            language: {
                lengthMenu: 'Tampilkan _MENU_ data',
                zeroRecords: 'Tidak ada data yang ditemukan',
                info: 'Menampilkan _START_–_END_ dari _TOTAL_ data',
                infoEmpty: 'Menampilkan 0 dari 0 data',
                infoFiltered: '(difilter dari _MAX_ total data)',
                search: 'Cari:',
                paginate: {
                    first: '«',
                    last: '»',
                    next: '›',
                    previous: '‹',
                },
                emptyTable: 'Belum ada data.',
            },
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            order: [],
            scrollX: true,
            scrollCollapse: true,
        });
    </script>
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
