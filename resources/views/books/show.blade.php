<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <!-- Breadcrumb -->
        <nav class="bg-gray-50 px-6 py-3 text-gray-700">
            <ol class="list-reset flex text-sm">
                <li><a href="#" class="text-blue-600 hover:text-blue-800">{{ __('Home') }}</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('books.index') }}"
                        class="text-blue-600 hover:text-blue-800">{{ __('Book Management') }}</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-500">{{ __('Book Details') }}</li>
            </ol>
        </nav>

        <!-- Main Content Area -->
        <main class="p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $book->name }}</h1>
                    <p class="text-gray-600 mt-1">{{ __('Detailed book information') }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('books.index') }}"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>{{ __('Back') }}
                    </a>
                    <a href="{{ route('books.edit', $book->id) }}"
                        class="px-4 py-2 text-white bg-yellow-600 rounded-lg hover:bg-yellow-700 transition-colors duration-200">
                        <i class="fas fa-edit mr-2"></i>{{ __('Edit') }}
                    </a>
                    <button type="button" onclick="printBook()"
                        class="px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-print mr-2"></i>{{ __('Print Information') }}
                    </button>
                </div>
            </div>

            <!-- Book Details -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Information -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow p-6 space-y-6">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-3">
                            <i class="fas fa-info-circle mr-2 text-blue-500"></i>{{ __('Basic Information') }}
                        </h3>

                        <!-- Book Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Book Title') }}</label>
                            <div class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                {{ $book->name }}
                            </div>
                        </div>

                        <!-- Author and Publishing House -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Author') }}</label>
                                <div
                                    class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                    {{ $book->author }}
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2">{{ __('Publishing House') }}</label>
                                <div
                                    class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                    {{ $book->publishing_house }}
                                </div>
                            </div>
                        </div>

                        <!-- Language -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Language') }}</label>
                            <div class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                {{ $book->language }}
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Description') }}</label>
                            <div
                                class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 min-h-[100px] whitespace-pre-wrap">
                                {{ $book->description ?? __('No description') }}
                            </div>
                        </div>

                        <!-- Categories -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Categories') }}</label>
                            <div class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                @if ($book->categories->count() > 0)
                                    {{ $book->categories->pluck('name')->implode(', ') }}
                                @else
                                    {{ __('Uncategorized') }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Technical Details -->
                    <div class="bg-white rounded-lg shadow p-6 space-y-6 mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-3">
                            <i class="fas fa-cogs mr-2 text-green-500"></i>{{ __('Technical Information') }}
                        </h3>

                        <!-- Page Number, Size, Year -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2">{{ __('Page Count') }}</label>
                                <div
                                    class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                    {{ number_format($book->page_number) }} {{ __('pages') }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Size') }}</label>
                                <div
                                    class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                    {{ $book->size }}
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2">{{ __('Publication Year') }}</label>
                                <div
                                    class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                    {{ \Carbon\Carbon::parse($book->year_of_publication)->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>

                        <!-- Cover Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Cover Type') }}</label>
                            <div class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @if ($book->cover_type == 'Softcover') bg-blue-100 text-blue-800
                                    @elseif($book->cover_type == 'Hardcover') bg-green-100 text-green-800
                                    @else bg-purple-100 text-purple-800 @endif">
                                    <i class="fas fa-book mr-1"></i>
                                    {{ $book->cover_type }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Book Images -->
                    @if ($book->images && $book->images->count() > 0)
                        <div class="bg-white rounded-lg shadow p-6 space-y-6 mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-3">
                                <i class="fas fa-images mr-2 text-indigo-500"></i>{{ __('Book Images') }}
                                ({{ $book->images->count() }} {{ __('images') }})
                            </h3>

                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach ($book->images as $index => $image)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $image->image_path) }}"
                                            alt="{{ __('Book Image') }} {{ $index + 1 }}"
                                            class="w-full h-48 object-cover rounded-lg shadow-sm cursor-pointer hover:shadow-md transition-shadow duration-200"
                                            onclick="openImageModal('{{ asset('storage/' . $image->image_path) }}', '{{ $book->name }}', {{ $index + 1 }})">
                                        <div
                                            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-200 rounded-lg flex items-center justify-center pointer-events-none">
                                            <i
                                                class="fas fa-search-plus text-white opacity-0 group-hover:opacity-100 text-2xl"></i>
                                        </div>
                                        <div
                                            class="absolute top-2 left-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                                            {{ $index + 1 }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Price and Stock -->
                    <div class="bg-white rounded-lg shadow p-6 space-y-6">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-3">
                            <i class="fas fa-dollar-sign mr-2 text-yellow-500"></i>{{ __('Price and Inventory') }}
                        </h3>

                        <!-- Prices -->
                        <div class="space-y-4">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2">{{ __('Original Price') }}</label>
                                <div
                                    class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 text-right">
                                    {{ number_format($book->original_price, 0, ',', '.') }} VNĐ
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2">{{ __('Current Price') }}</label>
                                <div
                                    class="w-full px-3 py-2 bg-green-50 border border-green-200 rounded-lg text-green-900 text-right font-semibold">
                                    {{ number_format($book->current_price, 0, ',', '.') }} VNĐ
                                </div>
                            </div>
                            @if ($book->original_price > $book->current_price)
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2">{{ __('Savings') }}</label>
                                    <div
                                        class="w-full px-3 py-2 bg-red-50 border border-red-200 rounded-lg text-red-900 text-right">
                                        {{ number_format($book->original_price - $book->current_price, 0, ',', '.') }}
                                        VNĐ
                                        ({{ number_format((($book->original_price - $book->current_price) / $book->original_price) * 100, 1) }}%)
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Stock -->
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2">{{ __('Stock Quantity') }}</label>
                            <div
                                class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 text-center">
                                <span
                                    class="text-2xl font-bold {{ $book->stock > 10 ? 'text-green-600' : ($book->stock > 0 ? 'text-yellow-600' : 'text-red-600') }}">
                                    {{ number_format($book->stock) }}
                                </span>
                                <span class="text-sm text-gray-500 block">{{ __('items') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="bg-white rounded-lg shadow p-6 space-y-6 mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-3">
                            <i class="fas fa-toggle-on mr-2 text-purple-500"></i>{{ __('Status') }}
                        </h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Book Status') }}</label>
                            <div class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg">
                                @php
                                    $statusConfig = [
                                        'active' => [
                                            'text' => __('Active'),
                                            'class' => 'bg-green-100 text-green-800',
                                            'icon' => 'fa-check-circle',
                                        ],
                                        'inactive' => [
                                            'text' => __('Inactive'),
                                            'class' => 'bg-yellow-100 text-yellow-800',
                                            'icon' => 'fa-pause-circle',
                                        ],
                                        'out_of_stock' => [
                                            'text' => __('Out of Stock'),
                                            'class' => 'bg-red-100 text-red-800',
                                            'icon' => 'fa-exclamation-circle',
                                        ],
                                        'discontinued' => [
                                            'text' => __('Discontinued'),
                                            'class' => 'bg-gray-100 text-gray-800',
                                            'icon' => 'fa-times-circle',
                                        ],
                                    ];
                                    $status = $statusConfig[$book->status] ?? [
                                        'text' => __('Unknown'),
                                        'class' => 'bg-gray-100 text-gray-800',
                                        'icon' => 'fa-question-circle',
                                    ];
                                @endphp
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $status['class'] }}">
                                    <i class="fas {{ $status['icon'] }} mr-1"></i>
                                    {{ $status['text'] }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-lg shadow p-6 space-y-6 mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-3">
                            <i class="fas fa-bolt mr-2 text-orange-500"></i>{{ __('Quick Actions') }}
                        </h3>

                        <div class="space-y-3">
                            <button type="button" onclick="addToCart({{ $book->id }})"
                                class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200 {{ $book->status != 'active' || $book->stock == 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                {{ $book->status != 'active' || $book->stock == 0 ? 'disabled' : '' }}>
                                <i class="fas fa-shopping-cart mr-2"></i>{{ __('Add to Cart') }}
                            </button>

                            <button type="button" onclick="shareBook({{ $book->id }})"
                                class="w-full px-4 py-2 text-blue-700 bg-blue-100 rounded-lg hover:bg-blue-200 transition-colors duration-200">
                                <i class="fas fa-share mr-2"></i>{{ __('Share') }}
                            </button>

                            <button type="button" onclick="addToWishlist({{ $book->id }})"
                                class="w-full px-4 py-2 text-red-700 bg-red-100 rounded-lg hover:bg-red-200 transition-colors duration-200">
                                <i class="fas fa-heart mr-2"></i>{{ __('Add to Wishlist') }}
                            </button>
                        </div>
                    </div>

                    <!-- Book Info Summary -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-lg p-6 mt-6">
                        <h4 class="font-semibold text-gray-900 mb-3">{{ __('Summary Information') }}</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ __('Book Code') }}:</span>
                                <span class="font-medium">#{{ str_pad($book->id, 6, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ __('Created At') }}:</span>
                                <span class="font-medium">{{ $book->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ __('Updated At') }}:</span>
                                <span class="font-medium">{{ $book->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Image Modal -->
        <div id="imageModal"
            class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex items-center justify-center p-4">
            <div class="max-w-4xl max-h-full bg-white rounded-lg overflow-hidden">
                <div class="flex items-center justify-between p-4 border-b">
                    <div>
                        <h3 id="modalImageTitle" class="text-lg font-semibold text-gray-900"></h3>
                        <p id="modalImageSubtitle" class="text-sm text-gray-600"></p>
                    </div>
                    <button onclick="closeImageModal()" class="text-gray-400 hover:text-gray-600"
                        aria-label="{{ __('Close') }}">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="p-4">
                    <img id="modalImage" src="" alt=""
                        class="max-w-full max-h-[70vh] mx-auto object-contain">
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    // Image Modal Functions
                    window.openImageModal = (imageSrc, bookName, imageIndex) => {
                        const modal = document.getElementById('imageModal');
                        const modalImage = document.getElementById('modalImage');
                        const modalTitle = document.getElementById('modalImageTitle');
                        const modalSubtitle = document.getElementById('modalImageSubtitle');

                        modalImage.src = imageSrc;
                        modalTitle.textContent = bookName;
                        modalSubtitle.textContent = `${'{{ __('Image') }}'} ${imageIndex}`;
                        modal.classList.remove('hidden');
                    };

                    window.closeImageModal = () => {
                        document.getElementById('imageModal').classList.add('hidden');
                    };

                    // Close Modal on Outside Click
                    document.getElementById('imageModal').addEventListener('click', (e) => {
                        if (e.target === e.currentTarget) {
                            closeImageModal();
                        }
                    });

                    // Close Modal on ESC Key
                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'Escape') {
                            closeImageModal();
                        }
                    });

                    // Print Function
                    window.printBook = () => {
                        window.print();
                    };

                    // Quick Action Functions
                    window.addToCart = (bookId) => {
                        alert('{{ __('Book added to cart!') }}');
                    };

                    window.shareBook = (bookId) => {
                        if (navigator.share) {
                            navigator.share({
                                title: '{{ $book->name }}',
                                text: `${'{{ __('Check out this book') }}'}: {{ $book->name }} - {{ $book->author }}`,
                                url: window.location.href
                            });
                        } else {
                            navigator.clipboard.writeText(window.location.href).then(() => {
                                alert('{{ __('Book link copied to clipboard!') }}');
                            });
                        }
                    };

                    window.addToWishlist = (bookId) => {
                        alert('{{ __('Book added to wishlist!') }}');
                    };
                });
            </script>
        @endpush
    </div>
</x-app-layout>
