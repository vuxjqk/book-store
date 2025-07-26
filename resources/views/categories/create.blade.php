<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <!-- Breadcrumb -->
        <nav class="bg-gray-50 px-6 py-3 text-gray-700">
            <ol class="list-reset flex text-sm">
                <li><a href="#" class="text-blue-600 hover:text-blue-800">{{ __('Home') }}</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('categories.index') }}"
                        class="text-blue-600 hover:text-blue-800">{{ __('Category Management') }}</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-500">{{ __('Create Category') }}</li>
            </ol>
        </nav>

        <!-- Main Content Area -->
        <main class="p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ __('Create Category') }}</h1>
                    <p class="text-gray-600 mt-1">{{ __('Add New Category Details') }}</p>
                </div>
                <div>
                    <a href="{{ route('categories.index') }}"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>{{ __('Cancel') }}
                    </a>
                </div>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('categories.store') }}" class="space-y-6">
                @csrf
                <div class="bg-white rounded-lg shadow p-6 space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-3">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>{{ __('Category Information') }}
                    </h3>

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Slug -->
                    <div>
                        <x-input-label for="slug" :value="__('Slug')" />
                        <x-text-input id="slug" class="block mt-1 w-full" type="text" name="slug"
                            :value="old('slug')" required autocomplete="slug" />
                        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <x-textarea id="description" class="block mt-1 w-full" rows="4" name="description"
                            autocomplete="description">{{ old('description') }}</x-textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-6">
                    <x-primary-button>
                        <i class="fas fa-save mr-2"></i>{{ __('Create') }}
                    </x-primary-button>
                </div>
            </form>
        </main>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const nameInput = document.getElementById('name');
                const slugInput = document.getElementById('slug');

                nameInput.addEventListener('input', function() {
                    let slug = nameInput.value
                        .toLowerCase()
                        .trim()
                        .replace(/á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/g, "a")
                        .replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/g, "e")
                        .replace(/i|í|ì|ỉ|ĩ|ị/g, "i")
                        .replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/g, "o")
                        .replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/g, "u")
                        .replace(/ý|ỳ|ỷ|ỹ|ỵ/g, "y")
                        .replace(/đ/g, "d")
                        .replace(/[^a-z0-9 -]/g, "")
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');

                    slugInput.value = slug;
                });
            });
        </script>
    @endpush
</x-app-layout>
