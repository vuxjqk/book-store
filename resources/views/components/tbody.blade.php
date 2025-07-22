@props([
    'divider' => true,
])

@php
    $classes = 'bg-white divide-gray-200';
    if ($divider) {
        $classes .= ' divide-y';
    }
@endphp

<tbody {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</tbody>
