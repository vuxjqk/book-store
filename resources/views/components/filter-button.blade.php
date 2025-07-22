@props([
    'size' => 'sm',
    'tooltip' => 'Lọc',
    'active' => false,
])

@php
    $sizeClasses = [
        'xs' => 'w-7 h-7 text-xs',
        'sm' => 'w-8 h-8 text-sm',
        'md' => 'w-10 h-10 text-base',
    ];

    if ($active) {
        $classes =
            'inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white shadow-lg shadow-indigo-500/25 ';
    } else {
        $classes =
            'inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white shadow-lg shadow-gray-500/25 ';
    }

    $classes .=
        'transition-all duration-200 transform hover:scale-110 active:scale-95 focus:outline-none focus:ring-4 focus:ring-opacity-50 ';
    $classes .= $active ? 'focus:ring-indigo-300 ' : 'focus:ring-gray-300 ';
    $classes .= $sizeClasses[$size] ?? $sizeClasses['sm'];
@endphp

<button type="button" {{ $attributes->merge(['class' => $classes, 'title' => $tooltip]) }}>
    <i class="fas fa-filter"></i>
</button>
