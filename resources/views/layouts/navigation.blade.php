<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('storage/logo/logo-carzone.png') }}" alt="Car Zone Logo" class="block h-9 w-auto fill-current text-gray-800">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home.homepage')" :active="request()->routeIs('home.homepage')" class="text-green-500">
                        {{ __('Trang Chủ') }}
                    </x-nav-link>

                    <x-nav-link :href="route('cars.index')" :active="request()->routeIs('cars.index')" class="text-green-500">
                        {{ __('Sản Phẩm') }}
                    </x-nav-link>

                    <x-nav-link :href="route('schedule.form')" :active="request()->routeIs('schedule.form')" class="text-green-500">
                        {{ __('Đặt lịch') }}
                    </x-nav-link>

                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="text-green-500">
                        {{ __('Liên Hệ') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown + Cart -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                    {{ __('Mua Bán') }}
                </x-nav-link>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Trang cá nhân') }}
                        </x-dropdown-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Đăng xuất') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger menu (mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Car Zone') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('home.homepage')" :active="request()->routeIs('home.homepage')">
                {{ __('Trang chủ') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('cars.index')" :active="request()->routeIs('cars.index')">
                {{ __('Danh sách xe') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                {{ __('Liên hệ') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                {{ __('Giỏ hàng') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Trang cá nhân') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Đăng xuất') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
