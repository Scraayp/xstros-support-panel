<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Ticket Management') }}
            </h2>
            <a href="{{ route('ticket.new') }}">
                <button type="button"
                        class="text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-sm font-medium rounded-lg text-sm px-4 py-2.5 inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create New Ticket
                </button>
            </a>
        </div>
    </x-slot>

    @if(session('status') === 'ticket-closed')
        <div id="toast-success"
             class="fixed bottom-6 right-6 flex items-center w-full max-w-sm p-4 text-white bg-gradient-to-r from-red-500 to-red-600 rounded-lg shadow-lg z-50 transition-all duration-300 backdrop-blur-sm bg-opacity-90"
             role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
            </div>
            <div class="ml-3 text-sm font-medium">Ticket has been closed.</div>
            <button onclick="document.getElementById('toast-success').style.display = 'none';"
                    class="ml-auto text-white hover:text-gray-300 focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('toast-success');
                if (toast) {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateY(20px)';
                    setTimeout(() => toast.remove(), 300);
                }
            }, 4000);
        </script>
    @endif

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tabs for different ticket views -->
            <div class="mb-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="flex flex-wrap -mb-px">
                        <button onclick="showTab('all-tickets')" class="tab-button inline-block p-4 border-b-2 border-blue-600 dark:border-blue-500 text-blue-600 dark:text-blue-500 active font-medium" id="all-tickets-tab">
                            All Tickets
                        </button>
                        @if(auth()->user()->role === 'Admin' || auth()->user()->role === 'Staff')
                            <button onclick="showTab('assigned-tickets')" class="tab-button inline-block p-4 border-b-2 border-transparent hover:border-gray-300 dark:hover:border-gray-600 text-gray-500 dark:text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" id="assigned-tickets-tab">
                                Assigned to Me
                            </button>
                        @endif
                        <button onclick="showTab('my-tickets')" class="tab-button inline-block p-4 border-b-2 border-transparent hover:border-gray-300 dark:hover:border-gray-600 text-gray-500 dark:text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" id="my-tickets-tab">
                            My Tickets
                        </button>
                    </nav>
                </div>
            </div>

            <!-- All Tickets Tab Content -->
            <div id="all-tickets" class="tab-content">
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl overflow-hidden">
                    <!-- Desktop Table View -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Creator</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Assigned To</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Created</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($tickets as $ticket)
                                @if(auth()->user()->role === 'Admin' || auth()->user()->role === 'Staff' || auth()->user()->id === $ticket->user->id)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300">
                                                    {{ substr($ticket->user->name, 0, 1) }}
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium">{{ $ticket->user->name }}</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $ticket->user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $ticket->title }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            @if($ticket->assignedTo)
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-7 w-7 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300">
                                                        {{ substr($ticket->assignedTo->name, 0, 1) }}
                                                    </div>
                                                    <div class="ml-2">
                                                        <div class="text-sm font-medium">{{ $ticket->assignedTo->name }}</div>
                                                        <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-full
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
                                                <span class="text-gray-500 dark:text-gray-400">Not assigned</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
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
                                                    <span class="relative flex w-2 h-2 mr-1.5">
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
                                                        Awaiting Client
                                                    @elseif($ticket->status === 'awaiting_staff_reply')
                                                        Awaiting Staff
                                                    @else
                                                        {{ ucfirst($ticket->status) }}
                                                    @endif
                                                </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $ticket->created_at->format('M d, Y') }}
                                            <div class="text-xs">{{ $ticket->created_at->format('h:i A') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <div class="flex items-center justify-center space-x-2">
                                                <a href="{{ route('ticket.view', $ticket->id) }}"
                                                   class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    View
                                                </a>
                                                @if($ticket->status !== 'closed')
                                                    <form action="{{ route('ticket.close', $ticket) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                            Close
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div> <!-- End Desktop Table View -->

                    <!-- Mobile Card View -->
                    <div class="md:hidden divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($tickets as $ticket)
                            @if(auth()->user()->role === 'Admin' || auth()->user()->role === 'Staff' || auth()->user()->id === $ticket->user->id)
                                <div class="p-4">
                                    <div class="flex justify-between items-start">
                                        <div>

                                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-2">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $ticket->created_at->format('M d, Y h:i A') }}
                                            </div>
                                        </div>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
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
                                            <span class="relative flex w-2 h-2 mr-1.5">
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
                                                Awaiting Client
                                            @elseif($ticket->status === 'awaiting_staff_reply')
                                                Awaiting Staff
                                            @else
                                                {{ ucfirst($ticket->status) }}
                                            @endif
                                        </span>
                                    </div>

                                    <div class="mt-2 grid grid-cols-2 gap-2 text-sm">
                                        <div>
                                            <div class="text-xs font-medium text-gray-500 dark:text-gray-400">Creator</div>
                                            <div class="flex items-center mt-1">
                                                <div class="flex-shrink-0 h-6 w-6 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xs text-gray-600 dark:text-gray-300">
                                                    {{ substr($ticket->user->name, 0, 1) }}
                                                </div>
                                                <div class="ml-2 text-xs text-gray-700 dark:text-gray-300">
                                                    {{ $ticket->user->name }}
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="text-xs font-medium text-gray-500 dark:text-gray-400">Assigned To</div>
                                            <div class="flex items-center mt-1">
                                                @if($ticket->assignedTo)
                                                    <div class="flex-shrink-0 h-6 w-6 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-xs text-blue-600 dark:text-blue-300">
                                                        {{ substr($ticket->assignedTo->name, 0, 1) }}
                                                    </div>
                                                    <div class="ml-2 text-xs text-gray-700 dark:text-gray-300">
                                                        {{ $ticket->assignedTo->name }}
                                                    </div>
                                                @else
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">Not assigned</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3 flex space-x-2">
                                        <a href="{{ route('ticket.view', $ticket->id) }}"
                                           class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            View
                                        </a>
                                        @if($ticket->status !== 'closed')
                                            <form action="{{ route('ticket.close', $ticket) }}" method="POST" class="flex-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="w-full inline-flex justify-center items-center px-3 py-2 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    Close
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div> <!-- End Mobile Card View -->
                </div>
            </div>

            <!-- Assigned Tickets Tab Content -->
            @if(auth()->user()->role === 'Admin' || auth()->user()->role === 'Staff')
                <div id="assigned-tickets" class="tab-content hidden">
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl overflow-hidden">
                        <!-- Desktop Table View -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Creator</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Created</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($tickets as $ticket)
                                    @if($ticket->assigned_to === auth()->user()->id)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300">
                                                        {{ substr($ticket->user->name, 0, 1) }}
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="text-sm font-medium">{{ $ticket->user->name }}</div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $ticket->user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                                {{ $ticket->title }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
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
                                                    <span class="relative flex w-2 h-2 mr-1.5">
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
                                                        Awaiting Client
                                                    @elseif($ticket->status === 'awaiting_staff_reply')
                                                        Awaiting Staff
                                                    @else
                                                        {{ ucfirst($ticket->status) }}
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ $ticket->created_at->format('M d, Y') }}
                                                <div class="text-xs">{{ $ticket->created_at->format('h:i A') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                <div class="flex items-center justify-center space-x-2">
                                                    <a href="{{ route('ticket.view', $ticket->id) }}"
                                                       class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                        View
                                                    </a>
                                                    @if($ticket->status !== 'closed')
                                                        <form action="{{ route('ticket.close', $ticket) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                                </svg>
                                                                Close
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div> <!-- End Desktop Table View -->

                        <!-- Mobile Card View -->
                        <div class="md:hidden divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($tickets as $ticket)
                                @if($ticket->assigned_to === auth()->user()->id)
                                    <div class="p-4">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-2">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ $ticket->created_at->format('M d, Y h:i A') }}
                                                </div>
                                            </div>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
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
                                            <span class="relative flex w-2 h-2 mr-1.5">
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
                                                    Awaiting Client
                                                @elseif($ticket->status === 'awaiting_staff_reply')
                                                    Awaiting Staff
                                                @else
                                                    {{ ucfirst($ticket->status) }}
                                                @endif
                                        </span>
                                        </div>

                                        <div class="mt-2">
                                            <div class="text-xs font-medium text-gray-500 dark:text-gray-400">Creator</div>
                                            <div class="flex items-center mt-1">
                                                <div class="flex-shrink-0 h-6 w-6 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xs text-gray-600 dark:text-gray-300">
                                                    {{ substr($ticket->user->name, 0, 1) }}
                                                </div>
                                                <div class="ml-2 text-xs text-gray-700 dark:text-gray-300">
                                                    {{ $ticket->user->name }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-3 flex space-x-2">
                                            <a href="{{ route('ticket.view', $ticket->id) }}"
                                               class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>
                                            @if($ticket->status !== 'closed')
                                                <form action="{{ route('ticket.close', $ticket) }}" method="POST" class="flex-1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="w-full inline-flex justify-center items-center px-3 py-2 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                        Close
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div> <!-- End Mobile Card View -->
                    </div>
                </div>
            @endif

            <!-- My Tickets Tab Content -->
            <div id="my-tickets" class="tab-content hidden">
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl overflow-hidden">
                    <!-- Desktop Table View -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Creator</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Assigned To</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Created</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($tickets as $ticket)
                                @if(auth()->user()->id === $ticket->user->id)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300">
                                                    {{ substr($ticket->user->name, 0, 1) }}
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium">{{ $ticket->user->name }}</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $ticket->user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $ticket->title }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            @if($ticket->assignedTo)
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-7 w-7 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300">
                                                        {{ substr($ticket->assignedTo->name, 0, 1) }}
                                                    </div>
                                                    <div class="ml-2">
                                                        <div class="text-sm font-medium">{{ $ticket->assignedTo->name }}</div>
                                                        <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-full
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
                                                <span class="text-gray-500 dark:text-gray-400">Not assigned</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
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
                                                    <span class="relative flex w-2 h-2 mr-1.5">
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
                                                        Awaiting Client
                                                    @elseif($ticket->status === 'awaiting_staff_reply')
                                                        Awaiting Staff
                                                    @else
                                                        {{ ucfirst($ticket->status) }}
                                                    @endif
                                                </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $ticket->created_at->format('M d, Y') }}
                                            <div class="text-xs">{{ $ticket->created_at->format('h:i A') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <div class="flex items-center justify-center space-x-2">
                                                <a href="{{ route('ticket.view', $ticket->id) }}"
                                                   class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    View
                                                </a>
                                                @if($ticket->status !== 'closed')
                                                    <form action="{{ route('ticket.close', $ticket) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                            Close
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div> <!-- End Desktop Table View -->

                    <!-- Mobile Card View -->
                    <div class="md:hidden divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($tickets as $ticket)
                            @if(auth()->user()->id === $ticket->user->id)
                                <div class="p-4">
                                    <div class="flex justify-between items-start">
                                        <div>

                                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-2">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $ticket->created_at->format('M d, Y h:i A') }}
                                            </div>
                                        </div>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
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
                                            <span class="relative flex w-2 h-2 mr-1.5">
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
                                                Awaiting Client
                                            @elseif($ticket->status === 'awaiting_staff_reply')
                                                Awaiting Staff
                                            @else
                                                {{ ucfirst($ticket->status) }}
                                            @endif
                                        </span>
                                    </div>

                                    <div class="mt-2">
                                        <div class="text-xs font-medium text-gray-500 dark:text-gray-400">Assigned To</div>
                                        <div class="flex items-center mt-1">
                                            @if($ticket->assignedTo)
                                                <div class="flex-shrink-0 h-6 w-6 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-xs text-blue-600 dark:text-blue-300">
                                                    {{ substr($ticket->assignedTo->name, 0, 1) }}
                                                </div>
                                                <div class="ml-2 text-xs text-gray-700 dark:text-gray-300">
                                                    {{ $ticket->assignedTo->name }}
                                                </div>
                                            @else
                                                <span class="text-xs text-gray-500 dark:text-gray-400">Not assigned</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-3 flex space-x-2">
                                        <a href="{{ route('ticket.view', $ticket->id) }}"
                                           class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            View
                                        </a>
                                        @if($ticket->status !== 'closed')
                                            <form action="{{ route('ticket.close', $ticket) }}" method="POST" class="flex-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="w-full inline-flex justify-center items-center px-3 py-2 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    Close
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div> <!-- End Mobile Card View -->
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabId) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });

            // Show the selected tab content
            document.getElementById(tabId).classList.remove('hidden');

            // Update tab button styles
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('border-blue-600', 'dark:border-blue-500', 'text-blue-600', 'dark:text-blue-500');
                button.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400', 'hover:border-gray-300', 'dark:hover:border-gray-600', 'hover:text-gray-600', 'dark:hover:text-gray-300');
            });

            // Highlight the active tab button
            document.getElementById(tabId + '-tab').classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400', 'hover:border-gray-300', 'dark:hover:border-gray-600', 'hover:text-gray-600', 'dark:hover:text-gray-300');
            document.getElementById(tabId + '-tab').classList.add('border-blue-600', 'dark:border-blue-500', 'text-blue-600', 'dark:text-blue-500');
        }
    </script>
</x-app-layout>
