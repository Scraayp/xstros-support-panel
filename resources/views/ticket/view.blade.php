<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Ticket #') }}<span class="text-blue-600 dark:text-blue-400">{{ $ticket->id }}</span>
            </h2>
        </div>
    </x-slot>

    <!-- Toast Notifications -->
    @if(session('status') === 'ticket-created' || session('status') === 'reply-created' || session('status') === 'ticket-assigned')
        <div id="toast-{{ session('status') }}"
             class="fixed bottom-6 right-6 flex items-center w-full max-w-sm p-4 text-white bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg shadow-lg backdrop-blur-sm bg-opacity-90 z-50 transition-all duration-300"
             role="alert">
            <div class="flex items-center justify-center w-8 h-8 text-white bg-green-700/50 rounded-full backdrop-blur-sm">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
            </div>
            <div class="ml-3 text-sm font-medium">
                @if(session('status') === 'ticket-created')
                    Ticket has been created.
                @elseif(session('status') === 'reply-created')
                    Reply has been sent.
                @elseif(session('status') === 'ticket-assigned')
                    Assigned successfully!
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
            <!-- Ticket Information -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:shadow-md rounded-xl overflow-hidden mb-6">
                <div class="border-b border-gray-100 dark:border-gray-700 px-6 py-4">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Ticket Information</h3>
                </div>

                <div class="p-6">
                    <!-- Title, Status, and Assigned To in one row -->
                    <div class="bg-gray-50 dark:bg-gray-900/40 rounded-xl p-5 mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Title -->
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1.5">Title</p>
                                <h4 class="text-base font-semibold text-gray-900 dark:text-white">{{ $ticket->title }}</h4>
                            </div>

                            <!-- Status -->
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1.5">Status</p>
                                <div class="inline-flex items-center">
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
                            </div>

                            <!-- Assigned To with integrated dropdown for admins -->
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1.5">Assigned to</p>

                                @if(auth()->user()->role === 'Admin')
                                    <form action="{{ route('ticket.assign', $ticket) }}" method="POST" class="space-y-2">
                                        @csrf
                                        <div class="flex items-center">
                                            @if($ticket->assignedTo)
                                                <span class="text-gray-900 dark:text-white font-medium mr-2">
                                                    {{ $ticket->assignedTo->name }}
                                                </span>
                                                <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-md bg-indigo-100 text-indigo-800 dark:bg-indigo-900/60 dark:text-indigo-300">
                                                    {{ $ticket->assignedTo->role }}
                                                </span>
                                            @else
                                                <span class="text-gray-500 dark:text-gray-400">Not assigned</span>
                                            @endif
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <select name="assigned_to" class="flex-1 text-sm bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 rounded-md py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                                <option value="" disabled selected>Change assignment</option>
                                                @foreach($staffMembers as $staff)
                                                    <option value="{{ $staff->id }}" {{ $ticket->assigned_to === $staff->id ? 'selected' : '' }}>
                                                        {{ $staff->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <div class="text-gray-900 dark:text-white">
                                        @if($ticket->assignedTo)
                                            <span class="font-medium">{{ $ticket->assignedTo->name }}</span>
                                            <span class="inline-flex items-center ml-2 px-2 py-0.5 text-xs font-medium rounded-md @if($ticket->assignedTo->role === "Staff") bg-green-100 text-green-800 dark:bg-green-900/60 dark:text-green-300 @else bg-indigo-100 text-indigo-800 dark:bg-indigo-900/60 dark:text-indigo-300 @endif">
                                                {{ $ticket->assignedTo->role }}
                                            </span>
                                        @else
                                            <span class="text-gray-500 dark:text-gray-400">Not assigned</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-gray-50 dark:bg-gray-900/40 rounded-xl p-5 mb-6">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1.5">Description</p>
                        <div class="prose prose-sm max-w-none text-gray-700 dark:text-gray-300 whitespace-pre-line">
                            {{ $ticket->description }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Created By -->
                        <div class="bg-gray-50 dark:bg-gray-900/40 rounded-xl p-5">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1.5">Created by</p>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400">
                                    {{ substr($ticket->user->name, 0, 1) }}
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

                        <!-- Created At -->
                        <div class="bg-gray-50 dark:bg-gray-900/40 rounded-xl p-5">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1.5">Ticket Timeline</p>
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
            </div>

            <!-- Replies Section -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:shadow-md rounded-xl overflow-hidden mb-6">
                <div class="border-b border-gray-100 dark:border-gray-700 px-6 py-4">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Conversation</h3>
                </div>

                <div class="p-6">
                    <div class="space-y-6">
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
                                <div class="p-4 sm:p-5">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400">
                                                {{ substr($reply->user->name, 0, 1) }}
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

                        @if($ticket->status === "closed")
                            <div class="bg-red-50 dark:bg-red-900/20 rounded-xl overflow-hidden border-l-4 border-red-500 dark:border-red-600 transition-all duration-200 hover:shadow-md">
                                <div class="p-4 sm:p-5">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 rounded-full bg-red-100 dark:bg-red-800 flex items-center justify-center text-red-500 dark:text-red-300">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">System</p>
                                            </div>
                                        </div>
                                        <span class="text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $ticket->closed_at }}
                                        </span>
                                    </div>
                                    <div class="prose prose-sm max-w-none text-gray-700 dark:text-gray-300">
                                        <p>
                                            Ticket has been closed by: <span class="font-medium">{{ $ticket->closer->name }}</span>
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
                </div>
            </div>

            @if($ticket->status !== "closed")
                <!-- Reply Form -->
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:shadow-md rounded-xl overflow-hidden">
                    <div class="border-b border-gray-100 dark:border-gray-700 px-6 py-4">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Post a Reply</h3>
                    </div>

                    <div class="p-6">
                        <form action="{{ route('ticket.replies.store', $ticket) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <textarea
                                    name="message"
                                    rows="4"
                                    class="w-full p-3 bg-gray-50 dark:bg-gray-900/40 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700 dark:text-gray-300"
                                    placeholder="Type your reply here..."
                                    required
                                ></textarea>
                                @error('message')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">
                                    <strong>Oh snap!</strong> {{ $message }}
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
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
