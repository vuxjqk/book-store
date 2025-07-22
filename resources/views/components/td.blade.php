@props([
    'align' => 'left', // left, center, right
    'truncate' => false,
    'nowrap' => false,
    'sticky' => false,
    'width' => null,
])

@php
    $alignClasses = [
        'left' => 'text-left',
        'center' => 'text-center',
        'right' => 'text-right',
    ];

    $classes = 'px-6 py-4 text-sm text-gray-900 ';
    $classes .= $alignClasses[$align] ?? $alignClasses['left'];

    if ($truncate) {
        $classes .= ' truncate max-w-0';
    }

    if ($nowrap) {
        $classes .= ' whitespace-nowrap';
    }

    if ($sticky) {
        $classes .= ' sticky left-0 bg-white z-10 border-r border-gray-200';
    }

    $style = '';
    if ($width) {
        $style = "width: {$width};";
    }
@endphp

<td {{ $attributes->merge(['class' => $classes]) }}
    @if ($style) style="{{ $style }}" @endif>
    @if ($truncate)
        <div class="truncate" title="{{ strip_tags($slot) }}">
            {{ $slot }}
        </div>
    @else
        {{ $slot }}
    @endif
</td>
