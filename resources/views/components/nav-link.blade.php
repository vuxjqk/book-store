@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center px-6 py-3 text-gray-100 hover:bg-gray-700 hover:text-white transition-colors duration-200 border-r-4 border-blue-500'
            : 'flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
