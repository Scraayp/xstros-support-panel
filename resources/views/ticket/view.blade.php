<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Ticket - #') }} {{ $ticket->id }}
        </h2>
    </x-slot>

    @if(session('status') === 'ticket-created')
        <div id="toast-success"
             class="fixed bottom-6 right-6 flex items-center w-full max-w-sm p-4 text-gray-100 bg-green-500 rounded-xl shadow-lg z-50 transition-all duration-300"
             role="alert">
            <div class="flex items-center justify-center w-8 h-8 text-white bg-green-700 rounded-full">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
            </div>
            <div class="ml-3 text-sm font-medium">Ticket has been created.</div>
            <button onclick="document.getElementById('toast-success').style.display = 'none';"
                    class="ml-auto text-white hover:text-gray-300">
                ✖
            </button>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('toast-success').style.opacity = '0';
                setTimeout(() => document.getElementById('toast-success').remove(), 300);
            }, 4000);
        </script>
    @endif

    @if(session('status') === 'reply-created')
        <div id="reply-success"
             class="fixed bottom-6 right-6 flex items-center w-full max-w-sm p-4 text-gray-100 bg-green-500 rounded-xl shadow-lg z-50 transition-all duration-300"
             role="alert">
            <div class="flex items-center justify-center w-8 h-8 text-white bg-green-700 rounded-full">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
            </div>
            <div class="ml-3 text-sm font-medium">Reply has been sent.</div>
            <button onclick="document.getElementById('reply-success').style.display = 'none';"
                    class="ml-auto text-white hover:text-gray-300">
                ✖
            </button>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('reply-success').style.opacity = '0';
                setTimeout(() => document.getElementById('reply-success').remove(), 300);
            }, 4000);
        </script>
    @endif

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Ticket Information -->
            <div class="shadow-lg rounded-xl p-8 mb-8">
                <div class="mb-8">
                    <div class="border border-gray-100 dark:border-gray-700 shadow-lg rounded-2xl p-8 mb-8">
                        <h3 class="text-2xl font-extrabold text-gray-900 dark:text-gray-100 mb-6">Ticket Information</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Title -->
                            <div class="bg-gray-50 dark:bg-gray-800 transition transform hover:scale-102 p-4 rounded-xl shadow-sm">
                                <p class="text-gray-700 dark:text-gray-300">
                                    <strong class="block text-gray-900 dark:text-gray-100">Title:</strong>
                                    <span class="block mt-1 text-gray-800 dark:text-gray-200">{{ $ticket->title }}</span>
                                </p>
                            </div>

                            <!-- Status -->
                            <div class="bg-gray-50 dark:bg-gray-800 transition transform hover:scale-102 p-4 rounded-xl shadow-sm">
                                <p class="text-gray-700 dark:text-gray-300">
                                    <strong class="block text-gray-900 dark:text-gray-100">Status:</strong>
                                    <span class="block mt-1 font-semibold
                    @if($ticket->status === 'open')
                        text-green-600
                    @elseif($ticket->status === 'awaiting_client_reply')
                        text-yellow-600
                    @elseif($ticket->status === 'awaiting_staff_reply')
                        text-blue-600
                    @else
                        text-red-600
                    @endif
                ">
                    @if($ticket->status === 'awaiting_client_reply')
                                            Awaiting Client Reply
                                        @elseif($ticket->status === 'awaiting_staff_reply')
                                            Awaiting Staff Reply
                                        @else
                                            {{ ucfirst($ticket->status) }}
                                        @endif
                </span>
                                </p>
                            </div>

                            <!-- Description -->
                            <div class="bg-gray-50 dark:bg-gray-800 transition transform hover:scale-102 hover: p-4 rounded-xl shadow-sm sm:col-span-2">
                                <p class="text-gray-700 dark:text-gray-300">
                                    <strong class="block text-gray-900 dark:text-gray-100">Description:</strong>
                                    <span class="block mt-1 text-gray-800 dark:text-gray-200">{{ $ticket->description }}</span>
                                </p>
                            </div>

                            <!-- Created By -->
                            <div class="bg-gray-50 dark:bg-gray-800 transition transform hover:scale-102 p-4 rounded-xl shadow-sm">
                                <p class="text-gray-700 dark:text-gray-300">
                                    <strong class="block text-gray-900 dark:text-gray-100">Created by:</strong>
                                    <span class="block mt-1 text-gray-800 dark:text-gray-200">{{ $ticket->user->name }} ({{ $ticket->user->email }}) | <span class="inline-block mt-2 text-xs px-3 py-1 rounded-lg
                    @if($ticket->user->role === 'Admin') bg-blue-500 text-white
                    @elseif($ticket->user->role === 'Staff') bg-green-500 text-white
                    @else bg-gray-500 text-white
                    @endif
                ">
                    {{ $ticket->user->role }}
                </span></span>

                                </p>
                            </div>

                            <!-- Created At -->
                            <div class="bg-gray-50 dark:bg-gray-800  transition transform hover:scale-102 p-4 rounded-xl shadow-sm">
                                <p class="text-gray-700 dark:text-gray-300">
                                    <strong class="block text-gray-900 dark:text-gray-100">Created at:</strong>
                                    <span class="block mt-1 text-gray-800 dark:text-gray-200">{{ $ticket->created_at->format('M d, Y h:i A') }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Replies</h3>
                        <div class="space-y-6">
                            @foreach($ticket->replies as $reply)
                                <div class="p-6 rounded-xl shadow-md transition transform hover:scale-102
                                @if($reply->user->role == 'Admin')
                                    border border-blue-400 dark:border-blue-400 hover:shadow-[6px_6px_12px_rgba(59,130,246,0.5)]
                                @elseif($reply->user->role == 'Staff')
                                    border border-green-400 dark:border-green-400 hover:shadow-[6px_6px_12px_rgba(34,197,94,0.5)]
                                @else
                                    border border-gray-400 dark:border-gray-400 hover:shadow-[6px_6px_12px_rgba(156,163,175,0.5)]
                                @endif
                            ">
                                    <div class="flex justify-between items-center mb-3">
                                        <div class="flex items-center space-x-3">
                                        <span class="font-semibold text-gray-900 dark:text-gray-100">
                                            {{ $reply->user->name }}
                                        </span>
                                            <span class="text-xs px-2 py-1 rounded-full
                                            @if($reply->user->role === 'Admin')
                                                bg-blue-400 text-white
                                            @elseif($reply->user->role === 'Staff')
                                                bg-green-400 text-white
                                            @else
                                                bg-gray-400 text-white
                                            @endif
                                        ">
                                            {{ $reply->user->role }}
                                        </span>
                                        </div>
                                        <span class="text-sm text-gray-500 dark:text-gray-300">
                                        {{ $reply->created_at->format('M d, Y h:i A') }}
                                    </span>
                                    </div>
                                    <p class="text-gray-800 dark:text-gray-200">{{ $reply->message }}</p>
                                </div>
                            @endforeach

                            @if($ticket->status === "closed")
                                <div class="p-6 rounded-xl shadow-md bg-red-50 border border-red-200 dark:bg-red-800 dark:border-red-600">
                                    <div class="flex justify-between items-center mb-3">
                                    <span class="font-semibold text-gray-900 dark:text-gray-100">
                                        <span class="px-2 py-1 rounded-full bg-red-500 text-white">System</span>
                                    </span>
                                        <span class="text-sm text-gray-500 dark:text-gray-300">
                                        {{ $ticket->closed_at }}
                                    </span>
                                    </div>
                                    <p class="text-gray-800 dark:text-gray-200">
                                        Ticket has been closed by: {{ $ticket->closer->name }} |
                                        <span class="text-xs px-2 py-1 rounded-full
                                        @if($ticket->closer->role === 'Admin')
                                            bg-blue-400 text-white
                                        @elseif($ticket->closer->role === 'Staff')
                                            bg-green-400 text-white
                                        @else
                                            bg-gray-400 text-white
                                        @endif
                                    ">
                                        {{ $ticket->closer->role }}
                                    </span>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                @if($ticket->status !== "closed")
                    <!-- Reply Form -->
                    <div class="bg-white dark:bg-gray-900 shadow-lg rounded-xl p-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Post a Reply</h3>
                        <form action="{{ route('ticket.replies.store', $ticket) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <textarea name="message" rows="4" class="w-full p-4 border border-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Type your reply here..." required></textarea>
                            </div>
                            @error('message')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">
                                <strong>Oh snap!</strong> {{ $message }}
                            </p>
                            @enderror
                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition duration-200 ease-in-out">
                                Post Reply
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
</x-app-layout>
