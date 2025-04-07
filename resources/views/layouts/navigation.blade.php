<nav x-data="{ open: false, showNotifications: false, showUserMenu: false }" 
     class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="group transition-all duration-300">
                        <img src="/no-bg-logo.png" alt="Logo" class="block h-10 w-auto transition-transform group-hover:scale-110" />
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden space-x-2 sm:ml-8 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                        class="px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 
                        {{ request()->routeIs('dashboard') 
                            ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-foreground' 
                            : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>{{ __('Dashboard') }}</span>
                        </div>
                    </x-nav-link>

                    <x-nav-link :href="route('ticket.list')" :active="request()->routeIs('ticket.list')" 
                        class="px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 
                        {{ request()->routeIs('ticket.list') 
                            ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-foreground' 
                            : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                            <span>{{ __('Tickets') }}</span>
                        </div>
                    </x-nav-link>
                    @if(Auth::user()->role == "Admin")

                        <x-nav-link :href="route('payments.invoice.list')" :active="request()->routeIs('payments.invoice.list')" 
                            class="px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 
                            {{ request()->routeIs('payments.invoice.list') 
                                ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-foreground' 
                                : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ __('Transactions') }}</span>
                            </div>
                        </x-nav-link>
                    
                        <x-nav-link :href="route('user.list')" :active="request()->routeIs('user.list')" 
                            class="px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 
                            {{ request()->routeIs('user.list') 
                                ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-foreground' 
                                : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <span>{{ __('Users') }}</span>
                            </div>
                        </x-nav-link>
                        <x-nav-link :href="route('logs')" :active="request()->routeIs('logs')" 
                            class="px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 
                            {{ request()->routeIs('logs') 
                                ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-foreground' 
                                : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2M12 18a6 6 0 100-12 6 6 0 000 12z"></path>
                        </svg>
                        <span>{{ __('Logs') }}</span>
                    </div>
                </x-nav-link>
                
                    @endif
                </div>
            </div>

            <!-- Right Side (Notifications + User Dropdown) -->
            <div class="hidden sm:flex sm:items-center sm:space-x-3">
                <!-- Notifications Dropdown -->
                <div class="relative" x-data="{ notificationCount: {{ auth()->user()->unreadNotifications->count() }} }">
                    <!-- Notification Bell Button -->
                    <button @click="showNotifications = !showNotifications; showUserMenu = false" 
                            class="relative flex items-center justify-center p-2 rounded-full text-gray-500 dark:text-gray-400 
                                   hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 
                                   focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-gray-800 
                                   transition-all duration-200"
                            :class="{ 'bg-gray-100 dark:bg-gray-700': showNotifications }">
                        
                        <!-- Bell Icon with Animation -->
                        <svg class="w-6 h-6" :class="{ 'animate-wiggle': notificationCount > 0 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V10a6 6 0 10-12 0v4c0 .386-.149.735-.405 1.005L4 17h5m4 0a3 3 0 01-6 0"></path>
                        </svg>

                        <!-- Notification Badge with Animation -->
                        <template x-if="notificationCount > 0">
                            <span class="absolute -top-1 -right-1 flex items-center justify-center w-5 h-5 text-xs font-bold text-white 
                                         bg-red-500 rounded-full ring-2 ring-white dark:ring-gray-800 animate-pulse">
                                <span x-text="notificationCount"></span>
                            </span>
                        </template>
                    </button>

                    <!-- Dropdown Notification Panel -->
                    <div x-cloak x-show="showNotifications" 
                         @click.away="showNotifications = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-80 sm:w-96 max-w-md bg-white dark:bg-gray-800 rounded-xl 
                                shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden z-50">

                        <!-- Header with Gradient Background -->
                        <div class="bg-gradient-to-r from-primary/90 to-primary px-4 py-3 text-white dark:text-white flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V10a6 6 0 10-12 0v4c0 .386-.149.735-.405 1.005L4 17h5m4 0a3 3 0 01-6 0"></path>
                                </svg>
                                <span class="text-base font-semibold">Notifications</span>
                                <span class="flex items-center justify-center px-2 py-0.5 text-xs font-medium rounded-full bg-opacity-20">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            </div>
                            
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <form method="POST" action="{{ route('notifications.markAsRead') }}">
                                    @csrf
                                    <button type="submit" 
                                            @click="notificationCount = 0"
                                            class="text-xs text-white hover:text-gray-100 hover:underline focus:outline-none focus:underline transition-colors">
                                        Mark all as read
                                    </button>
                                </form>
                            @endif
                        </div>

                        <!-- Notification List with Custom Scrollbar -->
                        <div class="max-h-[calc(100vh-200px)] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-600 scrollbar-track-transparent">
                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <div class="relative group">
                                    <div class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 border-b border-gray-100 dark:border-gray-700 transition-colors">
                                        <!-- Notification Type Icon -->
                                        <div class="shrink-0 mr-3">
                                            @if($notification->type === 'App\Notifications\ReplyNotification')
                                                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-500 dark:text-blue-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                                    </svg>
                                                </div>
                                            @elseif($notification->type === 'App\Notifications\CloseNotifcation')
                                                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 text-green-500 dark:text-green-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                            @elseif($notification->type === 'App\Notifications\AssignNotification')
                                                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-500 dark:text-purple-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Notification Content -->
                                        <div class="w-full pr-8">
                                            @if($notification->type === 'App\Notifications\ReplyNotification')
                                                <a href="{{ route('ticket.view', $notification->data['ticket_id']) }}" class="block">
                                                    <p class="font-medium text-gray-900 dark:text-gray-100 text-sm">Ticket Reply</p>
                                                    <p class="text-gray-600 dark:text-gray-400 text-sm">New reply on ticket #{{ $notification->data['ticket_id'] }}</p>
                                                </a>
                                            @elseif($notification->type === 'App\Notifications\CloseNotifcation')
                                                <a href="{{ route('ticket.view', $notification->data['ticket_id']) }}" class="block">
                                                    <p class="font-medium text-gray-900 dark:text-gray-100 text-sm">Ticket Closed</p>
                                                    <p class="text-gray-600 dark:text-gray-400 text-sm">Ticket #{{ $notification->data['ticket_id'] }} was closed</p>
                                                </a>
                                            @elseif($notification->type === 'App\Notifications\AssignNotification')
                                                <a href="{{ route('ticket.view', $notification->data['ticket_id']) }}" class="block">
                                                    <p class="font-medium text-gray-900 dark:text-gray-100 text-sm">Ticket Assigned</p>
                                                    <p class="text-gray-600 dark:text-gray-400 text-sm">You've been assigned to ticket #{{ $notification->data['ticket_id'] }}</p>
                                                </a>
                                            @endif
                                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                                {{ \Carbon\Carbon::parse($notification->data['timestamp'])->diffForHumans() }}
                                            </p>
                                        </div>

                                        <!-- Delete Notification Button (Visible on Hover) -->
                                        <form method="POST" action="{{ route('notifications.delete', $notification->id) }}" class="absolute right-2 top-1/2 -translate-y-1/2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    @click="notificationCount = Math.max(0, notificationCount - 1)"
                                                    class="p-1.5 rounded-full text-gray-400 hover:text-red-500 dark:text-gray-500 dark:hover:text-red-400 
                                                           hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors opacity-0 group-hover:opacity-100 focus:opacity-100">
                                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                                </svg>
                                                <span class="sr-only">Delete notification</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="py-8 px-4 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100">You're all caught up!</h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No new notifications at the moment.</p>
                                </div>
                            @endforelse
                        </div>
                        
                        <!-- Footer -->
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <div class="px-4 py-3 bg-gray-50  dark:bg-gray-800 text-black dark:text-white text-center border-t border-gray-100 dark:border-gray-700">
                                <a href="#" class="text-sm text-primary hover:text-primary-dark dark:hover:text-primary-light transition-colors">
                                    View all notifications
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- User Dropdown -->
                <div class="relative">
                    <button @click="showUserMenu = !showUserMenu; showNotifications = false" 
                            class="flex items-center space-x-3 px-3 py-2 border border-transparent rounded-lg 
                                   text-sm font-medium transition-all duration-200
                                   {{ !request()->routeIs('profile.edit') 
                                      ? 'text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600' 
                                      : 'text-white bg-primary hover:bg-primary-dark' }}"
                            :class="{ 'ring-2 ring-primary dark:ring-primary': showUserMenu }">
                        
                        <!-- Profile Image with Status -->
                        <div class="relative">
                            @if(Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"
                                     class="w-8 h-8 rounded-full border border-gray-300 dark:border-gray-600 shadow-sm object-cover">
                            @else
                                <div class="w-8 h-8 rounded-full border border-gray-300 dark:border-gray-600 shadow-sm 
                                            bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-700 dark:text-gray-300">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            @endif

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
                        <svg class="h-4 w-4 text-gray-600 dark:text-gray-300 transition-transform duration-200"
                             :class="{ 'rotate-180': showUserMenu }"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- User Dropdown Menu -->
                    <div x-cloak x-show="showUserMenu" 
                         @click.away="showUserMenu = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-56 rounded-xl bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden z-50">
                        
                        <!-- User Info Header -->
                        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 dark:bg-gray-750">
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        
                        <!-- Menu Items -->
                        <div class="py-1">
                            <!-- Profile Link -->
                            <a href="{{ route('profile.edit') }}" 
                               class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <svg class="mr-3 w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>{{ __('Profile') }}</span>
                            </a>
                            
                            <!-- Settings Link -->
                            {{-- <a href="#" 
                               class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <svg class="mr-3 w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ __('Settings') }}</span>
                            </a> --}}
                            
                            <div class="border-t border-gray-100 dark:border-gray-700 my-1"></div>
                            
                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="flex w-full items-center px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                    <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0  stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>{{ __('Log Out') }}</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button (Hamburger) -->
            <div class="flex items-center sm:hidden">
                <!-- Mobile Notification Button -->
                <div class="relative mr-2" x-data="{ notificationCount: {{ auth()->user()->unreadNotifications->count() }} }">
                    <button @click="showNotifications = !showNotifications; open = false" 
                            class="relative flex items-center justify-center p-2 rounded-full text-gray-500 dark:text-gray-400 
                                   hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 
                                   focus:outline-none transition-colors">
                        <svg class="w-6 h-6" :class="{ 'animate-wiggle': notificationCount > 0 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V10a6 6 0 10-12 0v4c0 .386-.149.735-.405 1.005L4 17h5m4 0a3 3 0 01-6 0"></path>
                        </svg>

                        <!-- Notification Badge -->
                        <template x-if="notificationCount > 0">
                            <span class="absolute -top-1 -right-1 flex items-center justify-center w-5 h-5 text-xs font-bold text-white 
                                         bg-red-500 rounded-full ring-2 ring-white dark:ring-gray-800 animate-pulse">
                                <span x-text="notificationCount"></span>
                            </span>
                        </template>
                    </button>
                </div>
                
                <!-- Hamburger Button -->
                <button @click="open = !open; showNotifications = false" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 dark:text-gray-400 
                               hover:text-gray-700 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 
                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-gray-800 
                               transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Notification Panel -->
    <div x-cloak x-show="showNotifications && window.innerWidth < 640" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="fixed inset-0 z-50 sm:hidden">
        
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black bg-opacity-25" @click="showNotifications = false"></div>
        
        <!-- Panel -->
        <div class="absolute inset-x-0 top-16 mx-4 rounded-xl bg-white dark:bg-gray-800 shadow-lg overflow-hidden max-h-[80vh] flex flex-col">
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary/90 to-primary px-4 py-3 text-white dark:text-white flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V10a6 6 0 10-12 0v4c0 .386-.149.735-.405 1.005L4 17h5m4 0a3 3 0 01-6 0"></path>
                    </svg>
                    <span class="text-base font-semibold">Notifications</span>
                    <span class="flex items-center justify-center px-2 py-0.5 text-xs font-medium rounded-full bg-white bg-opacity-20">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                </div>
                
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <form method="POST" action="{{ route('notifications.markAsRead') }}">
                        @csrf
                        <button type="submit" 
                                @click="notificationCount = 0"
                                class="text-xs text-white hover:text-gray-100 hover:underline focus:outline-none focus:underline transition-colors">
                            Mark all as read
                        </button>
                    </form>
                @endif
            </div>
            
            <!-- Notification List -->
            <div class="overflow-y-auto flex-1 scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-600 scrollbar-track-transparent">
                @forelse(auth()->user()->unreadNotifications as $notification)
                    <div class="relative group">
                        <div class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 border-b border-gray-100 dark:border-gray-700 transition-colors">
                            <!-- Notification Type Icon -->
                            <div class="shrink-0 mr-3">
                                @if($notification->type === 'App\Notifications\ReplyNotification')
                                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-500 dark:text-blue-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                        </svg>
                                    </div>
                                @elseif($notification->type === 'App\Notifications\CloseNotifcation')
                                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 text-green-500 dark:text-green-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                @elseif($notification->type === 'App\Notifications\AssignNotification')
                                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-500 dark:text-purple-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Notification Content -->
                            <div class="w-full pr-8">
                                @if($notification->type === 'App\Notifications\ReplyNotification')
                                    <a href="{{ route('ticket.view', $notification->data['ticket_id']) }}" class="block">
                                        <p class="font-medium text-gray-900 dark:text-gray-100 text-sm">Ticket Reply</p>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">New reply on ticket #{{ $notification->data['ticket_id'] }}</p>
                                    </a>
                                @elseif($notification->type === 'App\Notifications\CloseNotifcation')
                                    <a href="{{ route('ticket.view', $notification->data['ticket_id']) }}" class="block">
                                        <p class="font-medium text-gray-900 dark:text-gray-100 text-sm">Ticket Closed</p>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">Ticket #{{ $notification->data['ticket_id'] }} was closed</p>
                                    </a>
                                @elseif($notification->type === 'App\Notifications\AssignNotification')
                                    <a href="{{ route('ticket.view', $notification->data['ticket_id']) }}" class="block">
                                        <p class="font-medium text-gray-900 dark:text-gray-100 text-sm">Ticket Assigned</p>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">You've been assigned to ticket #{{ $notification->data['ticket_id'] }}</p>
                                    </a>
                                @endif
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                    {{ \Carbon\Carbon::parse($notification->data['timestamp'])->diffForHumans() }}
                                </p>
                            </div>

                            <!-- Delete Notification Button -->
                            <form method="POST" action="{{ route('notifications.delete', $notification->id) }}" class="absolute right-2 top-1/2 -translate-y-1/2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        @click="notificationCount = Math.max(0, notificationCount - 1)"
                                        class="p-1.5 rounded-full text-gray-400 hover:text-red-500 dark:text-gray-500 dark:hover:text-red-400 
                                               hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="py-8 px-4 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100">You're all caught up!</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No new notifications at the moment.</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Footer -->
            <div class="px-4 py-3 bg-gray-50 dark:bg-gray-750 text-center border-t border-gray-100 dark:border-gray-700">
                <button @click="showNotifications = false" class="w-full px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 
                                                                  bg-white dark:bg-gray-700 rounded-md border border-gray-300 dark:border-gray-600 
                                                                  hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div x-cloak x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                                  class="flex items-center space-x-2 text-base">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>{{ __('Dashboard') }}</span>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('ticket.list')" :active="request()->routeIs('ticket.list')" 
                                  class="flex items-center space-x-2 text-base">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                </svg>
                <span>{{ __('Tickets') }}</span>
            </x-responsive-nav-link>

            @if(Auth::user()->role == "Admin")
                <x-responsive-nav-link :href="route('user.list')" :active="request()->routeIs('user.list')" 
                                      class="flex items-center space-x-2 text-base">
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
                    @if(Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"
                             class="h-10 w-10 rounded-full border border-gray-300 dark:border-gray-600 shadow-sm object-cover">
                    @else
                        <div class="h-10 w-10 rounded-full border border-gray-300 dark:border-gray-600 shadow-sm 
                                    bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-700 dark:text-gray-300">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 border-t border-gray-200 dark:border-gray-700 pt-2">
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>{{ __('Profile') }}</span>
                </x-responsive-nav-link>

                <!-- Settings Link -->
                {{-- <x-responsive-nav-link href="#" class="flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>{{ __('Settings') }}</span>
                </x-responsive-nav-link> --}}

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

<!-- Add this to your CSS -->
<style>
    @keyframes wiggle {
        0%, 100% { transform: rotate(0); }
        25% { transform: rotate(-10deg); }
        50% { transform: rotate(0); }
        75% { transform: rotate(10deg); }
    }
    
    .animate-wiggle {
        animation: wiggle 1s ease-in-out infinite;
    }
    
    /* Dark mode adjustments */
    .dark .bg-gray-750 {
        background-color: #1e2433;
    }
</style>