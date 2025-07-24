<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create book') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <!-- Breadcrumb -->
        <div class="bg-gray-50 px-6 py-3 text-gray-700">
            <ol class="list-reset flex text-sm">
                <li><a href="#" class="text-blue-600 hover:text-blue-800">Trang chủ</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('books.index') }}" class="text-blue-600 hover:text-blue-800">Quản lý sách</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-500">Thêm sách mới</li>
            </ol>
        </div>

        <!-- Main Content Area -->
        <div class="p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Thêm sách mới</h1>
                    <p class="text-gray-600 mt-1">Nhập thông tin chi tiết về sách</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('books.index') }}"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>Hủy
                    </a>
                    <button type="button"
                        class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-eye mr-2"></i>Xem trước
                    </button>
                </div>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Main Information -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow p-6 space-y-6">
                            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-3">
                                <i class="fas fa-info-circle mr-2 text-blue-500"></i>Thông tin cơ bản
                            </h3>

                            <!-- Book Name -->
                            <div>
                                <x-input-label for="name">
                                    {{ __('Name') }} <span class="text-red-500">*</span>
                                </x-input-label>
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Author and Publishing House -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="author" :value="__('Author')" />
                                    <x-text-input id="author" class="block mt-1 w-full" type="text" name="author"
                                        :value="old('author')" autocomplete="author" />
                                    <x-input-error :messages="$errors->get('author')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="publishing_house" :value="__('Publishing house')" />
                                    <x-text-input id="publishing_house" class="block mt-1 w-full" type="text"
                                        name="publishing_house" :value="old('publishing_house')" autocomplete="publishing_house" />
                                    <x-input-error :messages="$errors->get('publishing_house')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Description -->
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-textarea id="description" class="block mt-1 w-full" rows="4" name="description"
                                    autocomplete="description">
                                    {{ old('description') }}
                                </x-textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <!-- Language -->
                            @php
                                $languages = ['Tiếng Anh', 'Tiếng Việt', 'Tiếng Nhật', 'Tiếng Hàn', 'Tiếng Trung'];
                            @endphp
                            <div>
                                <x-input-label :value="__('Language')" />
                                <div class="flex flex-wrap gap-4">
                                    @foreach ($languages as $language)
                                        <div class="flex items-center gap-2 mt-2">
                                            <x-radio-input id="language_{{ $loop->index }}" name="language"
                                                :value="$language" :checked="old('language') === $language" />
                                            <x-input-label for="language_{{ $loop->index }}" :value="$language" />
                                        </div>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('language')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Technical Details -->
                        <div class="bg-white rounded-lg shadow p-6 space-y-6 mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-3">
                                <i class="fas fa-cogs mr-2 text-green-500"></i>Thông tin kỹ thuật
                            </h3>

                            <!-- Page Number, Size, Year -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <x-input-label for="page_number" :value="__('Page number')" />
                                    <x-text-input id="page_number" class="block mt-1 w-full" type="number"
                                        min="0" name="page_number" :value="old('page_number')"
                                        autocomplete="page_number" />
                                    <x-input-error :messages="$errors->get('page_number')" class="mt-2" />
                                </div>
                                @php
                                    $sizes = ['13x20cm', '14x20cm', '16x24cm', '19x27cm', '21x29cm'];
                                @endphp
                                <div>
                                    <x-input-label for="size" :value="__('Size')" />
                                    <x-select id="size" class="block mt-1 w-full" name="size">
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size }}"
                                                {{ old('size') === $size ? 'selected' : '' }}>
                                                {{ $size }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                    <x-input-error :messages="$errors->get('size')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="year_of_publication" :value="__('Year of publication')" />
                                    <x-text-input id="year_of_publication" class="block mt-1 w-full" type="date"
                                        name="year_of_publication" :value="old('year_of_publication')"
                                        autocomplete="year_of_publication" />
                                    <x-input-error :messages="$errors->get('year_of_publication')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Cover Type -->
                            @php
                                $cover_types = ['Bìa mềm', 'Bìa cứng', 'Bìa da'];
                            @endphp
                            <div>
                                <x-input-label :value="__('Cover type')" />
                                <div class="flex flex-wrap gap-4">
                                    @foreach ($cover_types as $cover_type)
                                        <div class="flex items-center gap-2 mt-2">
                                            <x-radio-input id="cover_type_{{ $loop->index }}" name="cover_type"
                                                :value="$cover_type" :checked="old('cover_type') === $cover_type" />
                                            <x-input-label for="cover_type_{{ $loop->index }}" :value="$cover_type" />
                                        </div>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('cover_type')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Book Images Upload -->
                        <div class="bg-white rounded-lg shadow p-6 space-y-6 mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-3">
                                <i class="fas fa-image mr-2 text-indigo-500"></i>Ảnh sách
                            </h3>

                            <div class="space-y-4">
                                <div
                                    class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors duration-200">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                    <p class="text-gray-500 mb-2">Kéo thả ảnh vào đây hoặc</p>
                                    <label class="cursor-pointer">
                                        <span class="text-blue-600 hover:text-blue-800 font-medium">chọn file</span>
                                        <input type="file" name="images[]" accept="image/*" multiple
                                            class="hidden" id="fileInput">
                                    </label>
                                    <p class="text-xs text-gray-400 mt-2">PNG, JPG, JPEG tối đa 2MB</p>
                                </div>
                                <div>
                                    <x-input-error :messages="$errors->get('images.*')" class="mt-2" />
                                </div>

                                <!-- Preview area -->
                                <div id="imagePreviewContainer" class="flex flex-wrap gap-4 mt-4 hidden"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1">
                        <!-- Status -->
                        <div class="bg-white rounded-lg shadow p-6 space-y-6">
                            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-3">
                                <i class="fas fa-book mr-2 text-purple-500"></i>Danh mục
                            </h3>
                            <div>
                                <x-input-label for="categories" :value="__('Category')" />
                                <x-select id="categories" class="block mt-1 w-full" multiple size="10"
                                    name="categories[]">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </x-select>
                                <x-input-error :messages="$errors->get('categories.*')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Price and Stock -->
                        <div class="bg-white rounded-lg shadow p-6 space-y-6 mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-3">
                                <i class="fas fa-dollar-sign mr-2 text-yellow-500"></i>Giá và tồn kho
                            </h3>

                            <!-- Prices -->
                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="original_price" :value="__('Original price')" />
                                    <div class="relative">
                                        <x-text-input id="original_price" class="block mt-1 w-full" type="number"
                                            min="0" name="original_price" :value="old('original_price')"
                                            autocomplete="original_price" />
                                        <span class="absolute right-3 top-2 text-gray-500">VNĐ</span>
                                        <x-input-error :messages="$errors->get('original_price')" class="mt-2" />
                                    </div>
                                </div>
                                <div>
                                    <x-input-label for="current_price" :value="__('Current price')" />
                                    <div class="relative">
                                        <x-text-input id="current_price" class="block mt-1 w-full" type="number"
                                            min="0" name="current_price" :value="old('current_price')"
                                            autocomplete="current_price" />
                                        <span class="absolute right-3 top-2 text-gray-500">VNĐ</span>
                                        <x-input-error :messages="$errors->get('current_price')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <!-- Stock -->
                            <div>
                                <x-input-label for="stock" :value="__('Stock')" />
                                <x-text-input id="stock" class="block mt-1 w-full" type="number" min="0"
                                    name="stock" :value="old('stock')" autocomplete="stock" />
                                <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="bg-white rounded-lg shadow p-6 space-y-6 mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-3">
                                <i class="fas fa-toggle-on mr-2 text-purple-500"></i>Trạng thái
                            </h3>
                            @php
                                $statuses = ['Đang bán', 'Tạm ngưng', 'Hết hàng', 'Ngừng kinh doanh'];
                            @endphp
                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <x-select id="status" class="block mt-1 w-full" name="status">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}"
                                            {{ old('status') === $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </x-select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('books.index') }}"
                        class="px-6 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>Hủy
                    </a>
                    <button type="button"
                        class="px-6 py-2 text-blue-700 bg-blue-100 rounded-lg hover:bg-blue-200 transition-colors duration-200">
                        <i class="fas fa-save mr-2"></i>Lưu nháp
                    </button>
                    <x-primary-button>
                        <i class="fas fa-plus mr-2"></i>
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.getElementById('fileInput');
                const previewContainer = document.getElementById('imagePreviewContainer');
                let filesArray = [];

                updatePreview();

                fileInput.addEventListener('change', function(e) {
                    const newFiles = Array.from(e.target.files).filter(file => file.type.match('image.*'));
                    filesArray.push(...newFiles);
                    updateInputFiles();
                    updatePreview();
                });

                function updatePreview() {
                    previewContainer.innerHTML = '';
                    previewContainer.classList.toggle('hidden', filesArray.length === 0);

                    filesArray.forEach((file, index) => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const previewBox = document.createElement('div');
                            previewBox.classList.add('w-32', 'h-32', 'relative', 'rounded-lg',
                                'overflow-hidden', 'shadow', 'group');

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = `Preview ${index + 1}`;
                            img.className = 'w-full h-full object-cover';

                            const removeBtn = document.createElement('button');
                            removeBtn.type = 'button';
                            removeBtn.innerHTML = '<i class="fas fa-trash"></i>';
                            removeBtn.className =
                                'absolute top-1 right-1 text-red-500 bg-white rounded-full p-1 shadow opacity-0 group-hover:opacity-100 transition';
                            removeBtn.title = 'Xóa ảnh';

                            removeBtn.addEventListener('click', () => {
                                if (confirm('Bạn có chắc muốn xóa ảnh này?')) {
                                    filesArray.splice(index, 1);
                                    updateInputFiles();
                                    updatePreview();
                                }
                            });

                            previewBox.appendChild(img);
                            previewBox.appendChild(removeBtn);
                            previewContainer.appendChild(previewBox);
                        };
                        reader.readAsDataURL(file);
                    });
                }

                function updateInputFiles() {
                    const dataTransfer = new DataTransfer();
                    filesArray.forEach(file => dataTransfer.items.add(file));
                    fileInput.files = dataTransfer.files;
                }
            });
        </script>
    @endpush
</x-app-layout>
