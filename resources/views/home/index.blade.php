<x-guest-layout>
    @php
        // Hàm format tiền tệ
        function formatCurrency($amount)
        {
            return number_format($amount, 0, ',', '.');
        }

        // Hàm tính phần trăm giảm giá
        function calculateDiscount($original, $current)
        {
            if ($original > 0 && $current < $original) {
                return round((($original - $current) / $original) * 100, 1);
            }
            return 0;
        }
    @endphp

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
                <div class="bg-white rounded-lg shadow-md p-6 filter-sidebar">
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
                    <div class="flex flex-col sm:flex-row justify-between items-center">
                        <div class="flex items-center mb-4 sm:mb-0">
                            <span class="text-gray-600">Hiển thị <span class="font-semibold">1-12</span> của <span
                                    class="font-semibold">257</span> kết quả</span>
                        </div>
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
                                    <i class="fas fa-book-open text-6xl text-white"></i>
                                </div>
                                <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">
                                    -{{ calculateDiscount($book->original_price, $book->current_price) }}%
                                </div>
                                <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">
                                    {{ $book->status }}
                                </div>
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold text-lg mb-2 text-gray-800 hover:text-blue-600 cursor-pointer">
                                    <a href="{{ route('home.show', $book) }}">
                                        {{ $book->name }}
                                    </a>
                                </h4>
                                <p class="text-gray-600 text-sm mb-2">
                                    {{ $book->author }}
                                </p>
                                <p class="text-gray-500 text-xs mb-3">
                                    {{ $book->publishing_house }}
                                </p>
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
                                            {{ formatCurrency($book->current_price) }}₫
                                        </span>
                                        <span class="text-gray-400 line-through text-sm ml-2">
                                            {{ formatCurrency($book->original_price) }}₫
                                        </span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="p-2 text-gray-500 hover:text-red-500" title="Yêu thích">
                                            <i class="far fa-heart"></i>
                                        </button>
                                        <button onclick="add('{{ route('cart.store', $book) }}')"
                                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Book Card 1 -->
                    <div class="book-card bg-white rounded-lg overflow-hidden shadow-md" data-category="ky-nang"
                        data-price="89000" data-rating="4.8" data-publisher="nxb-tre" data-language="vi"
                        data-availability="in-stock">
                        <div class="relative">
                            <div
                                class="h-64 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                <i class="fas fa-book-open text-6xl text-white"></i>
                            </div>
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-26%
                            </div>
                            <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">Còn
                                hàng</div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg mb-2 text-gray-800 hover:text-blue-600 cursor-pointer">Đắc
                                Nhân Tâm</h4>
                            <p class="text-gray-600 text-sm mb-2">Dale Carnegie</p>
                            <p class="text-gray-500 text-xs mb-3">NXB Trẻ</p>
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
                                    <span class="text-red-500 font-bold text-lg">89.000₫</span>
                                    <span class="text-gray-400 line-through text-sm ml-2">120.000₫</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-500 hover:text-red-500" title="Yêu thích">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Book Card 2 -->
                    <div class="book-card bg-white rounded-lg overflow-hidden shadow-md" data-category="khoa-hoc"
                        data-price="156000" data-rating="4.3" data-publisher="nxb-giao-duc" data-language="vi"
                        data-availability="in-stock">
                        <div class="relative">
                            <div
                                class="h-64 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                                <i class="fas fa-book-open text-6xl text-white"></i>
                            </div>
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-20%
                            </div>
                            <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">Còn
                                hàng</div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg mb-2 text-gray-800 hover:text-blue-600 cursor-pointer">Tư Duy
                                Nhanh Và Chậm</h4>
                            <p class="text-gray-600 text-sm mb-2">Daniel Kahneman</p>
                            <p class="text-gray-500 text-xs mb-3">NXB Giáo dục</p>
                            <div class="flex items-center mb-3">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(4.3) 167 đánh giá</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-red-500 font-bold text-lg">156.000₫</span>
                                    <span class="text-gray-400 line-through text-sm ml-2">195.000₫</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-500 hover:text-red-500" title="Yêu thích">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Book Card 3 -->
                    <div class="book-card bg-white rounded-lg overflow-hidden shadow-md" data-category="ky-nang"
                        data-price="142000" data-rating="4.9" data-publisher="nxb-lao-dong" data-language="en"
                        data-availability="in-stock">
                        <div class="relative">
                            <div
                                class="h-64 bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                                <i class="fas fa-book-open text-6xl text-white"></i>
                            </div>
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-21%
                            </div>
                            <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">Còn
                                hàng</div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg mb-2 text-gray-800 hover:text-blue-600 cursor-pointer">Atomic
                                Habits</h4>
                            <p class="text-gray-600 text-sm mb-2">James Clear</p>
                            <p class="text-gray-500 text-xs mb-3">NXB Lao Động</p>
                            <div class="flex items-center mb-3">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(4.9) 445 đánh giá</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-red-500 font-bold text-lg">142.000₫</span>
                                    <span class="text-gray-400 line-through text-sm ml-2">180.000₫</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-500 hover:text-red-500" title="Yêu thích">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Book Card 4 -->
                    <div class="book-card bg-white rounded-lg overflow-hidden shadow-md" data-category="van-hoc"
                        data-price="67000" data-rating="4.7" data-publisher="nxb-tre" data-language="vi"
                        data-availability="in-stock">
                        <div class="relative">
                            <div
                                class="h-64 bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center">
                                <i class="fas fa-book-open text-6xl text-white"></i>
                            </div>
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-25%
                            </div>
                            <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">Còn
                                hàng</div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg mb-2 text-gray-800 hover:text-blue-600 cursor-pointer">Nhà Giả
                                Kim</h4>
                            <p class="text-gray-600 text-sm mb-2">Paulo Coelho</p>
                            <p class="text-gray-500 text-xs mb-3">NXB Trẻ</p>
                            <div class="flex items-center mb-3">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(4.7) 623 đánh giá</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-red-500 font-bold text-lg">67.000₫</span>
                                    <span class="text-gray-400 line-through text-sm ml-2">89.000₫</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-500 hover:text-red-500" title="Yêu thích">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Book Card 5 -->
                    <div class="book-card bg-white rounded-lg overflow-hidden shadow-md" data-category="thieu-nhi"
                        data-price="45000" data-rating="4.5" data-publisher="nxb-kim-dong" data-language="vi"
                        data-availability="in-stock">
                        <div class="relative">
                            <div
                                class="h-64 bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                                <i class="fas fa-book-open text-6xl text-white"></i>
                            </div>
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-18%
                            </div>
                            <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">Còn
                                hàng</div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg mb-2 text-gray-800 hover:text-blue-600 cursor-pointer">
                                Doraemon - Truyện Dài</h4>
                            <p class="text-gray-600 text-sm mb-2">Fujiko F. Fujio</p>
                            <p class="text-gray-500 text-xs mb-3">NXB Kim Đồng</p>
                            <div class="flex items-center mb-3">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(4.5) 234 đánh giá</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-red-500 font-bold text-lg">45.000₫</span>
                                    <span class="text-gray-400 line-through text-sm ml-2">55.000₫</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-500 hover:text-red-500" title="Yêu thích">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Book Card 6 -->
                    <div class="book-card bg-white rounded-lg overflow-hidden shadow-md" data-category="kinh-te"
                        data-price="178000" data-rating="4.6" data-publisher="nxb-lao-dong" data-language="vi"
                        data-availability="in-stock">
                        <div class="relative">
                            <div
                                class="h-64 bg-gradient-to-br from-indigo-400 to-purple-600 flex items-center justify-center">
                                <i class="fas fa-book-open text-6xl text-white"></i>
                            </div>
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-15%
                            </div>
                            <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">Còn
                                hàng</div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg mb-2 text-gray-800 hover:text-blue-600 cursor-pointer">Bộ Óc
                                Triệu Đô</h4>
                            <p class="text-gray-600 text-sm mb-2">Steven J. Scott</p>
                            <p class="text-gray-500 text-xs mb-3">NXB Lao Động</p>
                            <div class="flex items-center mb-3">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(4.6) 178 đánh giá</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-red-500 font-bold text-lg">178.000₫</span>
                                    <span class="text-gray-400 line-through text-sm ml-2">210.000₫</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-500 hover:text-red-500" title="Yêu thích">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Book Card 7 -->
                    <div class="book-card bg-white rounded-lg overflow-hidden shadow-md" data-category="giao-duc"
                        data-price="95000" data-rating="4.4" data-publisher="nxb-giao-duc" data-language="vi"
                        data-availability="pre-order">
                        <div class="relative">
                            <div
                                class="h-64 bg-gradient-to-br from-teal-400 to-blue-500 flex items-center justify-center">
                                <i class="fas fa-book-open text-6xl text-white"></i>
                            </div>
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-22%
                            </div>
                            <div class="absolute top-2 left-2 bg-orange-500 text-white text-xs px-2 py-1 rounded">Đặt
                                trước</div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg mb-2 text-gray-800 hover:text-blue-600 cursor-pointer">Học
                                Tiếng Anh Hiệu Quả</h4>
                            <p class="text-gray-600 text-sm mb-2">Nguyễn Văn A</p>
                            <p class="text-gray-500 text-xs mb-3">NXB Giáo dục</p>
                            <div class="flex items-center mb-3">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(4.4) 256 đánh giá</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-red-500 font-bold text-lg">95.000₫</span>
                                    <span class="text-gray-400 line-through text-sm ml-2">122.000₫</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-500 hover:text-red-500" title="Yêu thích">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Book Card 8 -->
                    <div class="book-card bg-white rounded-lg overflow-hidden shadow-md" data-category="van-hoc"
                        data-price="123000" data-rating="4.8" data-publisher="nxb-tre" data-language="vi"
                        data-availability="in-stock">
                        <div class="relative">
                            <div
                                class="h-64 bg-gradient-to-br from-pink-400 to-red-500 flex items-center justify-center">
                                <i class="fas fa-book-open text-6xl text-white"></i>
                            </div>
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-19%
                            </div>
                            <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">Còn
                                hàng</div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg mb-2 text-gray-800 hover:text-blue-600 cursor-pointer">Tôi
                                Thấy Hoa Vàng Trên Cỏ Xanh</h4>
                            <p class="text-gray-600 text-sm mb-2">Nguyễn Nhật Ánh</p>
                            <p class="text-gray-500 text-xs mb-3">NXB Trẻ</p>
                            <div class="flex items-center mb-3">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(4.8) 789 đánh giá</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-red-500 font-bold text-lg">123.000₫</span>
                                    <span class="text-gray-400 line-through text-sm ml-2">152.000₫</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-500 hover:text-red-500" title="Yêu thích">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Book Card 9 -->
                    <div class="book-card bg-white rounded-lg overflow-hidden shadow-md" data-category="khoa-hoc"
                        data-price="234000" data-rating="4.2" data-publisher="nxb-giao-duc" data-language="en"
                        data-availability="in-stock">
                        <div class="relative">
                            <div
                                class="h-64 bg-gradient-to-br from-gray-400 to-gray-600 flex items-center justify-center">
                                <i class="fas fa-book-open text-6xl text-white"></i>
                            </div>
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-12%
                            </div>
                            <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">Còn
                                hàng</div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg mb-2 text-gray-800 hover:text-blue-600 cursor-pointer">Vật Lý
                                Đại Cương</h4>
                            <p class="text-gray-600 text-sm mb-2">Halliday & Resnick</p>
                            <p class="text-gray-500 text-xs mb-3">NXB Giáo dục</p>
                            <div class="flex items-center mb-3">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(4.2) 156 đánh giá</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-red-500 font-bold text-lg">234.000₫</span>
                                    <span class="text-gray-400 line-through text-sm ml-2">267.000₫</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-500 hover:text-red-500" title="Yêu thích">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Book Card 10 -->
                    <div class="book-card bg-white rounded-lg overflow-hidden shadow-md" data-category="thieu-nhi"
                        data-price="38000" data-rating="4.6" data-publisher="nxb-kim-dong" data-language="vi"
                        data-availability="in-stock">
                        <div class="relative">
                            <div
                                class="h-64 bg-gradient-to-br from-orange-400 to-yellow-600 flex items-center justify-center">
                                <i class="fas fa-book-open text-6xl text-white"></i>
                            </div>
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-15%
                            </div>
                            <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">Còn
                                hàng</div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg mb-2 text-gray-800 hover:text-blue-600 cursor-pointer">Shin -
                                Cậu Bé Bút Chì</h4>
                            <p class="text-gray-600 text-sm mb-2">Yoshito Usui</p>
                            <p class="text-gray-500 text-xs mb-3">NXB Kim Đồng</p>
                            <div class="flex items-center mb-3">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(4.6) 312 đánh giá</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-red-500 font-bold text-lg">38.000₫</span>
                                    <span class="text-gray-400 line-through text-sm ml-2">45.000₫</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-500 hover:text-red-500" title="Yêu thích">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Book Card 11 -->
                    <div class="book-card bg-white rounded-lg overflow-hidden shadow-md" data-category="kinh-te"
                        data-price="165000" data-rating="4.5" data-publisher="nxb-tre" data-language="vi"
                        data-availability="in-stock">
                        <div class="relative">
                            <div
                                class="h-64 bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                <i class="fas fa-book-open text-6xl text-white"></i>
                            </div>
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-20%
                            </div>
                            <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">Còn
                                hàng</div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg mb-2 text-gray-800 hover:text-blue-600 cursor-pointer">Tư Duy
                                Kinh Tế</h4>
                            <p class="text-gray-600 text-sm mb-2">Nguyễn Văn B</p>
                            <p class="text-gray-500 text-xs mb-3">NXB Trẻ</p>
                            <div class="flex items-center mb-3">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(4.5) 198 đánh giá</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-red-500 font-bold text-lg">165.000₫</span>
                                    <span class="text-gray-400 line-through text-sm ml-2">206.000₫</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-500 hover:text-red-500" title="Yêu thích">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Book Card 12 -->
                    <div class="book-card bg-white rounded-lg overflow-hidden shadow-md" data-category="giao-duc"
                        data-price="82000" data-rating="4.3" data-publisher="nxb-giao-duc" data-language="vi"
                        data-availability="in-stock">
                        <div class="relative">
                            <div
                                class="h-64 bg-gradient-to-br from-teal-400 to-green-500 flex items-center justify-center">
                                <i class="fas fa-book-open text-6xl text-white"></i>
                            </div>
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-17%
                            </div>
                            <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">Còn
                                hàng</div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg mb-2 text-gray-800 hover:text-blue-600 cursor-pointer">Toán
                                Cao Cấp</h4>
                            <p class="text-gray-600 text-sm mb-2">Trần Văn C</p>
                            <p class="text-gray-500 text-xs mb-3">NXB Giáo dục</p>
                            <div class="flex items-center mb-3">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(4.3) 145 đánh giá</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-red-500 font-bold text-lg">82.000₫</span>
                                    <span class="text-gray-400 line-through text-sm ml-2">99.000₫</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-500 hover:text-red-500" title="Yêu thích">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        <button class="px-3 py-2 bg-gray-200 text-gray-600 rounded hover:bg-gray-300" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-2 bg-blue-600 text-white rounded">1</button>
                        <button class="px-3 py-2 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">2</button>
                        <button class="px-3 py-2 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">3</button>
                        <button class="px-3 py-2 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">4</button>
                        <button class="px-3 py-2 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">5</button>
                        <span class="px-3 py-2 text-gray-600">...</span>
                        <button class="px-3 py-2 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">22</button>
                        <button class="px-3 py-2 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Filter functionality
            let activeFilters = {
                categories: [],
                publishers: [],
                languages: [],
                availability: [],
                minPrice: 0,
                maxPrice: 500000,
                rating: null
            };

            // Price range slider
            const priceRange = document.getElementById('priceRange');
            const priceValue = document.getElementById('priceValue');
            const minPriceInput = document.getElementById('minPrice');
            const maxPriceInput = document.getElementById('maxPrice');

            priceRange.addEventListener('input', function() {
                const value = parseInt(this.value);
                priceValue.textContent = value.toLocaleString() + '₫';
                activeFilters.maxPrice = value;
                applyFilters();
            });

            minPriceInput.addEventListener('input', function() {
                activeFilters.minPrice = parseInt(this.value) || 0;
                applyFilters();
            });

            maxPriceInput.addEventListener('input', function() {
                activeFilters.maxPrice = parseInt(this.value) || 500000;
                applyFilters();
            });

            // Category filters
            document.querySelectorAll('.category-filter').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        activeFilters.categories.push(this.value);
                    } else {
                        activeFilters.categories = activeFilters.categories.filter(cat => cat !== this.value);
                    }
                    applyFilters();
                });
            });

            // Publisher filters
            document.querySelectorAll('.publisher-filter').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        activeFilters.publishers.push(this.value);
                    } else {
                        activeFilters.publishers = activeFilters.publishers.filter(pub => pub !== this.value);
                    }
                    applyFilters();
                });
            });

            // Language filters
            document.querySelectorAll('.language-filter').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        activeFilters.languages.push(this.value);
                    } else {
                        activeFilters.languages = activeFilters.languages.filter(lang => lang !== this.value);
                    }
                    applyFilters();
                });
            });

            // Availability filters
            document.querySelectorAll('.availability-filter').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        activeFilters.availability.push(this.value);
                    } else {
                        activeFilters.availability = activeFilters.availability.filter(avail => avail !== this
                            .value);
                    }
                    applyFilters();
                });
            });

            // Rating filters
            document.querySelectorAll('input[name="rating"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    activeFilters.rating = parseFloat(this.value);
                    applyFilters();
                });
            });

            // Apply filters function
            function applyFilters() {
                const books = document.querySelectorAll('.book-card');

                books.forEach(book => {
                    let shouldShow = true;

                    // Category filter
                    if (activeFilters.categories.length > 0) {
                        const bookCategory = book.dataset.category;
                        if (!activeFilters.categories.includes(bookCategory)) {
                            shouldShow = false;
                        }
                    }

                    // Publisher filter
                    if (activeFilters.publishers.length > 0) {
                        const bookPublisher = book.dataset.publisher;
                        if (!activeFilters.publishers.includes(bookPublisher)) {
                            shouldShow = false;
                        }
                    }

                    // Language filter
                    if (activeFilters.languages.length > 0) {
                        const bookLanguage = book.dataset.language;
                        if (!activeFilters.languages.includes(bookLanguage)) {
                            shouldShow = false;
                        }
                    }

                    // Availability filter
                    if (activeFilters.availability.length > 0) {
                        const bookAvailability = book.dataset.availability;
                        if (!activeFilters.availability.includes(bookAvailability)) {
                            shouldShow = false;
                        }
                    }

                    // Price filter
                    const bookPrice = parseInt(book.dataset.price);
                    if (bookPrice < activeFilters.minPrice || bookPrice > activeFilters.maxPrice) {
                        shouldShow = false;
                    }

                    // Rating filter
                    if (activeFilters.rating) {
                        const bookRating = parseFloat(book.dataset.rating);
                        if (bookRating < activeFilters.rating) {
                            shouldShow = false;
                        }
                    }

                    book.style.display = shouldShow ? 'block' : 'none';
                });

                updateActiveFilters();
            }

            // Update active filters display
            function updateActiveFilters() {
                const filterTags = document.getElementById('filterTags');
                const activeFiltersDiv = document.getElementById('activeFilters');

                filterTags.innerHTML = '';

                let hasFilters = false;

                // Add category tags
                activeFilters.categories.forEach(category => {
                    addFilterTag(getCategoryName(category), () => {
                        document.querySelector(`input[value="${category}"]`).checked = false;
                        activeFilters.categories = activeFilters.categories.filter(cat => cat !== category);
                        applyFilters();
                    });
                    hasFilters = true;
                });

                // Add publisher tags
                activeFilters.publishers.forEach(publisher => {
                    addFilterTag(getPublisherName(publisher), () => {
                        document.querySelector(`input[value="${publisher}"]`).checked = false;
                        activeFilters.publishers = activeFilters.publishers.filter(pub => pub !== publisher);
                        applyFilters();
                    });
                    hasFilters = true;
                });

                // Add language tags
                activeFilters.languages.forEach(language => {
                    addFilterTag(getLanguageName(language), () => {
                        document.querySelector(`input[value="${language}"]`).checked = false;
                        activeFilters.languages = activeFilters.languages.filter(lang => lang !== language);
                        applyFilters();
                    });
                    hasFilters = true;
                });

                // Add availability tags
                activeFilters.availability.forEach(availability => {
                    addFilterTag(getAvailabilityName(availability), () => {
                        document.querySelector(`input[value="${availability}"]`).checked = false;
                        activeFilters.availability = activeFilters.availability.filter(avail => avail !==
                            availability);
                        applyFilters();
                    });
                    hasFilters = true;
                });

                // Add price range tag
                if (activeFilters.minPrice > 0 || activeFilters.maxPrice < 500000) {
                    addFilterTag(`${activeFilters.minPrice.toLocaleString()}₫ - ${activeFilters.maxPrice.toLocaleString()}₫`,
                        () => {
                            activeFilters.minPrice = 0;
                            activeFilters.maxPrice = 500000;
                            priceRange.value = 500000;
                            priceValue.textContent = '500,000₫';
                            minPriceInput.value = '';
                            maxPriceInput.value = '';
                            applyFilters();
                        });
                    hasFilters = true;
                }

                // Add rating tag
                if (activeFilters.rating) {
                    addFilterTag(`${activeFilters.rating} sao trở lên`, () => {
                        document.querySelector(`input[value="${activeFilters.rating}"]`).checked = false;
                        activeFilters.rating = null;
                        applyFilters();
                    });
                    hasFilters = true;
                }

                activeFiltersDiv.style.display = hasFilters ? 'block' : 'none';
            }

            // Add filter tag
            function addFilterTag(text, removeCallback) {
                const filterTags = document.getElementById('filterTags');
                const tag = document.createElement('span');
                tag.className = 'filter-tag bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full flex items-center';
                tag.innerHTML = `
                ${text}
                <button class="ml-1 text-blue-600 hover:text-blue-800">
                    <i class="fas fa-times"></i>
                </button>
            `;

                tag.querySelector('button').addEventListener('click', removeCallback);
                filterTags.appendChild(tag);
            }

            // Get category name
            function getCategoryName(value) {
                const names = {
                    'van-hoc': 'Văn học',
                    'khoa-hoc': 'Khoa học',
                    'ky-nang': 'Kỹ năng sống',
                    'thieu-nhi': 'Thiếu nhi',
                    'giao-duc': 'Giáo dục',
                    'kinh-te': 'Kinh tế'
                };
                return names[value] || value;
            }

            // Get publisher name
            function getPublisherName(value) {
                const names = {
                    'nxb-tre': 'NXB Trẻ',
                    'nxb-kim-dong': 'NXB Kim Đồng',
                    'nxb-giao-duc': 'NXB Giáo dục',
                    'nxb-lao-dong': 'NXB Lao Động'
                };
                return names[value] || value;
            }

            // Get language name
            function getLanguageName(value) {
                const names = {
                    'vi': 'Tiếng Việt',
                    'en': 'Tiếng Anh',
                    'other': 'Khác'
                };
                return names[value] || value;
            }

            // Get availability name
            function getAvailabilityName(value) {
                const names = {
                    'in-stock': 'Còn hàng',
                    'pre-order': 'Đặt trước'
                };
                return names[value] || value;
            }

            // Clear all filters
            document.getElementById('clearFilters').addEventListener('click', function() {
                // Reset all checkboxes
                document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                    checkbox.checked = false;
                });

                // Reset radio buttons
                document.querySelectorAll('input[type="radio"]').forEach(radio => {
                    radio.checked = false;
                });

                // Reset price range
                priceRange.value = 500000;
                priceValue.textContent = '500,000₫';
                minPriceInput.value = '';
                maxPriceInput.value = '';

                // Reset active filters
                activeFilters = {
                    categories: [],
                    publishers: [],
                    languages: [],
                    availability: [],
                    minPrice: 0,
                    maxPrice: 500000,
                    rating: null
                };

                applyFilters();
            });

            // Sort functionality
            document.getElementById('sortBy').addEventListener('change', function() {
                const sortValue = this.value;
                const booksContainer = document.getElementById('booksContainer');
                const books = Array.from(booksContainer.querySelectorAll('.book-card'));

                books.sort((a, b) => {
                    switch (sortValue) {
                        case 'price-low':
                            return parseInt(a.dataset.price) - parseInt(b.dataset.price);
                        case 'price-high':
                            return parseInt(b.dataset.price) - parseInt(a.dataset.price);
                        case 'rating':
                            return parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating);
                        default:
                            return 0;
                    }
                });

                // Re-append sorted books
                books.forEach(book => booksContainer.appendChild(book));
            });

            // View toggle
            document.getElementById('gridView').addEventListener('click', function() {
                document.getElementById('booksContainer').className =
                    'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6';
                this.className = 'p-2 bg-blue-600 text-white rounded hover:bg-blue-700';
                document.getElementById('listView').className =
                    'p-2 bg-gray-300 text-gray-600 rounded hover:bg-gray-400';
            });

            document.getElementById('listView').addEventListener('click', function() {
                document.getElementById('booksContainer').className = 'grid grid-cols-1 gap-6';
                this.className = 'p-2 bg-blue-600 text-white rounded hover:bg-blue-700';
                document.getElementById('gridView').className =
                    'p-2 bg-gray-300 text-gray-600 rounded hover:bg-gray-400';
            });

            // Mobile filter toggle
            function toggleMobileFilters() {
                const sidebar = document.querySelector('.filter-sidebar');
                sidebar.classList.toggle('hidden');
            }

            function add(url) {
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        alert('Lỗi không xác định.');
                        console.error(error);
                    });
            }
        </script>
    @endpush
</x-guest-layout>
