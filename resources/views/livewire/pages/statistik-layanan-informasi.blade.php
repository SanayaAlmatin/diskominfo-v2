@push('styles')
    <style>
        /* ── Hero ── */
        .unit-kerja-statistik .statistik-hero {
            background: linear-gradient(135deg, #0b3c6f 0%, #0d4f94 52%, #1f78b9 100%);
            position: relative;
        }

        .unit-kerja-statistik .statistik-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='220' height='220' viewBox='0 0 220 220' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23FFFFFF' stroke-opacity='0.18' stroke-width='1.2'%3E%3Cpath d='M12 38h68v48h60v70h68'/%3E%3Cpath d='M32 188h48v-58h84V64h36'/%3E%3C/g%3E%3Cg fill='%23F7D558' fill-opacity='0.35'%3E%3Ccircle cx='72' cy='64' r='5'/%3E%3Ccircle cx='148' cy='152' r='5'/%3E%3Ccircle cx='170' cy='42' r='4'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 220px 220px;
            opacity: 0.6;
            animation: statistikPatternDrift 48s linear infinite;
            pointer-events: none;
        }

        @keyframes statistikPatternDrift {
            from {
                background-position: 0 0;
            }

            to {
                background-position: 240px 160px;
            }
        }

        /* ── Fade-up ── */
        .statistik-fade-up {
            opacity: 0;
            transform: translateY(14px);
            animation: statistikFadeUp 0.65s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        .statistik-d1 {
            animation-delay: 0.06s;
        }

        .statistik-d2 {
            animation-delay: 0.12s;
        }

        .statistik-d3 {
            animation-delay: 0.18s;
        }

        .statistik-d4 {
            animation-delay: 0.24s;
        }

        .statistik-d5 {
            animation-delay: 0.30s;
        }

        .statistik-d6 {
            animation-delay: 0.36s;
        }

        @keyframes statistikFadeUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (prefers-reduced-motion: reduce) {

            .unit-kerja-statistik .statistik-hero::before,
            .statistik-fade-up {
                animation: none !important;
                opacity: 1 !important;
                transform: none !important;
            }
        }
    </style>
@endpush

<main class="flex-1 unit-kerja-statistik">

    {{-- ════════════════════════════════════════
         HERO SECTION
         ════════════════════════════════════════ --}}
    <section class="statistik-hero relative overflow-hidden text-white">
        <div class="relative mx-auto max-w-7xl px-4 pb-14 pt-28 sm:px-6 lg:px-8 lg:pb-20 lg:pt-36">

            <div class="flex flex-col items-start">
                <x-breadcrumb class="statistik-fade-up statistik-d1 mb-5" :links="[
                    ['label' => 'Beranda', 'url' => route('home')],
                    ['label' => 'Unit Kerja', 'url' => '#'],
                    ['label' => 'Statistik & Layanan Informasi Publik'],
                ]" />

                <div
                    class="statistik-fade-up statistik-d1 inline-flex items-center gap-3 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em]">
                    <span class="h-2 w-2 rounded-full bg-[#F7D558]"></span>
                    Unit Kerja
                </div>
            </div>

            <h1
                class="statistik-fade-up statistik-d2 mt-5 text-3xl font-extrabold leading-tight sm:text-4xl lg:text-5xl">
                Bidang Penyelenggaraan<br class="hidden sm:block"> Statistik &amp; Layanan Informasi Publik
            </h1>

            <p class="statistik-fade-up statistik-d3 mt-4 max-w-2xl text-sm leading-7 text-blue-100 sm:text-base">
                Bertanggung jawab atas pengelolaan data statistik sektoral dan kualitas layanan informasi publik
                Kota Tangerang Selatan.
            </p>

        </div>
    </section>

    <section class="bg-slate-50 px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div
                class="tik-fade-up tik-d2 -mt-10 rounded-2xl border-t-4 border-[#F7D558] bg-white px-8 py-10 text-center shadow-xl">
                <span
                    class="inline-block rounded-full bg-[#F7D558]/20 px-4 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-[#044FA0]">Tugas
                    Pokok</span>
                <p class="mx-auto mt-4 max-w-3xl text-base font-medium leading-8 text-slate-700 sm:text-lg">
                    Menyelenggarakan fungsi perumusan kebijakan teknis, pelaksanaan program, serta evaluasi di bidang
                    statistik sektoral dan layanan informasi publik di wilayah Kota Tangerang Selatan.
                </p>
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════
         FEATURE CARDS (4 thematic groups)
         ════════════════════════════════════════ --}}
    <section class="bg-slate-50 px-4 py-14 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">

            <div class="statistik-fade-up statistik-d3 mb-10 text-center">
                <p class="text-[10px] font-semibold uppercase tracking-[0.22em] text-slate-400">Fungsi &amp; Ruang
                    Lingkup</p>
                <h2 class="mt-2 text-2xl font-extrabold text-slate-900 sm:text-3xl">Bidang Tugas</h2>
            </div>

            @php
                $cards = [
                    [
                        'title' => 'Statistik Sektoral & Satu Data',
                        'desc' =>
                            'Pengumpulan, analisis, dan diseminasi data statistik sektoral. Pengelolaan metadata, sinkronisasi data, serta pengembangan infrastruktur dan kelembagaan statistik.',
                        'accent' => 'border-blue-600',
                        'badge' => 'bg-blue-50 text-blue-700',
                        'icon_bg' => 'bg-blue-50',
                        'icon_color' => 'text-blue-600',
                        'items' => [
                            'Pengumpulan dan analisis data statistik sektoral',
                            'Pengelolaan metadata statistik daerah',
                            'Sinkronisasi Satu Data Kota Tangerang Selatan',
                            'Pengembangan infrastruktur kelembagaan statistik',
                        ],
                        'svg' =>
                            '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>',
                    ],
                    [
                        'title' => 'Layanan & Komunikasi Publik',
                        'desc' =>
                            'Pelaksanaan tugas Pejabat Pengelola Informasi dan Dokumentasi (PPID), monitoring opini aspirasi publik, serta pengelolaan media komunikasi dan penyediaan konten lintas sektoral.',
                        'accent' => 'border-emerald-600',
                        'badge' => 'bg-emerald-50 text-emerald-700',
                        'icon_bg' => 'bg-emerald-50',
                        'icon_color' => 'text-emerald-600',
                        'items' => [
                            'Pelaksanaan tugas PPID',
                            'Monitoring opini dan aspirasi publik',
                            'Pengelolaan media komunikasi pemerintah',
                            'Penyediaan konten informasi lintas sektoral',
                        ],
                        'svg' =>
                            '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>',
                    ],
                    [
                        'title' => 'Regulasi & Kebijakan',
                        'desc' =>
                            'Perumusan kebijakan strategis, standar, prosedur, dan kriteria, serta penyusunan produk hukum daerah yang berkaitan dengan statistik sektoral dan informasi publik.',
                        'accent' => 'border-amber-500',
                        'badge' => 'bg-amber-50 text-amber-700',
                        'icon_bg' => 'bg-amber-50',
                        'icon_color' => 'text-amber-600',
                        'items' => [
                            'Perumusan kebijakan strategis bidang statistik',
                            'Penyusunan standar dan prosedur teknis',
                            'Produk hukum daerah terkait informasi publik',
                            'Penetapan kriteria layanan informasi',
                        ],
                        'svg' =>
                            '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
                    ],
                    [
                        'title' => 'Administrasi & Pelaporan',
                        'desc' =>
                            'Penyusunan naskah dinas, LKPJ, Laporan Keuangan, pelaporan kinerja instansi, serta pembinaan dan evaluasi kinerja bawahan.',
                        'accent' => 'border-purple-600',
                        'badge' => 'bg-purple-50 text-purple-700',
                        'icon_bg' => 'bg-purple-50',
                        'icon_color' => 'text-purple-600',
                        'items' => [
                            'Penyusunan naskah dinas dan surat-menyurat',
                            'Laporan Keterangan Pertanggungjawaban (LKPJ)',
                            'Laporan keuangan dan kinerja instansi',
                            'Pembinaan dan evaluasi kinerja bawahan',
                        ],
                        'svg' =>
                            '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>',
                    ],
                ];
            @endphp

            <div class="grid gap-6 sm:grid-cols-2">
                @foreach ($cards as $index => $card)
                    <article
                        class="statistik-fade-up statistik-d{{ $index + 3 }} flex flex-col overflow-hidden rounded-2xl border-l-4 {{ $card['accent'] }} border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="flex items-start gap-4 px-6 pt-6 pb-4">
                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl {{ $card['icon_bg'] }} {{ $card['icon_color'] }}">
                                {!! $card['svg'] !!}
                            </div>
                            <div>
                                <span
                                    class="inline-block rounded-full px-2.5 py-0.5 text-[10px] font-semibold uppercase tracking-[0.15em] {{ $card['badge'] }}">Fungsi
                                    {{ $index + 1 }}</span>
                                <h3 class="mt-1 text-base font-bold text-slate-900">{{ $card['title'] }}</h3>
                                <p class="mt-1 text-xs leading-relaxed text-slate-500">{{ $card['desc'] }}</p>
                            </div>
                        </div>
                        <ul class="flex flex-1 flex-col divide-y divide-slate-100 border-t border-slate-100 px-6 pb-4">
                            @foreach ($card['items'] as $item)
                                <li class="flex items-start gap-2.5 py-2.5 text-xs leading-snug text-slate-700">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="mt-0.5 h-3.5 w-3.5 shrink-0 text-[#044FA0]" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

</main>
