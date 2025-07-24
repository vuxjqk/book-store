<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Details') }}
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
                <li class="text-gray-500">Chi tiết sách</li>
            </ol>
        </div>

        <!-- Main Content Area -->
        <div class="p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Chi tiết sách</h1>
                    <p class="text-gray-600 mt-1">Thông tin chi tiết về sách</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('books.edit', $book) }}"
                        class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-edit mr-2"></i>Chỉnh sửa
                    </a>
                    <a href="{{ route('books.index') }}"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Quay lại
                    </a>
                </div>
            </div>

            <!-- Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Information -->
                <div class="lg:col-span-2">
                    <!-- Basic Information -->
                    <div class="bg-white rounded-lg shadow p-6 space-y-6">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-3">
                            <i class="fas fa-info-circle mr-2 text-blue-500"></i>Thông tin cơ bản
                        </h3>

                        <!-- Book Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <p class="mt-1 text-gray-700">{{ $book->name }}</p>
                        </div>

                        <!-- Author and Publishing House -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="author" :value="__('Author')" />
                                <p class="mt-1 text-gray-700">{{ $book->author ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <x-input-label for="publishing_house" :value="__('Publishing house')" />
                                <p class="mt-1 text-gray-700">{{ $book->publishing_house ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <p class="mt-1 text-gray-700">{{ $book->description ?? 'N/A' }}</p>
                        </div>

                        <!-- Language -->
                        <div>
                            <x-input-label :value="__('Language')" />
                            <p class="mt-1 text-gray-700">{{ $book->language ?? 'N/A' }}</p>
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
                                <p class="mt-1 text-gray-700">{{ $book->page_number ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <x-input-label for="size" :value="__('Size')" />
                                <p class="mt-1 text-gray-700">{{ $book->size ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <x-input-label for="year_of_publication" :value="__('Year of publication')" />
                                <p class="mt-1 text-gray-700">{{ $book->year_of_publication ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Cover Type -->
                        <div>
                            <x-input-label :value="__('Cover type')" />
                            <p class="mt-1 text-gray-700">{{ $book->cover_type ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Book Images -->
                    <div class="bg-white rounded-lg shadow p-6 space-y-6 mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-3">
                            <i class="fas fa-image mr-2 text-indigo-500"></i>Ảnh sách
                        </h3>

                        <div class="flex flex-wrap gap-4">
                            @forelse ($book->images as $image)
                                <div class="w-32 h-32 relative rounded-lg overflow-hidden shadow">
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                        alt="Book Image {{ $loop->index + 1 }}" class="w-full h-full object-cover"
                                        loading="lazy">
                                </div>
                            @empty
                                <p class="text-gray-500">Không có ảnh nào được tải lên.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Categories -->
                    <div class="bg-white rounded-lg shadow p-6 space-y-6">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-3">
                            <i class="fas fa-book mr-2 text-purple-500"></i>Danh mục
                        </h3>
                        <div>
                            <x-input-label for="categories" :value="__('Category')" />
                            <p class="mt-1 text-gray-700">
                                {{ $book->categories->pluck('name')->join(', ') ?: 'N/A' }}
                            </p>
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
                                <p class="mt-1 text-gray-700">{{ number_format($book->original_price ?? 0) }} VNĐ</p>
                            </div>
                            <div>
                                <x-input-label for="current_price" :value="__('Current price')" />
                                <p class="mt-1 text-gray-700">{{ number_format($book->current_price ?? 0) }} VNĐ</p>
                            </div>
                        </div>

                        <!-- Stock -->
                        <div>
                            <x-input-label for="stock" :value="__('Stock')" />
                            <p class="mt-1 text-gray-700">{{ $book->stock ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="bg-white rounded-lg shadow p-6 space-y-6 mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-3">
                            <i class="fas fa-toggle-on mr-2 text-purple-500"></i>Trạng thái
                        </h3>
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <p class="mt-1 text-gray-700">{{ $book->status ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
