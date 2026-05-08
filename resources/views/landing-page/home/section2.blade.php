@push('styles')
    <style>
        /* Swiper Overrides */
        .berita-swiper {
            padding-bottom: 40px !important;
        }

        .swiper-button-next,
        .swiper-button-prev {
            background: rgba(255, 255, 255, 0.9) !important;
            width: 40px !important;
            height: 40px !important;
            border-radius: 50% !important;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2) !important;
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 16px !important;
            color: #044FA0 !important;
            font-weight: bold !important;
        }

        .swiper-pagination-bullet {
            background: #ccc !important;
            opacity: 1 !important;
        }

        .swiper-pagination-bullet-active {
            background: #044FA0 !important;
            width: 24px !important;
            border-radius: 6px !important;
        }

        /* Widget Overrides */
        #gpr-kominfo-widget-header {
            height: 0px !important;
        }

        #gpr-kominfo-widget-footer {
            height: 30px !important;
        }
    </style>
@endpush

<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- Berita Utama (Left Column) --}}
            <div class="lg:col-span-5">
                <h2 class="text-2xl font-bold text-[#044FA0] mb-1">Berita Utama</h2>
                <div class="w-12 h-1.5 bg-[#F7D558] mb-4 rounded-full"></div>

                <div class="swiper berita-swiper">
                    <div class="swiper-wrapper">

                        {{-- Slide 1 --}}
                        <div class="swiper-slide">
                            <div class="relative aspect-video overflow-hidden rounded-xl">
                                <img src="https://picsum.photos/800/600?random=1"
                                    alt="Pemkot Tangsel Resmikan Alun-alun Baru di Pusat Kota"
                                    class="w-full h-full object-cover">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent flex flex-col justify-end p-4">
                                    <h3 class="text-white font-semibold text-base leading-snug mb-2">
                                        <a href="#" class="hover:text-[#F7D558] transition-colors duration-200">
                                            Pemkot Tangsel Resmikan Alun-alun Baru di Pusat Kota
                                        </a>
                                    </h3>
                                    <div class="flex items-center gap-2 text-white/80 text-xs">
                                        <span>
                                            <i class="fas fa-calendar-alt text-[#F7D558] mr-1"></i>
                                            Kamis, 8 Mei 2025
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Slide 2 --}}
                        <div class="swiper-slide">
                            <div class="relative aspect-video overflow-hidden rounded-xl">
                                <img src="https://picsum.photos/800/600?random=2"
                                    alt="Diskominfo Tangsel Luncurkan Aplikasi Layanan Publik Digital"
                                    class="w-full h-full object-cover">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent flex flex-col justify-end p-4">
                                    <h3 class="text-white font-semibold text-base leading-snug mb-2">
                                        <a href="#" class="hover:text-[#F7D558] transition-colors duration-200">
                                            Diskominfo Tangsel Luncurkan Aplikasi Layanan Publik Digital
                                        </a>
                                    </h3>
                                    <div class="flex items-center gap-2 text-white/80 text-xs">
                                        <span>
                                            <i class="fas fa-calendar-alt text-[#F7D558] mr-1"></i>
                                            Rabu, 7 Mei 2025
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Slide 3 --}}
                        <div class="swiper-slide">
                            <div class="relative aspect-video overflow-hidden rounded-xl">
                                <img src="https://picsum.photos/800/600?random=3"
                                    alt="Program Smart City Tangsel Raih Penghargaan Nasional"
                                    class="w-full h-full object-cover">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent flex flex-col justify-end p-4">
                                    <h3 class="text-white font-semibold text-base leading-snug mb-2">
                                        <a href="#" class="hover:text-[#F7D558] transition-colors duration-200">
                                            Program Smart City Tangsel Raih Penghargaan Nasional
                                        </a>
                                    </h3>
                                    <div class="flex items-center gap-2 text-white/80 text-xs">
                                        <span>
                                            <i class="fas fa-calendar-alt text-[#F7D558] mr-1"></i>
                                            Selasa, 6 Mei 2025
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- Navigation --}}
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            {{-- Right Column (Berita Populer & Terbaru) --}}
            <div class="lg:col-span-4">

                {{-- Berita Populer --}}
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Berita Populer</h3>
                    <div class="w-12 h-1.5 bg-[#F7D558] mb-4 rounded-full"></div>
                    <div class="divide-y divide-gray-100">

                        <div class="flex items-start gap-3 py-3">
                            <div
                                class="flex-shrink-0 w-7 h-7 rounded-full bg-[#044FA0] text-white text-xs font-bold flex items-center justify-center">
                                1
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-700 leading-snug line-clamp-2">
                                    <a href="#" target="_blank"
                                        class="hover:text-[#044FA0] transition-colors duration-200">
                                        Wali Kota Tangsel Tinjau Langsung Pembangunan Infrastruktur Jalan
                                    </a>
                                </h4>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 py-3">
                            <div
                                class="flex-shrink-0 w-7 h-7 rounded-full bg-[#044FA0] text-white text-xs font-bold flex items-center justify-center">
                                2
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-700 leading-snug line-clamp-2">
                                    <a href="#" target="_blank"
                                        class="hover:text-[#044FA0] transition-colors duration-200">
                                        Pemkot Tangsel Buka Pendaftaran Beasiswa Pendidikan 2025
                                    </a>
                                </h4>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 py-3">
                            <div
                                class="flex-shrink-0 w-7 h-7 rounded-full bg-[#044FA0] text-white text-xs font-bold flex items-center justify-center">
                                3
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-700 leading-snug line-clamp-2">
                                    <a href="#" target="_blank"
                                        class="hover:text-[#044FA0] transition-colors duration-200">
                                        Festival Budaya Tangerang Selatan Dihadiri Ribuan Warga
                                    </a>
                                </h4>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Berita Terbaru --}}
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Berita Terbaru</h3>
                    <div class="w-12 h-1.5 bg-[#F7D558] mb-4 rounded-full"></div>
                    <div class="divide-y divide-gray-100">

                        <div class="flex items-start gap-3 py-3">
                            <div
                                class="flex-shrink-0 w-7 h-7 rounded-full bg-[#044FA0] text-white text-xs font-bold flex items-center justify-center">
                                1
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-700 leading-snug line-clamp-2">
                                    <a href="#" target="_blank"
                                        class="hover:text-[#044FA0] transition-colors duration-200">
                                        Rapat Koordinasi OPD Tangsel Bahas Rencana Pembangunan 2026
                                    </a>
                                </h4>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 py-3">
                            <div
                                class="flex-shrink-0 w-7 h-7 rounded-full bg-[#044FA0] text-white text-xs font-bold flex items-center justify-center">
                                2
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-700 leading-snug line-clamp-2">
                                    <a href="#" target="_blank"
                                        class="hover:text-[#044FA0] transition-colors duration-200">
                                        Sosialisasi Penggunaan Aplikasi Satu Data Kota Tangerang Selatan
                                    </a>
                                </h4>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 py-3">
                            <div
                                class="flex-shrink-0 w-7 h-7 rounded-full bg-[#044FA0] text-white text-xs font-bold flex items-center justify-center">
                                3
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-700 leading-snug line-clamp-2">
                                    <a href="#" target="_blank"
                                        class="hover:text-[#044FA0] transition-colors duration-200">
                                        Diskominfo Gelar Pelatihan Literasi Digital untuk Warga Tangsel
                                    </a>
                                </h4>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            {{-- GPR Widget Column --}}
            <div class="lg:col-span-3 w-full overflow-hidden rounded-xl">
                <div id="gpr-kominfo-widget-container"></div>
            </div>

        </div>
    </div>

    <script type="text/javascript" src="https://widget.komdigi.go.id/gpr-widget-kominfo.min.js" async></script>
</section>

<script data-navigate-once>
    function initBeritaSwiper() {
        const swiperContainer = document.querySelector('.berita-swiper');

        // Return if element doesn't exist or already initialized
        if (!swiperContainer || swiperContainer.classList.contains('swiper-initialized')) {
            return;
        }

        var beritaSwiper = new Swiper('.berita-swiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            speed: 800,
            effect: 'slide',
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },
                768: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                1024: {
                    slidesPerView: 1,
                    spaceBetween: 30
                }
            }
        });
    }

    // Initialize on DOMContentLoaded (for fresh loads)
    document.addEventListener('DOMContentLoaded', initBeritaSwiper);

    // Initialize on livewire:navigated (for SPA navigation)
    document.addEventListener('livewire:navigated', initBeritaSwiper);
</script>
