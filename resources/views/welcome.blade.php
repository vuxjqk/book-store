<x-guest-layout>
    <!-- Hero Section -->
    <section class="hero-gradient text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-5xl font-bold mb-6">Khám Phá Thế Giới Sách</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Hàng ngàn đầu sách đa dạng từ văn học, khoa học đến kỹ năng sống.
                Tìm kiếm cuốn sách yêu thích của bạn ngay hôm nay!</p>
            <div class="flex justify-center space-x-4">
                <button
                    class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition duration-300">
                    <i class="fas fa-search mr-2"></i>Khám phá ngay
                </button>
                <button
                    class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-600 transition duration-300">
                    <i class="fas fa-gift mr-2"></i>Ưu đãi đặc biệt
                </button>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-12 text-gray-800">Danh Mục Sách</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                <div class="category-card bg-white p-6 rounded-lg shadow-md text-center cursor-pointer">
                    <i class="fas fa-heart text-4xl text-red-500 mb-4"></i>
                    <h4 class="font-semibold text-gray-800">Văn học</h4>
                </div>
                <div class="category-card bg-white p-6 rounded-lg shadow-md text-center cursor-pointer">
                    <i class="fas fa-flask text-4xl text-green-500 mb-4"></i>
                    <h4 class="font-semibold text-gray-800">Khoa học</h4>
                </div>
                <div class="category-card bg-white p-6 rounded-lg shadow-md text-center cursor-pointer">
                    <i class="fas fa-graduation-cap text-4xl text-blue-500 mb-4"></i>
                    <h4 class="font-semibold text-gray-800">Giáo dục</h4>
                </div>
                <div class="category-card bg-white p-6 rounded-lg shadow-md text-center cursor-pointer">
                    <i class="fas fa-lightbulb text-4xl text-yellow-500 mb-4"></i>
                    <h4 class="font-semibold text-gray-800">Kỹ năng</h4>
                </div>
                <div class="category-card bg-white p-6 rounded-lg shadow-md text-center cursor-pointer">
                    <i class="fas fa-child text-4xl text-purple-500 mb-4"></i>
                    <h4 class="font-semibold text-gray-800">Thiếu nhi</h4>
                </div>
                <div class="category-card bg-white p-6 rounded-lg shadow-md text-center cursor-pointer">
                    <i class="fas fa-chart-line text-4xl text-indigo-500 mb-4"></i>
                    <h4 class="font-semibold text-gray-800">Kinh tế</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Books Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-12">
                <h3 class="text-3xl font-bold text-gray-800">Sách Nổi Bật</h3>
                <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold">Xem tất cả <i
                        class="fas fa-arrow-right ml-2"></i></a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Book Card 1 -->
                <div class="book-card bg-gray-50 rounded-lg overflow-hidden shadow-md">
                    <div class="h-64 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                        <i class="fas fa-book-open text-6xl text-white"></i>
                    </div>
                    <div class="p-6">
                        <h4 class="font-bold text-lg mb-2 text-gray-800">Đắc Nhân Tâm</h4>
                        <p class="text-gray-600 mb-2">Dale Carnegie</p>
                        <div class="flex items-center mb-3">
                            <div class="text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-gray-500 ml-2">(4.8)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-red-500 font-bold text-lg">89.000₫</span>
                                <span class="text-gray-400 line-through ml-2">120.000₫</span>
                            </div>
                            <button
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Book Card 2 -->
                <div class="book-card bg-gray-50 rounded-lg overflow-hidden shadow-md">
                    <div class="h-64 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                        <i class="fas fa-book-open text-6xl text-white"></i>
                    </div>
                    <div class="p-6">
                        <h4 class="font-bold text-lg mb-2 text-gray-800">Tư Duy Nhanh Và Chậm</h4>
                        <p class="text-gray-600 mb-2">Daniel Kahneman</p>
                        <div class="flex items-center mb-3">
                            <div class="text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="text-gray-500 ml-2">(4.3)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-red-500 font-bold text-lg">156.000₫</span>
                                <span class="text-gray-400 line-through ml-2">195.000₫</span>
                            </div>
                            <button
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Book Card 3 -->
                <div class="book-card bg-gray-50 rounded-lg overflow-hidden shadow-md">
                    <div class="h-64 bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-book-open text-6xl text-white"></i>
                    </div>
                    <div class="p-6">
                        <h4 class="font-bold text-lg mb-2 text-gray-800">Atomic Habits</h4>
                        <p class="text-gray-600 mb-2">James Clear</p>
                        <div class="flex items-center mb-3">
                            <div class="text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-gray-500 ml-2">(4.9)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-red-500 font-bold text-lg">142.000₫</span>
                                <span class="text-gray-400 line-through ml-2">180.000₫</span>
                            </div>
                            <button
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Book Card 4 -->
                <div class="book-card bg-gray-50 rounded-lg overflow-hidden shadow-md">
                    <div class="h-64 bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center">
                        <i class="fas fa-book-open text-6xl text-white"></i>
                    </div>
                    <div class="p-6">
                        <h4 class="font-bold text-lg mb-2 text-gray-800">Nhà Giả Kim</h4>
                        <p class="text-gray-600 mb-2">Paulo Coelho</p>
                        <div class="flex items-center mb-3">
                            <div class="text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-gray-500 ml-2">(4.7)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-red-500 font-bold text-lg">67.000₫</span>
                                <span class="text-gray-400 line-through ml-2">89.000₫</span>
                            </div>
                            <button
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Promotion Banner -->
    <section class="py-16 bg-gradient-to-r from-orange-400 to-red-500">
        <div class="container mx-auto px-4 text-center text-white">
            <h3 class="text-4xl font-bold mb-6">Khuyến Mãi Đặc Biệt</h3>
            <p class="text-xl mb-8">Giảm giá lên đến 50% cho tất cả sách văn học và kỹ năng sống</p>
            <div class="flex justify-center items-center space-x-8 mb-8">
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">15</div>
                    <div class="text-sm uppercase tracking-wide">Ngày</div>
                </div>
                <div class="text-4xl">:</div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">08</div>
                    <div class="text-sm uppercase tracking-wide">Giờ</div>
                </div>
                <div class="text-4xl">:</div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">23</div>
                    <div class="text-sm uppercase tracking-wide">Phút</div>
                </div>
                <div class="text-4xl">:</div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">45</div>
                    <div class="text-sm uppercase tracking-wide">Giây</div>
                </div>
            </div>
            <button
                class="bg-white text-orange-500 px-8 py-3 rounded-full font-bold hover:bg-gray-100 transition duration-300">
                <i class="fas fa-fire mr-2"></i>Mua Ngay
            </button>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <h3 class="text-3xl font-bold mb-6 text-gray-800">Đăng Ký Nhận Tin</h3>
                <p class="text-gray-600 mb-8">Nhận thông tin về sách mới, khuyến mãi đặc biệt và những cuốn sách hay
                    nhất</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <input type="email" placeholder="Nhập email của bạn"
                        class="flex-1 px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500">
                    <button
                        class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                        <i class="fas fa-envelope mr-2"></i>Đăng ký
                    </button>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
