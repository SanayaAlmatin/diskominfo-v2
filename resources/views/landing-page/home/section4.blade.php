<section id="aplikasi" class="relative py-20 bg-[#F8FAFC] overflow-hidden">

    {{-- ── Atmospheric Background Orbs ── --}}
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div
            class="absolute -top-24 -left-24 w-130 h-130 rounded-full bg-linear-to-br from-blue-100 to-sky-100 opacity-40 blur-3xl animate-pulse [animation-duration:6000ms]">
        </div>
        <div
            class="absolute -bottom-24 -right-24 w-130 h-130 rounded-full bg-linear-to-tl from-sky-100 to-blue-50 opacity-30 blur-3xl animate-pulse [animation-duration:8000ms]">
        </div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ── Section Header ── --}}
        <div class="mb-10 text-center">
            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900">
                Layanan
                <span class="bg-linear-to-r from-blue-600 to-amber-400 bg-clip-text text-transparent">Aplikasi
                    Publik</span>
            </h2>
            <p class="mt-2 text-base text-slate-500 max-w-2xl mx-auto">
                Akses seluruh layanan digital Kota Tangerang Selatan dalam satu portal terpadu.
            </p>
        </div>

        {{-- ── Alpine.js wrapper: search + tabs + cards ── --}}
        <div x-data="{ activeTab: 'all', search: '' }" class="space-y-8">

            {{-- Search Bar --}}
            <div class="relative max-w-lg mx-auto">
                <label for="app-search" class="sr-only">Cari nama aplikasi</label>
                <span
                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"
                    aria-hidden="true" style="font-size: 20px;">search</span>
                <input id="app-search" x-model="search" type="text" placeholder="Cari nama aplikasi..."
                    class="w-full pl-12 pr-5 py-3 bg-white border border-slate-200 rounded-full text-sm text-slate-800 placeholder:text-slate-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" />
            </div>

            {{-- Category Filter Tabs --}}
            <div class="flex flex-wrap gap-2 justify-center" role="tablist" aria-label="Filter kategori aplikasi">
                @foreach ([['key' => 'all', 'label' => 'Semua Layanan', 'icon' => 'apps'], ['key' => 'admin', 'label' => 'Administrasi', 'icon' => 'admin_panel_settings'], ['key' => 'health', 'label' => 'Kesehatan', 'icon' => 'health_and_safety'], ['key' => 'safety', 'label' => 'Keamanan Publik', 'icon' => 'shield'], ['key' => 'finance', 'label' => 'Keuangan', 'icon' => 'payments']] as $tab)
                    <button role="tab" :aria-selected="activeTab === '{{ $tab['key'] }}'"
                        @click="activeTab = '{{ $tab['key'] }}'"
                        :class="activeTab === '{{ $tab['key'] }}'
                            ?
                            'bg-blue-600 text-white shadow-md border-transparent' :
                            'bg-white text-slate-600 border-slate-200 hover:bg-slate-50 hover:border-slate-300'"
                        class="inline-flex items-center gap-1.5 px-5 py-2 rounded-full text-sm font-semibold border transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
                        <span class="material-symbols-outlined" aria-hidden="true"
                            style="font-variation-settings: 'FILL' 1; font-size: 16px;">{{ $tab['icon'] }}</span>
                        {{ $tab['label'] }}
                    </button>
                @endforeach
            </div>

            {{-- ── Featured Apps Zone ("Pilihan Admin") ── --}}
            <div>
                {{-- Zone label --}}
                <div class="flex items-center gap-3 mb-6">
                    <span
                        class="inline-flex items-center bg-blue-50 text-blue-600 border border-blue-200 rounded-full px-3 py-1 text-xs font-semibold shrink-0">
                        Aplikasi Terbaru
                    </span>
                    <div class="flex-1 h-px bg-slate-200/80"></div>
                </div>

                {{-- Featured Cards Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($featuredApps as $app)
                        <a href="{{ $app->href }}" aria-label="{{ $app->name }} — {{ $app->description }}"
                            class="group flex flex-col items-center text-center bg-white rounded-2xl border border-blue-200/60 shadow-[0_4px_20px_-2px_rgba(37,99,235,0.12)] hover:shadow-[0_10px_25px_-5px_rgba(37,99,235,0.22)] hover:-translate-y-1.5 transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">

                            <div class="py-7 px-7 flex flex-col items-center w-full">
                                {{-- Icon --}}
                                <div
                                    class="{{ $app->icon_bg }} w-20 h-20 rounded-2xl flex items-center justify-center p-3 relative overflow-hidden">
                                    @if ($app->icon_type === 'upload' && $app->logo_path)
                                        <img src="{{ Storage::disk('public')->url($app->logo_path) }}"
                                            alt="{{ $app->name }}" class="w-full h-full object-contain">
                                    @else
                                        <span class="material-symbols-outlined {{ $app->icon_color }}"
                                            aria-hidden="true"
                                            style="font-variation-settings: 'FILL' 1; font-size: 42px;">{{ $app->icon_material ?: 'apps' }}</span>
                                    @endif
                                </div>

                                <h3
                                    class="text-base font-bold text-slate-900 mt-4 group-hover:text-blue-600 transition-colors">
                                    {{ $app->name }}
                                </h3>
                                <p class="text-sm text-slate-500 mt-1.5 leading-relaxed line-clamp-2">
                                    {{ $app->description }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- ── Regular Apps Grid ── --}}
            <div>
                {{-- Zone label --}}
                <div class="flex items-center gap-3 mb-6">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-widest shrink-0">Semua
                        Aplikasi</span>
                    <div class="flex-1 h-px bg-slate-200/80"></div>
                </div>

                {{-- Single unified grid — x-show removes items from flow so visible cards always reflow cleanly --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach ($apps as $app)
                        <a href="{{ $app->href }}" aria-label="{{ $app->name }} — {{ $app->description }}"
                            x-show="(activeTab === 'all' || activeTab === '{{ $app->category }}') && '{{ strtolower($app->name) }}'.includes(search.toLowerCase())"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            @if ($loop->index === 8) :class="{ 'lg:col-start-2': activeTab === 'all' && search === '' }"
                            @elseif ($loop->index === 9) :class="{ 'lg:col-start-3': activeTab === 'all' && search === '' }" @endif
                            class="group flex flex-col items-center text-center bg-white rounded-2xl border border-slate-200/80 p-6 shadow-[0_2px_12px_-1px_rgba(37,99,235,0.07)] hover:shadow-[0_8px_20px_-4px_rgba(37,99,235,0.15)] hover:-translate-y-1 hover:border-blue-200 transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">

                            <div
                                class="{{ $app->icon_bg }} w-16 h-16 rounded-xl flex items-center justify-center p-2 relative overflow-hidden">
                                @if ($app->icon_type === 'upload' && $app->logo_path)
                                    <img src="{{ Storage::disk('public')->url($app->logo_path) }}"
                                        alt="{{ $app->name }}" class="w-full h-full object-contain">
                                @else
                                    <span class="material-symbols-outlined {{ $app->icon_color }}" aria-hidden="true"
                                        style="font-variation-settings: 'FILL' 1; font-size: 36px;">{{ $app->icon_material ?: 'apps' }}</span>
                                @endif
                            </div>
                            <h4
                                class="text-sm font-bold text-slate-900 mt-3 group-hover:text-blue-600 transition-colors">
                                {{ $app->name }}
                            </h4>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed line-clamp-2">
                                {{ $app->description }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- ── "Lihat Semua" CTA ── --}}
            <div class="pt-2 text-center">
                <a href="{{ route('layanan.aplikasi') }}" wire:navigate
                    class="group inline-flex items-center gap-2 border-2 border-blue-200 text-blue-700 rounded-full px-8 py-3 text-sm font-semibold hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
                    Lihat Semua Aplikasi
                    <span
                        class="material-symbols-outlined text-base group-hover:translate-x-1 transition-transform duration-200"
                        aria-hidden="true">arrow_forward</span>
                </a>
            </div>

        </div>
        {{-- /Alpine block --}}

    </div>
</section>
