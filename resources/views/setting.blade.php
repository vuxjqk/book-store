<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Setting') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <!-- Breadcrumb -->
        <div class="bg-gray-50 px-6 py-3 text-gray-700">
            <ol class="list-reset flex text-sm">
                <li><a href="#" class="text-blue-600 hover:text-blue-800">{{ __('Home') }}</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-500">{{ __('Setting') }}</li>
            </ol>
        </div>

        <!-- Main Content Area -->
        <div class="p-6">
            <div class="w-64">
                <x-input-label for="language-select" :value="__('Language')" />
                <x-select id="language-select" class="block mt-1 w-full" onchange="changeLanguage(this.value)">
                    <option value="vi" {{ app()->getLocale() == 'vi' ? 'selected' : '' }}>
                        {{ __('Vietnamese') }}
                    </option>
                    <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>
                        {{ __('English') }}
                    </option>
                </x-select>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function changeLanguage(locale) {
                let url = "{{ route('change.locale', ['locale' => '__locale__']) }}";
                url = url.replace('__locale__', locale);
                window.location.href = url;
            }
        </script>
    @endpush
</x-app-layout>
