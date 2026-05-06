
@php
    $vacancies = [
        [
            'type' => 'vacancy',
            'badge' => 'Lowongan Kerja',
            'badge_class' => 'card-badge-vacancy',
            'title' => 'Fullstack Developer',
            'desc' =>
                'Kami mencari pengembang fullstack berpengalaman untuk membangun dan memelihara sistem informasi layanan publik berbasis web.',
            'tags' => ['Laravel', 'Vue.js', 'PostgreSQL'],
            'meta' => 'Tangerang Selatan · Penuh Waktu',
            'cta' => 'Lamar Sekarang',
            'cta2' => 'Detail Posisi',
            'icon_bg' => 'bg-indigo-50',
            'icon_color' => 'text-indigo-600',
            'accent' => '#4F46E5',
        ],
        [
            'type' => 'bounty',
            'badge' => 'Kompetisi',
            'badge_class' => 'card-badge-bounty',
            'title' => 'Tangsel Bug Bounty 2024',
            'desc' =>
                'Temukan celah keamanan di portal layanan digital Diskominfo dan dapatkan hadiah menarik. Lindungi data warga bersama kami.',
            'tags' => ['Keamanan Siber', 'Ethical Hacking', 'Hadiah Menarik'],
            'meta' => 'Daring · Terbuka untuk Umum',
            'cta' => 'Ikut Serta',
            'cta2' => 'Lihat Panduan',
            'icon_bg' => 'bg-amber-50',
            'icon_color' => 'text-amber-600',
            'accent' => '#D97706',
        ],
        [
            'type' => 'vacancy',
            'badge' => 'Lowongan Kerja',
            'badge_class' => 'card-badge-vacancy',
            'title' => 'Network Engineer',
            'desc' =>
                'Bergabunglah sebagai insinyur jaringan untuk merancang dan mengelola infrastruktur TIK yang mendukung layanan kota cerdas.',
            'tags' => ['Cisco', 'Mikrotik', 'Firewall'],
            'meta' => 'Tangerang Selatan · Penuh Waktu',
            'cta' => 'Lamar Sekarang',
            'cta2' => 'Detail Posisi',
            'icon_bg' => 'bg-indigo-50',
            'icon_color' => 'text-indigo-600',
            'accent' => '#4F46E5',
        ],
        [
            'type' => 'program',
            'badge' => 'Program Khusus',
            'badge_class' => 'card-badge-program',
            'title' => 'Magang Digital Tangsel',
            'desc' =>
                'Program magang berbasis proyek nyata di unit digital Diskominfo. Dapatkan pengalaman langsung membangun solusi teknologi untuk pemerintahan.',
            'tags' => ['Magang', 'Teknologi', 'Pemerintahan'],
            'meta' => 'Tangerang Selatan · 3 Bulan',
            'cta' => 'Daftar Program',
            'cta2' => 'Info Lengkap',
            'icon_bg' => 'bg-sky-50',
            'icon_color' => 'text-sky-600',
            'accent' => '#0891B2',
        ],
        [
            'type' => 'vacancy',
            'badge' => 'Lowongan Kerja',
            'badge_class' => 'card-badge-vacancy',
            'title' => 'Data Analyst',
            'desc' =>
                'Analisis dan visualisasi data publik untuk mendukung kebijakan berbasis data di Kota Tangerang Selatan.',
            'tags' => ['Python', 'SQL', 'Power BI'],
            'meta' => 'Tangerang Selatan · Penuh Waktu',
            'cta' => 'Lamar Sekarang',
            'cta2' => 'Detail Posisi',
            'icon_bg' => 'bg-indigo-50',
            'icon_color' => 'text-indigo-600',
            'accent' => '#4F46E5',
        ],
    ];

    $icons = [
        'vacancy' =>
            '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>',
        'bounty' =>
            '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
        'program' =>
            '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>',
    ];
@endphp

<section id="lowongan-carousel" class="relative overflow-hidden bg-[#F8FAFC] px-4 py-16 sm:px-6 sm:py-20 lg:py-24">


    <div class="relative mx-auto max-w-7xl">

        {{-- Section header --}}
        <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div class="max-w-xl">
                <span
                    class="inline-flex items-center text-sm font-bold uppercase tracking-[0.18em] text-blue-800">
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
            <a href="#"
                class="inline-flex items-center gap-1.5 text-sm font-bold text-blue-800 hover:text-blue-800 hover:underline transition-colors duration-200">
                Lihat Semua
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14" />
                    <path d="m12 5 7 7-7 7" />
                </svg>
            </a>
        </div>

        {{-- Carousel viewport --}}
        <div class="relative select-none" x-data="vacancyCarousel" x-init="init()"
            @mouseenter="pause()"
            @mouseleave="resume()"
            @touchstart.passive="startX = $event.touches[0].clientX"
            @touchend="endX = $event.changedTouches[0].clientX; handleSwipe()"
            @mousedown="startX = $event.clientX"
            @mouseup="endX = $event.clientX; handleSwipe()">
            {{-- Cards track — absolute positioning eliminates flex DOM-order wrap bug --}}
            <div class="relative mx-auto max-w-5xl h-[450px] overflow-visible py-4">
                @foreach ($vacancies as $idx => $card)
                    @php $i = $idx; @endphp
                    <div class="vacancy-card-wrap absolute top-0 left-1/2 w-80 md:w-96 cursor-pointer"
                        :class="getCardClass({{ $i }})" style="perspective: 1200px;"
                        @click="goTo({{ $i }})">
                        <div class="vacancy-card-inner vacancy-card-shadow rounded-2xl bg-white"
                            :class="active === {{ $i }} ? 'vacancy-card-active' : ''">
                            <div class="flex h-full flex-col p-6">

                                {{-- Card top: icon only --}}
                                <div class="mb-5">
                                    <div
                                        class="flex h-12 w-12 items-center justify-center rounded-xl {{ $card['icon_bg'] }} {{ $card['icon_color'] }}">
                                        {!! $icons[$card['type']] !!}
                                    </div>
                                </div>

                                {{-- Title + desc --}}
                                <h3 class="text-lg font-extrabold leading-snug text-slate-900">{{ $card['title'] }}</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-500 line-clamp-3">{{ $card['desc'] }}</p>

                                {{-- Tags --}}
                                <div class="mt-4 flex flex-wrap gap-2">
                                    @foreach ($card['tags'] as $tag)
                                        <span
                                            class="rounded-md bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-600">{{ $tag }}</span>
                                    @endforeach
                                </div>

                                {{-- Meta --}}
                                <div class="mt-4 flex items-center gap-2 text-xs font-medium text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    {{ $card['meta'] }}
                                </div>

                                {{-- CTA --}}
                                <div class="mt-auto pt-5">
                                    <a href="#"
                                        class="inline-flex items-center px-5 py-2 text-sm font-semibold text-white bg-blue-700 rounded-full hover:bg-blue-800 transition-colors w-fit">
                                        Selengkapnya
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>{{-- /Cards track --}}

            {{-- Arrow: Prev --}}
            <button @click="prev()"
                class="absolute -left-5 top-1/2 z-20 -translate-y-1/2 flex h-12 w-12 items-center justify-center rounded-full bg-white text-slate-700 shadow-md hover:shadow-xl hover:scale-105 transition-all duration-200 focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
                aria-label="Sebelumnya">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </button>

            {{-- Arrow: Next --}}
            <button @click="next()"
                class="absolute -right-5 top-1/2 z-20 -translate-y-1/2 flex h-12 w-12 items-center justify-center rounded-full bg-white text-slate-700 shadow-md hover:shadow-xl hover:scale-105 transition-all duration-200 focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
                aria-label="Berikutnya">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </button>

            {{-- Dot indicators --}}
            <div class="mt-6 flex items-center justify-center gap-2" role="tablist" aria-label="Navigasi Carousel">
                @foreach ($vacancies as $idx => $card)
                    <button @click="goTo({{ $idx }})" class="carousel-dot h-2 rounded-full transition-all"
                        :class="active === {{ $idx }} ? 'w-6 bg-indigo-600' : 'w-2 bg-slate-300'"
                        :aria-selected="active === {{ $idx }}"
                        :aria-label="'Slide ' + ({{ $idx }} + 1)" role="tab"></button>
                @endforeach
            </div>
        </div>

    </div>
</section>


