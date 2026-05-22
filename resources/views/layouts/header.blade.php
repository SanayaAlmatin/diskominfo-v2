<header data-site-header x-data="{ scrolled: false, mobileMenuOpen: false }" @scroll.window="scrolled = (window.pageYOffset > 200)"
    @resize.window="if (window.innerWidth >= 1024) mobileMenuOpen = false"
    class="fixed top-0 left-0 w-full text-white z-[999]">

    {{-- Glass panel: visible at top of page, fades out when solid blue fades in --}}
    <div :class="scrolled ? 'opacity-0' : 'opacity-100'"
        class="absolute inset-0 bg-white/15 backdrop-blur-xl border-b border-white/10 transition-opacity duration-500 ease-in-out -z-10 pointer-events-none">
    </div>

    {{-- Solid-blue background panel: fades in on scroll (no translate to avoid compositing overflow above top-0) --}}
    <div :class="scrolled ? 'opacity-100' : 'opacity-0'"
        class="absolute inset-0 bg-[#044FA0] shadow-xl transition-opacity duration-500 ease-in-out -z-10"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

        <!-- Logo -->
        <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-3">
            <img src="{{ asset('Images/logo-kominfo.png') }}" alt="Logo Diskominfo Tangsel"
                class="h-18 w-auto object-contain">
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex items-center h-full">
            <ul class="flex items-center h-full space-x-1">

                <!-- Profil -->
                <li class="relative group h-full flex items-center">
                    <a href="{{ route('profil.visi-misi') }}" wire:navigate
                        class="px-3 py-2 text-sm font-semibold hover:text-white flex items-center gap-1 transition-colors h-full border-b-2 hover:border-kominfo-yellow {{ request()->routeIs('profil.*') ? 'border-kominfo-yellow text-white' : 'border-transparent' }}">
                        Profil
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 opacity-70 group-hover:rotate-180 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <ul
                        class="absolute top-full left-0 bg-white text-gray-800 shadow-xl rounded-b-lg w-48 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top -translate-y-2 group-hover:translate-y-0">
                        <li><a href="{{ route('profil.sekilas-diskominfo') }}" wire:navigate
                                class="block px-4 py-3 text-sm hover:bg-blue-50 hover:text-kominfo-blue transition-colors {{ request()->routeIs('profil.sekilas-diskominfo') ? 'bg-blue-50 font-semibold text-kominfo-blue' : '' }}">Sekilas
                                Diskominfo</a></li>
                        <li><a href="{{ route('profil.visi-misi') }}" wire:navigate
                                class="block px-4 py-3 text-sm hover:bg-blue-50 hover:text-kominfo-blue transition-colors {{ request()->routeIs('profil.visi-misi') ? 'bg-blue-50 font-semibold text-kominfo-blue' : '' }}">Visi
                                & Misi</a></li>
                        <li><a href="{{ route('profil.struktur-organisasi') }}" wire:navigate
                                class="block px-4 py-3 text-sm hover:bg-blue-50 hover:text-kominfo-blue transition-colors {{ request()->routeIs('profil.struktur-organisasi') ? 'bg-blue-50 font-semibold text-kominfo-blue' : '' }}">Struktur
                                Organisasi</a></li>
                    </ul>
                </li>

                <!-- Dot Divider -->
                <li class="text-white/30 text-xs px-1">•</li>

                <!-- Unit Kerja -->
                <li class="relative group h-full flex items-center">
                    <a href="#"
                        class="px-3 py-2 text-sm font-semibold hover:text-white flex items-center gap-1 transition-colors h-full border-b-2 border-transparent hover:border-kominfo-yellow">
                        Unit Kerja
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 opacity-70 group-hover:rotate-180 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <ul
                        class="absolute top-full left-0 bg-white text-gray-800 shadow-xl rounded-b-lg w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top -translate-y-2 group-hover:translate-y-0">
                        <li><a href="{{ route('unit-kerja.infrastruktur-tik') }}" wire:navigate
                                class="block px-4 py-3 text-sm hover:bg-blue-50 hover:text-kominfo-blue transition-colors {{ request()->routeIs('unit-kerja.infrastruktur-tik') ? 'bg-blue-50 font-semibold text-kominfo-blue' : '' }}">Bidang
                                Pengelolaan Infrastruktur TIK</a></li>
                        <li><a href="{{ route('unit-kerja.statistik-layanan-informasi') }}" wire:navigate
                                class="block px-4 py-3 text-sm hover:bg-blue-50 hover:text-kominfo-blue transition-colors {{ request()->routeIs('unit-kerja.statistik-layanan-informasi') ? 'bg-blue-50 font-semibold text-kominfo-blue' : '' }}">Bidang
                                Statistik &amp; Layanan Informasi</a></li>
                        <li><a href="#"
                                class="block px-4 py-3 text-sm hover:bg-blue-50 hover:text-kominfo-blue transition-colors">Bidang
                                Persandian</a></li>
                    </ul>
                </li>

                <!-- Dot Divider -->
                <li class="text-white/30 text-xs px-1">•</li>

                <!-- Regulasi -->
                <li class="h-full flex items-center">
                    <a href="#"
                        class="px-3 py-2 text-sm font-semibold hover:text-white transition-colors h-full flex items-center border-b-2 border-transparent hover:border-kominfo-yellow">
                        Regulasi
                    </a>
                </li>

                <!-- Dot Divider -->
                <li class="text-white/30 text-xs px-1">•</li>

                <!-- Gallery -->
                <li class="relative group h-full flex items-center">
                    <a href="#"
                        class="px-3 py-2 text-sm font-semibold hover:text-white flex items-center gap-1 transition-colors h-full border-b-2 border-transparent hover:border-kominfo-yellow">
                        Gallery
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 opacity-70 group-hover:rotate-180 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <ul
                        class="absolute top-full left-0 bg-white text-gray-800 shadow-xl rounded-b-lg w-48 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top -translate-y-2 group-hover:translate-y-0">
                        <li><a href="{{ route('galeri.foto') }}"
                                class="block px-4 py-3 text-sm hover:bg-blue-50 hover:text-kominfo-blue transition-colors">Foto</a>
                        </li>
                        <li><a href="#"
                                class="block px-4 py-3 text-sm hover:bg-blue-50 hover:text-kominfo-blue transition-colors">Video</a>
                        </li>
                    </ul>
                </li>

                <!-- Dot Divider -->
                <li class="text-white/30 text-xs px-1">•</li>

                <!-- Arsip -->
                <li class="relative group h-full flex items-center">
                    <a href="#"
                        class="px-3 py-2 text-sm font-semibold hover:text-white flex items-center gap-1 transition-colors h-full border-b-2 border-transparent hover:border-kominfo-yellow">
                        Arsip
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 opacity-70 group-hover:rotate-180 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <ul
                        class="absolute top-full left-0 bg-white text-gray-800 shadow-xl rounded-b-lg w-48 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top -translate-y-2 group-hover:translate-y-0">
                        <li><a href="#"
                                class="block px-4 py-3 text-sm hover:bg-blue-50 hover:text-kominfo-blue transition-colors">Dokumen
                                Publik</a></li>
                        <li><a href="#"
                                class="block px-4 py-3 text-sm hover:bg-blue-50 hover:text-kominfo-blue transition-colors">Laporan
                                Berkal</a></li>
                    </ul>
                </li>

                <!-- Dot Divider -->
                <li class="text-white/30 text-xs px-1">•</li>

                <!-- Layanan Publik -->
                <li class="relative group h-full flex items-center">
                    <a href="#"
                        class="px-3 py-2 text-sm font-bold text-kominfo-yellow hover:text-yellow-300 flex items-center gap-1 transition-colors h-full border-b-2 border-transparent hover:border-kominfo-yellow">
                        Layanan Publik
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 opacity-70 group-hover:rotate-180 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <ul
                        class="absolute top-full right-0 bg-white text-gray-800 shadow-xl rounded-b-lg w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top -translate-y-2 group-hover:translate-y-0">
                        <li><a href="#"
                                class="block px-4 py-3 text-sm hover:bg-blue-50 hover:text-kominfo-blue transition-colors">Pengaduan
                                Masyarakat</a></li>
                        <li><a href="#"
                                class="block px-4 py-3 text-sm hover:bg-blue-50 hover:text-kominfo-blue transition-colors">Permohonan
                                Informasi</a></li>
                        <li><a href="#"
                                class="block px-4 py-3 text-sm hover:bg-blue-50 hover:text-kominfo-blue transition-colors">Satu
                                Data Tangsel</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Mobile Menu Toggle -->
        <button @click="mobileMenuOpen = true" type="button"
            class="lg:hidden inline-flex h-10 w-10 items-center justify-center rounded-lg border border-white/20 text-white transition hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-[#F7D558]"
            aria-label="Buka menu navigasi">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

    </div>

    <!-- Full-Screen Mobile Overlay -->
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-250" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full" @keydown.escape.window="mobileMenuOpen = false"
        class="fixed inset-0 z-[1000] bg-[#044FA0] flex flex-col w-full h-[100dvh] overflow-hidden lg:hidden"
        style="display: none;">

        <!-- Overlay Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-white/10 shrink-0">
            <a href="{{ route('home') }}" wire:navigate @click="mobileMenuOpen = false" class="flex items-center">
                <img src="{{ asset('Images/logo-kominfo.png') }}" alt="Logo Diskominfo Tangsel"
                    class="h-12 w-auto object-contain">
            </a>
            <button @click="mobileMenuOpen = false" type="button"
                class="text-white hover:text-[#F7D558] focus:outline-none transition-colors p-1"
                aria-label="Tutup menu navigasi">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Scrollable Menu Body -->
        <div class="flex-1 overflow-y-auto px-6 py-2">
            <ul class="flex flex-col text-white divide-y divide-white/10">

                <!-- Profil -->
                <li x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                        class="w-full flex items-center justify-between py-4 text-left font-semibold text-base focus:outline-none transition-colors"
                        :class="open ? 'text-[#F7D558]' : 'text-white'">
                        <span>Profil</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200"
                            :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul x-show="open" x-transition class="pb-4 pl-4 space-y-3 text-sm">
                        <li><a href="{{ route('profil.sekilas-diskominfo') }}" wire:navigate
                                @click="mobileMenuOpen = false"
                                class="block py-1 text-blue-200 hover:text-white transition-colors {{ request()->routeIs('profil.sekilas-diskominfo') ? 'text-white font-semibold' : '' }}">Sekilas
                                Diskominfo</a></li>
                        <li><a href="{{ route('profil.visi-misi') }}" wire:navigate @click="mobileMenuOpen = false"
                                class="block py-1 text-blue-200 hover:text-white transition-colors {{ request()->routeIs('profil.visi-misi') ? 'text-white font-semibold' : '' }}">Visi
                                &amp; Misi</a></li>
                        <li><a href="{{ route('profil.struktur-organisasi') }}" wire:navigate
                                @click="mobileMenuOpen = false"
                                class="block py-1 text-blue-200 hover:text-white transition-colors {{ request()->routeIs('profil.struktur-organisasi') ? 'text-white font-semibold' : '' }}">Struktur
                                Organisasi</a></li>
                    </ul>
                </li>

                <!-- Unit Kerja -->
                <li x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                        class="w-full flex items-center justify-between py-4 text-left font-semibold text-base focus:outline-none transition-colors"
                        :class="open ? 'text-[#F7D558]' : 'text-white'">
                        <span>Unit Kerja</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200"
                            :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul x-show="open" x-transition class="pb-4 pl-4 space-y-3 text-sm">
                        <li><a href="{{ route('unit-kerja.infrastruktur-tik') }}" wire:navigate
                                @click="mobileMenuOpen = false"
                                class="block py-1 text-blue-200 hover:text-white transition-colors {{ request()->routeIs('unit-kerja.infrastruktur-tik') ? 'text-white font-semibold' : '' }}">Bidang
                                Pengelolaan Infrastruktur TIK</a></li>
                        <li><a href="{{ route('unit-kerja.statistik-layanan-informasi') }}" wire:navigate
                                @click="mobileMenuOpen = false"
                                class="block py-1 text-blue-200 hover:text-white transition-colors {{ request()->routeIs('unit-kerja.statistik-layanan-informasi') ? 'text-white font-semibold' : '' }}">Bidang
                                Statistik &amp; Layanan Informasi</a></li>
                        <li><a href="#"
                                class="block py-1 text-blue-200 hover:text-white transition-colors">Bidang
                                Persandian</a></li>
                    </ul>
                </li>

                <!-- Regulasi -->
                <li>
                    <a href="#" @click="mobileMenuOpen = false"
                        class="w-full flex items-center py-4 font-semibold text-base text-white hover:text-[#F7D558] transition-colors">
                        Regulasi
                    </a>
                </li>

                <!-- Gallery -->
                <li x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                        class="w-full flex items-center justify-between py-4 text-left font-semibold text-base focus:outline-none transition-colors"
                        :class="open ? 'text-[#F7D558]' : 'text-white'">
                        <span>Gallery</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200"
                            :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul x-show="open" x-transition class="pb-4 pl-4 space-y-3 text-sm">
                        <li><a href="{{ route('galeri.foto') }}" @click="mobileMenuOpen = false"
                                class="block py-1 text-blue-200 hover:text-white transition-colors">Foto</a></li>
                        <li><a href="#" @click="mobileMenuOpen = false"
                                class="block py-1 text-blue-200 hover:text-white transition-colors">Video</a></li>
                    </ul>
                </li>

                <!-- Arsip -->
                <li x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                        class="w-full flex items-center justify-between py-4 text-left font-semibold text-base focus:outline-none transition-colors"
                        :class="open ? 'text-[#F7D558]' : 'text-white'">
                        <span>Arsip</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200"
                            :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul x-show="open" x-transition class="pb-4 pl-4 space-y-3 text-sm">
                        <li><a href="#" @click="mobileMenuOpen = false"
                                class="block py-1 text-blue-200 hover:text-white transition-colors">Dokumen
                                Publik</a></li>
                        <li><a href="#" @click="mobileMenuOpen = false"
                                class="block py-1 text-blue-200 hover:text-white transition-colors">Laporan
                                Berkal</a></li>
                    </ul>
                </li>

                <!-- Layanan Publik -->
                <li x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                        class="w-full flex items-center justify-between py-4 text-left font-bold text-base focus:outline-none transition-colors text-[#F7D558]">
                        <span>Layanan Publik</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200"
                            :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul x-show="open" x-transition class="pb-4 pl-4 space-y-3 text-sm">
                        <li><a href="#" @click="mobileMenuOpen = false"
                                class="block py-1 text-yellow-200 hover:text-[#F7D558] transition-colors">Pengaduan
                                Masyarakat</a></li>
                        <li><a href="#" @click="mobileMenuOpen = false"
                                class="block py-1 text-yellow-200 hover:text-[#F7D558] transition-colors">Permohonan
                                Informasi</a></li>
                        <li><a href="#" @click="mobileMenuOpen = false"
                                class="block py-1 text-yellow-200 hover:text-[#F7D558] transition-colors">Satu
                                Data Tangsel</a></li>
                    </ul>
                </li>

            </ul>
        </div>

        <!-- Overlay Footer -->
        <div class="px-6 py-5 bg-[#033d7e] border-t border-white/10 shrink-0">
            <div class="flex items-center gap-3 mb-4">
                <span class="text-white font-semibold text-sm">Media Sosial:</span>
                <a href="#" aria-label="Facebook"
                    class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-[#F7D558] hover:text-[#044FA0] hover:border-transparent transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                    </svg>
                </a>
                <a href="#" aria-label="Instagram"
                    class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-[#F7D558] hover:text-[#044FA0] hover:border-transparent transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                    </svg>
                </a>
                <a href="#" aria-label="YouTube"
                    class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-[#F7D558] hover:text-[#044FA0] hover:border-transparent transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z" />
                        <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="#044FA0" />
                    </svg>
                </a>
            </div>
            <p class="text-blue-200 text-xs leading-relaxed">
                &copy; 2026 Dinas Komunikasi dan Informatika<br>Kota Tangerang Selatan. All Rights Reserved.
            </p>
        </div>
    </div>
</header>
