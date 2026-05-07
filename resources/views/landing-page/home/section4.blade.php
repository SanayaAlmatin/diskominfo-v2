@php
    $featuredApps = [
        [
            'name' => 'Sisumaker',
            'desc' => 'Kelola surat-menyurat dinas secara digital dengan mudah.',
            'bg' => 'bg-indigo-50',
            'icon_bg' => 'bg-indigo-100',
            'icon_color' => 'text-indigo-600',
            'icon' => 'description', // Nama icon Material Symbols
            'href' => '#',
        ],
        [
            'name' => 'Simponi',
            'desc' => 'Pantau dan bayar pajak daerah dari mana saja.',
            'bg' => 'bg-sky-50',
            'icon_bg' => 'bg-sky-100',
            'icon_color' => 'text-sky-600',
            'icon' => 'payments',
            'href' => '#',
        ],
        [
            'name' => 'Tangsel Sehat',
            'desc' => 'Daftar antrean online di Puskesmas dan RSUD Tangsel.',
            'bg' => 'bg-emerald-50',
            'icon_bg' => 'bg-emerald-100',
            'icon_color' => 'text-emerald-600',
            'icon' => 'health_and_safety',
            'href' => '#',
        ],
        [
            'name' => 'e-SPPD',
            'desc' => 'Ajukan dan verifikasi perjalanan dinas secara elektronik.',
            'bg' => 'bg-amber-50',
            'icon_bg' => 'bg-amber-100',
            'icon_color' => 'text-amber-600',
            'icon' => 'luggage',
            'href' => '#',
        ],
    ];

    $apps = [
        [
            'name' => 'Sisumaker',
            'category' => 'admin',
            'desc' => 'Manajemen persuratan dinas dan dokumen administratif warga.',
            'icon_bg' => 'bg-indigo-100',
            'icon_color' => 'text-indigo-600',
            'icon' => 'description',
            'href' => '#',
        ],
        [
            'name' => 'Simponi',
            'category' => 'finance',
            'desc' => 'Portal pembayaran dan pelaporan pajak daerah.',
            'icon_bg' => 'bg-sky-100',
            'icon_color' => 'text-sky-600',
            'icon' => 'payments',
            'href' => '#',
        ],
        [
            'name' => 'Tangsel Sehat',
            'category' => 'health',
            'desc' => 'Reservasi jadwal dokter dan antrean fasilitas kesehatan lokal.',
            'icon_bg' => 'bg-emerald-100',
            'icon_color' => 'text-emerald-600',
            'icon' => 'medical_information',
            'href' => '#',
        ],
        [
            'name' => 'e-SPPD',
            'category' => 'admin',
            'desc' => 'Pengajuan perjalanan dinas elektronik bagi aparatur sipil.',
            'icon_bg' => 'bg-amber-100',
            'icon_color' => 'text-amber-600',
            'icon' => 'flight_takeoff',
            'href' => '#',
        ],
        [
            'name' => 'SiPATU',
            'category' => 'safety',
            'desc' => 'Sistem pemantauan terpadu keamanan lingkungan.',
            'icon_bg' => 'bg-red-100',
            'icon_color' => 'text-red-600',
            'icon' => 'security',
            'href' => '#',
        ],
        [
            'name' => 'e-Absen',
            'category' => 'admin',
            'desc' => 'Pencatatan kehadiran digital untuk pegawai kota.',
            'icon_bg' => 'bg-violet-100',
            'icon_color' => 'text-violet-600',
            'icon' => 'fingerprint',
            'href' => '#',
        ],
        [
            'name' => 'BPJS Online',
            'category' => 'health',
            'desc' => 'Layanan informasi dan pendaftaran jaminan kesehatan.',
            'icon_bg' => 'bg-teal-100',
            'icon_color' => 'text-teal-600',
            'icon' => 'medical_services',
            'href' => '#',
        ],
        [
            'name' => 'SiGa',
            'category' => 'safety',
            'desc' => 'Sistem siaga pelaporan kondisi darurat masyarakat.',
            'icon_bg' => 'bg-orange-100',
            'icon_color' => 'text-orange-600',
            'icon' => 'emergency',
            'href' => '#',
        ],
        [
            'name' => 'e-Musrenbang',
            'category' => 'admin',
            'desc' => 'Perencanaan pembangunan partisipatif dari tingkat wilayah.',
            'icon_bg' => 'bg-blue-100',
            'icon_color' => 'text-blue-600',
            'icon' => 'groups',
            'href' => '#',
        ],
        [
            'name' => 'SimKes',
            'category' => 'health',
            'desc' => 'Sistem informasi terpadu puskesmas dan rumah sakit.',
            'icon_bg' => 'bg-green-100',
            'icon_color' => 'text-green-600',
            'icon' => 'local_hospital',
            'href' => '#',
        ],
        [
            'name' => 'SIAP',
            'category' => 'finance',
            'desc' => 'Sistem informasi anggaran publik dan transparansi.',
            'icon_bg' => 'bg-cyan-100',
            'icon_color' => 'text-cyan-600',
            'icon' => 'account_balance',
            'href' => '#',
        ],
        [
            'name' => 'Command Center',
            'category' => 'safety',
            'desc' => 'Pusat pantauan CCTV dan lalu lintas Kota Tangsel.',
            'icon_bg' => 'bg-rose-100',
            'icon_color' => 'text-rose-600',
            'icon' => 'monitor',
            'href' => '#',
        ],
    ];
@endphp

<section id="aplikasi" class="py-16 bg-[#F8FAFC]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        {{-- Section Header --}}
        <div class="space-y-2">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Aplikasi Unggulan Tangsel
            </h2>
            <p class="text-base text-slate-500">
                Akses seluruh layanan digital Kota Tangerang Selatan dalam satu portal terpadu.
            </p>
        </div>

        {{-- ── Featured Apps Row ── --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($featuredApps as $app)
                <div
                    class="{{ $app['bg'] }} p-6 rounded-2xl border border-slate-200/60 flex flex-col justify-between hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div>
                        <div class="{{ $app['icon_bg'] }} w-12 h-12 rounded-xl flex items-center justify-center mb-4">
                            {{-- Material Symbols Icon (Featured) --}}
                            <span class="material-symbols-outlined text-2xl {{ $app['icon_color'] }}"
                                style="font-variation-settings: 'FILL' 1;">
                                {{ $app['icon'] }}
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $app['name'] }}</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">{{ $app['desc'] }}</p>
                    </div>
                    <a href="{{ $app['href'] }}"
                        class="mt-6 {{ $app['icon_color'] }} text-xs font-bold tracking-wider flex items-center hover:gap-2 transition-all uppercase">
                        Buka Aplikasi
                        <span class="material-symbols-outlined text-base ml-1">arrow_forward</span>
                    </a>
                </div>
            @endforeach
        </div>

        {{-- ── Categorized App Grid (Alpine.js) ── --}}
        <div x-data="{ activeTab: 'all', search: '' }" class="space-y-8">

            {{-- Tabs & Search Bar --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                {{-- Tabs --}}
                <div class="flex flex-wrap gap-2">
                    @foreach ([['key' => 'all', 'label' => 'All Apps'], ['key' => 'health', 'label' => 'Health'], ['key' => 'admin', 'label' => 'Administration'], ['key' => 'safety', 'label' => 'Public Safety'], ['key' => 'finance', 'label' => 'Finance']] as $tab)
                        <button @click="activeTab = '{{ $tab['key'] }}'"
                            :class="activeTab === '{{ $tab['key'] }}'
                                ?
                                'bg-indigo-600 text-white shadow-md border-indigo-600' :
                                'bg-transparent text-slate-600 border-slate-200 hover:bg-slate-50'"
                            class="px-5 py-2 rounded-full text-sm font-semibold border transition-all duration-200 focus:outline-none">
                            {{ $tab['label'] }}
                        </button>
                    @endforeach
                </div>

                {{-- Search Bar --}}
                <div class="relative w-full md:max-w-sm">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"
                        style="font-size: 20px;">search</span>
                    <input x-model="search" type="text" placeholder="Filter by name..."
                        class="w-full pl-11 pr-4 py-2.5 bg-transparent border border-slate-200 rounded-full focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 text-sm text-slate-800 transition-all placeholder:text-slate-400 outline-none" />
                </div>
            </div>

            {{-- App Grid (Cards with Descriptions) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($apps as $app)
                    <a href="{{ $app['href'] }}"
                        x-show="(activeTab === 'all' || activeTab === '{{ $app['category'] }}') && '{{ strtolower($app['name']) }}'.includes(search.toLowerCase())"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        class="group flex flex-col p-6 border border-slate-200 rounded-2xl bg-white hover:shadow-lg transition-all duration-300 hover:-translate-y-1 focus:outline-none">

                        <div
                            class="{{ $app['icon_bg'] }} w-12 h-12 rounded-xl flex items-center justify-center mb-4 transition-colors">
                            {{-- Material Symbols Icon (Grid) --}}
                            <span class="material-symbols-outlined text-2xl {{ $app['icon_color'] }}"
                                style="font-variation-settings: 'FILL' 1;">
                                {{ $app['icon'] }}
                            </span>
                        </div>

                        <h4
                            class="text-base font-bold text-slate-900 mb-1 group-hover:text-indigo-600 transition-colors">
                            {{ $app['name'] }}
                        </h4>
                        <p class="text-sm text-slate-500 leading-relaxed line-clamp-2">
                            {{ $app['desc'] }}
                        </p>
                    </a>
                @endforeach
            </div>

        </div>
        {{-- /Alpine block --}}

    </div>
</section>
