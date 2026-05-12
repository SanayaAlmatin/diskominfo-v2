@push('styles')
    <style>
        /* ── Hero ── */
        .struktur-org-hero {
            background: linear-gradient(135deg, #0b3c6f 0%, #0d4f94 52%, #1f78b9 100%);
            position: relative;
        }

        .struktur-org-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='220' height='220' viewBox='0 0 220 220' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23FFFFFF' stroke-opacity='0.18' stroke-width='1.2'%3E%3Cpath d='M12 38h68v48h60v70h68'/%3E%3Cpath d='M32 188h48v-58h84V64h36'/%3E%3C/g%3E%3Cg fill='%23F7D558' fill-opacity='0.35'%3E%3Ccircle cx='72' cy='64' r='5'/%3E%3Ccircle cx='148' cy='152' r='5'/%3E%3Ccircle cx='170' cy='42' r='4'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 220px 220px;
            opacity: 0.6;
            animation: soPatternDrift 48s linear infinite;
            pointer-events: none;
        }

        @keyframes soPatternDrift {
            from {
                background-position: 0 0;
            }

            to {
                background-position: 240px 160px;
            }
        }

        /* ── Org-tree connector lines ── */
        .org-connector-v {
            width: 2px;
            min-height: 32px;
            background: #cbd5e1;
            margin: 0 auto;
        }

        .org-connector-h {
            display: flex;
            align-items: flex-start;
            position: relative;
        }

        .org-connector-h::before {
            content: "";
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            height: 2px;
            width: calc(100% - 4rem);
            background: #cbd5e1;
        }

        /* ── Card fade-up ── */
        .so-fade-up {
            opacity: 0;
            transform: translateY(14px);
            animation: soFadeUp 0.65s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        .so-d1 {
            animation-delay: 0.06s;
        }

        .so-d2 {
            animation-delay: 0.12s;
        }

        .so-d3 {
            animation-delay: 0.18s;
        }

        .so-d4 {
            animation-delay: 0.24s;
        }

        .so-d5 {
            animation-delay: 0.30s;
        }

        @keyframes soFadeUp {
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

            .struktur-org-hero::before,
            .so-fade-up {
                animation: none !important;
                opacity: 1 !important;
                transform: none !important;
            }
        }
    </style>
@endpush

<main class="flex-1 profile-struktur-org">

    {{-- ════════════════════════════════════════
	     HERO SECTION
	     ════════════════════════════════════════ --}}
    <section class="struktur-org-hero relative overflow-hidden text-white">
        <div class="relative mx-auto max-w-7xl px-4 pb-12 pt-28 sm:px-6 lg:px-8 lg:pb-16 lg:pt-36 text-center">

            <div class="flex flex-col items-center">
                <x-breadcrumb class="so-fade-up so-d1 mb-5" :links="[['label' => 'Beranda', 'url' => route('home')], ['label' => 'Struktur Organisasi']]" />

                <div
                    class="so-fade-up so-d1 inline-flex items-center gap-3 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em]">
                    <span class="h-2 w-2 rounded-full bg-[#F7D558]"></span>
                    Profil Diskominfo
                </div>
            </div>

            <h1 class="so-fade-up so-d2 mt-5 text-3xl font-extrabold leading-tight sm:text-4xl lg:text-5xl">
                Struktur Organisasi Tahun 2026
            </h1>

            <p class="so-fade-up so-d3 mt-4 text-sm leading-7 text-blue-100 sm:text-base">
                Susunan jabatan dan tata kerja Dinas Komunikasi dan Informatika Kota Tangerang Selatan.
            </p>

        </div>
    </section>

    {{-- ════════════════════════════════════════
	     ORGANIZATIONAL CHART
	     ════════════════════════════════════════ --}}
    <section class="bg-slate-50 px-4 py-14 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl overflow-x-auto">

            {{-- ── LEVEL 1: Kepala Dinas ── --}}
            <div class="flex justify-center so-fade-up so-d1">
                <div class="w-full max-w-sm rounded-2xl bg-[#0a2351] px-6 py-5 text-center text-white shadow-xl">
                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-white/15">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#F7D558]" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </div>
                    <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-[#F7D558]">Kepala Dinas</p>
                    <p class="mt-1 text-sm font-bold leading-snug">Dr. Tubagus Asep Nurdin, S.Kom., M.Kom</p>
                </div>
            </div>

            {{-- connector down --}}
            <div class="org-connector-v h-8"></div>

            {{-- ── LEVEL 2: Sekretariat ── --}}
            <div class="so-fade-up so-d2">
                <div class="flex justify-center">
                    <div class="w-full max-w-sm rounded-2xl bg-teal-700 px-6 py-5 text-center text-white shadow-lg">
                        <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-teal-200">Sekretariat</p>
                        <p class="mt-1 text-sm font-bold">Sekretaris Dinas</p>
                        <p class="mt-0.5 text-xs text-teal-100">Ahmad Syatiri, SE</p>
                    </div>
                </div>

                {{-- connector down --}}
                <div class="org-connector-v h-6"></div>

                {{-- Sub-bagian row --}}
                <div class="grid gap-4 sm:grid-cols-3">
                    @php
                        $subBag = [
                            ['title' => 'Kepala Sub Bagian Umum dan Kepegawaian', 'name' => 'Ellya Mufidah, S.Ikom'],
                            ['title' => 'Kepala Sub Bagian Keuangan', 'name' => 'Silvia Nelly, S.Sos'],
                            ['title' => 'Perencana Ahli Muda', 'name' => 'Syafii, S.IP'],
                        ];
                    @endphp
                    @foreach ($subBag as $sb)
                        <div class="rounded-xl border border-teal-200 bg-white px-5 py-4 text-center shadow-sm">
                            <p class="text-xs font-semibold leading-snug text-slate-700">{{ $sb['title'] }}</p>
                            <p class="mt-1 text-xs text-teal-700 font-medium">{{ $sb['name'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- connector down --}}
            <div class="org-connector-v h-8 mt-2"></div>

            {{-- ── LEVEL 3: Tiga Bidang Utama ── --}}
            <div class="so-fade-up so-d3">
                <p class="mb-6 text-center text-[10px] font-semibold uppercase tracking-[0.22em] text-slate-400">
                    Bidang-Bidang Utama</p>

                @php
                    $bidang = [
                        [
                            'title' => 'Kepala Bidang Pengelolaan Infrastruktur TIK',
                            'name' => 'Syaiful Bachri, S.Sos',
                            'color' => 'bg-blue-800',
                            'bar' => 'bg-blue-400',
                            'items' => [
                                'Tim Pengelola Pusat Data',
                                'Tim Pengelolaan Jaringan Intra Pemerintah Daerah dan Jaringan Wifi Publik',
                                'Pengawasan dan Pengendalian Menara Telekomunikasi',
                            ],
                        ],
                        [
                            'title' => 'Kepala Bidang Pengelolaan Aplikasi dan Persandian',
                            'name' => 'Bagus Gede Arta Perdana, S.Kom., M.Kom',
                            'color' => 'bg-blue-800',
                            'bar' => 'bg-[#F7D558]',
                            'items' => [
                                'Tim Tata Kelola e-Government',
                                'Tim Manajemen Keamanan Informasi',
                                'Tim Pengembangan SDM TIK',
                                'Tim Pengembangan Sistem Elektronik',
                                'Tim Pengelola Operasional & Helpdesk Sistem Elektronik',
                                'Tim Penyelenggara Keamanan Informasi',
                                'Tim Penyelenggara Sertifikat Elektronik',
                            ],
                        ],
                        [
                            'title' => 'Kepala Bidang Penyelenggaraan Statistik & Layanan Informasi Publik',
                            'name' => 'Budi Irwan Sukendar, ST., M.Si',
                            'color' => 'bg-blue-800',
                            'bar' => 'bg-emerald-500',
                            'items' => [
                                'Tim Statistik Sektoral & Satu Data',
                                'Tim Diseminasi Informasi & Kemitraan Komunikasi Publik',
                                'Tim Pengelolaan Opini, Aspirasi dan Informasi Publik',
                            ],
                        ],
                    ];
                @endphp

                <div class="grid gap-6 lg:grid-cols-3">
                    @foreach ($bidang as $index => $b)
                        <article
                            class="flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                            {{-- Header --}}
                            <div class="{{ $b['color'] }} px-5 py-5 text-white">
                                <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-blue-200">Bidang
                                    {{ $index + 1 }}</p>
                                <p class="mt-1 text-sm font-bold leading-snug">{{ $b['title'] }}</p>
                                <p class="mt-1 text-xs text-blue-200">{{ $b['name'] }}</p>
                            </div>

                            {{-- Sub-teams list --}}
                            <ul class="flex flex-1 flex-col divide-y divide-slate-100 px-5 py-3">
                                @foreach ($b['items'] as $item)
                                    <li class="flex items-start gap-3 py-2.5 text-xs leading-snug text-slate-700">
                                        <span class="mt-1 h-1.5 w-1.5 shrink-0 rounded-full {{ $b['bar'] }}"></span>
                                        {{ $item }}
                                    </li>
                                @endforeach
                            </ul>

                            {{-- Accent bottom bar --}}
                            <div class="h-1 w-full {{ $b['bar'] }}"></div>
                        </article>
                    @endforeach
                </div>
            </div>

            {{-- ════════════════════════════════════════
			     KELOMPOK JABATAN FUNGSIONAL
			     ════════════════════════════════════════ --}}
            <div class="mt-12 so-fade-up so-d4">
                <div class="overflow-hidden rounded-2xl shadow-lg">
                    <div class="bg-emerald-900 px-6 py-4 text-center">
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-white">Kelompok Jabatan Fungsional
                        </p>
                    </div>
                    <div class="bg-white">
                        @php
                            $fungsional = [
                                ['name' => 'EVA SURYANI, S.SiT, MT', 'jabatan' => 'Manggala Informatika Ahli Madya'],
                                [
                                    'name' => 'HAFIZHAN IRAWAN, S.Kom, M.Kom',
                                    'jabatan' => 'Manggala Informatika Ahli Muda',
                                ],
                                [
                                    'name' => 'NANI SUPRIYANI TAULIAR, ST, M.Kom',
                                    'jabatan' => 'Pranata Komputer Ahli Muda',
                                ],
                                ['name' => 'JIMMY ALBERTO, ST, M.M.S.I', 'jabatan' => 'Pranata Komputer Ahli Muda'],
                                ['name' => 'YAOMI M.LBERTO, S.Sos, MM', 'jabatan' => 'Pranata Komputer Ahli Muda'],
                                [
                                    'name' => 'MOHAMAD HILMY ZHAFRANI, S.Kom, M.T.I',
                                    'jabatan' => 'Pranata Komputer Ahli Pertama',
                                ],
                                ['name' => 'NOVI HASTIANI, S.SI', 'jabatan' => 'Pranata Komputer Ahli Pertama'],
                                ['name' => 'SRI WIDIASTUTI, S.Sos', 'jabatan' => 'Statistisi Ahli Muda'],
                                ['name' => 'FIRMAN, S.SiT, MM', 'jabatan' => 'Pranata Humas Ahli Muda'],
                                ['name' => 'ANNISA NIDYA HAPSARI, S.Ikom', 'jabatan' => 'Pranata Humas Ahli Pertama'],
                            ];
                        @endphp
                        @foreach ($fungsional as $i => $f)
                            <div
                                class="flex items-center gap-4 px-6 py-3 {{ $i % 2 === 0 ? 'bg-white' : 'bg-slate-50' }}">
                                <span
                                    class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-[11px] font-bold text-emerald-800">{{ $i + 1 }}</span>
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-slate-900">{{ $f['name'] }}</p>
                                    <p class="text-xs text-slate-500">{{ $f['jabatan'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ════════════════════════════════════════
			     DOWNLOAD CTA
			     ════════════════════════════════════════ --}}
            <div class="mt-12 so-fade-up so-d5 flex justify-center">
                <button type="button"
                    class="inline-flex items-center gap-2 rounded-lg bg-[#F7D558] px-6 py-3 text-sm font-bold text-[#044FA0] transition hover:bg-yellow-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                        <line x1="12" y1="15" x2="12" y2="3" />
                    </svg>
                    Unduh Struktur Organisasi
                </button>
            </div>

        </div>
    </section>

</main>
