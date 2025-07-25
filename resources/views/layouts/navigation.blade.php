<!-- Sidebar -->
<div id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <!-- Sidebar Header -->
    <div class="flex items-center justify-between h-16 px-6 bg-gray-800">
        <h1 class="text-xl font-bold flex items-center">
            <i class="fas fa-book-open mr-2"></i>
            BookStore Admin
        </h1>
        <button id="closeSidebar" class="lg:hidden text-white hover:text-gray-300 focus:outline-none">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Navigation Menu -->
    <nav x-data="{ open: false }" class="mt-8 h-[calc(100vh-6rem)] overflow-y-auto scrollbar-hidden">
        <!-- Overview Section -->
        <div class="px-6 py-3">
            <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide">{{ __('Overview') }}</h2>
        </div>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <i class="fas fa-tachometer-alt mr-3"></i>
            {{ __('Dashboard') }}
        </x-nav-link>

        <!-- Management Section -->
        <div class="px-6 py-3 mt-4">
            <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide">{{ __('Management') }}</h2>
        </div>
        <x-nav-link :href="route('books.index')" :active="request()->routeIs('books.*')">
            <i class="fas fa-book mr-3"></i>
            {{ __('Books') }}
        </x-nav-link>
        <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
            <i class="fas fa-list mr-3"></i>
            {{ __('Categories') }}
        </x-nav-link>
        <x-nav-link :href="url('#')" :active="request()->routeIs('v')">
            <i class="fas fa-user-edit mr-3"></i>
            {{ __('Authors') }}
        </x-nav-link>
        <x-nav-link :href="url('#')" :active="request()->routeIs('v')">
            <i class="fas fa-shopping-cart mr-3"></i>
            {{ __('Orders') }}
        </x-nav-link>
        <x-nav-link :href="url('#')" :active="request()->routeIs('v')">
            <i class="fas fa-users mr-3"></i>
            {{ __('Customers') }}
        </x-nav-link>

        <!-- Report Section -->
        <div class="px-6 py-3 mt-4">
            <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide">{{ __('Reports') }}</h2>
        </div>
        <x-nav-link :href="url('#')" :active="request()->routeIs('v')">
            <i class="fas fa-chart-bar mr-3"></i>
            {{ __('Statistics') }}
        </x-nav-link>
        <x-nav-link :href="url('#')" :active="request()->routeIs('v')">
            <i class="fas fa-file-alt mr-3"></i>
            {{ __('Reports') }}
        </x-nav-link>

        <!-- System Section -->
        <div class="px-6 py-3 mt-4">
            <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide">{{ __('System') }}</h2>
        </div>
        <x-nav-link :href="route('setting')" :active="request()->routeIs('setting')">
            <i class="fas fa-cog mr-3"></i>
            {{ __('Settings') }}
        </x-nav-link>
        <x-nav-link :href="url('#')" :active="request()->routeIs('v')">
            <i class="fas fa-shield-alt mr-3"></i>
            {{ __('Permissions') }}
        </x-nav-link>
    </nav>
</div>
