@push('styles')
    <style>
        .galeri-photo .gp-hero {
            background: linear-gradient(135deg, #0b3c6f 0%, #044FA0 52%, #1f78b9 100%);
            position: relative;
        }

        .galeri-photo .gp-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='220' height='220' viewBox='0 0 220 220' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23FFFFFF' stroke-opacity='0.18' stroke-width='1.2'%3E%3Cpath d='M12 38h68v48h60v70h68'/%3E%3Cpath d='M32 188h48v-58h84V64h36'/%3E%3C/g%3E%3Cg fill='%23F7D558' fill-opacity='0.35'%3E%3Ccircle cx='72' cy='64' r='5'/%3E%3Ccircle cx='148' cy='152' r='5'/%3E%3Ccircle cx='170' cy='42' r='4'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 220px 220px;
            background-position: 0 0;
            opacity: 0.6;
            animation: gpPatternDrift 48s linear infinite;
            pointer-events: none;
        }

        .galeri-photo .gp-orb {
            position: absolute;
            border-radius: 9999px;
            pointer-events: none;
            opacity: 0.7;
            filter: blur(0.5px);
            animation: gpOrbFloat 9s ease-in-out infinite;
        }

        .galeri-photo .gp-orb.orb-1 {
            width: 220px;
            height: 220px;
            right: 4%;
            top: -80px;
            background: radial-gradient(circle at 30% 30%, rgba(247, 213, 88, 0.55), rgba(247, 213, 88, 0));
            animation-delay: 0.3s;
        }

        .galeri-photo .gp-orb.orb-2 {
            width: 160px;
            height: 160px;
            left: -40px;
            bottom: -60px;
            background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.35), rgba(255, 255, 255, 0));
            animation-delay: 1.2s;
        }

        .galeri-photo .gp-orb.orb-3 {
            width: 120px;
            height: 120px;
            right: 24%;
            bottom: 12%;
            background: radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.28), rgba(255, 255, 255, 0));
            animation-delay: 2.1s;
        }

        .galeri-photo .gp-fade-up {
            opacity: 0;
            transform: translateY(16px);
            animation: gpFadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        .galeri-photo .gp-delay-1 {
            animation-delay: 0.08s;
        }

        .galeri-photo .gp-delay-2 {
            animation-delay: 0.16s;
        }

        .galeri-photo .gp-delay-3 {
            animation-delay: 0.24s;
        }

        .galeri-photo .gp-delay-4 {
            animation-delay: 0.34s;
        }

        @keyframes gpFadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes gpPatternDrift {
            from {
                background-position: 0 0;
            }

            to {
                background-position: 240px 160px;
            }
        }

        @keyframes gpOrbFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        .galeri-photo .gp-card {
            box-shadow: 0 4px 20px -2px rgba(4, 79, 160, 0.10), 0 2px 8px -2px rgba(4, 79, 160, 0.06);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .galeri-photo .gp-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 36px -4px rgba(4, 79, 160, 0.20), 0 4px 14px -2px rgba(4, 79, 160, 0.12);
        }

        @keyframes gpSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (prefers-reduced-motion: reduce) {

            .galeri-photo .gp-hero::before,
            .galeri-photo .gp-orb,
            .galeri-photo .gp-fade-up {
                animation: none !important;
                opacity: 1 !important;
                transform: none !important;
            }

            .galeri-photo .gp-card:hover {
                transform: none;
            }
        }
    </style>
@endpush

<main class="flex-1"
    x-data="{ lbOpen: false, lbSrc: '', lbTitle: '', lbCat: '' }"
    @keydown.escape.window="lbOpen = false">

    {{-- ── Hero ── --}}
    <section class="gp-hero relative overflow-hidden text-white">
        <span class="gp-orb orb-1"></span>
        <span class="gp-orb orb-2"></span>
        <span class="gp-orb orb-3"></span>

        <div class="relative mx-auto max-w-7xl px-4 pb-12 pt-28 sm:px-6 lg:px-8 lg:pb-16 lg:pt-36">
            <x-breadcrumb class="gp-fade-up gp-delay-1 mb-6" :links="[['label' => 'Beranda', 'url' => route('home')], ['label' => 'Galeri Foto']]" />

            <div
                class="gp-fade-up gp-delay-1 inline-flex items-center gap-3 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em]">
                <span class="h-2 w-2 rounded-full bg-[#F7D558]"></span>
                Photo Documentation
            </div>

            <h1 class="gp-fade-up gp-delay-2 mt-4 text-3xl font-extrabold leading-tight sm:text-4xl lg:text-5xl">
                Galeri Foto Kegiatan
            </h1>

            <p class="gp-fade-up gp-delay-3 mt-4 max-w-2xl text-base leading-7 text-blue-100">
                Dokumentasi visual kegiatan, program, dan inisiatif Diskominfo Kota Tangerang Selatan.
            </p>

            <div class="gp-fade-up gp-delay-4 mt-6 flex flex-wrap items-center gap-3 text-sm text-blue-100">
                <span class="flex items-center gap-1.5">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    {{ $fotos->total() }} foto tersedia
                </span>
            </div>
        </div>
    </section>

    {{-- ── Grid Foto ── --}}
    <section class="px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">

            @if ($fotos->isEmpty())

                {{-- ── Empty State ── --}}
                <div class="relative py-8">
                    <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
                        <div class="absolute -top-20 left-1/4 h-72 w-72 rounded-full bg-blue-100 opacity-40 blur-3xl">
                        </div>
                        <div
                            class="absolute -bottom-10 right-1/4 h-64 w-64 rounded-full bg-[#044FA0]/10 opacity-40 blur-3xl">
                        </div>
                    </div>
                    <div
                        class="relative mx-auto max-w-lg rounded-2xl border border-slate-100 bg-white px-8 py-14 text-center gp-card">
                        <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-2xl bg-blue-50">
                            <span class="material-symbols-outlined text-4xl text-[#044FA0]">photo_library</span>
                        </div>
                        <h3 class="text-xl font-extrabold tracking-tight text-slate-900 sm:text-2xl">
                            Belum Ada
                            <span class="bg-gradient-to-r from-[#044FA0] to-blue-500 bg-clip-text text-transparent">
                                Foto
                            </span>
                            Tersedia
                        </h3>
                        <p class="mx-auto mt-3 max-w-sm text-sm leading-7 text-slate-500">
                            Foto-foto kegiatan akan segera ditambahkan. Pantau halaman ini untuk melihat dokumentasi
                            terbaru.
                        </p>
                        <div
                            class="mx-auto mt-8 h-px w-16 rounded-full bg-gradient-to-r from-[#044FA0]/30 to-blue-300/30">
                        </div>
                        <p class="mt-4 text-xs font-medium text-slate-400">Konten akan diperbarui secara resmi oleh
                            admin</p>
                    </div>
                </div>
            @else
                {{-- ── Photo Grid ── --}}
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 sm:gap-5 lg:grid-cols-4 lg:gap-6">
                    @foreach ($fotos as $index => $foto)
                        <article
                            class="gp-card group flex flex-col overflow-hidden rounded-2xl border border-slate-100 bg-white"
                            style="animation: gpSlideUp 0.55s ease both; animation-delay: {{ ($index % 12) * 60 }}ms;">

                            {{-- Gambar --}}
                            <div class="relative overflow-hidden aspect-video">
                                @if ($foto->image_path)
                                    <img src="{{ asset('storage/' . $foto->image_path) }}" alt="{{ $foto->title }}"
                                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        loading="lazy" />
                                @else
                                    <div
                                        class="flex h-full w-full items-center justify-center bg-gradient-to-br from-[#044FA0]/10 to-[#044FA0]/25">
                                        <span
                                            class="material-symbols-outlined text-5xl text-[#044FA0]/30 transition-transform duration-300 group-hover:scale-110">
                                            image
                                        </span>
                                    </div>
                                @endif

                                {{-- Hover Overlay --}}
                                @if ($foto->image_path)
                                    <div class="absolute inset-0 cursor-pointer flex items-center justify-center bg-[#044FA0]/0 transition-colors duration-300 group-hover:bg-[#044FA0]/60"
                                        @click="lbSrc = {{ Js::from(asset('storage/' . $foto->image_path)) }}; lbTitle = {{ Js::from($foto->title) }}; lbCat = {{ Js::from($foto->category ?? '') }}; lbOpen = true">
                                        <span class="material-symbols-outlined text-4xl text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                            open_in_full
                                        </span>
                                    </div>
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center bg-[#044FA0]/0 transition-colors duration-300 group-hover:bg-[#044FA0]/60">
                                        <span class="material-symbols-outlined text-4xl text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                            open_in_full
                                        </span>
                                    </div>
                                @endif

                                {{-- Category Badge --}}
                                @if ($foto->category)
                                    <span
                                        class="absolute bottom-2 left-2 inline-flex items-center rounded-full bg-[#044FA0] px-2.5 py-0.5 text-[10px] font-bold text-white shadow-sm sm:text-[11px]">
                                        {{ $foto->category }}
                                    </span>
                                @endif
                            </div>

                            {{-- Card Body --}}
                            <div class="flex flex-1 flex-col p-3 sm:p-4">
                                <h3
                                    class="line-clamp-2 text-sm font-bold leading-snug text-slate-800 transition-colors duration-200 group-hover:text-[#044FA0] sm:text-sm">
                                    {{ $foto->title }}
                                </h3>
                                @if ($foto->description)
                                    <p class="mt-1.5 line-clamp-2 text-[11px] leading-5 text-slate-500 sm:text-xs">
                                        {{ $foto->description }}
                                    </p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- ── Pagination ── --}}
                <div class="mt-10">
                    {{ $fotos->links('vendor.pagination.galeri-pagination') }}
                </div>

            @endif

            {{-- ── Back Button ── --}}
            <div class="mt-10 flex justify-center">
                <button
                    onclick="document.referrer ? history.back() : window.location.assign('{{ route('home') }}#gallery')"
                    class="inline-flex cursor-pointer items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition-all duration-200 hover:border-[#044FA0]/30 hover:bg-blue-50 hover:text-[#044FA0]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5" />
                        <path d="m12 5-7 7 7 7" />
                    </svg>
                    Kembali ke Halaman Sebelumnya
                </button>
            </div>

        </div>
    </section>

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

</main>

@script
    <script>
        const mq = window.matchMedia('(min-width: 1024px)')
        const desired = mq.matches ? 12 : 8
        if ($wire.perPage !== desired) {
            $wire.setPerPage(desired)
        }
        mq.addEventListener('change', e => $wire.setPerPage(e.matches ? 12 : 8))
    </script>
@endscript
