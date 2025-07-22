@props([
    'striped' => false,
    'hover' => true,
    'bordered' => false,
    'compact' => false,
    'shadow' => true,
    'rounded' => true,
])

<div
    {{ $attributes->merge(['class' => 'overflow-hidden ' . ($shadow ? 'shadow-lg shadow-gray-200/50' : '') . ($rounded ? ' rounded-xl' : '')]) }}>
    <div class="overflow-x-auto">
        <table
            class="w-full {{ $striped ? 'table-striped' : '' }} {{ $hover ? 'table-hover' : '' }} {{ $bordered ? 'table-bordered' : '' }} {{ $compact ? 'table-compact' : '' }}">
            {{ $slot }}
        </table>
    </div>
</div>

<style>
    .table-striped tbody tr:nth-child(even) {
        @apply bg-gray-50/50;
    }

    .table-hover tbody tr:hover {
        @apply bg-blue-50/50 transition-colors duration-200;
    }

    .table-bordered {
        @apply border border-gray-200;
    }

    .table-bordered th,
    .table-bordered td {
        @apply border-r border-gray-200 last:border-r-0;
    }

    .table-compact th,
    .table-compact td {
        @apply py-2 px-3;
    }
</style>
