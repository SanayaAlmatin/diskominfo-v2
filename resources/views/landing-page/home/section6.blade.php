@php
    $galleryItems = [
        [
            'category' => 'Digital Governance',
            'title' => 'Smart City Command Centre Tour 2024',
            'img' => null,
            'icon' => 'dns',
        ],
        [
            'category' => 'Community',
            'title' => 'Digital Literacy Workshop for Seniors',
            'img' => null,
            'icon' => 'groups',
        ],
        [
            'category' => 'Infrastructure',
            'title' => 'Fibre Optic Network Expansion Phase 3',
            'img' => null,
            'icon' => 'cable',
        ],
        [
            'category' => 'Innovation',
            'title' => 'Startup & GovTech Collaboration Summit',
            'img' => null,
            'icon' => 'rocket_launch',
        ],
    ];

    $featuredVideo = [
        'title' => 'Rapat Paripurna HUT Kota Tangerang Selatan ke-16 — Sidang Terbuka DPRD',
        'channel' => 'Diskominfo Tangsel Official',
        'duration' => '1:24:05',
        'date' => '26 Nov 2024',
        'icon' => 'record_voice_over',
    ];

    $playlistVideos = [
        [
            'title' => 'Live Streaming Upacara Hari Pahlawan 2024 — Lapangan A. Yani Tangsel',
            'date' => '10 Nov 2024',
            'duration' => '58:30',
            'icon' => 'flag',
        ],
        [
            'title' => 'Peluncuran Aplikasi TangselKu — Layanan Digital Terpadu Warga Tangsel',
            'date' => '05 Nov 2024',
            'duration' => '35:12',
            'icon' => 'smartphone',
        ],
        [
            'title' => 'Workshop Literasi Digital UMKM — Pemkot Tangsel × Kominfo RI',
            'date' => '28 Okt 2024',
            'duration' => '1:10:44',
            'icon' => 'storefront',
        ],
    ];
@endphp

<section id="gallery" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ── Section Header ── --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-10">
            <div>
                <span
                    class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-[#044FA0] mb-2">
                    <span class="h-px w-8 bg-[#F7D558] inline-block rounded-full"></span>
                    Photo Activities
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 leading-tight">
                    Activities Gallery
                </h2>
                <p class="mt-2 text-slate-500 text-sm max-w-lg">
                    A visual record of our programmes, initiatives, and community engagements across South Tangerang.
                </p>
            </div>
            <a href="#"
                class="inline-flex items-center gap-2 text-sm font-bold text-[#044FA0] hover:text-[#F7D558] transition-colors duration-200 whitespace-nowrap group">
                View Full Album
                <span
                    class="material-symbols-outlined text-lg transition-transform duration-200 group-hover:translate-x-1">arrow_forward</span>
            </a>
        </div>

        {{-- ── 4-Column Responsive Grid ── --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($galleryItems as $index => $item)
                <article
                    class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 overflow-hidden group flex flex-col"
                    style="animation: fadeSlideUp 0.55s ease both; animation-delay: {{ $index * 80 }}ms;">

                    {{-- Image Placeholder --}}
                    <div
                        class="relative w-full aspect-video object-cover overflow-hidden rounded-t-2xl bg-gradient-to-br from-[#044FA0]/10 to-[#044FA0]/25 flex items-center justify-center">
                        {{-- Replace with <img> when real images are available --}}
                        <span
                            class="material-symbols-outlined text-6xl text-[#044FA0]/30 group-hover:scale-110 transition-transform duration-300">
                            {{ $item['icon'] }}
                        </span>

                        {{-- Hover overlay --}}
                        <div
                            class="absolute inset-0 bg-[#044FA0]/0 group-hover:bg-[#044FA0]/60 transition-colors duration-300 flex items-center justify-center">
                            <span
                                class="material-symbols-outlined text-white text-4xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                open_in_full
                            </span>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="p-5 flex flex-col flex-1">
                        <span
                            class="inline-block text-[10px] md:text-xs font-bold uppercase tracking-widest text-[#044FA0] mb-2">
                            {{ $item['category'] }}
                        </span>
                        <h3
                            class="text-sm md:text-base font-bold leading-tight line-clamp-2 text-slate-800 group-hover:text-[#044FA0] transition-colors duration-200 flex-1">
                            {{ $item['title'] }}
                        </h3>
                        <div
                            class="mt-4 flex items-center gap-1 text-xs font-semibold text-[#044FA0] opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <span>View Photos</span>
                            <span class="material-symbols-outlined text-base">chevron_right</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

    </div>
</section>

<section id="videos" class="py-16 bg-[#044FA0]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ── Section Header ── --}}
        <div class="text-start w-full mb-8 md:mb-10">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white">
                Video Terbaru
            </h2>
        </div>

        {{-- ── Asymmetric 12-Column Grid ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            {{-- ─── LEFT: Hero / Main Featured Video (8 cols) ─── --}}
            <div class="lg:col-span-6 flex flex-col h-full lg:mt-9">
                {{-- Responsive Card: stacked on mobile, overlay on desktop --}}
                <div
                    class="flex flex-col md:block relative w-full rounded-2xl md:rounded-3xl overflow-hidden shadow-xl md:shadow-2xl bg-[#033b7a] md:bg-slate-900 group cursor-pointer">

                    {{-- TOP: Thumbnail & Play Button --}}
                    <div class="relative aspect-video w-full shrink-0 overflow-hidden">
                        {{-- Background Image Placeholder (replace src with real YouTube thumbnail URL) --}}
                        <img src="https://placehold.co/1280x720/1e293b/ffffff?text=Video+Thumbnail"
                            alt="{{ $featuredVideo['title'] }}"
                            class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-105 transition-transform duration-500">

                        {{-- Centered Play Button (Red, Responsive) --}}
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-30">
                            <div
                                class="w-14 h-14 md:w-20 md:h-20 rounded-full bg-red-600/90 flex items-center justify-center shadow-[0_0_20px_rgba(220,38,38,0.5)] group-hover:bg-red-600 transition-all duration-300 transform group-hover:scale-110">
                                <i class="fas fa-play text-white text-lg md:text-3xl ml-1 md:ml-2"></i>
                            </div>
                        </div>
                    </div>

                    {{-- BOTTOM (Mobile) / OVERLAY (Desktop): Text Content --}}
                    <div
                        class="flex flex-col p-4 bg-white rounded-b-2xl md:bg-transparent md:rounded-none md:absolute md:inset-0 md:bg-gradient-to-t md:from-black/95 md:via-black/50 md:to-transparent md:justify-end md:p-8 z-20">

                        {{-- Title --}}
                        <h3
                            class="text-slate-900 md:text-white font-bold text-base md:text-2xl leading-snug md:leading-tight line-clamp-2 md:drop-shadow-md">
                            {{ $featuredVideo['title'] }}
                        </h3>

                        {{-- Metadata Row --}}
                        <div
                            class="flex flex-wrap items-center gap-x-3 gap-y-2 mt-2 md:mt-3 text-[11px] sm:text-xs text-slate-600 md:text-gray-300 font-medium">
                            <div class="flex items-center gap-1.5">
                                <i class="far fa-calendar-alt text-red-500 md:text-white/70 text-xs md:text-sm"></i>
                                <span>{{ $featuredVideo['date'] }}</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <i class="far fa-clock text-red-500 md:text-white/70 text-xs md:text-sm"></i>
                                <span>{{ $featuredVideo['duration'] }}</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <i class="far fa-user-circle text-red-500 md:text-white/70 text-xs md:text-sm"></i>
                                <span class="text-slate-800 md:text-white">{{ $featuredVideo['channel'] }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ─── RIGHT: Playlist (6 cols) ─── --}}
            <div class="lg:col-span-6 flex flex-col gap-3">

                {{-- Playlist header --}}
                <p class="text-sm font-bold uppercase tracking-widest text-white mb-1 border-b border-white/10 pb-3">
                    Video Lainnya
                </p>

                @foreach ($playlistVideos as $index => $video)
                    <article
                        class="group flex flex-row gap-3 items-center cursor-pointer p-2 hover:bg-white/5 rounded-xl transition-colors duration-200">

                        {{-- Thumbnail --}}
                        <div
                            class="relative w-32 md:w-36 aspect-video rounded-lg overflow-hidden bg-[#021e45] shrink-0">
                            {{-- Placeholder background --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-[#1a5fb4]/60 to-[#021e45] flex items-center justify-center">
                                <span
                                    class="material-symbols-outlined text-3xl text-white/20 select-none">{{ $video['icon'] }}</span>
                            </div>
                            {{-- Play overlay on hover --}}
                            <div
                                class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors duration-200">
                            </div>
                            {{-- Small play icon --}}
                            <span
                                class="absolute inset-0 m-auto w-8 h-8 rounded-full bg-red-600 flex items-center justify-center shadow group-hover:scale-110 transition-transform duration-200">
                                <span class="material-symbols-outlined text-white text-base"
                                    style="font-variation-settings: 'FILL' 1;">
                                    play_arrow
                                </span>
                            </span>
                            {{-- Duration badge --}}
                            <span
                                class="absolute bottom-1 right-1 bg-black/80 text-white text-[10px] font-bold px-1.5 py-0.5 rounded">
                                {{ $video['duration'] }}
                            </span>
                        </div>

                        {{-- Video Details --}}
                        <div class="flex flex-col flex-1 min-w-0">
                            <h4
                                class="text-sm font-semibold text-white leading-snug line-clamp-2 group-hover:text-white transition-colors duration-200">
                                {{ $video['title'] }}
                            </h4>
                            <div class="flex items-center gap-2 mt-1.5 text-xs text-blue-300">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">calendar_today</span>
                                    {{ $video['date'] }}
                                </span>
                            </div>
                        </div>

                    </article>
                @endforeach

            </div>

        </div>

        {{-- ── Bottom CTA ── --}}
        <div class="flex justify-center mt-10 md:mt-12 w-full">
            <a href="https://www.youtube.com/@diskominfotangsel" target="_blank" rel="noopener noreferrer"
                class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-red-600 hover:bg-red-700 text-white text-sm md:text-base font-bold rounded-2xl md:rounded-3xl transition-all duration-200 hover:-translate-y-1 shadow-lg shadow-red-600/20">
                <i class="fab fa-youtube text-lg md:text-xl"></i>
                Kunjungi Channel YouTube
            </a>
        </div>

    </div>
</section>

@push('styles')
    <style>
        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush
