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

        /* Brutalist Reset for GPR Widget */
        #gpr-kominfo-widget-container {
            height: 100% !important;
            max-height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            border-radius: 0 !important;
            background: transparent !important;
        }

        #gpr-kominfo-widget-header,
        #gpr-kominfo-widget-footer {
            display: none !important;
        }

        #gpr-kominfo-widget-body {
            height: 100% !important;
            max-height: 100% !important;
            margin: 0 !important;
            padding: 10px 10px 0 10px !important;
            background-color: #ffffff !important;
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

                        @forelse ($latestNews ?? [] as $news)
                        <div class="swiper-slide">
                            <div
                                class="relative w-full aspect-[4/3] md:aspect-video lg:aspect-[1/1] xl:aspect-[4/3] overflow-hidden rounded-2xl bg-slate-800">
                                @if($news->description_image)
                                <img src="{{ asset('storage/' . $news->description_image) }}"
                                    alt="{{ $news->title }}"
                                    class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full bg-gradient-to-br from-[#044FA0] to-[#1E78B7]"></div>
                                @endif
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent flex flex-col justify-end p-4">
                                    <h3 class="text-white font-semibold text-base leading-snug mb-2">
                                        <a href="#" class="hover:text-[#F7D558] transition-colors duration-200">
                                            {{ $news->title }}
                                        </a>
                                    </h3>
                                    <div class="flex items-center gap-2 text-white/80 text-xs">
                                        <span>
                                            <i class="fas fa-calendar-alt text-[#F7D558] mr-1"></i>
                                            {{ $news->published_at?->isoFormat('dddd, D MMMM YYYY') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="swiper-slide">
                            <div class="relative w-full aspect-[4/3] md:aspect-video lg:aspect-[1/1] xl:aspect-[4/3] overflow-hidden rounded-2xl bg-slate-200 flex items-center justify-center">
                                <p class="text-slate-400 text-sm">Belum ada berita yang dipublikasikan.</p>
                            </div>
                        </div>
                        @endforelse

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

                        @forelse (($popularNews ?? [])->take(3) as $index => $news)
                        <div class="flex items-start gap-3 py-3">
                            <div
                                class="flex-shrink-0 w-7 h-7 rounded-full bg-[#044FA0] text-white text-xs font-bold flex items-center justify-center">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-700 leading-snug line-clamp-2">
                                    <a href="#" class="hover:text-[#044FA0] transition-colors duration-200">
                                        {{ $news->title }}
                                    </a>
                                </h4>
                            </div>
                        </div>
                        @empty
                        <p class="py-3 text-xs text-slate-400 italic">Belum ada data berita.</p>
                        @endforelse

                    </div>
                </div>

                {{-- Berita Terbaru --}}
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Berita Terbaru</h3>
                    <div class="w-12 h-1.5 bg-[#F7D558] mb-4 rounded-full"></div>
                    <div class="divide-y divide-gray-100">

                        @forelse ($latestNews ?? [] as $index => $news)
                        <div class="flex items-start gap-3 py-3">
                            <div
                                class="flex-shrink-0 w-7 h-7 rounded-full bg-[#044FA0] text-white text-xs font-bold flex items-center justify-center">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-700 leading-snug line-clamp-2">
                                    <a href="#" class="hover:text-[#044FA0] transition-colors duration-200">
                                        {{ $news->title }}
                                    </a>
                                </h4>
                            </div>
                        </div>
                        @empty
                        <p class="py-3 text-xs text-slate-400 italic">Belum ada berita terbaru.</p>
                        @endforelse

                    </div>
                </div>

            </div>

            {{-- GPR Widget Column --}}
            <div class="lg:col-span-3 w-full">
                <div class="relative w-full h-[480px] bg-[#1a2a6c] rounded-xl overflow-hidden">
                    <div
                        class="absolute top-[14px] bottom-[14px] left-[2px] right-[2px] bg-white rounded-[10px] overflow-hidden shadow-inner">
                        <div id="gpr-kominfo-widget-container" class="w-full h-full"></div>
                    </div>
                </div>
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
