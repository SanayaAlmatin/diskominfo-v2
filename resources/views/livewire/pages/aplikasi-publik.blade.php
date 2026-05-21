@push('styles')
    <style>
        /* â”€â”€ Hero â”€â”€ */
        .aplikasi-publik .ap-hero {
            background: linear-gradient(135deg, #0b3c6f 0%, #0d4f94 52%, #1f78b9 100%);
            position: relative;
        }

        .aplikasi-publik .ap-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='220' height='220' viewBox='0 0 220 220' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23FFFFFF' stroke-opacity='0.18' stroke-width='1.2'%3E%3Cpath d='M12 38h68v48h60v70h68'/%3E%3Cpath d='M32 188h48v-58h84V64h36'/%3E%3C/g%3E%3Cg fill='%23F7D558' fill-opacity='0.35'%3E%3Ccircle cx='72' cy='64' r='5'/%3E%3Ccircle cx='148' cy='152' r='5'/%3E%3Ccircle cx='170' cy='42' r='4'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 220px 220px;
            background-position: 0 0;
            opacity: 0.6;
            animation: apPatternDrift 48s linear infinite;
            pointer-events: none;
        }

        .aplikasi-publik .ap-orb {
            position: absolute;
            border-radius: 9999px;
            pointer-events: none;
            opacity: 0.7;
            filter: blur(0.5px);
            animation: apOrbFloat 9s ease-in-out infinite;
        }

        .aplikasi-publik .ap-orb.orb-1 {
            width: 220px;
            height: 220px;
            right: 4%;
            top: -80px;
            background: radial-gradient(circle at 30% 30%, rgba(247, 213, 88, 0.55), rgba(247, 213, 88, 0));
            animation-delay: 0.3s;
        }

        .aplikasi-publik .ap-orb.orb-2 {
            width: 160px;
            height: 160px;
            left: -40px;
            bottom: -60px;
            background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.35), rgba(255, 255, 255, 0));
            animation-delay: 1.2s;
        }

        .aplikasi-publik .ap-orb.orb-3 {
            width: 120px;
            height: 120px;
            right: 24%;
            bottom: 12%;
            background: radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.28), rgba(255, 255, 255, 0));
            animation-delay: 2.1s;
        }

        /* â”€â”€ Fade-up entry animation â”€â”€ */
        .aplikasi-publik .ap-fade-up {
            opacity: 0;
            transform: translateY(16px);
            animation: apFadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        .aplikasi-publik .ap-delay-1 {
            animation-delay: 0.08s;
        }

        .aplikasi-publik .ap-delay-2 {
            animation-delay: 0.16s;
        }

        .aplikasi-publik .ap-delay-3 {
            animation-delay: 0.24s;
        }

        .aplikasi-publik .ap-delay-4 {
            animation-delay: 0.34s;
        }

        @keyframes apFadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes apPatternDrift {
            from {
                background-position: 0 0;
            }

            to {
                background-position: 240px 160px;
            }
        }

        @keyframes apOrbFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        /* â”€â”€ App cards â”€â”€ */
        .aplikasi-publik .ap-featured-card {
            box-shadow: 0 4px 20px -2px rgba(37, 99, 235, 0.12);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .aplikasi-publik .ap-featured-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.22);
        }

        .aplikasi-publik .ap-card {
            box-shadow: 0 2px 12px -1px rgba(37, 99, 235, 0.07);
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .aplikasi-publik .ap-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px -4px rgba(37, 99, 235, 0.15);
            border-color: #bfdbfe;
            /* blue-200 */
        }

        @media (prefers-reduced-motion: reduce) {

            .aplikasi-publik .ap-hero::before,
            .aplikasi-publik .ap-orb,
            .aplikasi-publik .ap-fade-up {
                animation: none !important;
                opacity: 1 !important;
                transform: none !important;
            }

            .aplikasi-publik .ap-featured-card:hover,
            .aplikasi-publik .ap-card:hover {
                transform: none;
            }
        }

        /* ── Navbar: force dark glass on this page instead of picking up body's white background ── */
        .aplikasi-publik [data-site-header]>div:first-child {
            background: rgba(4, 79, 160, 0.45) !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
        }
    </style>
@endpush

<main class="flex-1">

    {{-- â”€â”€ Hero â”€â”€ --}}
    <section class="ap-hero relative overflow-hidden text-white">
        <span class="ap-orb orb-1"></span>
        <span class="ap-orb orb-2"></span>
        <span class="ap-orb orb-3"></span>

        <div class="relative mx-auto max-w-7xl px-4 pb-24 pt-28 sm:px-6 lg:px-8 lg:pb-32 lg:pt-36 text-center">

            {{-- Breadcrumb --}}
            <div class="flex justify-center">
                <x-breadcrumb class="ap-fade-up ap-delay-1 mb-6" :links="[['label' => 'Beranda', 'url' => route('home')], ['label' => 'Layanan Aplikasi Publik']]" />
            </div>

            {{-- Section tag --}}
            <div class="ap-fade-up ap-delay-1 flex justify-center">
                <div
                    class="inline-flex items-center gap-3 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em]">
                    <span class="h-2 w-2 rounded-full bg-[#F7D558]"></span>
                    Layanan Digital
                </div>
            </div>

            <h1 class="ap-fade-up ap-delay-2 mt-4 text-3xl font-extrabold leading-tight sm:text-4xl lg:text-5xl">
                Layanan Aplikasi Publik
            </h1>

            <p class="ap-fade-up ap-delay-3 mt-4 max-w-2xl mx-auto text-base leading-7 text-blue-100">
                Seluruh layanan digital Kota Tangerang Selatan dalam satu portal terpadu â€” dari administrasi warga
                hingga pemantauan kota.
            </p>

            {{-- Stats badges --}}
            <div
                class="ap-fade-up ap-delay-4 mt-6 flex flex-wrap items-center justify-center gap-4 text-sm text-blue-100">
                <span class="flex items-center gap-1.5">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    {{ $totalApps }} aplikasi tersedia
                </span>
                <span class="text-white/30">Â·</span>
                <span class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-base text-[#F7D558]" aria-hidden="true"
                        style="font-variation-settings: 'FILL' 1;">category</span>
                    5 kategori layanan
                </span>
            </div>

            {{-- Search Bar â”€â”€ inside hero â”€â”€ --}}
            <div class="ap-fade-up ap-delay-4 mt-8 relative max-w-lg mx-auto">
                <label for="ap-search" class="sr-only">Cari nama aplikasi</label>
                <span
                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"
                    aria-hidden="true" style="font-size: 20px;">search</span>
                <input id="ap-search" wire:model.live.debounce.300ms="search" type="text"
                    placeholder="Cari nama aplikasi..." autocomplete="off"
                    class="w-full pl-12 pr-10 py-3.5 bg-white border border-transparent rounded-full text-sm text-slate-800 placeholder:text-slate-400 shadow-xl focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-200" />
                @if ($search)
                    <button wire:click="$set('search', '')"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors"
                        aria-label="Hapus pencarian">
                        <span class="material-symbols-outlined" style="font-size: 18px;">close</span>
                    </button>
                @endif
            </div>

        </div>
    </section>

    {{-- â”€â”€ Main Content â”€â”€ --}}
    <section class="py-14 bg-[#F8FAFC]">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- â”€â”€ Category Tabs â”€â”€ --}}
            <div class="flex flex-wrap gap-2 justify-center" role="tablist" aria-label="Filter kategori aplikasi">
                @foreach ([['key' => 'all', 'label' => 'Semua Layanan', 'icon' => 'apps'], ['key' => 'admin', 'label' => 'Administrasi', 'icon' => 'description'], ['key' => 'health', 'label' => 'Kesehatan', 'icon' => 'health_and_safety'], ['key' => 'safety', 'label' => 'Keamanan Publik', 'icon' => 'security'], ['key' => 'finance', 'label' => 'Keuangan', 'icon' => 'account_balance']] as $tab)
                    <button role="tab" wire:click="selectTab('{{ $tab['key'] }}')"
                        aria-selected="{{ $activeTab === $tab['key'] ? 'true' : 'false' }}"
                        @class([
                            'inline-flex items-center gap-1.5 px-5 py-2 rounded-full text-sm font-semibold border transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2',
                            'bg-blue-600 text-white shadow-md border-transparent' =>
                                $activeTab === $tab['key'],
                            'bg-white text-slate-600 border-slate-200 hover:bg-slate-50 hover:border-slate-300' =>
                                $activeTab !== $tab['key'],
                        ])>
                        <span class="material-symbols-outlined" aria-hidden="true"
                            style="font-variation-settings: 'FILL' 1; font-size: 15px;">{{ $tab['icon'] }}</span>
                        {{ $tab['label'] }}
                    </button>
                @endforeach
            </div>

            {{-- â”€â”€ Result count â”€â”€ --}}
            <div class="text-center -mt-2">
                <span wire:loading.remove class="text-xs text-slate-400">
                    Menampilkan {{ $filteredApps->count() }} aplikasi
                    @if ($activeTab !== 'all' || $search !== '')
                        <span class="text-blue-500">(difilter dari {{ $totalApps }} total)</span>
                    @endif
                </span>
                <span wire:loading class="text-xs text-slate-400 animate-pulse">Memuat...</span>
            </div>

            {{-- â”€â”€ Apps Grid â”€â”€ --}}
            <div wire:loading.class="opacity-50 pointer-events-none" class="transition-opacity duration-200">

                @if ($filteredApps->isEmpty())
                    {{-- Empty state --}}
                    <div
                        class="mx-auto max-w-sm rounded-2xl border border-slate-100 bg-white px-8 py-14 text-center shadow-sm">
                        <div class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-2xl bg-blue-50">
                            <span class="material-symbols-outlined text-blue-300" aria-hidden="true"
                                style="font-size: 40px;">search_off</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Aplikasi tidak ditemukan</h3>
                        <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                            Tidak ada aplikasi yang cocok dengan pencarian
                            @if ($search !== '')
                                "<strong>{{ $search }}</strong>"
                            @endif
                            @if ($activeTab !== 'all')
                                pada kategori <strong>{{ $activeTab }}</strong>
                            @endif.
                        </p>
                        <button wire:click="resetFilter"
                            class="mt-6 inline-flex items-center gap-2 rounded-full bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:-translate-y-0.5 hover:shadow-md transition-all duration-200">
                            Reset Filter
                        </button>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                        @foreach ($filteredApps as $app)
                            <div class="ap-card group flex flex-col bg-white rounded-2xl border border-slate-200/80">
                                {{-- Upper: centered icon + name + desc --}}
                                <div class="flex flex-col items-center text-center flex-1 px-6 pt-6 pb-4">
                                    <div
                                        class="{{ $app['icon_bg'] }} w-14 h-14 rounded-xl flex items-center justify-center">
                                        <span class="material-symbols-outlined {{ $app['icon_color'] }}"
                                            aria-hidden="true"
                                            style="font-variation-settings: 'FILL' 1; font-size: 28px;">{{ $app['icon'] }}</span>
                                    </div>
                                    <h4
                                        class="text-sm font-bold text-slate-900 mt-3 group-hover:text-blue-600 transition-colors">
                                        {{ $app['name'] }}
                                    </h4>
                                    <p class="text-xs text-slate-500 mt-1 leading-relaxed line-clamp-2">
                                        {{ $app['desc'] }}
                                    </p>
                                </div>
                                {{-- Footer: URL (left) + open button (right) --}}
                                <div class="mx-4 mb-4 pt-3 border-t border-slate-100 flex items-center gap-2 min-w-0">
                                    <span class="text-xs text-slate-400 truncate flex-1 min-w-0"
                                        title="{{ $app['url'] }}">
                                        {{ $app['url'] }}
                                    </span>
                                    <a href="{{ $app['href'] }}" target="_blank" rel="noopener noreferrer"
                                        aria-label="Buka {{ $app['name'] }} di tab baru"
                                        class="inline-flex items-center gap-1 bg-blue-600 text-white text-xs font-semibold px-2.5 py-1.5 rounded-lg hover:bg-blue-700 active:scale-95 transition-all shrink-0 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-1">
                                        Buka
                                        <span class="material-symbols-outlined" aria-hidden="true"
                                            style="font-size: 13px;">open_in_new</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

            {{-- â”€â”€ Back to home â”€â”€ --}}
            <div class="pt-2 text-center">
                <a href="{{ route('home') }}" wire:navigate
                    class="group inline-flex items-center gap-2 border-2 border-blue-200 text-blue-700 rounded-full px-8 py-3 text-sm font-semibold hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
                    <span
                        class="material-symbols-outlined text-base group-hover:-translate-x-1 transition-transform duration-200"
                        aria-hidden="true">arrow_back</span>
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </section>

</main>
