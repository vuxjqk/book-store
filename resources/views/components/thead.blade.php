@props([
    'variant' => 'primary', // primary, secondary, dark
    'sticky' => false,
])

@php
    $variants = [
        'primary' => 'bg-gradient-to-r from-blue-600 to-blue-700 text-white',
        'secondary' => 'bg-gradient-to-r from-gray-100 to-gray-200 text-gray-900',
        'dark' => 'bg-gradient-to-r from-gray-800 to-gray-900 text-white',
    ];

    $classes = $variants[$variant] ?? $variants['primary'];

    if ($sticky) {
        $classes .= ' sticky top-0 z-10';
    }
@endphp

<thead {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</thead>
