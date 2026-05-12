<footer class="bg-[#044FA0] text-white">
    <div class="border-t-2 border-[#F7D558]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">

            {{-- ─── Col 1: Identity ─── --}}
            <div class="lg:col-span-1">
                <h3 class="text-xl font-extrabold text-[#F7D558] mb-3 leading-tight">
                    Kominfo Tangsel
                </h3>
                <p class="text-sm text-white/65 leading-relaxed mb-6">
                    Dinas Komunikasi dan Informatika Kota Tangerang Selatan — mendorong transformasi digital demi
                    layanan publik yang cerdas, terbuka, dan terpercaya.
                </p>

                {{-- Social Media Icons --}}
                <div class="flex items-center gap-3">
                    {{-- Instagram --}}
                    <a href="#" aria-label="Instagram Diskominfo Tangsel"
                        class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                            <circle cx="12" cy="12" r="4" />
                            <circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" />
                        </svg>
                    </a>

                    {{-- Twitter / X --}}
                    <a href="#" aria-label="Twitter Diskominfo Tangsel"
                        class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                    </a>

                    {{-- YouTube --}}
                    <a href="#" aria-label="YouTube Diskominfo Tangsel"
                        class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- ─── Col 2: Contact Us ─── --}}
            <div>
                <h4 class="text-sm font-extrabold uppercase tracking-widest text-white mb-5">
                    Contact Us
                </h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-[#F7D558] text-xl flex-shrink-0 mt-0.5"
                            style="font-variation-settings: 'FILL' 1;">
                            location_on
                        </span>
                        <span class="text-sm text-white/70 leading-relaxed">
                            Jl. Maruga No. 1, Serua, Ciputat,<br>
                            Kota Tangerang Selatan,<br>
                            Banten 15414
                        </span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-[#F7D558] text-xl flex-shrink-0"
                            style="font-variation-settings: 'FILL' 1;">
                            phone
                        </span>
                        <a href="tel:+62215388833"
                            class="text-sm text-white/70 hover:text-[#F7D558] transition-colors duration-200">
                            (021) 538 8833
                        </a>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-[#F7D558] text-xl flex-shrink-0"
                            style="font-variation-settings: 'FILL' 1;">
                            mail
                        </span>
                        <a href="mailto:diskominfo@tangselkota.go.id"
                            class="text-sm text-white/70 hover:text-[#F7D558] transition-colors duration-200 break-all">
                            diskominfo@tangselkota.go.id
                        </a>
                    </li>
                </ul>
            </div>

            {{-- ─── Col 3: Related Portals ─── --}}
            <div>
                <h4 class="text-sm font-extrabold uppercase tracking-widest text-white mb-5">
                    Related Portals
                </h4>
                <ul class="space-y-3">
                    @php
                        $portals = [
                            ['label' => 'Dinkes Tangsel', 'url' => '#'],
                            ['label' => 'Dispora Tangsel', 'url' => '#'],
                            ['label' => 'DPMPTSP Tangsel', 'url' => '#'],
                            ['label' => 'Dinas Pendidikan', 'url' => '#'],
                            ['label' => 'BPBD Tangsel', 'url' => '#'],
                            ['label' => 'Pemerintah Kota', 'url' => '#'],
                        ];
                    @endphp
                    @foreach ($portals as $portal)
                        <li>
                            <a href="{{ $portal['url'] }}"
                                class="flex items-center gap-2 text-sm text-white/65 hover:text-[#F7D558] transition-colors duration-200 group">
                                <span
                                    class="material-symbols-outlined text-sm text-white/30 group-hover:text-[#F7D558] transition-colors duration-200">
                                    chevron_right
                                </span>
                                {{ $portal['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- ─── Col 4: Location Map ─── --}}
            <div>
                <h4 class="text-sm font-extrabold uppercase tracking-widest text-white mb-5">
                    Our Location
                </h4>

                {{-- Map Placeholder (replace src with real Google Maps embed) --}}
                <div
                    class="rounded-xl overflow-hidden aspect-video bg-[#033a7a] border border-white/10 relative flex items-center justify-center mb-4">
                    {{--
                        To embed a real map, replace this block with:
                        <iframe
                            src="https://www.google.com/maps/embed?pb=..."
                            class="absolute inset-0 w-full h-full grayscale"
                            style="border:0;"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    --}}
                    <div class="text-center">
                        <span class="material-symbols-outlined text-5xl text-[#F7D558]/40 block"
                            style="font-variation-settings: 'FILL' 1;">
                            map
                        </span>
                        <p class="text-xs text-white/40 mt-2">Map embed</p>
                    </div>
                    <span
                        class="absolute bottom-3 left-3 bg-[#F7D558] text-[#044FA0] text-xs font-bold px-2 py-1 rounded-full">
                        Ciputat, Tangsel
                    </span>
                </div>

                {{-- Bottom utility links --}}
                <div class="flex flex-wrap items-center gap-x-4 gap-y-1">
                    <a href="#"
                        class="text-xs text-slate-400 hover:text-[#F7D558] transition-colors duration-200">
                        Privacy Policy
                    </a>
                    <span class="text-white/20 text-xs">•</span>
                    <a href="#"
                        class="text-xs text-slate-400 hover:text-[#F7D558] transition-colors duration-200">
                        Terms of Use
                    </a>
                    <span class="text-white/20 text-xs">•</span>
                    <a href="#"
                        class="text-xs text-slate-400 hover:text-[#F7D558] transition-colors duration-200">
                        Sitemap
                    </a>
                </div>
            </div>

        </div>
    </div>
    <div class="border-t border-white/10">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-center gap-2">
            <p class="text-xs text-white/50 text-center sm:text-left">
                &copy; {{ date('Y') }} South Tangerang City Government — Dinas Komunikasi dan Informatika. All
                rights reserved.
            </p>
        </div>
    </div>

</footer>
