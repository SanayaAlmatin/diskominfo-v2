@php
    use App\Models\TmFoto;
    use App\Models\TmYoutubeVideo;

    try {
        $galleryItems = TmFoto::active()
            ->orderBy('sort_order')
            ->latest()
            ->take(4)
            ->get();
    } catch (\Exception $e) {
        $galleryItems = collect();
    }

    try {
        $featuredVideo = TmYoutubeVideo::getFeaturedVideo();
        $allVideos = TmYoutubeVideo::getRecentVideos(7);
        $playlistVideos = $featuredVideo
            ? $allVideos->filter(fn($v) => $v->id !== $featuredVideo->id)->values()->slice(0, 6)
            : $allVideos->slice(0, 6);
    } catch (\Exception $e) {
        $featuredVideo = null;
        $playlistVideos = collect();
    }

    $videoPages = $playlistVideos->chunk(3);
@endphp

<section id="gallery" class="py-20 bg-white"
    x-data="{ lbOpen: false, lbSrc: '', lbTitle: '', lbCat: '' }"
    @keydown.escape.window="lbOpen = false">
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
            <a href="{{ route('galeri.foto') }}" wire:navigate
                class="inline-flex items-center gap-2 text-sm font-bold text-[#044FA0] hover:text-[#F7D558] transition-colors duration-200 whitespace-nowrap group">
                View Full Album
                <span
                    class="material-symbols-outlined text-lg transition-transform duration-200 group-hover:translate-x-1">arrow_forward</span>
            </a>
        </div>

        {{-- ── 4-Column Responsive Grid ── --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($galleryItems as $index => $item)
                <article
                    class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 overflow-hidden group flex flex-col"
                    style="animation: fadeSlideUp 0.55s ease both; animation-delay: {{ $index * 80 }}ms;">

                    {{-- Image --}}
                    <div
                        class="relative w-full aspect-video overflow-hidden rounded-t-2xl bg-gradient-to-br from-[#044FA0]/10 to-[#044FA0]/25 flex items-center justify-center">
                        @if ($item->image_path)
                            <img src="{{ Storage::url($item->image_path) }}"
                                alt="{{ $item->title }}"
                                class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                loading="lazy">
                        @else
                            <span class="material-symbols-outlined text-6xl text-[#044FA0]/30 group-hover:scale-110 transition-transform duration-300">
                                image
                            </span>
                        @endif

                        {{-- Hover overlay --}}
                        @if ($item->image_path)
                            <div class="absolute inset-0 cursor-pointer bg-[#044FA0]/0 transition-colors duration-300 group-hover:bg-[#044FA0]/60 flex items-center justify-center"
                                @click="lbSrc = {{ Js::from(Storage::url($item->image_path)) }}; lbTitle = {{ Js::from($item->title) }}; lbCat = {{ Js::from($item->category ?? 'Kegiatan') }}; lbOpen = true">
                                <span class="material-symbols-outlined text-white text-4xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    open_in_full
                                </span>
                            </div>
                        @else
                            <div class="absolute inset-0 bg-[#044FA0]/0 group-hover:bg-[#044FA0]/60 transition-colors duration-300 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-4xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    open_in_full
                                </span>
                            </div>
                        @endif
                    </div>

                    {{-- Card Body --}}
                    <div class="p-5 flex flex-col flex-1">
                        <span
                            class="inline-block text-[10px] md:text-xs font-bold uppercase tracking-widest text-[#044FA0] mb-2">
                            {{ $item->category ?? 'Kegiatan' }}
                        </span>
                        <h3
                            class="text-sm md:text-base font-bold leading-tight line-clamp-2 text-slate-800 group-hover:text-[#044FA0] transition-colors duration-200 flex-1">
                            {{ $item->title }}
                        </h3>
                    </div>
                </article>
            @empty
                {{-- Placeholder saat belum ada foto --}}
                @foreach (range(0, 3) as $index)
                    <article
                        class="bg-white rounded-2xl shadow-sm overflow-hidden flex flex-col"
                        style="animation: fadeSlideUp 0.55s ease both; animation-delay: {{ $index * 80 }}ms;">
                        <div class="w-full aspect-video bg-gradient-to-br from-[#044FA0]/10 to-[#044FA0]/25 flex items-center justify-center rounded-t-2xl">
                            <span class="material-symbols-outlined text-6xl text-[#044FA0]/20">image</span>
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <span class="inline-block h-3 w-20 bg-slate-100 rounded mb-2"></span>
                            <span class="inline-block h-4 w-full bg-slate-100 rounded mb-1"></span>
                            <span class="inline-block h-4 w-3/4 bg-slate-100 rounded"></span>
                        </div>
                    </article>
                @endforeach
            @endforelse
        </div>

    </div>

    {{-- ── Lightbox Modal ── --}}
    <div x-show="lbOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[1000] flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
        @click.self="lbOpen = false"
        style="display:none;">

        <div x-show="lbOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative max-w-3xl w-full bg-white rounded-2xl overflow-hidden shadow-2xl">

            {{-- Close button --}}
            <button @click="lbOpen = false"
                class="absolute top-3 right-3 z-10 flex h-8 w-8 items-center justify-center rounded-full bg-black/50 text-white hover:bg-black/70 transition-colors">
                <span class="material-symbols-outlined text-lg">close</span>
            </button>

            {{-- Image --}}
            <img :src="lbSrc" :alt="lbTitle"
                class="w-full max-h-[70vh] object-contain bg-slate-900">

            {{-- Caption --}}
            <div class="px-5 py-4">
                <p x-show="lbCat" class="text-[11px] font-bold uppercase tracking-widest text-[#044FA0] mb-1" x-text="lbCat"></p>
                <p class="text-sm font-semibold text-slate-800" x-text="lbTitle"></p>
            </div>
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
                <a href="{{ $featuredVideo?->getYoutubeUrl() ?? '#' }}" target="_blank" rel="noopener noreferrer"
                    class="flex flex-col md:block relative w-full rounded-2xl md:rounded-3xl overflow-hidden shadow-xl md:shadow-2xl bg-[#033b7a] md:bg-slate-900 group cursor-pointer">

                    {{-- TOP: Thumbnail & Play Button --}}
                    <div class="relative aspect-video w-full shrink-0 overflow-hidden">
                        {{-- Background Image (from YouTube) --}}
                        <img src="{{ $featuredVideo?->thumbnail_url ?? 'https://placehold.co/1280x720/1e293b/ffffff?text=Video+Thumbnail' }}"
                            alt="{{ $featuredVideo?->title ?? 'Featured Video' }}"
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
                            {{ $featuredVideo?->title ?? 'Featured Video' }}
                        </h3>

                        {{-- Metadata Row --}}
                        <div
                            class="flex flex-wrap items-center gap-x-3 gap-y-2 mt-2 md:mt-3 text-[11px] sm:text-xs text-slate-600 md:text-gray-300 font-medium">
                            @if ($featuredVideo)
                                <div class="flex items-center gap-1.5">
                                    <i class="far fa-calendar-alt text-red-500 md:text-white/70 text-xs md:text-sm"></i>
                                    <span>{{ $featuredVideo->published_at->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <i class="far fa-clock text-red-500 md:text-white/70 text-xs md:text-sm"></i>
                                    <span>{{ $featuredVideo->duration }}</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <i class="far fa-user-circle text-red-500 md:text-white/70 text-xs md:text-sm"></i>
                                    <span
                                        class="text-slate-800 md:text-white">{{ $featuredVideo->channel_name }}</span>
                                </div>
                            @endif
                        </div>

                    </div>
                </a>
            </div>

            {{-- ─── RIGHT: Video Lainnya (6 cols) ─── --}}
            <div class="lg:col-span-6 flex flex-col">

                {{-- Header --}}
                <p class="text-sm font-bold uppercase tracking-widest text-white mb-3 border-b border-white/10 pb-3">
                    Video Lainnya
                </p>

                @if ($playlistVideos->isNotEmpty())
                    <div class="relative select-none"
                        x-data="{
                            active: 0,
                            totalPages: {{ $videoPages->count() }},
                            autoPlayInterval: null,
                            startX: 0,
                            endX: 0,
                            init() { this.resume(); },
                            pause() { clearInterval(this.autoPlayInterval); },
                            resume() {
                                this.pause();
                                this.autoPlayInterval = setInterval(() => this.next(), 4000);
                            },
                            next() { this.active = (this.active + 1) % this.totalPages; },
                            prev() { this.active = (this.active - 1 + this.totalPages) % this.totalPages; },
                            goTo(i) { this.active = i; },
                            handleSwipe() {
                                const d = this.startX - this.endX;
                                if (d > 40) this.next();
                                else if (d < -40) this.prev();
                            },
                            getPageClass(i) {
                                return i === this.active ? 'vp6-page vp6-active' : 'vp6-page vp6-hidden';
                            }
                        }"
                        @mouseenter="pause()" @mouseleave="resume()"
                        @touchstart.passive="startX = $event.touches[0].clientX"
                        @touchend="endX = $event.changedTouches[0].clientX; handleSwipe()"
                        @mousedown="startX = $event.clientX"
                        @mouseup="endX = $event.clientX; handleSwipe()">

                        <div class="flex flex-row gap-3 items-stretch">

                            {{-- Page Viewport --}}
                            <div class="flex-1 relative min-h-[295px] md:min-h-[325px]">
                                @foreach ($videoPages as $pageIdx => $page)
                                    <div :class="getPageClass({{ $pageIdx }})"
                                         class="absolute inset-x-0 top-0 flex flex-col gap-3">
                                        @foreach ($page as $video)
                                            <a href="{{ $video->getYoutubeUrl() }}"
                                               target="_blank" rel="noopener noreferrer"
                                               class="group flex flex-row gap-3 items-center p-2 hover:bg-white/5 rounded-xl transition-colors duration-200">

                                                <div class="relative w-32 md:w-36 aspect-video rounded-lg overflow-hidden bg-[#021e45] shrink-0">
                                                    <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}"
                                                         class="absolute inset-0 w-full h-full object-cover">
                                                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors duration-200"></div>
                                                    <span class="absolute inset-0 m-auto w-8 h-8 rounded-full bg-red-600 flex items-center justify-center shadow group-hover:scale-110 transition-transform duration-200">
                                                        <span class="material-symbols-outlined text-white text-base"
                                                              style="font-variation-settings:'FILL' 1;">play_arrow</span>
                                                    </span>
                                                    <span class="absolute bottom-1 right-1 bg-black/80 text-white text-[10px] font-bold px-1.5 py-0.5 rounded">
                                                        {{ $video->duration }}
                                                    </span>
                                                </div>

                                                <div class="flex flex-col flex-1 min-w-0">
                                                    <h4 class="text-sm font-semibold text-white leading-snug line-clamp-2">
                                                        {{ $video->title }}
                                                    </h4>
                                                    <div class="flex items-center gap-1.5 mt-1.5 text-xs text-blue-300">
                                                        <span class="material-symbols-outlined text-xs">calendar_today</span>
                                                        {{ $video->published_at->format('d M Y') }}
                                                    </div>
                                                </div>

                                            </a>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>

                            {{-- Nav Buttons (right side, vertical) --}}
                            @if ($videoPages->count() > 1)
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <button @click="prev()"
                                            class="w-9 h-9 bg-white rounded-full flex items-center justify-center text-gray-400 shadow-md transition-all duration-200 hover:text-gray-700 hover:shadow-lg hover:scale-110 active:scale-95">
                                        <span class="material-symbols-outlined text-lg">keyboard_arrow_up</span>
                                    </button>
                                    <button @click="next()"
                                            class="w-9 h-9 bg-white rounded-full flex items-center justify-center text-gray-400 shadow-md transition-all duration-200 hover:text-gray-700 hover:shadow-lg hover:scale-110 active:scale-95">
                                        <span class="material-symbols-outlined text-lg">keyboard_arrow_down</span>
                                    </button>
                                </div>
                            @endif

                        </div>

                        {{-- Dot Indicators --}}
                        @if ($videoPages->count() > 1)
                            <div class="flex items-center justify-center gap-2 mt-4">
                                @foreach ($videoPages as $i => $page)
                                    <button @click="goTo({{ $i }})"
                                        class="h-1.5 rounded-full transition-all duration-300"
                                        :class="active === {{ $i }} ? 'w-5 bg-white' : 'w-1.5 bg-white/30'">
                                    </button>
                                @endforeach
                            </div>
                        @endif

                    </div>

                @else
                    <div class="flex flex-col items-center justify-center py-10 text-white/40">
                        <span class="material-symbols-outlined text-5xl mb-3">video_library</span>
                        <p class="text-sm">Video akan segera tersedia</p>
                    </div>
                @endif

            </div>

        </div>

        {{-- ── Bottom CTA ── --}}
        <div class="flex justify-center mt-10 md:mt-12 w-full">
            <a href="https://www.youtube.com/@humaskotatangerangselatan232" target="_blank" rel="noopener noreferrer"
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
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .vp6-page {
            transition: opacity 0.42s cubic-bezier(0.4,0,0.2,1), transform 0.42s cubic-bezier(0.4,0,0.2,1);
        }
        .vp6-active {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }
        .vp6-hidden {
            opacity: 0;
            transform: translateY(10px);
            pointer-events: none;
        }
    </style>
@endpush
