<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center transition-transform hover:scale-105">
                        <img src="/no-bg-logo.png" alt="Logo" class="block h-10 w-auto" />
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ms-8 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="px-4 py-2 rounded-md transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>{{ __('Dashboard') }}</span>
                        </div>
                    </x-nav-link>

                    <x-nav-link :href="route('ticket.list')" :active="request()->routeIs('ticket.list')" class="px-4 py-2 rounded-md transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                            <span>{{ __('Tickets') }}</span>
                        </div>
                    </x-nav-link>

                    {{--                    <x-nav-link :href="route('payments.invoice.list')" :active="request()->routeIs('payments.invoice.list')" class="px-4 py-2 rounded-md transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-700">--}}
                    {{--                        <div class="flex items-center space-x-2">--}}
                    {{--                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">--}}
                    {{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>--}}
                    {{--                            </svg>--}}
                    {{--                            <span>{{ __('Transactions') }}</span>--}}
                    {{--                        </div>--}}
                    {{--                    </x-nav-link>--}}

                    @if(Auth::user()->role == "Admin")
                        <x-nav-link :href="route('user.list')" :active="request()->routeIs('user.list')" class="px-4 py-2 rounded-md transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <span>{{ __('Users') }}</span>
                            </div>
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Right Side (Notifications + User Dropdown) -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                <!-- Notifications Dropdown -->
                <div x-data="{ showNotifications: false }" class="relative">
                    <!-- Notification Bell Button -->
                    <button @click="showNotifications = !showNotifications" class="relative flex items-center p-2 rounded-full text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition-colors">
                        <!-- Bell Icon (Visible on All Devices) -->
                        <svg class="w-6 h-6 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V10a6 6 0 10-12 0v4c0 .386-.149.735-.405 1.005L4 17h5m4 0a3 3 0 01-6 0"></path>
                        </svg>

                        <!-- Notification Badge (Unread Count) -->
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute -top-1 -right-1 flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-600 rounded-full">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </button>

                    <!-- Dropdown Notification Panel -->
                    <div x-cloak x-show="showNotifications" @click.away="showNotifications = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-3 w-80 sm:w-96 max-w-xs sm:max-w-md bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden z-50">

                        <!-- Header -->
                        <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                            <span class="text-base font-semibold">Notifications ({{ auth()->user()->unreadNotifications->count() }})</span>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <form method="POST" action="{{ route('notifications.markAsRead') }}">
                                    @csrf
                                    <button type="submit" class="text-xs text-blue-500 hover:underline">
                                        Mark all as read
                                    </button>
                                </form>
                            @endif
                        </div>

                        <!-- Notification List -->
                        <div class="max-h-60 overflow-y-auto">
                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <div class="relative flex items-center px-4 py-3 space-x-3 hover:bg-gray-100 dark:hover:bg-gray-700 border-b border-gray-100 dark:border-gray-700 last:border-0">
                                    <!-- User Avatar Placeholder -->
                                    <div class="shrink-0">
                                        <img class="rounded-full w-10 h-10" src="{{ Auth::user()->avatar ?? '/pfp-placeholder.png' }}" alt="User Avatar">
                                    </div>

                                    <!-- Notification Content -->
                                    <div class="w-full">
                                        @if($notification->type === 'App\Notifications\ReplyNotification')
                                            <!-- Reply Notification -->
                                            <a href="{{ route('ticket.view', $notification->data['ticket_id']) }}" class="block text-gray-700 dark:text-gray-300 text-sm">
                                                <strong class="text-base">Ticket Reply</strong>
                                                <span class="block text-sm">There was a reply to your ticket (#{{ $notification->data['ticket_id'] }})</span>
                                            </a>
                                        @elseif($notification->type === 'App\Notifications\CloseNotifcation')
                                            <!-- Close Notification -->
                                            <a href="{{ route('ticket.view', $notification->data['ticket_id']) }}" class="block text-gray-700 dark:text-gray-300 text-sm">
                                                <strong class="text-base">Ticket Closed</strong>
                                                <span class="block text-sm">Your ticket (#{{ $notification->data['ticket_id'] }}) was closed by the support team.</span>
                                            </a>
                                        @elseif($notification->type === 'App\Notifications\AssignNotification')
                                            <a href="{{ route('ticket.view', $notification->data['ticket_id']) }}" class="block text-gray-700 dark:text-gray-300 text-sm">
                                                <strong class="text-base">Ticket Assigned</strong>
                                                <span class="block text-sm">You have been assigned a new ticket!</span>
                                            </a>
                                        @endif
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            {{ \Carbon\Carbon::parse($notification->data['timestamp'])->diffForHumans() }}
                                        </div>
                                    </div>

                                    <!-- Delete Notification Button -->
                                    <form method="POST" action="{{ route('notifications.delete', $notification->id) }}" class="ml-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-500 dark:text-gray-500 dark:hover:text-red-400 transition-colors">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="p-6 text-center text-sm text-gray-500 dark:text-gray-400">
                                    <svg class="mx-auto h-8 w-8 text-gray-400 dark:text-gray-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    No new notifications
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-3 px-3 py-2 border border-transparent text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition ease-in-out duration-150">
                            <!-- Profile Image -->
                            <div class="relative">
                                <img src="{{ Auth::user()->avatar ?? '/pfp-placeholder.png' }}" alt="Profile Image"
                                     class="w-8 h-8 rounded-full border border-gray-300 dark:border-gray-600 shadow-sm object-cover">

                                <!-- Status Indicator -->
                                <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-400 border-2 border-white dark:border-gray-800"></span>
                            </div>

                            <!-- User Info -->
                            <div class="flex flex-col items-start">
                                <span class="font-semibold text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</span>
                                <span class="text-xs font-medium
                                    @if(Auth::user()->role === 'Admin') text-blue-600 dark:text-blue-400
                                    @elseif(Auth::user()->role === 'Staff') text-green-600 dark:text-green-400
                                    @else text-gray-500 dark:text-gray-400
                                    @endif">
                                    {{ Auth::user()->role }}
                                </span>
                            </div>

                            <!-- Dropdown Icon -->
                            <svg class="ml-1 h-4 w-4 text-gray-600 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <!-- Profile Link -->
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>{{ __('Profile') }}</span>
                        </x-dropdown-link>


                        <div class="border-t border-gray-100 dark:border-gray-700"></div>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="flex items-center space-x-3 px-4 py-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 transition-colors"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span>{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Menu Button (Hamburger) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition duration-150 ease-in-out">
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
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>{{ __('Dashboard') }}</span>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('ticket.list')" :active="request()->routeIs('ticket.list')" class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                </svg>
                <span>{{ __('Tickets') }}</span>
            </x-responsive-nav-link>

            {{--            <x-responsive-nav-link :href="route('payments.invoice.list')" :active="request()->routeIs('payments.invoice.list', 'payments.invoice.show')" class="flex items-center space-x-2">--}}
            {{--                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">--}}
            {{--                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>--}}
            {{--                </svg>--}}
            {{--                <span>{{ __('Transactions') }}</span>--}}
            {{--            </x-responsive-nav-link>--}}

            @if(Auth::user()->role == "Admin")
                <x-responsive-nav-link :href="route('user.list')" :active="request()->routeIs('user.list')" class="flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span>{{ __('Users') }}</span>
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Mobile User Profile -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center px-4 py-2">
                <div class="flex-shrink-0 mr-3">
                    <img src="{{ Auth::user()->avatar ?? '/pfp-placeholder.png' }}" alt="Profile Image"
                         class="h-10 w-10 rounded-full border border-gray-300 dark:border-gray-600 shadow-sm object-cover">

                         {{-- filepath: /home/michal/Xstros/xstros-support-panel/resources/views/layouts/navigation.blade.php --}}
                    <div class="h-10 w-10 rounded-full border border-gray-300 dark:border-gray-600 shadow-sm object-cover flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        {!! Auth::user()->avatar ? '<img src="'.Auth::user()->avatar.'" alt="'.Auth::user()->name.'" class="h-10 w-10 rounded-full border border-gray-300 dark:border-gray-600 shadow-sm object-cover">' : substr(Auth::user()->name, 0, 1) !!}
                    </div>
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <!-- Mobile Notifications -->
            <div class="mt-3 px-4 py-2 border-t border-gray-200 dark:border-gray-700">
                <div class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Notifications</div>

                <div x-data="{ showNotifications: false }" class="relative">
                    <!-- Notification Bell Button -->
                    <button @click="showNotifications = !showNotifications" class="relative flex items-center px-3 py-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                        <!-- Bell Icon (Visible on All Devices) -->
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V10a6 6 0 10-12 0v4c0 .386-.149.735-.405 1.005L4 17h5m4 0a3 3 0 01-6 0"></path>
                        </svg>

                        <!-- Notification Badge (Unread Count) -->
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute -top-1 -right-1 flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-600 rounded-full">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif

                        <span class="ml-2 text-sm">
                            {{ auth()->user()->unreadNotifications->count() }} unread notifications
                        </span>
                    </button>

                    <!-- Dropdown Notification Panel -->
                    <div x-cloak x-show="showNotifications" @click.away="showNotifications = false"
                         class="mt-2 bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden z-50">

                        <!-- Header -->
                        <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                            <span class="text-base font-semibold">Notifications ({{ auth()->user()->unreadNotifications->count() }})</span>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <form method="POST" action="{{ route('notifications.markAsRead') }}">
                                    @csrf
                                    <button type="submit" class="text-xs text-blue-500 hover:underline">
                                        Mark all as read
                                    </button>
                                </form>
                            @endif
                        </div>

                        <!-- Notification List -->
                        <div class="max-h-48 overflow-y-auto">
                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <div class="relative flex items-center px-4 py-3 space-x-3 hover:bg-gray-100 dark:hover:bg-gray-700 border-b border-gray-100 dark:border-gray-700 last:border-0">
                                    <!-- User Avatar Placeholder -->
                                    <div class="shrink-0">
                                        <img class="rounded-full w-8 h-8" src="{{ Auth::user()->avatar ?? '/pfp-placeholder.png' }}" alt="User Avatar">
                                    </div>

                                    <!-- Notification Content -->
                                    <div class="w-full">
                                        @if($notification->type === 'App\Notifications\ReplyNotification')
                                            <!-- Reply Notification -->
                                            <a href="{{ route('ticket.view', $notification->data['ticket_id']) }}" class="block text-gray-700 dark:text-gray-300 text-sm">
                                                <strong class="text-sm">Ticket Reply</strong>
                                                <span class="block text-xs">There was a reply to your ticket (#{{ $notification->data['ticket_id'] }})</span>
                                            </a>
                                        @elseif($notification->type === 'App\Notifications\CloseNotifcation')
                                            <!-- Close Notification -->
                                            <a href="{{ route('ticket.view', $notification->data['ticket_id']) }}" class="block text-gray-700 dark:text-gray-300 text-sm">
                                                <strong class="text-sm">Ticket Closed</strong>
                                                <span class="block text-xs">Your ticket (#{{ $notification->data['ticket_id'] }}) was closed by the support team.</span>
                                            </a>
                                        @elseif($notification->type === 'App\Notifications\AssignNotification')
                                            <a href="{{ route('ticket.view', $notification->data['ticket_id']) }}" class="block text-gray-700 dark:text-gray-300 text-sm">
                                                <strong class="text-sm">Ticket Assigned</strong>
                                                <span class="block text-xs">You have been assigned a new ticket!</span>
                                            </a>
                                        @endif
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            {{ \Carbon\Carbon::parse($notification->data['timestamp'])->diffForHumans() }}
                                        </div>
                                    </div>

                                    <!-- Delete Notification Button -->
                                    <form method="POST" action="{{ route('notifications.delete', $notification->id) }}" class="ml-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-500 dark:text-gray-500 dark:hover:text-red-400 transition-colors">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="p-4 text-center text-sm text-gray-500 dark:text-gray-400">No new notifications</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1 border-t border-gray-200 dark:border-gray-700 pt-2">
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>{{ __('Profile') }}</span>
                </x-responsive-nav-link>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                           class="flex items-center space-x-2 text-red-600 dark:text-red-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>{{ __('Log Out') }}</span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

</nav>
