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

    <!-- Styles -->
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
                <!-- Logo -->
                <div class="flex items-center">
                    <i class="fas fa-book text-3xl text-blue-600 mr-3"></i>
                    <h1 class="text-2xl font-bold text-gray-800">BookStore</h1>
                </div>

                <!-- Navigation -->
                @php
                    function isActive($active)
                    {
                        return $active
                            ? 'text-blue-600 font-semibold'
                            : 'text-gray-600 hover:text-blue-600 transition duration-300';
                    }
                @endphp
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ url('/') }}" class="{{ isActive(request()->is('/')) }}">{{ __('Home') }}</a>
                    <a href="{{ route('home.index') }}"
                        class="{{ isActive(request()->routeIs('home.index')) }}">{{ __('All Books') }}</a>
                    <a href="#"
                        class="text-gray-600 hover:text-blue-600 transition duration-300">{{ __('Categories') }}</a>
                    <a href="{{ route('home.promotions') }}"áo
                        class="{{ isActive(request()->routeIs('home.promotions')) }}">{{ __('Promotions') }}</a>
                    <a href="{{ route('home.contact') }}"
                        class="{{ isActive(request()->routeIs('home.contact')) }}">{{ __('Contact') }}</a>
                </nav>

                <!-- Right Section -->
                <div class="flex items-center space-x-4">
                    <!-- Search Bar -->
                    <div class="relative hidden md:block">
                        <input type="text" placeholder="{{ __('Search books...') }}"
                            class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:border-blue-500 w-64"
                            aria-label="{{ __('Search') }}">
                        <i class="fas fa-search absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="relative" aria-label="{{ __('Cart') }}">
                        <i class="fas fa-shopping-cart text-2xl {{ isActive(request()->routeIs('cart.index')) }}"></i>
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center"
                            id="cartCount">0</span>
                    </a>

                    <!-- User -->
                    <i class="fas fa-user text-2xl text-gray-600 hover:text-blue-600 cursor-pointer"
                        aria-label="{{ __('User') }}"></i>

                    <!-- Mobile Menu Toggle -->
                    <div class="md:hidden">
                        <i class="fas fa-bars text-2xl text-gray-600 cursor-pointer"
                            aria-label="{{ __('Menu') }}"></i>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 mt-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-book text-2xl text-blue-400 mr-3"></i>
                        <h4 class="text-xl font-bold">BookStore</h4>
                    </div>
                    <p class="text-gray-400 mb-4">{{ __('Connecting you with knowledge and the best books') }}</p>
                    <div class="flex space-x-4">
                        <i class="fab fa-facebook-f text-xl hover:text-blue-400 cursor-pointer"
                            aria-label="Facebook"></i>
                        <i class="fab fa-twitter text-xl hover:text-blue-400 cursor-pointer" aria-label="Twitter"></i>
                        <i class="fab fa-instagram text-xl hover:text-blue-400 cursor-pointer"
                            aria-label="Instagram"></i>
                        <i class="fab fa-youtube text-xl hover:text-blue-400 cursor-pointer" aria-label="YouTube"></i>
                    </div>
                </div>

                <!-- Categories -->
                <div>
                    <h5 class="text-lg font-semibold mb-4">{{ __('Categories') }}</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">{{ __('Literature') }}</a></li>
                        <li><a href="#" class="hover:text-white">{{ __('Science') }}</a></li>
                        <li><a href="#" class="hover:text-white">{{ __('Life Skills') }}</a></li>
                        <li><a href="#" class="hover:text-white">{{ __('Children') }}</a></li>
                        <li><a href="#" class="hover:text-white">{{ __('Education') }}</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h5 class="text-lg font-semibold mb-4">{{ __('Support') }}</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">{{ __('Contact') }}</a></li>
                        <li><a href="#" class="hover:text-white">{{ __('FAQs') }}</a></li>
                        <li><a href="#" class="hover:text-white">{{ __('Return Policy') }}</a></li>
                        <li><a href="#" class="hover:text-white">{{ __('Payment Methods') }}</a></li>
                        <li><a href="#" class="hover:text-white">{{ __('Shipping') }}</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h5 class="text-lg font-semibold mb-4">{{ __('Contact') }}</h5>
                    <div class="space-y-2 text-gray-400">
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-3"></i>
                            <span>123 ABC Street, District 1, HCMC</span>
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
                <p>© 2025 BookStore. {{ __('All rights reserved.') }}</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mobile Menu Toggle
            document.querySelector('.fa-bars').addEventListener('click', () => {
                console.log('Mobile menu clicked');
                // Add mobile menu functionality here
            });

            // Smooth Scrolling for Anchor Links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', (e) => {
                    e.preventDefault();
                    const target = document.querySelector(anchor.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
