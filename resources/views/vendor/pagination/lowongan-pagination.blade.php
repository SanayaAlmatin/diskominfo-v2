@if ($paginator->hasPages())
<nav role="navigation" aria-label="Navigasi Halaman"
    class="flex flex-wrap items-center justify-center gap-1.5 sm:gap-2">

    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 bg-white
                     text-slate-300 opacity-50 cursor-not-allowed select-none"
              aria-disabled="true" aria-label="Halaman Sebelumnya">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6"/>
            </svg>
        </span>
    @else
        <button type="button"
            wire:click="previousPage('{{ $paginator->getPageName() }}')"
            wire:loading.attr="disabled"
            class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 bg-white
                   text-slate-600 shadow-[0_2px_8px_-2px_rgba(79,70,229,0.08)]
                   transition-all duration-200 hover:-translate-y-0.5 hover:border-indigo-200
                   hover:bg-indigo-50 hover:text-indigo-700 hover:shadow-[0_4px_14px_0_rgba(79,70,229,0.15)]
                   focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
            aria-label="Halaman Sebelumnya">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6"/>
            </svg>
        </button>
    @endif

    {{-- Page Numbers --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-full text-sm font-medium text-slate-400
                         select-none" aria-hidden="true">
                {{ $element }}
            </span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page"
                            class="inline-flex h-9 w-9 items-center justify-center rounded-full
                                   bg-gradient-to-br from-indigo-600 to-violet-600 text-sm font-bold text-white
                                   shadow-[0_4px_14px_0_rgba(79,70,229,0.35)] select-none">
                            {{ $page }}
                        </span>
                    @else
                        <button type="button"
                            wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                            wire:loading.attr="disabled"
                            class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 bg-white
                                   text-sm font-semibold text-slate-600
                                   shadow-[0_2px_8px_-2px_rgba(79,70,229,0.08)]
                                   transition-all duration-200 hover:-translate-y-0.5 hover:border-indigo-200
                                   hover:bg-indigo-50 hover:text-indigo-700 hover:shadow-[0_4px_14px_0_rgba(79,70,229,0.15)]
                                   focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
                            aria-label="Halaman {{ $page }}">
                            {{ $page }}
                        </button>
                    @endif
                </span>
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <button type="button"
            wire:click="nextPage('{{ $paginator->getPageName() }}')"
            wire:loading.attr="disabled"
            class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 bg-white
                   text-slate-600 shadow-[0_2px_8px_-2px_rgba(79,70,229,0.08)]
                   transition-all duration-200 hover:-translate-y-0.5 hover:border-indigo-200
                   hover:bg-indigo-50 hover:text-indigo-700 hover:shadow-[0_4px_14px_0_rgba(79,70,229,0.15)]
                   focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
            aria-label="Halaman Berikutnya">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6"/>
            </svg>
        </button>
    @else
        <span class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 bg-white
                     text-slate-300 opacity-50 cursor-not-allowed select-none"
              aria-disabled="true" aria-label="Halaman Berikutnya">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6"/>
            </svg>
        </span>
    @endif

</nav>
@endif
