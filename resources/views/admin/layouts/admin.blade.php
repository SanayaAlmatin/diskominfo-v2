<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CMS') — Diskominfo Tangsel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
    </style>
</head>

<body class="h-full bg-gray-50 font-sans" x-data="{ sidebarOpen: false }">

    <!-- Mobile sidebar overlay -->
    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-black/50 lg:hidden"
        @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <aside class="fixed inset-y-0 left-0 z-50 w-64 flex flex-col transition-transform duration-300 lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" style="background-color: var(--navy);">

        <!-- Logo -->
        <div class="flex items-center gap-3 px-6 py-5 border-b border-white/10">
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
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="text-blue-400 hover:text-red-400 transition-colors" title="Logout">
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
                        Lihat Website
                    </a>
                    <span class="text-gray-300">|</span>
                    <span class="text-xs text-gray-500 font-medium">{{ auth()->user()?->nama }}</span>
                </div>
            </div>
        </header>

        <!-- Page content -->
        <main class="flex-1 p-6">

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="mb-4 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 text-sm"
                    x-data x-init="setTimeout(() => $el.remove(), 4000)">
                    <svg class="w-4 h-4 flex-shrink-0 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-4 flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3 text-sm">
                    <svg class="w-4 h-4 flex-shrink-0 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="py-3 px-6 border-t border-gray-200 bg-white">
            <p class="text-xs text-gray-400 text-center">CMS Portal Diskominfo Tangerang Selatan &copy;
                {{ date('Y') }}</p>
        </footer>
    </div>

</body>

</html>
