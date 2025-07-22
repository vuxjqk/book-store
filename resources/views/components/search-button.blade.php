@props([
    'size' => 'sm', // xs, sm, md
    'tooltip' => 'Tìm kiếm',
    'type' => 'submit',
])

@php
    $sizeClasses = [
        'xs' => 'w-7 h-7 text-xs',
        'sm' => 'w-8 h-8 text-sm',
        'md' => 'w-10 h-10 text-base',
    ];

    $classes =
        'inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white shadow-lg shadow-gray-500/25 transition-all duration-200 transform hover:scale-110 active:scale-95 focus:outline-none focus:ring-4 focus:ring-gray-300 focus:ring-opacity-50 ';
    $classes .= $sizeClasses[$size] ?? $sizeClasses['sm'];
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes, 'title' => $tooltip]) }}>
    <i class="fas fa-search"></i>
</button>
