@php
    use Illuminate\Support\Facades\Storage;

    $jenisMeta = [
        'pekerjaan' => ['type' => 'vacancy', 'badge' => 'Lowongan Kerja',  'badge_class' => 'card-badge-vacancy', 'icon_bg' => 'bg-indigo-50', 'icon_color' => 'text-indigo-600', 'accent' => '#4F46E5'],
        'magang'    => ['type' => 'program',  'badge' => 'Program Magang',  'badge_class' => 'card-badge-program', 'icon_bg' => 'bg-sky-50',    'icon_color' => 'text-sky-600',    'accent' => '#0891B2'],
        'program'   => ['type' => 'program',  'badge' => 'Program Khusus', 'badge_class' => 'card-badge-program', 'icon_bg' => 'bg-sky-50',    'icon_color' => 'text-sky-600',    'accent' => '#0891B2'],
        'kompetisi' => ['type' => 'bounty',   'badge' => 'Kompetisi',       'badge_class' => 'card-badge-bounty',  'icon_bg' => 'bg-amber-50',  'icon_color' => 'text-amber-600',  'accent' => '#D97706'],
    ];
    $defaultMeta = ['type' => 'vacancy', 'badge' => 'Lowongan', 'badge_class' => 'card-badge-vacancy', 'icon_bg' => 'bg-indigo-50', 'icon_color' => 'text-indigo-600', 'accent' => '#4F46E5'];

    $vacancies = collect($lowongan ?? [])->map(function ($item) use ($jenisMeta, $defaultMeta) {
        $m = $jenisMeta[$item->jenis] ?? $defaultMeta;
        $metaStr = collect([$item->lokasi, $item->tipe_kerja])->filter()->implode(' · ');
        return array_merge($m, [
            'id'     => $item->id,
            'title'  => $item->posisi,
            'desc'   => $item->deskripsi ?? '',
            'tags'   => is_array($item->tags) ? $item->tags : [],
            'meta'   => $metaStr ?: '-',
            'link'   => $item->link_daftar ?? '#',
            'gambar' => $item->gambar,
        ]);
    });

    $icons = [
        'vacancy' =>
            '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>',
        'bounty' =>
            '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
        'program' =>
            '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>',
    ];
@endphp

<section id="lowongan-carousel" class="relative overflow-hidden bg-[#F5F8FC] px-4 py-16 sm:px-6 sm:py-20 lg:py-24">

    <div class="relative mx-auto max-w-7xl">

        {{-- Section header --}}
        <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div class="max-w-xl">
                <span class="inline-flex items-center text-sm font-bold uppercase tracking-[0.18em] text-blue-800">
                    Karir &amp; Program
                </span>
                <h2 class="mt-3 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl lg:text-4xl">
                    Bergabung &amp;
                    <span class="gradient-text">Berkontribusi</span>
                    <br>untuk Kota Digital
                </h2>
                <p class="mt-3 text-sm leading-7 text-slate-500 sm:text-base">
                    Lowongan, program magang, dan kompetisi terbuka dari Diskominfo Kota Tangerang Selatan.
                </p>
            </div>
            <a href="{{ route('lowongan.index') }}" wire:navigate
                class="group inline-flex shrink-0 items-center gap-1.5 text-sm font-bold text-blue-800 transition-colors duration-200 hover:text-blue-600 whitespace-nowrap">
                Lihat Semua Lowongan &amp; Program
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14" />
                    <path d="m12 5 7 7-7 7" />
                </svg>
            </a>
        </div>

        @if($vacancies->isEmpty())
        {{-- ── Empty state ── --}}
        <div class="relative py-8">
            <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
                <div class="absolute -top-20 left-1/4 h-72 w-72 rounded-full bg-indigo-100 opacity-40 blur-3xl"></div>
                <div class="absolute -bottom-10 right-1/4 h-64 w-64 rounded-full bg-violet-100 opacity-30 blur-3xl"></div>
            </div>
            <div class="relative mx-auto max-w-lg rounded-2xl border border-slate-100 bg-white px-8 py-14 text-center transition-all duration-200 hover:-translate-y-1"
                style="box-shadow: 0 4px 20px -2px rgba(79,70,229,0.1), 0 2px 8px -2px rgba(124,58,237,0.06);">
                <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="20" height="14" rx="2"/>
                        <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
                        <line x1="12" y1="12" x2="12" y2="16"/>
                        <line x1="10" y1="14" x2="14" y2="14"/>
                    </svg>
                </div>
                <h3 class="text-xl font-extrabold tracking-tight text-slate-900 sm:text-2xl">
                    Belum Ada
                    <span class="bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent">
                        Lowongan
                    </span>
                    Saat Ini
                </h3>
                <p class="mx-auto mt-3 max-w-sm text-sm leading-7 text-slate-500">
                    Pantau portal ini secara berkala untuk mendapatkan informasi lowongan kerja, program magang, dan kompetisi terbaru dari Diskominfo Kota Tangerang Selatan.
                </p>
                <div class="mx-auto mt-8 h-px w-16 rounded-full bg-gradient-to-r from-indigo-200 to-violet-200"></div>
                <p class="mt-4 text-xs font-medium text-slate-400">
                    Informasi akan diperbarui secara resmi oleh admin
                </p>
            </div>
        </div>

        @elseif($vacancies->count() === 1)
        {{-- ── 1 card: centered, tanpa carousel ── --}}
        @php $card = $vacancies->first(); @endphp
        <div class="flex justify-center py-4">
            <div class="w-72 md:w-96 lg:w-[400px] vacancy-card-shadow rounded-2xl bg-white overflow-hidden transition-all duration-200 hover:-translate-y-1">
                <div class="relative">
                    @if ($card['gambar'])
                        <img src="{{ Storage::url($card['gambar']) }}" alt="Banner {{ $card['title'] }}"
                            class="w-full h-36 md:h-48 object-cover rounded-t-2xl" />
                    @else
                        <img src="https://placehold.co/800x450/{{ ltrim($card['accent'], '#') }}/FFFFFF?text={{ rawurlencode($card['title']) }}"
                            alt="Ilustrasi {{ $card['title'] }}"
                            class="w-full h-36 md:h-48 object-cover rounded-t-2xl" />
                    @endif
                    <span class="absolute bottom-3 left-3 inline-flex items-center rounded-md px-2.5 py-1 text-[11px] font-bold text-white bg-black/40 backdrop-blur-sm">
                        {{ $card['badge'] }}
                    </span>
                </div>
                <div class="flex flex-col p-4 md:p-6">
                    <div class="mb-5">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl {{ $card['icon_bg'] }} {{ $card['icon_color'] }}">
                            {!! $icons[$card['type']] !!}
                        </div>
                    </div>
                    <h3 class="text-base md:text-lg font-extrabold leading-snug text-slate-900">{{ $card['title'] }}</h3>
                    <p class="mt-2 text-xs md:text-sm leading-6 text-slate-500 line-clamp-3">{{ $card['desc'] }}</p>
                    <div class="mt-3 md:mt-4 flex flex-wrap gap-1.5 md:gap-2">
                        @foreach ($card['tags'] as $tag)
                            <span class="rounded-md bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-600">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-xs font-medium text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        {{ $card['meta'] }}
                    </div>
                    <div class="mt-auto pt-5">
                        <a href="{{ route('karir.show', $card['id']) }}"
                            class="inline-flex items-center px-5 py-2 text-sm font-semibold text-white bg-blue-700 rounded-md hover:bg-blue-800 transition-colors w-fit">
                            Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @elseif($vacancies->count() === 2)
        {{-- ── 2 cards: carousel di mobile, grid di desktop ── --}}

        {{-- Mobile: carousel (disembunyikan di md+) --}}
        <div class="relative select-none md:hidden"
            x-data="{ ...vacancyCarousel(), totalCards: {{ $vacancies->count() }} }" x-init="init()"
            @mouseenter="pause()" @mouseleave="resume()"
            @touchstart.passive="startX = $event.touches[0].clientX"
            @touchend="endX = $event.changedTouches[0].clientX; handleSwipe()"
            @mousedown="startX = $event.clientX"
            @mouseup="endX = $event.clientX; handleSwipe()">
            <div class="relative mx-auto max-w-5xl h-[580px] overflow-visible py-4">
                @foreach ($vacancies as $idx => $card)
                    @php $i = $idx; @endphp
                    <div class="vacancy-card-wrap absolute top-0 left-1/2 cursor-pointer"
                        :class="getCardClass({{ $i }})" style="perspective: 1200px;"
                        @click="goTo({{ $i }})">
                        <div class="vacancy-card-inner vacancy-card-shadow rounded-2xl bg-white overflow-hidden"
                            :class="active === {{ $i }} ? 'vacancy-card-active' : ''">
                            <div class="relative">
                                @if ($card['gambar'])
                                    <img src="{{ Storage::url($card['gambar']) }}" alt="Banner {{ $card['title'] }}"
                                        class="w-full h-36 md:h-48 object-cover rounded-t-2xl" />
                                @else
                                    <img src="https://placehold.co/800x450/{{ ltrim($card['accent'], '#') }}/FFFFFF?text={{ rawurlencode($card['title']) }}"
                                        alt="Ilustrasi {{ $card['title'] }}"
                                        class="w-full h-36 md:h-48 object-cover rounded-t-2xl" />
                                @endif
                                <span class="absolute bottom-3 left-3 inline-flex items-center rounded-md px-2.5 py-1 text-[11px] font-bold text-white bg-black/40 backdrop-blur-sm">
                                    {{ $card['badge'] }}
                                </span>
                            </div>
                            <div class="flex flex-col p-4 md:p-6">
                                <div class="mb-5">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-xl {{ $card['icon_bg'] }} {{ $card['icon_color'] }}">
                                        {!! $icons[$card['type']] !!}
                                    </div>
                                </div>
                                <h3 class="text-base md:text-lg font-extrabold leading-snug text-slate-900">{{ $card['title'] }}</h3>
                                <p class="mt-2 text-xs md:text-sm leading-6 text-slate-500 line-clamp-3">{{ $card['desc'] }}</p>
                                <div class="mt-3 md:mt-4 flex flex-wrap gap-1.5 md:gap-2">
                                    @foreach ($card['tags'] as $tag)
                                        <span class="rounded-md bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-600">{{ $tag }}</span>
                                    @endforeach
                                </div>
                                <div class="mt-4 flex items-center gap-2 text-xs font-medium text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    {{ $card['meta'] }}
                                </div>
                                <div class="mt-auto pt-5">
                                    <a href="{{ route('karir.show', $card['id']) }}"
                                        class="inline-flex items-center px-5 py-2 text-sm font-semibold text-white bg-blue-700 rounded-md hover:bg-blue-800 transition-colors w-fit">
                                        Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button @click="prev()"
                class="absolute -left-5 top-1/2 z-20 -translate-y-1/2 flex h-12 w-12 items-center justify-center rounded-full bg-white text-slate-700 shadow-md hover:shadow-xl hover:scale-105 transition-all duration-200 focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
                aria-label="Sebelumnya">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </button>
            <button @click="next()"
                class="absolute -right-5 top-1/2 z-20 -translate-y-1/2 flex h-12 w-12 items-center justify-center rounded-full bg-white text-slate-700 shadow-md hover:shadow-xl hover:scale-105 transition-all duration-200 focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
                aria-label="Berikutnya">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </button>
            <div class="mt-6 flex items-center justify-center gap-2" role="tablist" aria-label="Navigasi Carousel">
                @foreach ($vacancies as $idx => $card)
                    <button @click="goTo({{ $idx }})" class="carousel-dot h-2 rounded-full transition-all"
                        :class="active === {{ $idx }} ? 'w-6 bg-indigo-600' : 'w-2 bg-slate-300'"
                        :aria-selected="active === {{ $idx }}"
                        :aria-label="'Slide ' + ({{ $idx }} + 1)" role="tab"></button>
                @endforeach
            </div>
        </div>

        {{-- Desktop: grid 2 kolom (disembunyikan di mobile) --}}
        <div class="hidden md:flex justify-center gap-6 py-4">
            @foreach ($vacancies as $card)
                <div class="w-96 lg:w-[400px] flex-shrink-0 vacancy-card-shadow rounded-2xl bg-white overflow-hidden transition-all duration-200 hover:-translate-y-1">
                    <div class="relative">
                        @if ($card['gambar'])
                            <img src="{{ Storage::url($card['gambar']) }}" alt="Banner {{ $card['title'] }}"
                                class="w-full h-48 object-cover rounded-t-2xl" />
                        @else
                            <img src="https://placehold.co/800x450/{{ ltrim($card['accent'], '#') }}/FFFFFF?text={{ rawurlencode($card['title']) }}"
                                alt="Ilustrasi {{ $card['title'] }}"
                                class="w-full h-48 object-cover rounded-t-2xl" />
                        @endif
                        <span class="absolute bottom-3 left-3 inline-flex items-center rounded-md px-2.5 py-1 text-[11px] font-bold text-white bg-black/40 backdrop-blur-sm">
                            {{ $card['badge'] }}
                        </span>
                    </div>
                    <div class="flex flex-col p-6">
                        <div class="mb-5">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl {{ $card['icon_bg'] }} {{ $card['icon_color'] }}">
                                {!! $icons[$card['type']] !!}
                            </div>
                        </div>
                        <h3 class="text-lg font-extrabold leading-snug text-slate-900">{{ $card['title'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500 line-clamp-3">{{ $card['desc'] }}</p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach ($card['tags'] as $tag)
                                <span class="rounded-md bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-600">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <div class="mt-4 flex items-center gap-2 text-xs font-medium text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            {{ $card['meta'] }}
                        </div>
                        <div class="mt-auto pt-5">
                            <a href="{{ route('karir.show', $card['id']) }}"
                                class="inline-flex items-center px-5 py-2 text-sm font-semibold text-white bg-blue-700 rounded-md hover:bg-blue-800 transition-colors w-fit">
                                Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @else
        {{-- ── 3+ cards: carousel ── --}}
        <div class="relative select-none"
            x-data="{ ...vacancyCarousel(), totalCards: {{ $vacancies->count() }} }" x-init="init()"
            @mouseenter="pause()" @mouseleave="resume()"
            @touchstart.passive="startX = $event.touches[0].clientX"
            @touchend="endX = $event.changedTouches[0].clientX; handleSwipe()"
            @mousedown="startX = $event.clientX"
            @mouseup="endX = $event.clientX; handleSwipe()">
            <div class="relative mx-auto max-w-5xl h-[580px] overflow-visible py-4">
                @foreach ($vacancies as $idx => $card)
                    @php $i = $idx; @endphp
                    <div class="vacancy-card-wrap absolute top-0 left-1/2 cursor-pointer"
                        :class="getCardClass({{ $i }})" style="perspective: 1200px;"
                        @click="goTo({{ $i }})">
                        <div class="vacancy-card-inner vacancy-card-shadow rounded-2xl bg-white overflow-hidden"
                            :class="active === {{ $i }} ? 'vacancy-card-active' : ''">
                            <div class="relative">
                                @if ($card['gambar'])
                                    <img src="{{ Storage::url($card['gambar']) }}"
                                        alt="Banner {{ $card['title'] }}"
                                        class="w-full h-36 md:h-48 object-cover rounded-t-2xl" />
                                @else
                                    <img src="https://placehold.co/800x450/{{ ltrim($card['accent'], '#') }}/FFFFFF?text={{ rawurlencode($card['title']) }}"
                                        alt="Ilustrasi {{ $card['title'] }}"
                                        class="w-full h-36 md:h-48 object-cover rounded-t-2xl" />
                                @endif
                                <span class="absolute bottom-3 left-3 inline-flex items-center rounded-md px-2.5 py-1 text-[11px] font-bold text-white bg-black/40 backdrop-blur-sm">
                                    {{ $card['badge'] }}
                                </span>
                            </div>
                            <div class="flex flex-col p-4 md:p-6">
                                <div class="mb-5">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-xl {{ $card['icon_bg'] }} {{ $card['icon_color'] }}">
                                        {!! $icons[$card['type']] !!}
                                    </div>
                                </div>
                                <h3 class="text-base md:text-lg font-extrabold leading-snug text-slate-900">
                                    {{ $card['title'] }}</h3>
                                <p class="mt-2 text-xs md:text-sm leading-6 text-slate-500 line-clamp-3">
                                    {{ $card['desc'] }}</p>
                                <div class="mt-3 md:mt-4 flex flex-wrap gap-1.5 md:gap-2">
                                    @foreach ($card['tags'] as $tag)
                                        <span class="rounded-md bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-600">{{ $tag }}</span>
                                    @endforeach
                                </div>
                                <div class="mt-4 flex items-center gap-2 text-xs font-medium text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    {{ $card['meta'] }}
                                </div>
                                <div class="mt-auto pt-5">
                                    <a href="{{ route('karir.show', $card['id']) }}"
                                        class="inline-flex items-center px-5 py-2 text-sm font-semibold text-white bg-blue-700 rounded-md hover:bg-blue-800 transition-colors w-fit">
                                        Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button @click="prev()"
                class="absolute -left-5 top-1/2 z-20 -translate-y-1/2 flex h-12 w-12 items-center justify-center rounded-full bg-white text-slate-700 shadow-md hover:shadow-xl hover:scale-105 transition-all duration-200 focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
                aria-label="Sebelumnya">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </button>
            <button @click="next()"
                class="absolute -right-5 top-1/2 z-20 -translate-y-1/2 flex h-12 w-12 items-center justify-center rounded-full bg-white text-slate-700 shadow-md hover:shadow-xl hover:scale-105 transition-all duration-200 focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
                aria-label="Berikutnya">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </button>
            <div class="mt-6 flex items-center justify-center gap-2" role="tablist" aria-label="Navigasi Carousel">
                @foreach ($vacancies as $idx => $card)
                    <button @click="goTo({{ $idx }})" class="carousel-dot h-2 rounded-full transition-all"
                        :class="active === {{ $idx }} ? 'w-6 bg-indigo-600' : 'w-2 bg-slate-300'"
                        :aria-selected="active === {{ $idx }}"
                        :aria-label="'Slide ' + ({{ $idx }} + 1)" role="tab"></button>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>
