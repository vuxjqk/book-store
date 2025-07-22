@props([
    'text' => 'Thêm mới',
    'icon' => 'fa-plus',
    'size' => 'md', // sm, md, lg
    'variant' => 'primary', // primary, success, info
    'href' => null,
    'type' => 'button',
])

@php
    $sizeClasses = [
        'sm' => 'px-4 py-2 text-sm',
        'md' => 'px-6 py-3 text-base',
        'lg' => 'px-8 py-4 text-lg',
    ];

    $variants = [
        'primary' =>
            'bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white shadow-blue-500/25',
        'success' =>
            'bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white shadow-green-500/25',
        'info' =>
            'bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white shadow-indigo-500/25',
    ];

    $classes =
        'inline-flex items-center font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 active:scale-95 shadow-lg focus:outline-none focus:ring-4 focus:ring-opacity-50 ';
    $classes .= ($sizeClasses[$size] ?? $sizeClasses['md']) . ' ';
    $classes .= $variants[$variant] ?? $variants['primary'];

    if ($variant === 'primary') {
        $classes .= ' focus:ring-blue-300';
    } elseif ($variant === 'success') {
        $classes .= ' focus:ring-green-300';
    } else {
        $classes .= ' focus:ring-indigo-300';
    }
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        <i class="fas {{ $icon }} mr-2"></i>
        {{ $text }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        <i class="fas {{ $icon }} mr-2"></i>
        {{ $text }}
    </button>
@endif
