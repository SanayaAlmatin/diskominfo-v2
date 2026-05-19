@php
    use Illuminate\Support\Facades\Storage;

    $jenisMeta = [
        'pekerjaan' => ['type' => 'vacancy', 'badge' => 'Lowongan Kerja',  'icon_bg' => 'bg-indigo-50', 'icon_color' => 'text-indigo-600', 'badge_class' => 'bg-indigo-100 text-indigo-700', 'accent' => '4F46E5'],
        'magang'    => ['type' => 'program',  'badge' => 'Program Magang',  'icon_bg' => 'bg-sky-50',    'icon_color' => 'text-sky-600',    'badge_class' => 'bg-sky-100 text-sky-700',       'accent' => '0891B2'],
        'program'   => ['type' => 'program',  'badge' => 'Program Khusus', 'icon_bg' => 'bg-sky-50',    'icon_color' => 'text-sky-600',    'badge_class' => 'bg-sky-100 text-sky-700',       'accent' => '0891B2'],
        'kompetisi' => ['type' => 'bounty',   'badge' => 'Kompetisi',      'icon_bg' => 'bg-amber-50',  'icon_color' => 'text-amber-600',  'badge_class' => 'bg-amber-100 text-amber-700',   'accent' => 'D97706'],
    ];
    $defaultMeta = ['type' => 'vacancy', 'badge' => 'Lowongan', 'icon_bg' => 'bg-indigo-50', 'icon_color' => 'text-indigo-600', 'badge_class' => 'bg-indigo-100 text-indigo-700', 'accent' => '4F46E5'];

    $icons = [
        'vacancy' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>',
        'bounty'  => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
        'program' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>',
    ];

    $cards = $lowongan->through(function ($item) use ($jenisMeta, $defaultMeta) {
        $m = $jenisMeta[$item->jenis] ?? $defaultMeta;
        $metaStr = collect([$item->lokasi, $item->tipe_kerja])->filter()->implode(' · ');
        $tags = is_array($item->tags) ? $item->tags : [];
        $daysLeft = $item->tanggal_tutup ? now()->diffInDays($item->tanggal_tutup, false) : null;
        return array_merge($m, [
            'id'        => $item->id,
            'title'     => $item->posisi,
            'desc'      => $item->deskripsi ?? '',
            'tags'      => $tags,
            'meta'      => $metaStr ?: '-',
            'gambar'    => $item->gambar,
            'tutup'     => $item->tanggal_tutup,
            'days_left' => $daysLeft,
            'link'      => $item->link_daftar ?? '#',
        ]);
    });
@endphp

@push('styles')
<style>
    .lowongan-index .li-hero {
        background: linear-gradient(135deg, #0b3c6f 0%, #0d4f94 52%, #1f78b9 100%);
        position: relative;
    }
    .lowongan-index .li-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='220' height='220' viewBox='0 0 220 220' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23FFFFFF' stroke-opacity='0.18' stroke-width='1.2'%3E%3Cpath d='M12 38h68v48h60v70h68'/%3E%3Cpath d='M32 188h48v-58h84V64h36'/%3E%3C/g%3E%3Cg fill='%23F7D558' fill-opacity='0.35'%3E%3Ccircle cx='72' cy='64' r='5'/%3E%3Ccircle cx='148' cy='152' r='5'/%3E%3Ccircle cx='170' cy='42' r='4'/%3E%3C/g%3E%3C/svg%3E");
        background-size: 220px 220px;
        background-position: 0 0;
        opacity: 0.6;
        animation: liPatternDrift 48s linear infinite;
        pointer-events: none;
    }
    .lowongan-index .li-orb {
        position: absolute;
        border-radius: 9999px;
        pointer-events: none;
        opacity: 0.7;
        filter: blur(0.5px);
        animation: liOrbFloat 9s ease-in-out infinite;
    }
    .lowongan-index .li-orb.orb-1 {
        width: 220px; height: 220px;
        right: 4%; top: -80px;
        background: radial-gradient(circle at 30% 30%, rgba(247,213,88,0.55), rgba(247,213,88,0));
        animation-delay: 0.3s;
    }
    .lowongan-index .li-orb.orb-2 {
        width: 160px; height: 160px;
        left: -40px; bottom: -60px;
        background: radial-gradient(circle at 50% 50%, rgba(255,255,255,0.35), rgba(255,255,255,0));
        animation-delay: 1.2s;
    }
    .lowongan-index .li-orb.orb-3 {
        width: 120px; height: 120px;
        right: 24%; bottom: 12%;
        background: radial-gradient(circle at 40% 40%, rgba(255,255,255,0.28), rgba(255,255,255,0));
        animation-delay: 2.1s;
    }
    .lowongan-index .li-fade-up {
        opacity: 0;
        transform: translateY(16px);
        animation: liFadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }
    .lowongan-index .li-delay-1 { animation-delay: 0.08s; }
    .lowongan-index .li-delay-2 { animation-delay: 0.16s; }
    .lowongan-index .li-delay-3 { animation-delay: 0.24s; }
    .lowongan-index .li-delay-4 { animation-delay: 0.34s; }
    @keyframes liFadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes liPatternDrift {
        from { background-position: 0 0; }
        to   { background-position: 240px 160px; }
    }
    @keyframes liOrbFloat {
        0%, 100% { transform: translateY(0); }
        50%       { transform: translateY(-12px); }
    }
    .lowongan-index .li-card {
        box-shadow: 0 4px 20px -2px rgba(79,70,229,0.10), 0 2px 8px -2px rgba(79,70,229,0.06);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .lowongan-index .li-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 36px -4px rgba(79,70,229,0.18), 0 4px 14px -2px rgba(79,70,229,0.10);
    }
    @media (prefers-reduced-motion: reduce) {
        .lowongan-index .li-hero::before,
        .lowongan-index .li-orb,
        .lowongan-index .li-fade-up { animation: none !important; opacity: 1 !important; transform: none !important; }
        .lowongan-index .li-card:hover { transform: none; }
    }
</style>
@endpush

<main class="flex-1">

    {{-- ── Hero ── --}}
    <section class="li-hero relative overflow-hidden text-white">
        <span class="li-orb orb-1"></span>
        <span class="li-orb orb-2"></span>
        <span class="li-orb orb-3"></span>

        <div class="relative mx-auto max-w-7xl px-4 pb-12 pt-28 sm:px-6 lg:px-8 lg:pb-16 lg:pt-36">
            <x-breadcrumb class="li-fade-up li-delay-1 mb-6" :links="[
                ['label' => 'Beranda', 'url' => route('home')],
                ['label' => 'Lowongan & Program'],
            ]" />

            <div class="li-fade-up li-delay-1 inline-flex items-center gap-3 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em]">
                <span class="h-2 w-2 rounded-full bg-[#F7D558]"></span>
                Karir &amp; Program
            </div>

            <h1 class="li-fade-up li-delay-2 mt-4 text-3xl font-extrabold leading-tight sm:text-4xl lg:text-5xl">
                Lowongan &amp; Program
            </h1>

            <p class="li-fade-up li-delay-3 mt-4 max-w-2xl text-base leading-7 text-blue-100">
                Lowongan pekerjaan, program magang, dan kompetisi terbuka dari Diskominfo Kota Tangerang Selatan.
            </p>

            <div class="li-fade-up li-delay-4 mt-6 flex flex-wrap items-center gap-3 text-sm text-blue-100">
                <span class="flex items-center gap-1.5">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    {{ $lowongan->total() }} posisi tersedia
                </span>
            </div>
        </div>
    </section>

    {{-- ── Grid Konten ── --}}
    <section class="px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">

            @if($lowongan->isEmpty())
            {{-- ── Empty state ── --}}
            <div class="relative py-8">
                <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
                    <div class="absolute -top-20 left-1/4 h-72 w-72 rounded-full bg-indigo-100 opacity-40 blur-3xl"></div>
                    <div class="absolute -bottom-10 right-1/4 h-64 w-64 rounded-full bg-violet-100 opacity-30 blur-3xl"></div>
                </div>
                <div class="relative mx-auto max-w-lg rounded-2xl border border-slate-100 bg-white px-8 py-14 text-center li-card">
                    <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="14" rx="2"/>
                            <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
                            <line x1="12" y1="12" x2="12" y2="16"/>
                            <line x1="10" y1="14" x2="14" y2="14"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-extrabold tracking-tight text-slate-900 sm:text-2xl">
                        Belum Ada
                        <span class="bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent">
                            Lowongan
                        </span>
                        Saat Ini
                    </h3>
                    <p class="mx-auto mt-3 max-w-sm text-sm leading-7 text-slate-500">
                        Pantau portal ini secara berkala untuk mendapatkan informasi lowongan kerja, program magang, dan kompetisi terbaru.
                    </p>
                    <div class="mx-auto mt-8 h-px w-16 rounded-full bg-gradient-to-r from-indigo-200 to-violet-200"></div>
                    <p class="mt-4 text-xs font-medium text-slate-400">Informasi akan diperbarui secara resmi oleh admin</p>
                    <a href="{{ route('home') }}" wire:navigate
                        class="mt-6 inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>

            @else
            {{-- ── Card Grid ── --}}
            <div class="grid grid-cols-2 gap-4 sm:gap-5 lg:grid-cols-3 lg:gap-6">
                @foreach($cards as $card)
                <article class="li-card flex flex-col overflow-hidden rounded-2xl border border-slate-100 bg-white">

                    {{-- Gambar / Placeholder --}}
                    <div class="relative overflow-hidden">
                        @if($card['gambar'])
                            <img src="{{ Storage::url($card['gambar']) }}"
                                alt="Banner {{ $card['title'] }}"
                                class="h-28 w-full object-cover sm:h-40 lg:h-48 transition-transform duration-500 hover:scale-105" />
                        @else
                            <img src="https://placehold.co/800x450/{{ $card['accent'] }}/FFFFFF?text={{ rawurlencode($card['title']) }}"
                                alt="Ilustrasi {{ $card['title'] }}"
                                class="h-28 w-full object-cover sm:h-40 lg:h-48" />
                        @endif

                        {{-- Badge jenis --}}
                        <span class="absolute bottom-2 left-2 inline-flex items-center rounded-full px-2 py-0.5 text-[10px] font-bold {{ $card['badge_class'] }} sm:px-2.5 sm:text-[11px]">
                            {{ $card['badge'] }}
                        </span>
                    </div>

                    {{-- Konten Card --}}
                    <div class="flex flex-1 flex-col p-3 sm:p-5">

                        {{-- Ikon + Judul --}}
                        <div class="flex items-start gap-2 sm:gap-3">
                            <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg {{ $card['icon_bg'] }} {{ $card['icon_color'] }} sm:h-10 sm:w-10 sm:rounded-xl">
                                {!! $icons[$card['type']] !!}
                            </div>
                            <h2 class="mt-0.5 text-sm font-extrabold leading-snug text-slate-900 line-clamp-2 sm:text-base">
                                {{ $card['title'] }}
                            </h2>
                        </div>

                        {{-- Deskripsi --}}
                        @if($card['desc'])
                        <p class="mt-2 text-[11px] leading-5 text-slate-500 line-clamp-2 sm:mt-3 sm:text-xs sm:leading-6">
                            {{ strip_tags($card['desc']) }}
                        </p>
                        @endif

                        {{-- Tags --}}
                        @if(count($card['tags']) > 0)
                        <div class="mt-2 flex flex-wrap gap-1 sm:mt-3 sm:gap-1.5">
                            @foreach(array_slice($card['tags'], 0, 3) as $tag)
                                <span class="rounded-md bg-indigo-50 px-1.5 py-0.5 text-[10px] font-semibold text-indigo-700 sm:px-2 sm:py-1 sm:text-[11px]">
                                    {{ $tag }}
                                </span>
                            @endforeach
                            @if(count($card['tags']) > 3)
                                <span class="rounded-md bg-slate-100 px-1.5 py-0.5 text-[10px] font-semibold text-slate-500 sm:px-2 sm:py-1 sm:text-[11px]">
                                    +{{ count($card['tags']) - 3 }}
                                </span>
                            @endif
                        </div>
                        @endif

                        {{-- Lokasi + Tipe --}}
                        <div class="mt-2 flex items-center gap-1.5 text-[10px] font-medium text-slate-400 sm:mt-3 sm:text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 flex-shrink-0 sm:h-3.5 sm:w-3.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/>
                            </svg>
                            <span class="truncate">{{ $card['meta'] }}</span>
                        </div>

                        {{-- Tanggal Tutup --}}
                        @if($card['tutup'])
                        <div class="mt-1.5 flex items-center gap-1.5 text-[10px] font-semibold sm:mt-2 sm:text-xs
                            @if($card['days_left'] !== null && $card['days_left'] <= 7) text-red-500
                            @elseif($card['days_left'] !== null && $card['days_left'] <= 14) text-amber-500
                            @else text-slate-400 @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 flex-shrink-0 sm:h-3.5 sm:w-3.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            <span>Tutup {{ $card['tutup']->translatedFormat('d M Y') }}</span>
                        </div>
                        @endif

                        {{-- CTA --}}
                        <div class="mt-auto pt-3 sm:pt-4">
                            <a href="{{ route('karir.show', $card['id']) }}" wire:navigate
                                class="inline-flex w-full items-center justify-center gap-1.5 rounded-lg bg-blue-700 px-3 py-2 text-[11px] font-bold text-white shadow-sm transition-colors duration-200 hover:bg-blue-800 sm:rounded-xl sm:px-4 sm:text-sm focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
                                Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            {{-- ── Pagination ── --}}
            <div class="mt-10">
                {{ $lowongan->links('vendor.pagination.lowongan-pagination') }}
            </div>
            @endif

            {{-- Back link --}}
            <div class="mt-10 flex justify-center">
                <a href="{{ route('home') }}#lowongan-carousel" wire:navigate
                    class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition-all duration-200 hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5"/><path d="m12 5-7 7 7 7"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </section>

</main>

@script
<script>
    const mq = window.matchMedia('(min-width: 1024px)')
    const desired = mq.matches ? 6 : 4
    if ($wire.perPage !== desired) {
        $wire.setPerPage(desired)
    }
    mq.addEventListener('change', e => $wire.setPerPage(e.matches ? 6 : 4))
</script>
@endscript
