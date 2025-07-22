@props([
    'size' => 'sm',
    'tooltip' => 'In',
])

@php
    $sizeClasses = [
        'xs' => 'w-7 h-7 text-xs',
        'sm' => 'w-8 h-8 text-sm',
        'md' => 'w-10 h-10 text-base',
    ];

    $classes =
        'inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white shadow-lg shadow-purple-500/25 transition-all duration-200 transform hover:scale-110 active:scale-95 focus:outline-none focus:ring-4 focus:ring-purple-300 focus:ring-opacity-50 ';
    $classes .= $sizeClasses[$size] ?? $sizeClasses['sm'];
@endphp

<button type="button" {{ $attributes->merge(['class' => $classes, 'title' => $tooltip]) }} onclick="window.print()">
    <i class="fas fa-print"></i>
</button>
