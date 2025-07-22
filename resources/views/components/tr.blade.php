@props([
    'clickable' => false,
    'selected' => false,
    'variant' => null, // success, warning, danger, info
])

@php
    $classes = 'transition-all duration-200';

    if ($clickable) {
        $classes .= ' cursor-pointer hover:bg-blue-50/70 active:bg-blue-100/70';
    }

    if ($selected) {
        $classes .= ' bg-blue-100/80 border-l-4 border-blue-500';
    }

    if ($variant) {
        $variants = [
            'success' => 'bg-green-50/50 border-l-4 border-green-500',
            'warning' => 'bg-yellow-50/50 border-l-4 border-yellow-500',
            'danger' => 'bg-red-50/50 border-l-4 border-red-500',
            'info' => 'bg-blue-50/50 border-l-4 border-blue-500',
        ];
        $classes .= ' ' . ($variants[$variant] ?? '');
    }
@endphp

<tr {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</tr>
