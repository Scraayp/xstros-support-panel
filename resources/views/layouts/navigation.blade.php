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

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @if(Auth::user()->role == "Admin")
                        <x-nav-link :href="route('user.list')" :active="request()->routeIs('user.list')">
                            {{ __('Users') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Right Side (Notifications + User Dropdown) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Notifications Dropdown -->
                <div class="relative">
                    <button @click="showNotifications = !showNotifications" class="relative px-3 py-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V10a6 6 0 10-12 0v4c0 .386-.149.735-.405 1.005L4 17h5m4 0a3 3 0 01-6 0"></path>
                        </svg>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-600 rounded-full">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </button>

                    <!-- Notification Dropdown Menu -->
                    <div x-show="showNotifications" @click.away="showNotifications = false" class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden z-50">
                        <div class="px-4 py-2 border-b text-gray-900 dark:text-gray-100 flex justify-between">
                            <span>Notifications ({{ auth()->user()->unreadNotifications->count() }})</span>
                            <form method="POST" action="{{ route('notifications.markAsRead') }}">
                                @csrf
                                <button type="submit" class="text-xs text-blue-500 hover:underline">
                                    Mark all as read
                                </button>
                            </form>
                        </div>

                        <div class="max-h-60 overflow-y-auto">
                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <div class="relative px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 flex justify-between items-center">
                                    <a href="{{ route('ticket.view', $notification->data['ticket_id']) }}" class="flex-1 cursor-pointer">
                                        <strong>{{ $notification->data['reply_creator'] }} | <span class="@if($notification->data['reply_creator_role'] === "Admin") text-blue-500 @else text-green-500 @endif">{{ $notification->data['reply_creator_role'] }} </span></strong> replied to your ticket (#{{ $notification->data['ticket_id'] }})
                                        <br>
                                        <small class="text-gray-500">{{ \Carbon\Carbon::parse($notification->data['timestamp'])->diffForHumans() }}</small>
                                    </a>
                                    <!-- Delete Notification Button -->
                                    <form method="POST" action="{{ route('notifications.delete', $notification->id) }}" class="ml-3">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            ✖
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="p-4 text-sm text-gray-500 dark:text-gray-400">No new notifications</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-hidden transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }} |
                                <span class="@if(Auth::user()->role === 'Admin') text-blue-500 @elseif(Auth::user()->role === 'Staff') text-green-500 @else text-gray-400 @endif">
                                    {{ Auth::user()->role }}
                                </span>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
