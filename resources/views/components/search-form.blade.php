@props([
    'placeholder' => 'Tìm kiếm...',
    'value' => '',
    'name' => 'search',
    'withButton' => true,
    'buttonText' => 'Tìm kiếm',
    'size' => 'md', // sm, md, lg
])

@php
    $sizeClasses = [
        'sm' => 'px-3 py-2 text-sm',
        'md' => 'px-4 py-2.5 text-base',
        'lg' => 'px-5 py-3 text-lg',
    ];

    $inputClasses =
        'block w-full border border-gray-300 rounded-lg bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 ';
    $inputClasses .= $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

@if ($withButton)
    <div class="flex rounded-lg shadow-sm">
        <div class="relative flex-grow">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input type="text" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}"
                {{ $attributes->merge(['class' => $inputClasses . ' pl-10 rounded-r-none border-r-0']) }}>
        </div>
        <x-create-button text="{{ $buttonText }}" icon="fa-search" type="submit"
            class="rounded-l-none shadow-none border-l-0" />
    </div>
@else
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-search text-gray-400"></i>
        </div>
        <input type="text" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}"
            {{ $attributes->merge(['class' => $inputClasses . ' pl-10']) }}>
    </div>
@endif
