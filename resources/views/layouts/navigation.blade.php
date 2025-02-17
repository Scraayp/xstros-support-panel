<nav x-data="{ open: false, showNotifications: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="/no-bg-logo.png" alt="Logo" class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('ticket.list')" :active="request()->routeIs('ticket.list')">
                        {{ __('Tickets') }}
                    </x-nav-link>
                    <x-nav-link :href="route('payments.invoice.list')" :active="request()->routeIs('payments.invoice.list')">
                        {{ __('Transactions') }}
                    </x-nav-link>
                    @if(Auth::user()->role == "Admin")
                        <x-nav-link :href="route('user.list')" :active="request()->routeIs('user.list')">
                            {{ __('Users') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Right Side (Notifications + User Dropdown) -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">
                <!-- Notifications Dropdown -->
                @include('layouts.partials.notif')

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-3 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition ease-in-out duration-150">
                            <!-- Profile Image -->
                            <img src="{{ Auth::user()->profile_image ?? '/pfp-placeholder.png' }}" alt="Profile Image"
                                 class="w-8 h-8 rounded-full border border-gray-300 dark:border-gray-700 shadow-sm">

                            <!-- User Info -->
                            <div class="flex flex-col items-start">
                                <span class="font-semibold text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</span>
                                <span class="text-xs font-medium
                    @if(Auth::user()->role === 'Admin') text-blue-500
                    @elseif(Auth::user()->role === 'Staff') text-green-500
                    @else text-gray-400
                    @endif">
                    {{ Auth::user()->role }}
                </span>
                            </div>

                            <!-- Dropdown Icon -->
                            <svg class="ml-2 -mr-0.5 h-4 w-4 text-gray-600 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Profile Link -->
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>{{ __('Profile') }}</span>
                        </x-dropdown-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="flex items-center space-x-3 px-4 py-2 hover:bg-red-100 dark:hover:bg-red-700 text-red-500"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"></path>
                                </svg>
                                <span>{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

            </div>

            <!-- Mobile Menu Button (Hamburger) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('ticket.list')" :active="request()->routeIs('ticket.list')">
                {{ __('Tickets') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('payments.invoice.list')" :active="request()->routeIs('payments.invoice.list', 'payments.invoice.show')">
                {{ __('Transactions') }}
            </x-responsive-nav-link>
            @if(Auth::user()->role == "Admin")
                <x-responsive-nav-link :href="route('user.list')" :active="request()->routeIs('user.list')">
                    {{ __('Users') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Mobile Notifications -->
        <div class="px-4 py-2 border-t border-gray-200 dark:border-gray-600">
            <span class="text-gray-700 dark:text-gray-300 font-medium">Notifications</span>
            @include('layouts.partials.notif')
        </div>

        <!-- Responsive User Dropdown -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                            this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
