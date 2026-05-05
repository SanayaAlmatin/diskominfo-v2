<main class="flex-1 bg-[#f8fafc] font-sans pb-12">
    <!-- Hero / Header Section -->
    <div class="relative bg-[#0b1b36] pt-16 pb-48 overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-br from-[#081326] via-[#0b1b36] to-[#042854] opacity-95"></div>
            <!-- Decorative blur blobs -->
            <div class="absolute top-0 right-0 -mr-32 -mt-32 h-[30rem] w-[30rem] rounded-full bg-blue-500/10 blur-[80px]"></div>
            <div class="absolute bottom-0 left-0 -ml-32 -mb-32 h-[20rem] w-[20rem] rounded-full bg-cyan-500/10 blur-[60px]"></div>
            <!-- Subtle dot pattern -->
            <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-[size:32px_32px] opacity-30"></div>
        </div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <nav aria-label="Breadcrumb" class="flex items-center gap-3 text-sm text-slate-400 font-medium">
                <a href="{{ route('home') }}" wire:navigate class="hover:text-blue-400 transition-colors">Beranda</a>
                <svg class="h-3 w-3 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="hover:text-white transition-colors cursor-default">Profil Kota</span>
                <svg class="h-3 w-3 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white">Visi & Misi</span>
            </nav>

            <h1 class="mt-8 text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl max-w-3xl drop-shadow-sm">
                Visi dan Misi Kota Tangerang Selatan
            </h1>
        </div>
    </div>

    <!-- Main Content Overlapping Card -->
    <div class="relative z-10 mx-auto -mt-32 max-w-7xl px-4 pb-24 sm:px-6 lg:px-8">
        <div class="rounded-[2rem] bg-white p-6 shadow-2xl shadow-slate-200/50 sm:p-12 lg:p-16 ring-1 ring-slate-900/5">
            
            <!-- Visi Section -->
            <div class="grid items-center gap-12 lg:grid-cols-5 lg:gap-12">
                <!-- Left side title -->
                <div class="lg:col-span-2 relative">
                    <div class="absolute -inset-x-4 -inset-y-4 z-0 bg-gradient-to-br from-blue-50 to-transparent opacity-50 blur-2xl rounded-full"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-4 text-xs font-bold uppercase tracking-widest text-blue-600">
                            <span class="h-[2px] w-8 bg-blue-600 rounded-full"></span> PEMERINTAH KOTA
                        </div>
                        <h2 class="mt-6 text-7xl font-black tracking-tighter text-[#1e293b]">
                            <span class="bg-gradient-to-br from-slate-800 to-slate-600 bg-clip-text text-transparent">Visi</span><br>
                            <span class="text-slate-300 font-light">&amp;</span> 
                            <span class="bg-gradient-to-br from-[#0051A2] to-blue-500 bg-clip-text text-transparent">Misi</span>
                        </h2>
                        <p class="mt-6 text-lg tracking-tight text-slate-500 leading-relaxed border-l-4 border-blue-100 pl-4">
                            Arah pembangunan dan cita-cita luhur<br>Kota Tangerang Selatan.
                        </p>
                    </div>
                </div>

                <!-- Right side vision card -->
                <div class="lg:col-span-3">
                    <div class="group relative rounded-3xl border border-slate-100 bg-white p-8 shadow-xl shadow-slate-200/40 sm:p-12 transition-all hover:shadow-2xl hover:shadow-blue-900/5 hover:-translate-y-1 overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                        <p class="relative z-10 text-2xl sm:text-[1.7rem] font-bold leading-relaxed tracking-tight text-slate-800">
                            <span class="text-[#0051A2] relative inline-block">
                                {{ explode('Menuju', $vision)[0] ?? 'Terwujudnya Tangsel Unggul,' }}
                                <span class="absolute bottom-1 left-0 w-full h-3 bg-blue-100/60 -z-10 rounded-sm"></span>
                            </span>
                            @if(str_contains($vision, 'Menuju'))
                                Menuju {{ explode('Menuju', $vision)[1] }}
                            @else
                                {{ $vision }}
                            @endif
                        </p>
                        <div class="mt-10 flex items-center gap-3 text-xs font-bold uppercase tracking-widest text-[#0051A2] relative z-10">
                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-blue-50">
                                <span class="h-2 w-2 rounded-full bg-[#0051A2] animate-pulse"></span>
                            </span> 
                            VISI UTAMA
                        </div>
                    </div>
                </div>
            </div>

            <!-- Misi Section -->
            <div class="mt-24 lg:mt-32">
                <div class="flex items-end justify-between border-b border-slate-100 pb-6 mb-12">
                    <h3 class="text-3xl font-extrabold tracking-tight text-slate-800 flex items-center gap-3">
                        <span class="bg-blue-600 w-2 h-8 rounded-full"></span> Misi
                    </h3>
                    <span class="flex items-center gap-2 rounded-full bg-slate-50 px-4 py-1.5 text-sm font-bold tracking-widest text-slate-400 font-mono ring-1 ring-inset ring-slate-200">
                        01 <span class="text-slate-300">&mdash;</span> {{ sprintf('%02d', count($missions)) }}
                    </span>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($missions as $mission)
                        <div class="group relative overflow-hidden rounded-[2rem] border border-slate-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-xl hover:shadow-blue-900/5 hover:-translate-y-1 hover:border-blue-100">
                            <!-- Background Number -->
                            <div class="absolute -right-6 -top-8 select-none text-[9rem] font-black leading-none text-slate-50 transition-all duration-500 group-hover:text-blue-50 group-hover:-translate-y-2 group-hover:translate-x-2 group-hover:rotate-6">
                                {{ sprintf('%02d', $loop->iteration) }}
                            </div>
                            
                            <div class="relative z-10 flex flex-col h-full">
                                <div class="mb-8 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-50 to-slate-50 text-[#0051A2] ring-1 ring-slate-100 transition-all duration-300 group-hover:scale-110 group-hover:shadow-md group-hover:from-blue-500 group-hover:to-[#0051A2] group-hover:text-white">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <p class="text-[1.05rem] font-bold leading-relaxed tracking-tight text-slate-700 group-hover:text-slate-900 transition-colors">
                                    {{ $mission }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>