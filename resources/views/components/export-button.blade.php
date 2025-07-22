@props([
    'size' => 'sm',
    'tooltip' => 'Xuất Excel',
    'href' => null,
])

@php
    $sizeClasses = [
        'xs' => 'w-7 h-7 text-xs',
        'sm' => 'w-8 h-8 text-sm',
        'md' => 'w-10 h-10 text-base',
    ];

    $classes =
        'inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white shadow-lg shadow-green-500/25 transition-all duration-200 transform hover:scale-110 active:scale-95 focus:outline-none focus:ring-4 focus:ring-green-300 focus:ring-opacity-50 ';
    $classes .= $sizeClasses[$size] ?? $sizeClasses['sm'];
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes, 'title' => $tooltip]) }}>
        <i class="fas fa-file-excel"></i>
    </a>
@else
    <button type="button" {{ $attributes->merge(['class' => $classes, 'title' => $tooltip]) }}>
        <i class="fas fa-file-excel"></i>
    </button>
@endif
