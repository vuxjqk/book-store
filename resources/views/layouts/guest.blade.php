<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/style.css'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-book text-3xl text-blue-600 mr-3"></i>
                    <h1 class="text-2xl font-bold text-gray-800">BookStore</h1>
                </div>
                @php
                    function isActive($active)
                    {
                        return $active
                            ? 'text-blue-600 font-semibold'
                            : 'text-gray-600 hover:text-blue-600 transition duration-300';
                    }
                @endphp
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ url('/') }}" class="{{ isActive(request()->is('/')) }}">Trang chủ</a>
                    <a href="{{ route('home.index') }}" class="{{ isActive(request()->routeIs('home.index')) }}">Tất cả
                        sách</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 transition duration-300">Danh mục</a>
                    <a href="{{ route('home.promotions') }}"
                        class="{{ isActive(request()->routeIs('home.promotions')) }}">Khuyến mãi</a>
                    <a href="{{ route('home.contact') }}"
                        class="{{ isActive(request()->routeIs('home.contact')) }}">Liên
                        hệ</a>
                </nav>
                <div class="flex items-center space-x-4">
                    <div class="relative hidden md:block">
                        <input type="text" placeholder="Tìm kiếm sách..."
                            class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:border-blue-500 w-64">
                        <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                    </div>
                    <a href="{{ route('cart.index') }}" class="relative">
                        <i class="fas fa-shopping-cart text-2xl {{ isActive(request()->routeIs('cart.index')) }}"></i>
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center"
                            id="cartCount">0</span>
                    </a>
                    <i class="fas fa-user text-2xl text-gray-600 hover:text-blue-600 cursor-pointer"></i>
                    <div class="md:hidden">
                        <i class="fas fa-bars text-2xl text-gray-600 cursor-pointer"></i>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 mt-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-book text-2xl text-blue-400 mr-3"></i>
                        <h4 class="text-xl font-bold">BookStore</h4>
                    </div>
                    <p class="text-gray-400 mb-4">Nơi kết nối bạn với tri thức và những cuốn sách hay nhất</p>
                    <div class="flex space-x-4">
                        <i class="fab fa-facebook-f text-xl hover:text-blue-400 cursor-pointer"></i>
                        <i class="fab fa-twitter text-xl hover:text-blue-400 cursor-pointer"></i>
                        <i class="fab fa-instagram text-xl hover:text-blue-400 cursor-pointer"></i>
                        <i class="fab fa-youtube text-xl hover:text-blue-400 cursor-pointer"></i>
                    </div>
                </div>
                <div>
                    <h5 class="text-lg font-semibold mb-4">Danh Mục</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Văn học</a></li>
                        <li><a href="#" class="hover:text-white">Khoa học</a></li>
                        <li><a href="#" class="hover:text-white">Kỹ năng sống</a></li>
                        <li><a href="#" class="hover:text-white">Thiếu nhi</a></li>
                        <li><a href="#" class="hover:text-white">Giáo dục</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-lg font-semibold mb-4">Hỗ Trợ</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Liên hệ</a></li>
                        <li><a href="#" class="hover:text-white">Câu hỏi thường gặp</a></li>
                        <li><a href="#" class="hover:text-white">Chính sách đổi trả</a></li>
                        <li><a href="#" class="hover:text-white">Phương thức thanh toán</a></li>
                        <li><a href="#" class="hover:text-white">Vận chuyển</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-lg font-semibold mb-4">Liên Hệ</h5>
                    <div class="space-y-2 text-gray-400">
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-3"></i>
                            <span>123 Đường ABC, Quận 1, TP.HCM</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone mr-3"></i>
                            <span>0123 456 789</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-envelope mr-3"></i>
                            <span>info@bookstore.com</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>© 2025 BookStore. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')

    <script>
        // Simple mobile menu toggle (you can enhance this)
        document.querySelector('.fa-bars').addEventListener('click', function() {
            // Add mobile menu functionality here
            console.log('Mobile menu clicked');
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>
