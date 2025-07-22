@props([
    'sortable' => false,
    'sorted' => null, // 'asc', 'desc', null
    'align' => 'left', // left, center, right
    'width' => null,
    'sticky' => false,
])

@php
    $alignClasses = [
        'left' => 'text-left',
        'center' => 'text-center',
        'right' => 'text-right',
    ];

    $classes = 'px-6 py-4 text-xs font-semibold uppercase tracking-wider border-b border-white/20 ';
    $classes .= $alignClasses[$align] ?? $alignClasses['left'];

    if ($sortable) {
        $classes .= ' cursor-pointer hover:bg-black/10 transition-colors duration-200 select-none relative group';
    }

    if ($sticky) {
        $classes .= ' sticky left-0 bg-inherit z-20';
    }

    $style = '';
    if ($width) {
        $style = "width: {$width};";
    }
@endphp

<th {{ $attributes->merge(['class' => $classes]) }}
    @if ($style) style="{{ $style }}" @endif>
    <div
        class="flex items-center {{ $align === 'center' ? 'justify-center' : ($align === 'right' ? 'justify-end' : 'justify-start') }}">
        <span>{{ $slot }}</span>

        @if ($sortable)
            <div class="ml-2 flex flex-col">
                @if ($sorted === 'asc')
                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                @elseif($sorted === 'desc')
                    <svg class="w-3 h-3 text-white transform rotate-180" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                @else
                    <div class="opacity-0 group-hover:opacity-60 transition-opacity duration-200">
                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                @endif
            </div>
        @endif
    </div>
</th>
