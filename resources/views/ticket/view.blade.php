<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Ticket #') }}<span class="text-blue-600 dark:text-blue-400">{{ $ticket->id }}</span>
            </h2>
            
            <div class="flex items-center space-x-3">
                @if($ticket->status !== "closed")
                    <form action="{{ route('ticket.close', $ticket) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" 
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Close Ticket
                        </button>
                    </form>
                @endif
                
                <a href="{{ route('ticket.list') }}" class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Tickets
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Toast Notifications -->
    @if(session('status') === 'ticket-created' || session('status') === 'reply-created' || session('status') === 'ticket-assigned')
        <div id="toast-{{ session('status') }}"
             class="fixed bottom-6 right-6 flex items-center w-full max-w-sm p-4 text-white bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg shadow-lg backdrop-blur-sm bg-opacity-90 z-50 transition-all duration-300 transform translate-y-0 opacity-100"
             role="alert">
            <div class="flex items-center justify-center w-8 h-8 text-white bg-green-700/50 rounded-full backdrop-blur-sm">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
            </div>
            <div class="ml-3 text-sm font-medium">
                @if(session('status') === 'ticket-created')
                    Ticket has been created successfully.
                @elseif(session('status') === 'reply-created')
                    Your reply has been sent successfully.
                @elseif(session('status') === 'ticket-assigned')
                    Ticket has been assigned successfully!
                @endif
            </div>
            <button onclick="document.getElementById('toast-{{ session('status') }}').style.display = 'none';"
                    class="ml-auto text-white hover:text-gray-300 focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('toast-{{ session('status') }}');
                if (toast) {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateY(20px)';
                    setTimeout(() => toast.remove(), 300);
                }
            }, 4000);
        </script>
    @endif

    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Ticket Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Ticket Information -->
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl overflow-hidden">
                        <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4 flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Ticket Details</h3>
                            <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full
                                @if($ticket->status === 'open')
                                    bg-green-100 text-green-800 dark:bg-green-900/60 dark:text-green-300
                                @elseif($ticket->status === 'awaiting_client_reply')
                                    bg-amber-100 text-amber-800 dark:bg-amber-900/60 dark:text-amber-300
                                @elseif($ticket->status === 'awaiting_staff_reply')
                                    bg-blue-100 text-blue-800 dark:bg-blue-900/60 dark:text-blue-300
                                @else
                                    bg-red-100 text-red-800 dark:bg-red-900/60 dark:text-red-300
                                @endif
                            ">
                                <span class="relative flex w-2 h-2 mr-2">
                                    <span class="absolute inline-flex w-full h-full rounded-full opacity-75
                                        @if($ticket->status === 'open')
                                            bg-green-500 animate-ping
                                        @elseif($ticket->status === 'awaiting_client_reply')
                                            bg-amber-500 animate-ping
                                        @elseif($ticket->status === 'awaiting_staff_reply')
                                            bg-blue-500 animate-ping
                                        @else
                                            bg-red-500
                                        @endif
                                    "></span>
                                    <span class="relative inline-flex rounded-full w-2 h-2
                                        @if($ticket->status === 'open')
                                            bg-green-500
                                        @elseif($ticket->status === 'awaiting_client_reply')
                                            bg-amber-500
                                        @elseif($ticket->status === 'awaiting_staff_reply')
                                            bg-blue-500
                                        @else
                                            bg-red-500
                                        @endif
                                    "></span>
                                </span>
                                @if($ticket->status === 'awaiting_client_reply')
                                    Awaiting Client Reply
                                @elseif($ticket->status === 'awaiting_staff_reply')
                                    Awaiting Staff Reply
                                @else
                                    {{ ucfirst($ticket->status) }}
                                @endif
                            </span>
                        </div>

                        <div class="p-6">
                            <!-- Title -->
                            <div class="mb-6">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $ticket->title }}</h2>
                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                    Created {{ $ticket->created_at->diffForHumans() }} ({{ $ticket->created_at->format('M d, Y h:i A') }})
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="bg-gray-50 dark:bg-gray-900/40 rounded-xl p-5 mb-6">
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-3">Description</h4>
                                <div class="prose prose-sm max-w-none text-gray-700 dark:text-gray-300 whitespace-pre-line">
                                    {{ $ticket->description }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Conversation Section -->
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl overflow-hidden">
                        <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                Conversation
                                <span class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                                    ({{ count($ticket->replies) }} {{ Str::plural('reply', count($ticket->replies)) }})
                                </span>
                            </h3>
                        </div>

                        <div class="p-6">
                            <div class="space-y-6">
                                <!-- Original Ticket as First Message -->
                                <div class="bg-gray-50 dark:bg-gray-900/40 rounded-xl overflow-hidden transition-all duration-200 hover:shadow-md
                                    @if($ticket->user->role == 'Admin')
                                        border-l-4 border-blue-500 dark:border-blue-400
                                    @elseif($ticket->user->role == 'Staff')
                                        border-l-4 border-green-500 dark:border-green-400
                                    @else
                                        border-l-4 border-gray-500 dark:border-gray-400
                                    @endif
                                ">
                                    <div class="p-5">
                                        <div class="flex items-start justify-between mb-4">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-gray-300 to-gray-400 dark:from-gray-600 dark:to-gray-700 flex items-center justify-center text-white dark:text-gray-300 font-medium shadow-sm">
                                                    {!! $ticket->user->avatar ? '<img src="'.$ticket->user->avatar.'" alt="'.$ticket->user->name.'" class="h-10 w-10 rounded-full border border-gray-300 dark:border-gray-600 shadow-sm object-cover">' : substr($ticket->user->name, 0, 1) !!}
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $ticket->user->name }}</p>
                                                    <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-md
                                                        @if($ticket->user->role === 'Admin')
                                                            bg-blue-100 text-blue-800 dark:bg-blue-900/60 dark:text-blue-300
                                                        @elseif($ticket->user->role === 'Staff')
                                                            bg-green-100 text-green-800 dark:bg-green-900/60 dark:text-green-300
                                                        @else
                                                            bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                                        @endif
                                                    ">
                                                        {{ $ticket->user->role }}
                                                    </span>
                                                </div>
                                            </div>
                                            <span class="text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $ticket->created_at->format('M d, Y h:i A') }}
                                            </span>
                                        </div>
                                        <div class="prose prose-sm max-w-none text-gray-700 dark:text-gray-300 whitespace-pre-line">
                                            {{ $ticket->description }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Replies -->
                                @foreach($ticket->replies as $reply)
                                    <div class="bg-gray-50 dark:bg-gray-900/40 rounded-xl overflow-hidden transition-all duration-200 hover:shadow-md
                                        @if($reply->user->role == 'Admin')
                                            border-l-4 border-blue-500 dark:border-blue-400
                                        @elseif($reply->user->role == 'Staff')
                                            border-l-4 border-green-500 dark:border-green-400
                                        @else
                                            border-l-4 border-gray-500 dark:border-gray-400
                                        @endif
                                    ">
                                        <div class="p-5">
                                            <div class="flex items-start justify-between mb-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-gray-300 to-gray-400 dark:from-gray-600 dark:to-gray-700 flex items-center justify-center text-white dark:text-gray-300 font-medium shadow-sm">
                                                        {!! $reply->user->avatar ? '<img src="'.$reply->user->avatar.'" alt="'.$reply->user->name.'" class="h-10 w-10 rounded-full border border-gray-300 dark:border-gray-600 shadow-sm object-cover">' : substr($reply->user->name, 0, 1) !!}
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $reply->user->name }}</p>
                                                        <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-md
                                                            @if($reply->user->role === 'Admin')
                                                                bg-blue-100 text-blue-800 dark:bg-blue-900/60 dark:text-blue-300
                                                            @elseif($reply->user->role === 'Staff')
                                                                bg-green-100 text-green-800 dark:bg-green-900/60 dark:text-green-300
                                                            @else
                                                                bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                                            @endif
                                                        ">
                                                            {{ $reply->user->role }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <span class="text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ $reply->created_at->format('M d, Y h:i A') }}
                                                </span>
                                            </div>
                                            <div class="prose prose-sm max-w-none text-gray-700 dark:text-gray-300 whitespace-pre-line">
                                                {{ $reply->message }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Closed Ticket Message -->
                                @if($ticket->status === "closed")
                                    <div class="bg-red-50 dark:bg-red-900/20 rounded-xl overflow-hidden border-l-4 border-red-500 dark:border-red-600 transition-all duration-200 hover:shadow-md">
                                        <div class="p-5">
                                            <div class="flex items-start justify-between mb-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-red-100 dark:bg-red-800 flex items-center justify-center text-red-500 dark:text-red-300">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-sm font-medium text-gray-900 dark:text-white">System</p>
                                                        <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-md bg-red-100 text-red-800 dark:bg-red-900/60 dark:text-red-300">
                                                            Notification
                                                        </span>
                                                    </div>
                                                </div>
                                                <span class="text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($ticket->closed_at)->format('M d, Y h:i A') }}
                                                </span>
                                            </div>
                                            <div class="prose prose-sm max-w-none text-gray-700 dark:text-gray-300">
                                                <p>
                                                    This ticket has been closed by: <span class="font-medium">{{ $ticket->closer->name }}</span>
                                                    <span class="inline-flex items-center ml-2 px-2 py-0.5 text-xs font-medium rounded-md
                                                        @if($ticket->closer->role === 'Admin')
                                                            bg-blue-100 text-blue-800 dark:bg-blue-900/60 dark:text-blue-300
                                                        @elseif($ticket->closer->role === 'Staff')
                                                            bg-green-100 text-green-800 dark:bg-green-900/60 dark:text-green-300
                                                        @else
                                                            bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                                        @endif
                                                    ">
                                                        {{ $ticket->closer->role }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Reply Form -->
                            @if($ticket->status !== "closed")
                                <div class="mt-8">
                                    <form action="{{ route('ticket.replies.store', $ticket) }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Reply</label>
                                            <textarea
                                                id="message"
                                                name="message"
                                                rows="4"
                                                class="w-full p-3 bg-gray-50 dark:bg-gray-900/40 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700 dark:text-gray-300"
                                                placeholder="Type your reply here..."
                                                required
                                            ></textarea>
                                            @error('message')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                                </svg>
                                                Post Reply
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="mt-8 bg-gray-50 dark:bg-gray-900/40 rounded-lg p-4 text-center">
                                    <p class="text-gray-600 dark:text-gray-400">This ticket is closed. No further replies can be added.</p>
                                    {{-- TODO: Fix reopen --}}
                                    <form action="" method="POST" class="mt-2">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                            Reopen Ticket
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column - Sidebar -->
                <div class="space-y-6">
                    <!-- Ticket Info Card -->
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl overflow-hidden">
                        <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Ticket Information</h3>
                        </div>
                        <div class="p-6 space-y-5">
                            <!-- Created By -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Created by</h4>
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-gray-300 to-gray-400 dark:from-gray-600 dark:to-gray-700 flex items-center justify-center text-white dark:text-gray-300 font-medium shadow-sm">
                                        {!! $ticket->user->avatar ? '<img src="'.$ticket->user->avatar.'" alt="'.$ticket->user->name.'" class="h-10 w-10 rounded-full border border-gray-300 dark:border-gray-600 shadow-sm object-cover">' : substr($ticket->user->name, 0, 1) !!}
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $ticket->user->name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $ticket->user->email }}</p>
                                        <span class="inline-flex items-center mt-1 px-2 py-0.5 text-xs font-medium rounded-md
                                            @if($ticket->user->role === 'Admin')
                                                bg-blue-100 text-blue-800 dark:bg-blue-900/60 dark:text-blue-300
                                            @elseif($ticket->user->role === 'Staff')
                                                bg-green-100 text-green-800 dark:bg-green-900/60 dark:text-green-300
                                            @else
                                                bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                            @endif
                                        ">
                                            {{ $ticket->user->role }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Assigned To -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Assigned to</h4>
                                @if(auth()->user()->role === 'Admin')
                                    <form action="{{ route('ticket.assign', $ticket) }}" method="POST" class="space-y-3">
                                        @csrf
                                        <div class="flex items-center mb-2">
                                            @if($ticket->assignedTo)
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 dark:from-blue-500 dark:to-blue-700 flex items-center justify-center text-white font-medium shadow-sm">
                                                        {{ substr($ticket->assignedTo->name, 0, 1) }}
                                                    </div>
                                                    <div class="ml-2">
                                                        <span class="text-sm font-medium text-gray-900 dark:text-white">
                                                            {{ $ticket->assignedTo->name }}
                                                        </span>
                                                        <span class="inline-flex items-center ml-1 px-2 py-0.5 text-xs font-medium rounded-md
                                                            @if($ticket->assignedTo->role === 'Admin')
                                                                bg-blue-100 text-blue-800 dark:bg-blue-900/60 dark:text-blue-300
                                                            @else
                                                                bg-green-100 text-green-800 dark:bg-green-900/60 dark:text-green-300
                                                            @endif
                                                        ">
                                                            {{ $ticket->assignedTo->role }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-sm text-gray-500 dark:text-gray-400">Not assigned</span>
                                            @endif
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <select name="assigned_to" class="flex-1 text-sm bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 rounded-md py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                                <option value="" disabled selected>Change assignment</option>
                                                @foreach($staffMembers as $staff)
                                                    <option value="{{ $staff->id }}" {{ $ticket->assigned_to === $staff->id ? 'selected' : '' }}>
                                                        {{ $staff->name }} ({{ $staff->role }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                Assign
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <div class="flex items-center">
                                        @if($ticket->assignedTo)
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 dark:from-blue-500 dark:to-blue-700 flex items-center justify-center text-white font-medium shadow-sm">
                                                    {{ substr($ticket->assignedTo->name, 0, 1) }}
                                                </div>
                                                <div class="ml-2">
                                                    <span class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ $ticket->assignedTo->name }}
                                                    </span>
                                                    <span class="inline-flex items-center ml-1 px-2 py-0.5 text-xs font-medium rounded-md
                                                        @if($ticket->assignedTo->role === 'Admin')
                                                            bg-blue-100 text-blue-800 dark:bg-blue-900/60 dark:text-blue-300
                                                        @else
                                                            bg-green-100 text-green-800 dark:bg-green-900/60 dark:text-green-300
                                                        @endif
                                                    ">
                                                        {{ $ticket->assignedTo->role }}
                                                    </span>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Not assigned</span>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Timeline -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Timeline</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-sm text-gray-700 dark:text-gray-300">
                                            <span class="font-medium text-gray-900 dark:text-white">Created:</span>
                                            {{ $ticket->created_at->format('M d, Y h:i A') }}
                                        </span>
                                    </div>

                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-sm text-gray-700 dark:text-gray-300">
                                            <span class="font-medium text-gray-900 dark:text-white">Last reply:</span>
                                            @if(count($ticket->replies) > 0)
                                                {{ $ticket->replies->sortByDesc('created_at')->first()->created_at->format('M d, Y h:i A') }}
                                            @else
                                                <span class="text-gray-500 dark:text-gray-400">No replies yet</span>
                                            @endif
                                        </span>
                                    </div>

                                    @if($ticket->status === 'closed')
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-red-400 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                                <span class="font-medium text-gray-900 dark:text-white">Closed:</span>
                                                {{ \Carbon\Carbon::parse($ticket->closed_at)->format('M d, Y h:i A') }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl overflow-hidden">
                        <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Quick Actions</h3>
                        </div>
                        <div class="p-6 space-y-3">
                            @if($ticket->status !== "closed")
                                <form action="{{ route('ticket.close', $ticket) }}" method="POST" class="w-full">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" 
                                            class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Close Ticket
                                    </button>
                                </form>
                            @else
                            {{-- TODO: Fix reopen --}}
                                <form action=" method="POST" class="w-full">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" 
                                            class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                        Reopen Ticket
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('ticket.list') }}" 
                               class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Tickets
                            </a>
                        </div>
                    </div>

                    <!-- Related Tickets (if applicable) -->
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl overflow-hidden">
                        <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Related Tickets</h3>
                        </div>
                        <div class="p-6">
                            @if(count($relatedTickets ?? []) > 0)
                                <ul class="space-y-3">
                                    @foreach($relatedTickets as $relatedTicket)
                                        <li>
                                            <a href="{{ route('ticket.view', $relatedTicket->id) }}" class="flex items-center p-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                                <span class="inline-flex items-center justify-center w-8 h-8 mr-3 rounded-full
                                                    @if($relatedTicket->status === 'open')
                                                        bg-green-100 text-green-800 dark:bg-green-900/60 dark:text-green-300
                                                    @elseif($relatedTicket->status === 'awaiting_client_reply' || $relatedTicket->status === 'awaiting_staff_reply')
                                                        bg-amber-100 text-amber-800 dark:bg-amber-900/60 dark:text-amber-300
                                                    @else
                                                        bg-red-100 text-red-800 dark:bg-red-900/60 dark:text-red-300
                                                    @endif
                                                ">
                                                    <span class="text-xs font-medium">{{ substr(ucfirst($relatedTicket->status), 0, 1) }}</span>
                                                </span>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ Str::limit($relatedTicket->title, 30) }}</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">Ticket #{{ $relatedTicket->id }}</p>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-gray-500 dark:text-gray-400 text-center">No related tickets found</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

