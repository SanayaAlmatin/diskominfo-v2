@props(['links' => [], 'class' => ''])

@php
    $items = collect($links);
    $lastIndex = $items->count() - 1;
@endphp

<nav aria-label="Breadcrumb"
    {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 text-base text-blue-200 ' . $class]) }}>
    <ol class="flex flex-wrap items-center gap-1.5">
        @foreach ($items as $index => $item)
            <li class="flex items-center gap-1.5">

                @if ($index === $lastIndex)
                    {{-- Active / current page: plain text --}}
                    <span class="font-semibold text-white" aria-current="page">
                        {{ $item['label'] }}
                    </span>
                @else
                    {{-- Ancestor link --}}
                    <a href="{{ $item['url'] }}" wire:navigate
                        class="font-medium text-blue-200 transition-colors hover:text-white">
                        {{ $item['label'] }}
                    </a>

                    {{-- Chevron separator --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-blue-300/70" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round" aria-hidden="true">
                        <polyline points="9 18 15 12 9 6" />
                    </svg>
                @endif

            </li>
        @endforeach
    </ol>
</nav>
