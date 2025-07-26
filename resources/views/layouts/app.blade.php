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

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">
        <!-- Sidebar -->
        @include('layouts.navigation')

        <!-- Main Content -->
        <div id="main-content" class="flex-1 lg:ml-64 content-transition">
            <!-- Page Header -->
            @include('layouts.header')

            <!-- Page Content -->
            <main class="h-[calc(100vh-5.041875rem)] overflow-y-auto scrollbar-hidden">
                {{ $slot }}
            </main>
        </div>

        <!-- Mobile Backdrop -->
        <div id="backdrop" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>
    </div>

    <!-- Scripts -->
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // DOM Elements
            const elements = {
                sidebar: document.getElementById('sidebar'),
                toggleBtn: document.getElementById('toggleSidebar'),
                closeBtn: document.getElementById('closeSidebar'),
                backdrop: document.getElementById('backdrop'),
                userMenuButton: document.getElementById('userMenuButton'),
                userMenu: document.getElementById('userMenu')
            };

            // Sidebar Toggle Functionality
            const toggleSidebar = () => {
                elements.sidebar.classList.toggle('-translate-x-full');
                elements.backdrop.classList.toggle('hidden');
            };

            // Close Sidebar
            const closeSidebar = () => {
                elements.sidebar.classList.add('-translate-x-full');
                elements.backdrop.classList.add('hidden');
            };

            // Event Listeners for Sidebar
            elements.toggleBtn?.addEventListener('click', toggleSidebar);
            elements.closeBtn?.addEventListener('click', closeSidebar);
            elements.backdrop?.addEventListener('click', closeSidebar);

            // User Menu Toggle
            elements.userMenuButton?.addEventListener('click', () => {
                elements.userMenu.classList.toggle('hidden');
            });

            // Close User Menu on Outside Click
            document.addEventListener('click', (event) => {
                if (!elements.userMenuButton?.contains(event.target) &&
                    !elements.userMenu?.contains(event.target)) {
                    elements.userMenu.classList.add('hidden');
                }
            });

            // Handle Window Resize
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    elements.sidebar.classList.remove('-translate-x-full');
                    elements.backdrop.classList.add('hidden');
                } else {
                    elements.sidebar.classList.add('-translate-x-full');
                    elements.backdrop.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>
