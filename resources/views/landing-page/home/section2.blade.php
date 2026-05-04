@php
    $defaultBeritas = [
        [
            'title' => 'Penguatan Layanan Digital Kota Tangerang Selatan',
            'excerpt' => 'Diskominfo Tangerang Selatan terus mendorong layanan pemerintahan berbasis teknologi agar informasi dan pelayanan publik semakin mudah diakses warga.',
            'category' => 'Transformasi Digital',
            'date_label' => 'Terbaru',
            'url' => '#',
        ],
        [
            'title' => 'Literasi Digital untuk Masyarakat yang Aman dan Produktif',
            'excerpt' => 'Edukasi literasi digital menjadi bagian dari upaya membangun ruang digital yang sehat, aman, dan bermanfaat bagi masyarakat.',
            'category' => 'Komunikasi Publik',
            'date_label' => 'Info Publik',
            'url' => '#',
        ],
        [
            'title' => 'Integrasi Data Mendukung Kebijakan Kota Cerdas',
            'excerpt' => 'Penguatan tata kelola data membantu perangkat daerah mengambil keputusan yang lebih akurat dan terukur.',
            'category' => 'Satu Data',
            'date_label' => 'Update',
            'url' => '#',
        ],
        [
            'title' => 'Infrastruktur TIK untuk Pelayanan yang Responsif',
            'excerpt' => 'Konektivitas dan keamanan sistem elektronik terus ditingkatkan untuk mendukung pelayanan publik yang stabil.',
            'category' => 'Infrastruktur TIK',
            'date_label' => 'Berita',
            'url' => '#',
        ],
    ];

    $sourceBeritas = $beritas ?? $defaultBeritas;

    if ($sourceBeritas instanceof \Illuminate\Pagination\AbstractPaginator) {
        $newsItems = collect($sourceBeritas->items());
    } elseif ($sourceBeritas instanceof \Illuminate\Support\Collection) {
        $newsItems = $sourceBeritas;
    } else {
        $newsItems = collect($sourceBeritas);
    }

    $newsItems = $newsItems->take(4)->values();

    $getValue = function ($item, array $keys, $fallback = null) {
        foreach ($keys as $key) {
            $value = data_get($item, $key);

            if (! is_null($value) && $value !== '') {
                return $value;
            }
        }

        return $fallback;
    };

    $formatDate = function ($value) {
        if (! $value) {
            return 'Terbaru';
        }

        if ($value instanceof \Carbon\CarbonInterface) {
            return $value->format('d M Y');
        }

        try {
            return \Carbon\Carbon::parse($value)->format('d M Y');
        } catch (\Throwable $exception) {
            return $value;
        }
    };

    $resolveImage = function ($path) {
        if (! $path) {
            return null;
        }

        if (preg_match('/^(https?:)?\/\//', $path) || substr($path, 0, 1) === '/') {
            return $path;
        }

        return asset($path);
    };

    $toText = function ($value, $fallback = '') {
        if (is_null($value) || $value === '') {
            return $fallback;
        }

        if (is_scalar($value)) {
            return (string) $value;
        }

        if (is_object($value) && method_exists($value, '__toString')) {
            return (string) $value;
        }

        return $fallback;
    };

    $featuredNews = $newsItems->first();
    $sideNews = $newsItems->slice(1);
@endphp

@if ($featuredNews)
    <section id="berita" class="bg-white px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="mb-7 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.18em] text-[#044FA0]">Berita Terkini</p>
                    <h2 class="mt-2 text-2xl font-extrabold tracking-normal text-slate-950 sm:text-3xl">Informasi terbaru Diskominfo Tangerang Selatan</h2>
                </div>
                <a href="#" class="inline-flex items-center gap-2 text-sm font-bold text-[#044FA0] transition hover:text-slate-950">
                    Lihat Semua Berita
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="grid gap-5 lg:grid-cols-[1.12fr_.88fr]">
                @php
                    $featuredTitle = $toText($getValue($featuredNews, ['title', 'judul'], null), 'Berita Diskominfo Tangerang Selatan');
                    $featuredExcerpt = $toText($getValue($featuredNews, ['excerpt', 'ringkasan', 'description', 'deskripsi', 'content', 'isi'], null), 'Informasi resmi seputar layanan digital, data, komunikasi publik, dan infrastruktur TIK Kota Tangerang Selatan.');
                    $featuredCategory = $toText($getValue($featuredNews, ['category.name', 'category', 'kategori.name', 'kategori'], null), 'Berita');
                    $featuredDate = $getValue($featuredNews, ['date_label'], null) ?: $formatDate($getValue($featuredNews, ['published_at', 'tanggal', 'created_at', 'date'], null));
                    $featuredImage = $resolveImage($getValue($featuredNews, ['image', 'thumbnail', 'gambar', 'foto'], null));
                    $featuredUrl = $getValue($featuredNews, ['url', 'link'], null);
                    $featuredSlug = $getValue($featuredNews, ['slug'], null);
                    $featuredUrl = $featuredUrl ?: ($featuredSlug ? url('/berita/' . $featuredSlug) : '#');
                @endphp

                <article class="overflow-hidden rounded-lg border border-slate-200 bg-[#F8FBFF] transition hover:-translate-y-1 hover:border-[#044FA0] hover:shadow-lg">
                    <a href="{{ $featuredUrl }}" class="grid h-full md:grid-cols-[.98fr_1.02fr]">
                        <div class="relative min-h-64 overflow-hidden bg-[#044FA0]">
                            @if ($featuredImage)
                                <img src="{{ $featuredImage }}" alt="{{ $featuredTitle }}" class="h-full w-full object-cover transition duration-500 hover:scale-105">
                            @else
                                <div class="flex h-full min-h-64 items-center justify-center bg-[#044FA0] p-8">
                                    <img src="{{ asset('Images/logo-kominfo.png') }}" alt="Logo Diskominfo Tangsel" class="max-h-24 w-auto object-contain">
                                </div>
                            @endif
                            <span class="absolute left-4 top-4 rounded-md bg-[#F7D558] px-3 py-1 text-xs font-bold uppercase tracking-wide text-[#044FA0]">{{ $featuredCategory }}</span>
                        </div>

                        <div class="flex flex-col justify-between p-6">
                            <div>
                                <div class="mb-4 flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#044FA0]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M8 2v4" />
                                        <path d="M16 2v4" />
                                        <rect width="18" height="18" x="3" y="4" rx="2" />
                                        <path d="M3 10h18" />
                                    </svg>
                                    {{ $featuredDate }}
                                </div>
                                <h3 class="text-2xl font-extrabold leading-tight text-slate-950">{{ $featuredTitle }}</h3>
                                <p class="mt-4 text-sm leading-7 text-slate-600">{{ \Illuminate\Support\Str::limit(strip_tags((string) $featuredExcerpt), 170) }}</p>
                            </div>
                            <span class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-[#044FA0]">
                                Baca Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14" />
                                    <path d="m12 5 7 7-7 7" />
                                </svg>
                            </span>
                        </div>
                    </a>
                </article>

                <div class="grid gap-4">
                    @foreach ($sideNews as $berita)
                        @php
                            $title = $toText($getValue($berita, ['title', 'judul'], null), 'Berita Diskominfo Tangerang Selatan');
                            $excerpt = $toText($getValue($berita, ['excerpt', 'ringkasan', 'description', 'deskripsi', 'content', 'isi'], null), 'Informasi resmi Diskominfo Tangerang Selatan.');
                            $category = $toText($getValue($berita, ['category.name', 'category', 'kategori.name', 'kategori'], null), 'Berita');
                            $date = $getValue($berita, ['date_label'], null) ?: $formatDate($getValue($berita, ['published_at', 'tanggal', 'created_at', 'date'], null));
                            $image = $resolveImage($getValue($berita, ['image', 'thumbnail', 'gambar', 'foto'], null));
                            $url = $getValue($berita, ['url', 'link'], null);
                            $slug = $getValue($berita, ['slug'], null);
                            $url = $url ?: ($slug ? url('/berita/' . $slug) : '#');
                        @endphp

                        <article class="rounded-lg border border-slate-200 bg-white transition hover:-translate-y-1 hover:border-[#044FA0] hover:shadow-lg">
                            <a href="{{ $url }}" class="grid gap-4 p-4 sm:grid-cols-[150px_1fr]">
                                <div class="h-36 overflow-hidden rounded-lg bg-[#044FA0] sm:h-full">
                                    @if ($image)
                                        <img src="{{ $image }}" alt="{{ $title }}" class="h-full w-full object-cover transition duration-500 hover:scale-105">
                                    @else
                                        <div class="flex h-full min-h-32 items-center justify-center bg-[#044FA0] p-5">
                                            <img src="{{ asset('Images/logo-kominfo.png') }}" alt="Logo Diskominfo Tangsel" class="max-h-16 w-auto object-contain">
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="mb-2 flex flex-wrap items-center gap-2">
                                        <span class="rounded-md bg-blue-50 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wide text-[#044FA0]">{{ $category }}</span>
                                        <span class="text-xs font-semibold text-slate-500">{{ $date }}</span>
                                    </div>
                                    <h3 class="text-base font-extrabold leading-snug text-slate-950">{{ $title }}</h3>
                                    <p class="mt-2 text-sm leading-6 text-slate-600">{{ \Illuminate\Support\Str::limit(strip_tags((string) $excerpt), 105) }}</p>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
