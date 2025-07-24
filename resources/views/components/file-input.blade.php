@props(['disabled' => false])

<input type="file" @disabled($disabled)
    {{ $attributes->merge(['class' => 'block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm']) }}>
