@props(['disabled' => false, 'checked' => false])

<input type="radio" @disabled($disabled) @checked($checked)
    {{ $attributes->merge(['class' => 'text-indigo-600 focus:ring-indigo-500']) }}>
