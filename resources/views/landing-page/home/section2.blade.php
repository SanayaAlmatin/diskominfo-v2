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
@endphp

@if ($newsItems->isNotEmpty())
    <section id="berita" class="bg-white px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex flex-col gap-4 border-b border-slate-200 pb-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <p class="text-sm font-bold uppercase tracking-[0.18em] text-[#044FA0]">Berita Terkini</p>
                    <h2 class="mt-2 text-2xl font-extrabold leading-tight tracking-normal text-slate-950 sm:text-3xl">
                        Informasi terbaru Diskominfo Tangerang Selatan
                    </h2>
                </div>

                <a href="#" class="inline-flex w-fit items-center gap-2 text-sm font-bold text-[#044FA0] transition hover:text-slate-950">
                    Lihat Semua
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($newsItems as $berita)
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

                    <article class="group flex h-full flex-col overflow-hidden rounded-lg border border-slate-200 bg-white transition hover:-translate-y-1 hover:border-[#044FA0] hover:shadow-lg">
                        <a href="{{ $url }}" class="flex h-full flex-col">
                            <div class="relative aspect-square overflow-hidden bg-[#F5F8FC]">
                                @if ($image)
                                    <img src="{{ $image }}" alt="{{ $title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-[#044FA0] p-8">
                                        <img src="{{ asset('Images/logo-kominfo.png') }}" alt="Logo Diskominfo Tangsel" class="max-h-24 w-auto object-contain">
                                    </div>
                                @endif

                                <span class="absolute left-3 top-3 max-w-[90%] rounded-md bg-white/95 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wide text-[#044FA0] shadow-sm">
                                    {{ $category }}
                                </span>
                            </div>

                            <div class="flex flex-1 flex-col p-4">
                                <div class="mb-3 flex items-center gap-2 text-xs font-semibold text-slate-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#044FA0]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M8 2v4" />
                                        <path d="M16 2v4" />
                                        <rect width="18" height="18" x="3" y="4" rx="2" />
                                        <path d="M3 10h18" />
                                    </svg>
                                    {{ $date }}
                                </div>

                                <h3 class="text-base font-extrabold leading-snug text-slate-950">
                                    {{ $title }}
                                </h3>
                                <p class="mt-3 text-sm leading-6 text-slate-600">
                                    {{ \Illuminate\Support\Str::limit(strip_tags((string) $excerpt), 105) }}
                                </p>

                                <span class="mt-auto inline-flex items-center gap-2 pt-5 text-sm font-bold text-[#044FA0]">
                                    Baca Selengkapnya
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                        <path d="m12 5 7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif
