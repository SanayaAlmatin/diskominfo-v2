@push('styles')
    <style>
        .profile-sekilas-diskominfo .sekilas-hero {
            background: linear-gradient(135deg, #0b3c6f 0%, #0d4f94 52%, #1f78b9 100%);
            position: relative;
        }

        .profile-sekilas-diskominfo .sekilas-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='220' height='220' viewBox='0 0 220 220' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23FFFFFF' stroke-opacity='0.18' stroke-width='1.2'%3E%3Cpath d='M12 38h68v48h60v70h68'/%3E%3Cpath d='M32 188h48v-58h84V64h36'/%3E%3C/g%3E%3Cg fill='%23F7D558' fill-opacity='0.35'%3E%3Ccircle cx='72' cy='64' r='5'/%3E%3Ccircle cx='148' cy='152' r='5'/%3E%3Ccircle cx='170' cy='42' r='4'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 220px 220px;
            background-position: 0 0;
            opacity: 0.6;
            animation: sekilasPatternDrift 48s linear infinite;
            pointer-events: none;
        }

        .profile-sekilas-diskominfo .sekilas-orb {
            position: absolute;
            border-radius: 9999px;
            pointer-events: none;
            opacity: 0.7;
            filter: blur(0.5px);
            animation: sekilasOrbFloat 9s ease-in-out infinite;
        }

        .profile-sekilas-diskominfo .sekilas-orb.orb-1 {
            width: 220px;
            height: 220px;
            right: 4%;
            top: -80px;
            background: radial-gradient(circle at 30% 30%, rgba(247, 213, 88, 0.55), rgba(247, 213, 88, 0));
            animation-delay: 0.3s;
        }

        .profile-sekilas-diskominfo .sekilas-orb.orb-2 {
            width: 160px;
            height: 160px;
            left: -40px;
            bottom: -60px;
            background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.35), rgba(255, 255, 255, 0));
            animation-delay: 1.2s;
        }

        .profile-sekilas-diskominfo .sekilas-orb.orb-3 {
            width: 120px;
            height: 120px;
            right: 24%;
            bottom: 12%;
            background: radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.28), rgba(255, 255, 255, 0));
            animation-delay: 2.1s;
        }

        .profile-sekilas-diskominfo .sekilas-fade-up {
            opacity: 0;
            transform: translateY(16px);
            animation: sekilasFadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        .profile-sekilas-diskominfo .sekilas-delay-1 {
            animation-delay: 0.08s;
        }

        .profile-sekilas-diskominfo .sekilas-delay-2 {
            animation-delay: 0.16s;
        }

        .profile-sekilas-diskominfo .sekilas-delay-3 {
            animation-delay: 0.24s;
        }

        .profile-sekilas-diskominfo .sekilas-delay-4 {
            animation-delay: 0.32s;
        }

        .profile-sekilas-diskominfo .sekilas-delay-5 {
            animation-delay: 0.4s;
        }

        @keyframes sekilasFadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes sekilasPatternDrift {
            from {
                background-position: 0 0;
            }

            to {
                background-position: 240px 160px;
            }
        }

        @keyframes sekilasOrbFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        @media (prefers-reduced-motion: reduce) {

            .profile-sekilas-diskominfo .sekilas-hero::before,
            .profile-sekilas-diskominfo .sekilas-orb,
            .profile-sekilas-diskominfo .sekilas-fade-up {
                animation: none !important;
                opacity: 1 !important;
                transform: none !important;
            }
        }
    </style>
@endpush

<main class="flex-1">

    {{-- ===================== HERO SECTION ===================== --}}
    <section class="sekilas-hero relative overflow-hidden text-white">
        <span class="sekilas-orb orb-1"></span>
        <span class="sekilas-orb orb-2"></span>
        <span class="sekilas-orb orb-3"></span>

        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">

            {{-- Badge --}}
            <div
                class="sekilas-fade-up sekilas-delay-1 inline-flex items-center gap-3 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em]">
                <span class="h-2 w-2 rounded-full bg-[#F7D558]"></span>
                Profil Diskominfo
            </div>

            <div class="mt-6 grid gap-10 lg:grid-cols-[1.1fr_.9fr] lg:items-center">

                {{-- Left column --}}
                <div>
                    <h1
                        class="sekilas-fade-up sekilas-delay-2 text-3xl font-extrabold leading-tight text-white sm:text-4xl lg:text-5xl">
                        Sekilas Diskominfo
                    </h1>
                    <p
                        class="sekilas-fade-up sekilas-delay-3 mt-4 max-w-2xl text-sm leading-7 text-blue-100 sm:text-base">
                        Dinas Komunikasi dan Informatika Kota Tangerang Selatan merupakan unsur pelaksana otonomi
                        daerah di bidang komunikasi dan informatika, persandian dan statistik.
                    </p>

                    {{-- Breadcrumb --}}
                    <nav class="sekilas-fade-up sekilas-delay-4 mt-6 flex items-center gap-2 text-xs text-blue-100"
                        aria-label="Breadcrumb">
                        <a href="{{ route('home') }}" wire:navigate
                            class="font-semibold text-white/90 transition hover:text-white">Beranda</a>
                        <span class="text-blue-200">/</span>
                        <span class="text-white">Sekilas Diskominfo</span>
                    </nav>

                    {{-- Stat chips --}}
                    <div class="sekilas-fade-up sekilas-delay-5 mt-6 grid gap-3 sm:grid-cols-3">
                        <div class="rounded-xl border border-white/20 bg-white/10 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#F7D558]">Komunikasi</p>
                            <p class="mt-2 text-sm text-blue-50">Informasi publik yang transparan dan responsif.</p>
                        </div>
                        <div class="rounded-xl border border-white/20 bg-white/10 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#F7D558]">Informatika</p>
                            <p class="mt-2 text-sm text-blue-50">Infrastruktur TI dan e-government yang modern.</p>
                        </div>
                        <div class="rounded-xl border border-white/20 bg-white/10 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#F7D558]">Persandian</p>
                            <p class="mt-2 text-sm text-blue-50">Keamanan informasi dan statistik sektoral daerah.</p>
                        </div>
                    </div>
                </div>

                {{-- Right column – floating card --}}
                <div class="sekilas-fade-up sekilas-delay-3">
                    <div class="rounded-2xl border border-white/40 bg-white p-6 text-slate-900 shadow-2xl sm:p-8">
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#044FA0]">Fokus Utama</p>
                        <blockquote class="mt-4 text-lg font-semibold leading-relaxed text-slate-900 sm:text-xl">
                            Membantu Wali Kota melaksanakan kewenangan desentralisasi dan tugas pembantuan di bidang
                            teknologi informasi.
                        </blockquote>
                        <div class="mt-6 flex flex-wrap gap-2">
                            <span
                                class="rounded-lg bg-[#F7D558] px-3 py-1 text-xs font-semibold text-[#044FA0]">E-Government</span>
                            <span
                                class="rounded-lg bg-[#E6F2FF] px-3 py-1 text-xs font-semibold text-[#044FA0]">Komunikasi
                                Publik</span>
                            <span
                                class="rounded-lg bg-[#F5F8FC] px-3 py-1 text-xs font-semibold text-[#044FA0]">Persandian</span>
                            <span
                                class="rounded-lg bg-[#F7E9B5] px-3 py-1 text-xs font-semibold text-[#044FA0]">Statistik
                                Sektoral</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ===================== HISTORY / SOTK SECTION ===================== --}}
    <section class="bg-[#F5F8FC] px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-2xl">
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#044FA0]">Landasan Hukum</p>
                    <h2 class="mt-2 text-2xl font-extrabold tracking-normal text-slate-950 sm:text-3xl">
                        Evolusi Struktur Organisasi
                    </h2>
                </div>
                <p class="max-w-xl text-sm leading-7 text-slate-600">
                    Tiga tonggak regulasi yang membentuk identitas dan kewenangan Diskominfo Kota Tangerang Selatan
                    hingga yang berlaku saat ini.
                </p>
            </div>

            @php
                $sotk = [
                    [
                        'year' => '2010',
                        'perda' => 'Perda No. 6 Tahun 2010',
                        'desc' => 'Nomenklatur awal sebagai Dinas Perhubungan, Komunikasi, dan Informatika.',
                        'icon_bg' => 'bg-[#FFF3C2] text-[#8A6C00]',
                        'bar' => 'bg-[#F7D558]',
                    ],
                    [
                        'year' => '2016',
                        'perda' => 'Perda No. 8 Tahun 2016',
                        'desc' => 'Pemisahan fungsi, resmi berdiri sendiri sebagai Dinas Komunikasi dan Informatika.',
                        'icon_bg' => 'bg-[#E8F6EE] text-[#1B6A3D]',
                        'bar' => 'bg-[#10B981]',
                    ],
                    [
                        'year' => '2022',
                        'perda' => 'Perda No. 56 Tahun 2022',
                        'desc' => 'Penyederhanaan birokrasi dan penyempurnaan SOTK terbaru.',
                        'icon_bg' => 'bg-[#F1EAFE] text-[#5B21B6]',
                        'bar' => 'bg-[#7C3AED]',
                    ],
                ];
            @endphp

            <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($sotk as $item)
                    <article
                        class="group relative flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="flex flex-1 items-start gap-4 p-6">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl {{ $item['icon_bg'] }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2">
                                    </rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                    {{ $item['year'] }}</p>
                                <p class="mt-1 text-sm font-bold text-slate-800">{{ $item['perda'] }}</p>
                                <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                        {{-- Accent bottom bar --}}
                        <div class="h-1 w-full {{ $item['bar'] }}"></div>
                    </article>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ===================== TUGAS POKOK & FUNGSI SECTION ===================== --}}
    <section class="bg-white px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="grid gap-6 lg:grid-cols-[1.05fr_.95fr]">

                {{-- Left – solid blue card --}}
                <div
                    class="rounded-2xl bg-gradient-to-br from-[#044FA0] via-[#0C5AA6] to-[#1E78B7] p-8 text-white shadow-xl">
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#F7D558]">Tugas Pokok</p>
                    <h3 class="mt-3 text-2xl font-extrabold">Pusat Transformasi Digital Tangsel</h3>
                    <p class="mt-4 text-sm leading-7 text-blue-100">
                        Berpedoman pada Peraturan Wali Kota untuk mengatur kedudukan, susunan organisasi, tugas,
                        fungsi, dan tata kerja Diskominfo yang modern dan responsif.
                    </p>
                    <a href="#"
                        class="mt-6 inline-flex items-center gap-2 rounded-lg bg-[#F7D558] px-5 py-3 text-sm font-bold text-[#044FA0] transition hover:bg-white">
                        Lihat Regulasi Penuh
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg>
                    </a>
                </div>

                {{-- Right – white card --}}
                <div class="rounded-2xl border border-slate-200 bg-[#F5F8FC] p-8 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#044FA0]">Lingkup Kerja</p>
                    <h3 class="mt-3 text-xl font-extrabold text-slate-950">Pilar Utama Diskominfo</h3>
                    <ul class="mt-5 space-y-3 text-sm leading-6 text-slate-700">
                        <li class="flex items-start gap-3">
                            <span class="mt-1 h-2 w-2 shrink-0 rounded-full bg-[#044FA0]"></span>
                            Pengelolaan Komunikasi Publik dan Media.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-1 h-2 w-2 shrink-0 rounded-full bg-[#F7D558]"></span>
                            Pengembangan Infrastruktur TI dan E-Government.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-1 h-2 w-2 shrink-0 rounded-full bg-[#1E78B7]"></span>
                            Tata Kelola Persandian dan Keamanan Informasi.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-1 h-2 w-2 shrink-0 rounded-full bg-[#10B981]"></span>
                            Penyelenggaraan Statistik Sektoral Daerah.
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

</main>
