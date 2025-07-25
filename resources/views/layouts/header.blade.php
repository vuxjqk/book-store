<!-- Header -->
<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="flex justify-between items-center px-6 py-4">
        <!-- Left Section -->
        <div class="flex items-center">
            <button id="toggleSidebar" class="lg:hidden text-gray-500 hover:text-gray-700 mr-4 focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
            @isset($header)
                {{ $header }}
            @endisset
        </div>

        <!-- Right Section -->
        <div class="flex items-center space-x-4">
            <!-- Search Bar -->
            <div class="relative hidden md:block">
                <input type="text" placeholder="{{ __('Search...') }}"
                    class="w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    aria-label="{{ __('Search') }}">
                <i class="fas fa-search absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>

            <!-- Notifications -->
            <div class="relative">
                <button class="text-gray-500 hover:text-gray-700 relative focus:outline-none"
                    aria-label="{{ __('Notifications') }}">
                    <i class="fas fa-bell text-xl"></i>
                    <span
                        class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </button>
            </div>

            <div class="flex items-center">
                <x-theme-toggle />
            </div>

            <!-- User Menu -->
            <div class="relative">
                <button id="userMenuButton"
                    class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none"
                    aria-label="{{ __('User Menu') }}">
                    <img src="{{ Auth::user()->avatar }}" alt="{{ __('User Avatar') }}" class="w-8 h-8 rounded-full">
                    <span class="hidden md:block">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </button>

                <div id="userMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden">
                    <a href="{{ route('profile.edit') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-user mr-2"></i>
                        {{ __('Profile') }}
                    </a>
                    <a href="{{ route('setting') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-cog mr-2"></i>
                        {{ __('Settings') }}
                    </a>
                    <hr class="my-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
