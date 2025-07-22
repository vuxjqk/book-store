@props([
    'align' => 'left', // left, center, right
    'spacing' => 'normal', // tight, normal, loose
])

@php
    $alignClasses = [
        'left' => 'justify-start',
        'center' => 'justify-center',
        'right' => 'justify-end',
    ];

    $spacingClasses = [
        'tight' => 'space-x-1',
        'normal' => 'space-x-2',
        'loose' => 'space-x-4',
    ];

    $classes = 'inline-flex items-center ';
    $classes .= ($alignClasses[$align] ?? $alignClasses['left']) . ' ';
    $classes .= $spacingClasses[$spacing] ?? $spacingClasses['normal'];
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
