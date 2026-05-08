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
        'title' => 'Annual Digital Transformation Progress Report — South Tangerang 2024',
        'duration' => '42:18',
        'date' => '15 Apr 2024',
    ];

    $sideVideos = [
        [
            'title' => 'City Data Governance Policy Briefing',
            'date' => '10 Apr 2024',
            'duration' => '28:05',
            'icon' => 'policy',
        ],
        [
            'title' => 'Cybersecurity Infrastructure Update',
            'date' => '02 Apr 2024',
            'duration' => '19:44',
            'icon' => 'security',
        ],
        [
            'title' => 'Public WiFi Expansion — Q1 Review',
            'date' => '25 Mar 2024',
            'duration' => '22:30',
            'icon' => 'wifi',
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

<section id="videos" class="py-20 bg-[#044FA0]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ── Section Header ── --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10">
            <div>
                <span
                    class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-[#F7D558] mb-2">
                    <span class="h-px w-8 bg-[#F7D558] inline-block rounded-full"></span>
                    Official Recordings
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                    Latest Public Briefings
                </h2>
            </div>
            <a href="#"
                class="inline-flex items-center gap-2 bg-[#F7D558] text-[#044FA0] font-bold rounded-full px-6 py-2 text-sm hover:bg-white transition-colors duration-200 whitespace-nowrap self-start sm:self-auto">
                <span class="material-symbols-outlined text-base"
                    style="font-variation-settings: 'FILL' 1;">play_circle</span>
                Watch All Videos
            </a>
        </div>

        {{-- ── Two-Column Layout ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

            {{-- ─── LEFT: Main Featured Video ─── --}}
            <div class="group cursor-pointer" x-data>

                {{-- Thumbnail Container --}}
                <div
                    class="relative rounded-2xl overflow-hidden bg-gradient-to-br from-[#1a5fb4] to-[#033a7a] aspect-video flex items-center justify-center shadow-2xl">

                    {{-- Replace with real thumbnail image: --}}
                    {{-- <img src="..." alt="{{ $featuredVideo['title'] }}" class="absolute inset-0 w-full h-full object-cover"> --}}

                    {{-- Background icon placeholder --}}
                    <span class="material-symbols-outlined text-8xl text-white/10">
                        videocam
                    </span>

                    {{-- Dark overlay that clears on hover --}}
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors duration-300">
                    </div>

                    {{-- Large Yellow Play Button --}}
                    <button
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-20 h-20 rounded-full bg-[#F7D558] flex items-center justify-center shadow-lg hover:scale-110 active:scale-95 transition-transform duration-200 z-10"
                        aria-label="Play featured video">
                        {{-- Pulse ring --}}
                        <span class="absolute inset-0 rounded-full bg-[#F7D558]/40 animate-ping"></span>
                        <span class="material-symbols-outlined text-[#044FA0] text-3xl z-10"
                            style="font-variation-settings: 'FILL' 1;">
                            play_arrow
                        </span>
                    </button>

                    {{-- Bottom Gradient Overlay with badge & title --}}
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent px-5 pb-5 pt-16">
                        <span
                            class="inline-block bg-[#F7D558] text-[#044FA0] text-xs font-extrabold uppercase tracking-widest px-3 py-1 rounded-full mb-2">
                            Featured Briefing
                        </span>
                        <h3 class="text-base font-bold text-white leading-snug">
                            {{ $featuredVideo['title'] }}
                        </h3>
                        <div class="flex items-center gap-3 mt-2 text-xs text-white/70">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">calendar_today</span>
                                {{ $featuredVideo['date'] }}
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">schedule</span>
                                {{ $featuredVideo['duration'] }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ─── RIGHT: Side Video List ─── --}}
            <div class="flex flex-col gap-4">
                @foreach ($sideVideos as $index => $video)
                    <article
                        class="group flex gap-4 items-start bg-white/10 hover:bg-white/20 rounded-2xl p-4 cursor-pointer transition-colors duration-200">

                        {{-- Small Thumbnail --}}
                        <div
                            class="relative flex-shrink-0 w-28 aspect-video rounded-xl overflow-hidden bg-white/10 flex items-center justify-center">
                            {{-- Replace with <img> when available --}}
                            <span class="material-symbols-outlined text-3xl text-white/30">{{ $video['icon'] }}</span>

                            {{-- Tiny Yellow Play Button --}}
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span
                                    class="w-8 h-8 rounded-full bg-[#F7D558] flex items-center justify-center shadow group-hover:scale-110 transition-transform duration-200"
                                    aria-label="Play video">
                                    <span class="material-symbols-outlined text-[#044FA0] text-base"
                                        style="font-variation-settings: 'FILL' 1; font-size: 16px;">
                                        play_arrow
                                    </span>
                                </span>
                            </div>
                        </div>

                        {{-- Video Info --}}
                        <div class="flex-1 min-w-0">
                            <span class="inline-block text-[#F7D558] text-xs font-bold uppercase tracking-widest mb-1">
                                Briefing #{{ count($sideVideos) - $index + 1 }}
                            </span>
                            <h4
                                class="text-sm font-bold text-white leading-snug group-hover:text-[#F7D558] transition-colors duration-200 line-clamp-2">
                                {{ $video['title'] }}
                            </h4>
                            <div class="flex items-center gap-3 mt-2 text-xs text-white/60">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">calendar_today</span>
                                    {{ $video['date'] }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">schedule</span>
                                    {{ $video['duration'] }}
                                </span>
                            </div>
                        </div>

                        <span
                            class="material-symbols-outlined text-white/30 group-hover:text-[#F7D558] transition-colors duration-200 mt-1 flex-shrink-0">
                            chevron_right
                        </span>
                    </article>
                @endforeach


            </div>

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
