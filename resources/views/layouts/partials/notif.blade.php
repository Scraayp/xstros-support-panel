<!-- Notifications Dropdown -->
<div x-data="{ showNotifications: false }" class="relative">
    <!-- Notification Bell Button -->
    <button @click="showNotifications = !showNotifications" class="relative flex items-center px-3 py-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
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
         class="absolute right-0 mt-3 w-80 sm:w-96 max-w-xs sm:max-w-md bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden z-50">

        <!-- Header -->
        <div class="px-4 py-2 border-b text-gray-900 dark:text-gray-100 flex justify-between items-center">
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
                <div class="relative flex items-center px-4 py-3 space-x-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <!-- User Avatar Placeholder -->
                    <div class="shrink-0">
                        <img class="rounded-full w-10 h-10" src="/pfp-placeholder.png" alt="User Avatar">
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
                        @endif
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            {{ \Carbon\Carbon::parse($notification->data['timestamp'])->diffForHumans() }}
                        </div>
                    </div>

                    <!-- Delete Notification Button -->
                    <form method="POST" action="{{ route('notifications.delete', $notification->id) }}" class="ml-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            ✖
                        </button>
                    </form>
                </div>
            @empty
                <div class="p-4 text-center text-sm text-gray-500 dark:text-gray-400">No new notifications</div>
            @endforelse
        </div>
    </div>
</div>
