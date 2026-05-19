@php
    use Illuminate\Support\Facades\Storage;

    $jenisMeta = [
        'pekerjaan' => ['label' => 'Lowongan Kerja', 'badge' => 'bg-indigo-100 text-indigo-700'],
        'magang'    => ['label' => 'Program Magang',  'badge' => 'bg-sky-100 text-sky-700'],
        'program'   => ['label' => 'Program Khusus',  'badge' => 'bg-sky-100 text-sky-700'],
        'kompetisi' => ['label' => 'Kompetisi',        'badge' => 'bg-amber-100 text-amber-700'],
    ];
    $meta = $jenisMeta[$lowongan->jenis] ?? $jenisMeta['pekerjaan'];
    $tags = is_array($lowongan->tags) ? $lowongan->tags : [];
@endphp

@push('styles')
<style>
    .lowongan-detail .ld-hero {
        background: linear-gradient(135deg, #0b3c6f 0%, #0d4f94 52%, #1f78b9 100%);
        position: relative;
    }
    .lowongan-detail .ld-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='220' height='220' viewBox='0 0 220 220' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23FFFFFF' stroke-opacity='0.18' stroke-width='1.2'%3E%3Cpath d='M12 38h68v48h60v70h68'/%3E%3Cpath d='M32 188h48v-58h84V64h36'/%3E%3C/g%3E%3Cg fill='%23F7D558' fill-opacity='0.35'%3E%3Ccircle cx='72' cy='64' r='5'/%3E%3Ccircle cx='148' cy='152' r='5'/%3E%3Ccircle cx='170' cy='42' r='4'/%3E%3C/g%3E%3C/svg%3E");
        background-size: 220px 220px;
        background-position: 0 0;
        opacity: 0.6;
        animation: ldPatternDrift 48s linear infinite;
        pointer-events: none;
    }
    .lowongan-detail .ld-orb {
        position: absolute;
        border-radius: 9999px;
        pointer-events: none;
        opacity: 0.7;
        filter: blur(0.5px);
        animation: ldOrbFloat 9s ease-in-out infinite;
    }
    .lowongan-detail .ld-orb.orb-1 {
        width: 220px; height: 220px;
        right: 4%; top: -80px;
        background: radial-gradient(circle at 30% 30%, rgba(247,213,88,0.55), rgba(247,213,88,0));
        animation-delay: 0.3s;
    }
    .lowongan-detail .ld-orb.orb-2 {
        width: 160px; height: 160px;
        left: -40px; bottom: -60px;
        background: radial-gradient(circle at 50% 50%, rgba(255,255,255,0.35), rgba(255,255,255,0));
        animation-delay: 1.2s;
    }
    .lowongan-detail .ld-orb.orb-3 {
        width: 120px; height: 120px;
        right: 24%; bottom: 12%;
        background: radial-gradient(circle at 40% 40%, rgba(255,255,255,0.28), rgba(255,255,255,0));
        animation-delay: 2.1s;
    }
    .lowongan-detail .ld-fade-up {
        opacity: 0;
        transform: translateY(16px);
        animation: ldFadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }
    .lowongan-detail .ld-delay-1 { animation-delay: 0.08s; }
    .lowongan-detail .ld-delay-2 { animation-delay: 0.16s; }
    .lowongan-detail .ld-delay-3 { animation-delay: 0.24s; }
    .lowongan-detail .ld-delay-4 { animation-delay: 0.34s; }
    @keyframes ldFadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes ldPatternDrift {
        from { background-position: 0 0; }
        to   { background-position: 240px 160px; }
    }
    @keyframes ldOrbFloat {
        0%, 100% { transform: translateY(0); }
        50%       { transform: translateY(-12px); }
    }
    .lowongan-detail .prose h2,
    .lowongan-detail .prose h3 {
        font-weight: 700;
        color: #0f172a;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
    }
    .lowongan-detail .prose p  { margin-bottom: 0.75rem; line-height: 1.75; color: #475569; }
    .lowongan-detail .prose ul { list-style: disc; padding-left: 1.25rem; color: #475569; }
    .lowongan-detail .prose ol { list-style: decimal; padding-left: 1.25rem; color: #475569; }
    .lowongan-detail .prose li { margin-bottom: 0.25rem; }
    @media (prefers-reduced-motion: reduce) {
        .lowongan-detail .ld-hero::before,
        .lowongan-detail .ld-orb,
        .lowongan-detail .ld-fade-up { animation: none !important; opacity: 1 !important; transform: none !important; }
    }
</style>
@endpush

<main class="flex-1">

    {{-- ── Hero ── --}}
    <section class="ld-hero relative overflow-hidden text-white">
        <span class="ld-orb orb-1"></span>
        <span class="ld-orb orb-2"></span>
        <span class="ld-orb orb-3"></span>

        <div class="relative mx-auto max-w-7xl px-4 pb-12 pt-28 sm:px-6 lg:px-8 lg:pb-16 lg:pt-36">
            <x-breadcrumb class="ld-fade-up ld-delay-1 mb-6" :links="[
                ['label' => 'Beranda', 'url' => route('home')],
                ['label' => $meta['label']],
            ]" />

            <div class="ld-fade-up ld-delay-1 inline-flex items-center gap-3 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em]">
                <span class="h-2 w-2 rounded-full bg-[#F7D558]"></span>
                Karir &amp; Program
            </div>

            <h1 class="ld-fade-up ld-delay-2 mt-4 text-3xl font-extrabold leading-tight sm:text-4xl lg:text-5xl">
                {{ $lowongan->posisi }}
            </h1>

            {{-- Quick meta strip --}}
            <div class="ld-fade-up ld-delay-3 mt-5 flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-blue-100">
                @if($lowongan->lokasi)
                <span class="flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/>
                    </svg>
                    {{ $lowongan->lokasi }}
                </span>
                @endif
                @if($lowongan->tipe_kerja)
                <span class="flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
                    </svg>
                    {{ $lowongan->tipe_kerja }}
                </span>
                @endif
                @if($lowongan->tanggal_tutup)
                <span class="flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    Tutup {{ $lowongan->tanggal_tutup->translatedFormat('d F Y') }}
                </span>
                @endif
            </div>
        </div>
    </section>

    {{-- ── Main content ── --}}
    <section class="bg-[#F5F8FC] px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="grid gap-8 lg:grid-cols-3">

                {{-- ── Left: banner, tags, deskripsi ── --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Banner image --}}
                    @if($lowongan->gambar)
                    <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white"
                        style="box-shadow: 0 4px 20px -2px rgba(79,70,229,0.10), 0 2px 8px -2px rgba(79,70,229,0.06);">
                        <img src="{{ Storage::url($lowongan->gambar) }}"
                            alt="Banner {{ $lowongan->posisi }}"
                            class="h-56 w-full object-cover sm:h-72 lg:h-80 transition-transform duration-500 hover:scale-105" />
                    </div>
                    @endif

                    {{-- Tags --}}
                    @if(count($tags) > 0)
                    <div class="rounded-2xl border border-slate-200 bg-white p-6"
                        style="box-shadow: 0 4px 20px -2px rgba(79,70,229,0.07);">
                        <p class="mb-3 text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Keahlian / Bidang</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($tags as $tag)
                                <span class="rounded-lg bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Deskripsi --}}
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8"
                        style="box-shadow: 0 4px 20px -2px rgba(79,70,229,0.07);">
                        <p class="mb-4 text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Deskripsi Lowongan</p>
                        @if($lowongan->deskripsi)
                            <div class="prose max-w-none text-sm leading-7 text-slate-600">
                                {!! $lowongan->deskripsi !!}
                            </div>
                        @else
                            <p class="text-sm text-slate-400 italic">Deskripsi belum tersedia.</p>
                        @endif
                    </div>
                </div>

                {{-- ── Sidebar: CTA & info ── --}}
                <div class="space-y-4">

                    {{-- CTA card --}}
                    <div class="rounded-2xl border border-indigo-100 bg-white p-6"
                        style="box-shadow: 0 4px 20px -2px rgba(79,70,229,0.1), 0 2px 8px -2px rgba(124,58,237,0.06);">

                        <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                            <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Sedang Dibuka
                        </div>

                        @if($lowongan->tanggal_tutup)
                        <div class="mb-5 rounded-xl bg-slate-50 px-4 py-3">
                            <p class="text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Batas Pendaftaran</p>
                            <p class="mt-1 text-sm font-bold text-slate-800">
                                {{ $lowongan->tanggal_tutup->translatedFormat('d F Y') }}
                            </p>
                        </div>
                        @endif

                        @if($lowongan->link_daftar)
                        <a href="{{ $lowongan->link_daftar }}" target="_blank" rel="noopener noreferrer"
                            class="flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-6 py-3.5 text-sm font-bold text-white shadow-md transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-indigo-200 focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                            Daftar Sekarang
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                <polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>
                            </svg>
                        </a>
                        @else
                        <p class="text-center text-xs text-slate-400 italic">Link pendaftaran belum tersedia.</p>
                        @endif
                    </div>

                    {{-- Info detail --}}
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 space-y-4"
                        style="box-shadow: 0 4px 20px -2px rgba(79,70,229,0.07);">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Informasi Posisi</p>

                        @if($lowongan->lokasi)
                        <div class="flex items-start gap-3">
                            <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Lokasi</p>
                                <p class="text-sm font-semibold text-slate-800">{{ $lowongan->lokasi }}</p>
                            </div>
                        </div>
                        @endif

                        @if($lowongan->tipe_kerja)
                        <div class="flex items-start gap-3">
                            <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Tipe Kerja</p>
                                <p class="text-sm font-semibold text-slate-800">{{ $lowongan->tipe_kerja }}</p>
                            </div>
                        </div>
                        @endif

                        <div class="flex items-start gap-3">
                            <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 7H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/><path d="M16 3H8a2 2 0 0 0-2 2v2h12V5a2 2 0 0 0-2-2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Kategori</p>
                                <p class="text-sm font-semibold text-slate-800">{{ $meta['label'] }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Back button --}}
                    <button onclick="history.back()"
                        class="flex w-full cursor-pointer items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 shadow-sm transition-all duration-200 hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 12H5"/><path d="m12 5-7 7 7 7"/>
                        </svg>
                        Kembali
                    </button>
                </div>

            </div>
        </div>
    </section>

</main>
