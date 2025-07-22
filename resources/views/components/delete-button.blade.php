@props([
    'size' => 'sm', // xs, sm, md
    'confirm' => true,
    'confirmMessage' => 'Bạn có chắc chắn muốn xóa?',
    'tooltip' => 'Xóa',
])

@php
    $sizeClasses = [
        'xs' => 'w-7 h-7 text-xs',
        'sm' => 'w-8 h-8 text-sm',
        'md' => 'w-10 h-10 text-base',
    ];

    $classes =
        'inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white shadow-lg shadow-red-500/25 transition-all duration-200 transform hover:scale-110 active:scale-95 focus:outline-none focus:ring-4 focus:ring-red-300 focus:ring-opacity-50 ';
    $classes .= $sizeClasses[$size] ?? $sizeClasses['sm'];

    $onClick = '';
    if ($confirm) {
        $onClick = "return confirm('{$confirmMessage}')";
    }
@endphp

<button type="button" {{ $attributes->merge(['class' => $classes, 'title' => $tooltip]) }}
    @if ($onClick) onclick="{{ $onClick }}" @endif>
    <i class="fas fa-trash-alt"></i>
</button>
