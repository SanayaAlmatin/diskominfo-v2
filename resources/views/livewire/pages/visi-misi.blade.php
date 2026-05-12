@push('styles')
    <style>
        .profile-visi-misi .visi-hero {
            background: linear-gradient(135deg, #0b3c6f 0%, #0d4f94 52%, #1f78b9 100%);
            position: relative;
        }

        .profile-visi-misi .visi-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='220' height='220' viewBox='0 0 220 220' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23FFFFFF' stroke-opacity='0.18' stroke-width='1.2'%3E%3Cpath d='M12 38h68v48h60v70h68'/%3E%3Cpath d='M32 188h48v-58h84V64h36'/%3E%3C/g%3E%3Cg fill='%23F7D558' fill-opacity='0.35'%3E%3Ccircle cx='72' cy='64' r='5'/%3E%3Ccircle cx='148' cy='152' r='5'/%3E%3Ccircle cx='170' cy='42' r='4'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 220px 220px;
            background-position: 0 0;
            opacity: 0.6;
            animation: visiPatternDrift 48s linear infinite;
            pointer-events: none;
        }

        .profile-visi-misi .visi-orb {
            position: absolute;
            border-radius: 9999px;
            pointer-events: none;
            opacity: 0.7;
            filter: blur(0.5px);
            animation: visiOrbFloat 9s ease-in-out infinite;
        }

        .profile-visi-misi .visi-orb.orb-1 {
            width: 220px;
            height: 220px;
            right: 4%;
            top: -80px;
            background: radial-gradient(circle at 30% 30%, rgba(247, 213, 88, 0.55), rgba(247, 213, 88, 0));
            animation-delay: 0.3s;
        }

        .profile-visi-misi .visi-orb.orb-2 {
            width: 160px;
            height: 160px;
            left: -40px;
            bottom: -60px;
            background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.35), rgba(255, 255, 255, 0));
            animation-delay: 1.2s;
        }

        .profile-visi-misi .visi-orb.orb-3 {
            width: 120px;
            height: 120px;
            right: 24%;
            bottom: 12%;
            background: radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.28), rgba(255, 255, 255, 0));
            animation-delay: 2.1s;
        }

        .profile-visi-misi .visi-fade-up {
            opacity: 0;
            transform: translateY(16px);
            animation: visiFadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        .profile-visi-misi .visi-delay-1 {
            animation-delay: 0.08s;
        }

        .profile-visi-misi .visi-delay-2 {
            animation-delay: 0.16s;
        }

        .profile-visi-misi .visi-delay-3 {
            animation-delay: 0.24s;
        }

        .profile-visi-misi .visi-delay-4 {
            animation-delay: 0.32s;
        }

        .profile-visi-misi .visi-delay-5 {
            animation-delay: 0.4s;
        }

        @keyframes visiFadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes visiPatternDrift {
            from {
                background-position: 0 0;
            }

            to {
                background-position: 240px 160px;
            }
        }

        @keyframes visiOrbFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        @media (prefers-reduced-motion: reduce) {

            .profile-visi-misi .visi-hero::before,
            .profile-visi-misi .visi-orb,
            .profile-visi-misi .visi-fade-up {
                animation: none !important;
                opacity: 1 !important;
                transform: none !important;
            }
        }
    </style>
@endpush

<main class="flex-1">
    <section class="visi-hero relative overflow-hidden text-white">
        <span class="visi-orb orb-1"></span>
        <span class="visi-orb orb-2"></span>
        <span class="visi-orb orb-3"></span>

        <div class="relative mx-auto max-w-7xl px-4 pb-12 pt-28 sm:px-6 lg:px-8 lg:pb-16 lg:pt-36">
            <div class="flex flex-col items-start">
                <x-breadcrumb class="visi-fade-up visi-delay-1 mb-5" :links="[['label' => 'Beranda', 'url' => route('home')], ['label' => 'Visi & Misi']]" />

                <div
                    class="visi-fade-up visi-delay-1 inline-flex items-center gap-3 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em]">
                    <span class="h-2 w-2 rounded-full bg-[#F7D558]"></span>
                    Profil Diskominfo
                </div>
            </div>

            <div class="mt-6 grid gap-10 lg:grid-cols-[1.1fr_.9fr] lg:items-center">
                <div>
                    <h1
                        class="visi-fade-up visi-delay-2 text-3xl font-extrabold leading-tight text-white sm:text-4xl lg:text-5xl">
                        Visi dan Misi
                    </h1>
                    <p class="visi-fade-up visi-delay-3 mt-4 max-w-2xl text-sm leading-7 text-blue-100 sm:text-base">
                        Arah pembangunan Diskominfo Tangerang Selatan dalam memperkuat layanan publik, tata kelola data,
                        dan infrastruktur digital yang aman serta saling terkoneksi.
                    </p>

                    <div class="visi-fade-up visi-delay-5 mt-6 grid gap-3 sm:grid-cols-3">
                        <div class="rounded-xl border border-white/20 bg-white/10 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#F7D558]">SDM Unggul</p>
                            <p class="mt-2 text-sm text-blue-50">Kompetensi aparatur dan masyarakat digital.</p>
                        </div>
                        <div class="rounded-xl border border-white/20 bg-white/10 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#F7D558]">Kota Lestari</p>
                            <p class="mt-2 text-sm text-blue-50">Inovasi berkelanjutan dan ramah lingkungan.</p>
                        </div>
                        <div class="rounded-xl border border-white/20 bg-white/10 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#F7D558]">Terkoneksi</p>
                            <p class="mt-2 text-sm text-blue-50">Data, layanan, dan informasi terintegrasi.</p>
                        </div>
                    </div>
                </div>

                <div class="visi-fade-up visi-delay-3">
                    <div class="rounded-2xl border border-white/40 bg-white p-6 text-slate-900 shadow-2xl sm:p-8">
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#044FA0]">Visi Kota</p>
                        <blockquote class="mt-4 text-lg font-semibold leading-relaxed text-slate-900 sm:text-xl">
                            {{ $vision }}
                        </blockquote>
                        <div class="mt-6 flex flex-wrap gap-2">
                            <span class="rounded-lg bg-[#F7D558] px-3 py-1 text-xs font-semibold text-[#044FA0]">Tangsel
                                unggul</span>
                            <span class="rounded-lg bg-[#F5F8FC] px-3 py-1 text-xs font-semibold text-[#044FA0]">Efektif
                                dan efisien</span>
                            <span class="rounded-lg bg-[#E6F2FF] px-3 py-1 text-xs font-semibold text-[#044FA0]">Kota
                                lestari</span>
                            <span class="rounded-lg bg-[#F7E9B5] px-3 py-1 text-xs font-semibold text-[#044FA0]">Saling
                                terkoneksi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#F5F8FC] px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-2xl">
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#044FA0]">Misi</p>
                    <h2 class="mt-2 text-2xl font-extrabold tracking-normal text-slate-950 sm:text-3xl">
                        Langkah strategis pembangunan Kota Tangerang Selatan
                    </h2>
                </div>
                <p class="max-w-xl text-sm leading-7 text-slate-600">
                    Misi ini menjadi landasan kerja Diskominfo untuk menghadirkan layanan publik yang modern,
                    responsif, dan terukur bagi masyarakat.
                </p>
            </div>

            @php
                $missionAccents = [
                    'bg-[#E6F2FF] text-[#044FA0]',
                    'bg-[#FFF3C2] text-[#8A6C00]',
                    'bg-[#E8F6EE] text-[#1B6A3D]',
                    'bg-[#FDE8E8] text-[#9B1C1C]',
                    'bg-[#F1EAFE] text-[#5B21B6]',
                ];
            @endphp

            <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($missions as $index => $mission)
                    @php
                        $accent = $missionAccents[$index % count($missionAccents)];
                        $number = str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT);
                    @endphp
                    <article wire:key="mission-{{ $index }}"
                        class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="flex items-start gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl {{ $accent }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 5v14" />
                                    <path d="m19 12-7 7-7-7" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Misi
                                    {{ $number }}</p>
                                <p class="mt-2 text-base font-semibold leading-relaxed text-slate-900">
                                    {{ $mission }}</p>
                            </div>
                        </div>
                        <div class="mt-6 h-1 w-full rounded-full bg-slate-100">
                            <div class="h-full w-1/2 rounded-full bg-[#044FA0]/60"></div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="grid gap-6 lg:grid-cols-[1.05fr_.95fr]">
                <div
                    class="rounded-2xl bg-gradient-to-br from-[#044FA0] via-[#0C5AA6] to-[#1E78B7] p-8 text-white shadow-xl">
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#F7D558]">Komitmen Layanan</p>
                    <h3 class="mt-3 text-2xl font-extrabold">Melayani dengan data, teknologi, dan komunikasi publik</h3>
                    <p class="mt-4 text-sm leading-7 text-blue-100">
                        Diskominfo menjaga keterbukaan informasi, menguatkan literasi digital, serta memastikan
                        layanan teknologi informasi dapat diakses dengan mudah dan aman oleh seluruh warga.
                    </p>
                    <a href="{{ route('home') }}" wire:navigate
                        class="mt-6 inline-flex items-center gap-2 rounded-lg bg-[#F7D558] px-5 py-3 text-sm font-bold text-[#044FA0] transition hover:bg-white">
                        Kembali ke Beranda
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-[#F5F8FC] p-8 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#044FA0]">Fokus Utama</p>
                    <h3 class="mt-3 text-xl font-extrabold text-slate-950">Prioritas strategis yang dijalankan</h3>
                    <ul class="mt-5 space-y-3 text-sm leading-6 text-slate-700">
                        <li class="flex items-start gap-3">
                            <span class="mt-1 h-2 w-2 rounded-full bg-[#044FA0]"></span>
                            Penguatan SDM, literasi digital, dan budaya pelayanan yang ramah publik.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-1 h-2 w-2 rounded-full bg-[#F7D558]"></span>
                            Infrastruktur teknologi informasi yang saling terkoneksi dan siap melayani.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-1 h-2 w-2 rounded-full bg-[#1E78B7]"></span>
                            Tata kelola birokrasi yang efektif, efisien, dan transparan berbasis data.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>
