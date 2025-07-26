<x-guest-layout>
    <!-- Breadcrumb -->
    <nav class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <div class="flex items-center space-x-2 text-gray-600">
                <a href="index.php" class="hover:text-blue-600">Trang chủ</a>
                <i class="fas fa-chevron-right text-sm"></i>
                <span class="text-blue-600">Tất cả sách</span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6 overflow-y-auto" style="max-height: calc(100vh - 200px);">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Bộ lọc</h3>
                        <button id="clearFilters" class="text-red-500 hover:text-red-700 text-sm">
                            <i class="fas fa-times mr-1"></i>Xóa tất cả
                        </button>
                    </div>

                    <!-- Active Filters -->
                    <div id="activeFilters" class="mb-6 hidden">
                        <h4 class="font-semibold mb-3 text-gray-700">Bộ lọc đang áp dụng:</h4>
                        <div class="flex flex-wrap gap-2" id="filterTags"></div>
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold mb-3 text-gray-700">Danh mục</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="category-filter mr-2" value="van-hoc">
                                <span class="text-gray-600">Văn học</span>
                                <span class="ml-auto text-gray-400">(45)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="category-filter mr-2" value="khoa-hoc">
                                <span class="text-gray-600">Khoa học</span>
                                <span class="ml-auto text-gray-400">(28)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="category-filter mr-2" value="ky-nang">
                                <span class="text-gray-600">Kỹ năng sống</span>
                                <span class="ml-auto text-gray-400">(67)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="category-filter mr-2" value="thieu-nhi">
                                <span class="text-gray-600">Thiếu nhi</span>
                                <span class="ml-auto text-gray-400">(34)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="category-filter mr-2" value="giao-duc">
                                <span class="text-gray-600">Giáo dục</span>
                                <span class="ml-auto text-gray-400">(52)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="category-filter mr-2" value="kinh-te">
                                <span class="text-gray-600">Kinh tế</span>
                                <span class="ml-auto text-gray-400">(39)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Price Range Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold mb-3 text-gray-700">Khoảng giá</h4>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2">
                                <input type="range" id="priceRange" class="price-slider" min="0" max="500000"
                                    value="500000">
                            </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>0₫</span>
                                <span id="priceValue">500,000₫</span>
                            </div>
                            <div class="flex space-x-2">
                                <input type="number" id="minPrice" placeholder="Từ"
                                    class="w-1/2 px-3 py-2 border border-gray-300 rounded text-sm">
                                <input type="number" id="maxPrice" placeholder="Đến"
                                    class="w-1/2 px-3 py-2 border border-gray-300 rounded text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Rating Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold mb-3 text-gray-700">Đánh giá</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="rating" value="5" class="mr-2">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="ml-2 text-gray-600">5 sao</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="rating" value="4" class="mr-2">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="ml-2 text-gray-600">4 sao trở lên</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="rating" value="3" class="mr-2">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="ml-2 text-gray-600">3 sao trở lên</span>
                            </label>
                        </div>
                    </div>

                    <!-- Publisher Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold mb-3 text-gray-700">Nhà xuất bản</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="publisher-filter mr-2" value="nxb-tre">
                                <span class="text-gray-600">NXB Trẻ</span>
                                <span class="ml-auto text-gray-400">(23)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="publisher-filter mr-2" value="nxb-kim-dong">
                                <span class="text-gray-600">NXB Kim Đồng</span>
                                <span class="ml-auto text-gray-400">(18)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="publisher-filter mr-2" value="nxb-giao-duc">
                                <span class="text-gray-600">NXB Giáo dục</span>
                                <span class="ml-auto text-gray-400">(31)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="publisher-filter mr-2" value="nxb-lao-dong">
                                <span class="text-gray-600">NXB Lao Động</span>
                                <span class="ml-auto text-gray-400">(15)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Language Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold mb-3 text-gray-700">Ngôn ngữ</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="language-filter mr-2" value="vi">
                                <span class="text-gray-600">Tiếng Việt</span>
                                <span class="ml-auto text-gray-400">(156)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="language-filter mr-2" value="en">
                                <span class="text-gray-600">Tiếng Anh</span>
                                <span class="ml-auto text-gray-400">(89)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="language-filter mr-2" value="other">
                                <span class="text-gray-600">Khác</span>
                                <span class="ml-auto text-gray-400">(12)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Availability Filter -->
                    <div class="mb-6">
                        <h4 class="font-semibold mb-3 text-gray-700">Tình trạng</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="availability-filter mr-2" value="in-stock">
                                <span class="text-gray-600">Còn hàng</span>
                                <span class="ml-auto text-gray-400">(234)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="availability-filter mr-2" value="pre-order">
                                <span class="text-gray-600">Đặt trước</span>
                                <span class="ml-auto text-gray-400">(23)</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:w-3/4">
                <!-- Top Bar -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <div class="flex flex-col sm:flex-row justify-end items-center">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <label class="text-gray-600">Sắp xếp:</label>
                                <select id="sortBy"
                                    class="px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                                    <option value="newest">Mới nhất</option>
                                    <option value="oldest">Cũ nhất</option>
                                    <option value="price-low">Giá thấp đến cao</option>
                                    <option value="price-high">Giá cao đến thấp</option>
                                    <option value="rating">Đánh giá cao nhất</option>
                                    <option value="popular">Phổ biến nhất</option>
                                </select>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button id="gridView" class="p-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    <i class="fas fa-th"></i>
                                </button>
                                <button id="listView"
                                    class="p-2 bg-gray-300 text-gray-600 rounded hover:bg-gray-400">
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Books Grid -->
                <div id="booksContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($books as $book)
                        <div class="book-card bg-white rounded-lg overflow-hidden shadow-md" data-category="ky-nang"
                            data-price="89000" data-rating="4.8" data-publisher="nxb-tre" data-language="vi"
                            data-availability="in-stock">
                            <div class="relative">
                                <div
                                    class="h-64 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                    @if ($book->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $book->images->first()->image_path) }}"
                                            alt="alt="{{ __('Book Image') }}" class="w-full h-full object-cover"">
                                    @else
                                        <i class="fas fa-book-open text-6xl text-white"></i>
                                    @endif
                                </div>
                                @if ($book->original_price > $book->current_price)
                                    <div
                                        class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">
                                        -{{ number_format((($book->original_price - $book->current_price) / $book->original_price) * 100, 1) }}%
                                    </div>
                                @endif
                                @if ($book->stock > 0)
                                    <div
                                        class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">
                                        Còn hàng
                                    </div>
                                @else
                                    <div
                                        class="absolute top-2 left-2 bg-orange-500 text-white text-xs px-2 py-1 rounded">
                                        Đặt trước
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h4
                                    class="font-bold text-lg mb-2 text-gray-800 hover:text-blue-600 cursor-pointer truncate max-w-xs">
                                    {{ $book->name }}
                                </h4>
                                <p class="text-gray-600 text-sm mb-2">{!! $book->author ?? '&nbsp;' !!}</p>
                                <p class="text-gray-500 text-xs mb-3">{!! $book->publishing_house ?? '&nbsp;' !!}</p>
                                <div class="flex items-center mb-3">
                                    <div class="text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <span class="text-gray-500 text-sm ml-2">(4.8) 89 đánh giá</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-red-500 font-bold text-lg">
                                            {{ number_format($book->current_price, 0, ',', '.') }}₫
                                        </span>
                                        <span class="block text-gray-400 line-through text-sm ml-2">
                                            @if ($book->original_price > $book->current_price)
                                                {{ number_format($book->original_price, 0, ',', '.') }}₫
                                            @else
                                                &nbsp;
                                            @endif
                                        </span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="p-2 text-gray-500 hover:text-red-500" title="Yêu thích">
                                            <i class="far fa-heart"></i>
                                        </button>
                                        <button data-id="{{ $book->id }}"
                                            class="add-to-cart-btn bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    {{ $books->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                    button.addEventListener('click', () => {
                        const bookId = button.dataset.id;
                        fetch('{{ route('cart.add') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute('content'),
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    book_id: bookId,
                                    quantity: 1
                                }),
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    location.reload();
                                } else {
                                    alert(data.message);
                                }
                            })
                            .catch(error => {
                                alert('{{ __('Unknown error while adding.') }}');
                                console.error(error);
                            });
                    });
                });
            });
        </script>
    @endpush
</x-guest-layout>
