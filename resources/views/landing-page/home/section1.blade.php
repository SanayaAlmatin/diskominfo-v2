@extends('layouts.app')

@section('title', 'Portal Resmi Diskominfo Tangerang Selatan')
@section('body_class', 'welcome-modern bg-[#F5F8FC] text-slate-900 selection:bg-[#F7D558] selection:text-[#044FA0]')

@push('styles')
    <style>
        .welcome-modern header {
            /* background: #044FA0 !important; */
            border-top-color: rgba(255, 255, 255, 0.16) !important;
            /* border-bottom-color: rgba(255, 255, 255, 0.14) !important; */
            box-shadow: none !important;
        }

        .city-pattern {
            background-color: #044FA0;
            background-image: url("data:image/svg+xml,%3Csvg width='180' height='180' viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23FFFFFF' stroke-opacity='.13' stroke-width='1.5'%3E%3Cpath d='M18 42h40v34h38v42h46'/%3E%3Cpath d='M30 132h28V98h48V58h44'/%3E%3Cpath d='M90 18v34M132 76h30M18 86h30M84 136v26'/%3E%3Ccircle cx='58' cy='42' r='4' fill='%23F7D558' fill-opacity='.72' stroke='none'/%3E%3Ccircle cx='96' cy='76' r='4' fill='%23FFFFFF' fill-opacity='.45' stroke='none'/%3E%3Ccircle cx='132' cy='132' r='4' fill='%23F7D558' fill-opacity='.72' stroke='none'/%3E%3Ccircle cx='90' cy='18' r='3' fill='%23FFFFFF' fill-opacity='.45' stroke='none'/%3E%3C/g%3E%3Cg fill='%23FFFFFF' fill-opacity='.1'%3E%3Crect x='18' y='146' width='12' height='16' rx='1'/%3E%3Crect x='36' y='134' width='12' height='28' rx='1'/%3E%3Crect x='54' y='122' width='12' height='40' rx='1'/%3E%3Crect x='126' y='144' width='12' height='18' rx='1'/%3E%3Crect x='144' y='126' width='12' height='36' rx='1'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 220px 220px;
            animation: cityPatternDrift 36s linear infinite;
        }

        .service-mark {
            background-image: url("data:image/svg+xml,%3Csvg width='96' height='96' viewBox='0 0 96 96' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23044FA0' stroke-opacity='.16' stroke-width='2'%3E%3Cpath d='M16 48h18l10-18 16 36 8-18h12'/%3E%3Ccircle cx='48' cy='48' r='34'/%3E%3Ccircle cx='48' cy='48' r='18'/%3E%3C/g%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem bottom 1rem;
        }

        .welcome-reveal {
            opacity: 0;
            transform: translateY(18px);
            animation: welcomeReveal 0.75s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        .welcome-fade {
            opacity: 0;
            animation: welcomeFade 0.7s ease forwards;
        }

        .welcome-delay-1 { animation-delay: 0.08s; }
        .welcome-delay-2 { animation-delay: 0.16s; }
        .welcome-delay-3 { animation-delay: 0.24s; }
        .welcome-delay-4 { animation-delay: 0.32s; }
        .welcome-delay-5 { animation-delay: 0.4s; }

        .welcome-signal-dot {
            position: relative;
            isolation: isolate;
        }

        .welcome-signal-dot::after {
            content: "";
            position: absolute;
            inset: -7px;
            z-index: -1;
            border: 1px solid rgba(247, 213, 88, 0.72);
            border-radius: 999px;
            animation: welcomeSignalPulse 1.9s ease-out infinite;
        }

        .welcome-network-panel {
            opacity: 0;
            animation: welcomeFade 0.7s ease 0.32s forwards, welcomeFloat 7s ease-in-out 1s infinite;
            will-change: transform;
        }

        .welcome-metric {
            animation: welcomeSoftFloat 6s ease-in-out infinite;
        }

        .welcome-metric:nth-child(2) {
            animation-delay: 0.7s;
        }

        .service-card {
            opacity: 0;
            animation: welcomeFade 0.65s ease forwards;
        }

        .service-card:nth-child(1) { animation-delay: 0.12s; }
        .service-card:nth-child(2) { animation-delay: 0.22s; }
        .service-card:nth-child(3) { animation-delay: 0.32s; }
        .service-card:nth-child(4) { animation-delay: 0.42s; }

        @keyframes welcomeReveal {
            from {
                opacity: 0;
                transform: translateY(18px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes welcomeFade {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes cityPatternDrift {
            from { background-position: 0 0; }
            to { background-position: 320px 180px; }
        }

        @keyframes welcomeSignalPulse {
            from {
                opacity: 0.72;
                transform: scale(0.82);
            }
            to {
                opacity: 0;
                transform: scale(1.9);
            }
        }

        @keyframes welcomeFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes welcomeSoftFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }

        @media (prefers-reduced-motion: reduce) {
            .city-pattern,
            .welcome-reveal,
            .welcome-fade,
            .welcome-signal-dot::after,
            .welcome-network-panel,
            .welcome-metric,
            .service-card {
                animation: none !important;
                opacity: 1 !important;
                transform: none !important;
            }
        }
    </style>
@endpush

@section('content')
    <main class="flex-1">
        <section class="city-pattern relative overflow-hidden text-white">
            <div class="absolute inset-x-0 bottom-0 h-px bg-white/20"></div>
            <div class="relative mx-auto grid min-h-[50vh] max-w-7xl items-center gap-10 px-4 py-10 sm:px-6 lg:grid-cols-[1.08fr_.92fr] lg:px-8 lg:py-12">
                <div class="max-w-3xl">
                    <div class="welcome-reveal welcome-delay-1 mb-5 inline-flex items-center gap-3 rounded-lg border border-white/20 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-white">
                        <span class="welcome-signal-dot h-2 w-2 rounded-full bg-[#F7D558]"></span>
                        Portal Diskominfo Tangerang Selatan
                    </div>

                    <h1 class="welcome-reveal welcome-delay-2 max-w-4xl text-3xl font-extrabold leading-tight tracking-normal text-white sm:text-4xl lg:text-5xl">
                        Akselerasi <span class="text-[#F7D558]">Transformasi Digital</span> Kota Tangerang Selatan
                    </h1>

                    <p class="welcome-reveal welcome-delay-3 mt-5 max-w-2xl text-base leading-8 text-blue-50 sm:text-lg">
                        Mengelola komunikasi publik dan infrastruktur teknologi informasi demi pelayanan masyarakat yang lebih cerdas dan responsif.
                    </p>

                    <p class="welcome-reveal welcome-delay-4 mt-4 max-w-2xl text-sm leading-7 text-blue-100">
                        Diskominfo menjadi penghubung informasi resmi, tata kelola data, keamanan informasi, dan layanan digital yang mendukung kota terkoneksi.
                    </p>

                    <div class="welcome-reveal welcome-delay-5 mt-7 flex flex-col gap-3 sm:flex-row">
                        <a href="#" class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#F7D558] px-5 py-3 text-sm font-bold text-[#044FA0] transition hover:bg-white">
                            Jelajahi Layanan
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                        </a>
                        <a href="#" class="inline-flex items-center justify-center gap-2 rounded-lg border border-white/25 px-5 py-3 text-sm font-semibold text-white transition hover:border-white hover:bg-white/10">
                            Informasi Publik
                        </a>
                    </div>
                </div>

                <div class="relative hidden lg:block">
                    <div class="welcome-network-panel ml-auto w-full max-w-md rounded-lg border border-white/20 bg-white/10 p-5">
                        <div class="flex items-center justify-between border-b border-white/20 pb-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#F7D558]">Kota Terkoneksi</p>
                                <p class="mt-1 text-sm text-blue-50">Satu ekosistem informasi dan layanan digital.</p>
                            </div>
                            <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-white text-[#044FA0]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 20v-6" />
                                    <path d="M6 20V10" />
                                    <path d="M18 20V4" />
                                </svg>
                            </div>
                        </div>

                        <div class="mt-5 grid grid-cols-2 gap-3">
                            <div class="welcome-metric rounded-lg bg-white p-4 text-[#044FA0]">
                                <p class="text-2xl font-extrabold">24/7</p>
                                <p class="mt-1 text-xs font-semibold uppercase tracking-wide text-slate-500">Monitoring</p>
                            </div>
                            <div class="welcome-metric rounded-lg bg-[#F7D558] p-4 text-[#044FA0]">
                                <p class="text-2xl font-extrabold">Data</p>
                                <p class="mt-1 text-xs font-semibold uppercase tracking-wide">Terpadu</p>
                            </div>
                        </div>

                        <div class="mt-5 space-y-3">
                            <div class="flex items-center gap-3 rounded-lg border border-white/20 p-3">
                                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-[#F7D558]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 12.55a11 11 0 0 1 16 0" />
                                        <path d="M8.5 16.1a5 5 0 0 1 7 0" />
                                        <path d="M12 20h.01" />
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-sm font-semibold text-white">Infrastruktur TIK</p>
                                    <p class="text-xs text-blue-100">Konektivitas perangkat daerah dan ruang publik.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 rounded-lg border border-white/20 p-3">
                                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-[#F7D558]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z" />
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-sm font-semibold text-white">Komunikasi Publik</p>
                                    <p class="text-xs text-blue-100">Informasi resmi yang jelas, cepat, dan terverifikasi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- @include('layouts.landing-page.home.section2') --}}

        <section class="bg-[#F5F8FC] px-4 py-10 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <div class="mb-6 flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-[0.18em] text-[#044FA0]">Fokus Layanan</p>
                        <h2 class="mt-2 text-2xl font-extrabold tracking-normal text-slate-950">Membangun layanan kota yang mudah diakses</h2>
                    </div>
                    <p class="max-w-xl text-sm leading-7 text-slate-600">
                        Kolaborasi teknologi, data, dan komunikasi publik untuk mendukung pelayanan warga Tangerang Selatan.
                    </p>
                </div>

                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <a href="#" class="service-card service-mark rounded-lg border border-slate-200 bg-white p-5 transition hover:-translate-y-1 hover:border-[#044FA0] hover:shadow-lg">
                        <span class="mb-5 flex h-11 w-11 items-center justify-center rounded-lg bg-[#044FA0] text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                <path d="M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5z" />
                            </svg>
                        </span>
                        <h3 class="text-base font-bold text-slate-950">Informasi Publik</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600">Publikasi berita, agenda, dan dokumen resmi pemerintah kota.</p>
                    </a>

                    <a href="#" class="service-card service-mark rounded-lg border border-slate-200 bg-white p-5 transition hover:-translate-y-1 hover:border-[#044FA0] hover:shadow-lg">
                        <span class="mb-5 flex h-11 w-11 items-center justify-center rounded-lg bg-[#044FA0] text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 3v18h18" />
                                <path d="m19 9-5 5-4-4-3 3" />
                            </svg>
                        </span>
                        <h3 class="text-base font-bold text-slate-950">Satu Data Tangsel</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600">Penguatan data sektoral untuk perencanaan dan evaluasi kebijakan.</p>
                    </a>

                    <a href="#" class="service-card service-mark rounded-lg border border-slate-200 bg-white p-5 transition hover:-translate-y-1 hover:border-[#044FA0] hover:shadow-lg">
                        <span class="mb-5 flex h-11 w-11 items-center justify-center rounded-lg bg-[#044FA0] text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </span>
                        <h3 class="text-base font-bold text-slate-950">Keamanan Informasi</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600">Dukungan persandian dan perlindungan sistem elektronik pemerintah.</p>
                    </a>

                    <a href="#" class="service-card service-mark rounded-lg border border-slate-200 bg-white p-5 transition hover:-translate-y-1 hover:border-[#044FA0] hover:shadow-lg">
                        <span class="mb-5 flex h-11 w-11 items-center justify-center rounded-lg bg-[#044FA0] text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12.55a11 11 0 0 1 14 0" />
                                <path d="M8.5 16.1a5 5 0 0 1 7 0" />
                                <path d="M12 20h.01" />
                            </svg>
                        </span>
                        <h3 class="text-base font-bold text-slate-950">Smart City</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600">Integrasi infrastruktur digital untuk pelayanan yang responsif.</p>
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection
