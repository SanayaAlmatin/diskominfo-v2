<main class="flex-1">
    <section class="bg-[#044FA0] text-white">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-10 sm:px-6 lg:grid-cols-[1fr_340px] lg:px-8 lg:py-12">
            <div>
                <nav aria-label="Breadcrumb" class="mb-6 flex flex-wrap items-center gap-2 text-xs font-semibold uppercase tracking-[0.14em] text-blue-100">
                    <a href="{{ route('home') }}" wire:navigate class="transition hover:text-[#F7D558]">Beranda</a>
                    <span class="text-white/40">/</span>
                    <span>Profil</span>
                    <span class="text-white/40">/</span>
                    <span class="text-[#F7D558]">Visi & Misi</span>
                </nav>

                <p class="mb-3 text-sm font-bold uppercase tracking-[0.18em] text-[#F7D558]">Profil Pemerintah Kota</p>
                <h1 class="max-w-4xl text-3xl font-extrabold leading-tight tracking-normal text-white sm:text-4xl lg:text-5xl">
                    Visi & Misi Kota Tangerang Selatan
                </h1>
                <p class="mt-5 max-w-3xl text-sm leading-7 text-blue-50 sm:text-base">
                    Arah pembangunan daerah yang menjadi landasan kerja pelayanan publik, tata kelola kota, dan penguatan ekonomi masyarakat.
                </p>
            </div>

            <aside class="rounded-lg border border-white/20 bg-white/10 p-5">
                <div class="flex items-center gap-4">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-lg bg-white p-2">
                        <img src="{{ asset('Images/logo-kominfo.png') }}" alt="Logo Diskominfo Tangerang Selatan" class="h-full w-auto object-contain">
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#F7D558]">Diskominfo</p>
                        <p class="mt-1 text-sm font-semibold leading-6 text-white">Kota Tangerang Selatan</p>
                    </div>
                </div>
                <div class="mt-5 border-t border-white/20 pt-5">
                    <p class="text-sm leading-7 text-blue-50">
                        Mendukung ekosistem informasi, konektivitas, dan layanan digital kota yang efektif.
                    </p>
                </div>
            </aside>
        </div>
    </section>

    <section class="px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-6 lg:grid-cols-[0.92fr_1.08fr]">
            <article class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <div class="mb-6 flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#044FA0] text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </span>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#044FA0]">Visi</p>
                        <h2 class="text-xl font-extrabold tracking-normal text-slate-950">Arah Utama Pembangunan</h2>
                    </div>
                </div>

                <blockquote class="border-l-4 border-[#F7D558] bg-[#F8FBFF] px-5 py-6 text-xl font-extrabold leading-9 text-slate-950 sm:text-2xl sm:leading-10">
                    &ldquo;{{ $vision }}&rdquo;
                </blockquote>
            </article>

            <article class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <div class="mb-6 flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#044FA0]">Misi</p>
                        <h2 class="mt-2 text-xl font-extrabold tracking-normal text-slate-950">Langkah Strategis</h2>
                    </div>
                    <span class="inline-flex w-fit items-center rounded-md bg-[#FFF7D8] px-3 py-1 text-xs font-bold uppercase tracking-wide text-[#044FA0]">
                        5 Misi
                    </span>
                </div>

                <ol class="space-y-3">
                    @foreach ($missions as $mission)
                        <li class="flex gap-4 rounded-lg border border-slate-200 bg-[#F8FBFF] p-4">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#044FA0] text-sm font-extrabold text-white">
                                {{ $loop->iteration }}
                            </span>
                            <p class="pt-1 text-sm font-semibold leading-7 text-slate-700 sm:text-base">
                                {{ $mission }}
                            </p>
                        </li>
                    @endforeach
                </ol>
            </article>
        </div>
    </section>
</main>
