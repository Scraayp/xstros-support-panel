<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Ticket Management') }}
            </h2>
            <a href="{{ route('ticket.new') }}" class="group">
                <button type="button"
                        class="text-white bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-sm font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center transition-all duration-200 group-hover:shadow-md">
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
             class="fixed bottom-6 right-6 flex items-center w-full max-w-sm p-4 text-white bg-gradient-to-r from-red-500 to-red-600 rounded-lg shadow-lg z-50 transition-all duration-300 backdrop-blur-sm bg-opacity-90 transform translate-y-0 opacity-100"
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
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Open Tickets -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6 relative overflow-hidden">
                        <div class="absolute right-0 top-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-green-500 opacity-10"></div>
                        <div class="absolute right-0 bottom-0 -mb-4 -mr-4 h-24 w-24 rounded-full bg-green-500 opacity-10"></div>
                        
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-300 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Open Tickets</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $ticketStats['open'] }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-green-500 h-2.5 rounded-full" 
                                style="width: {{ ($ticketStats['total'] ?? 0) > 0 ? ($ticketStats['open'] / max($ticketStats['total'], 1)) * 100 : 0 }}%">
                           </div>
                           
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Awaiting Reply -->
                {{-- TODO: FIX THIS --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6 relative overflow-hidden">
                        <div class="absolute right-0 top-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-amber-500 opacity-10"></div>
                        <div class="absolute right-0 bottom-0 -mb-4 -mr-4 h-24 w-24 rounded-full bg-amber-500 opacity-10"></div>
                        
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-300 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Awaiting Reply</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $ticketStats['awaiting'] }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-amber-500 h-2.5 rounded-full" style="width: {{ $ticketStats['open'] > 0 ? ($ticketStats['awaiting'] / $ticketStats['open']) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Closed Tickets -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6 relative overflow-hidden">
                        <div class="absolute right-0 top-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-red-500 opacity-10"></div>
                        <div class="absolute right-0 bottom-0 -mb-4 -mr-4 h-24 w-24 rounded-full bg-red-500 opacity-10"></div>
                        
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-300 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Closed Tickets</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $ticketStats['closed']}}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-red-500 h-2.5 rounded-full" 
     style="width: {{ ($ticketStats['total'] ?? 0) > 0 ? ($ticketStats['closed'] / max($ticketStats['total'], 1)) * 100 : 0 }}%">
</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tabs for different ticket views -->
            <div class="mb-6 bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="flex flex-wrap">
                        <button onclick="showTab('all-tickets')" class="tab-button inline-flex items-center px-4 py-3 border-b-2 border-blue-600 dark:border-blue-500 text-blue-600 dark:text-blue-500 font-medium text-sm" id="all-tickets-tab">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            All Tickets
                        </button>
                        @if(auth()->user()->role === 'Admin' || auth()->user()->role === 'Staff')
                            <button onclick="showTab('assigned-tickets')" class="tab-button inline-flex items-center px-4 py-3 border-b-2 border-transparent hover:border-gray-300 dark:hover:border-gray-600 text-gray-500 dark:text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 font-medium text-sm" id="assigned-tickets-tab">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Assigned to Me
                            </button>
                        @endif
                        <button onclick="showTab('my-tickets')" class="tab-button inline-flex items-center px-4 py-3 border-b-2 border-transparent hover:border-gray-300 dark:hover:border-gray-600 text-gray-500 dark:text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 font-medium text-sm" id="my-tickets-tab">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            My Tickets
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Search and Filter Bar -->
            <div class="mb-6 bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="p-4 flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
                    <div class="relative w-full sm:w-auto">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" id="search-tickets" class="block w-full sm:w-64 p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white dark:bg-gray-800 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Search tickets...">
                    </div>
                    <div class="flex items-center space-x-2 w-full sm:w-auto">
                        <select id="status-filter" class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2">
                            <option value="">All Statuses</option>
                            <option value="open">Open</option>
                            <option value="awaiting_client_reply">Awaiting Client</option>
                            <option value="awaiting_staff_reply">Awaiting Staff</option>
                            <option value="closed">Closed</option>
                        </select>
                        <button type="button" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none dark:focus:ring-blue-700 transition-colors">Filter</button>
                    </div>
                </div>
            </div>

            <!-- All Tickets Tab Content -->
            <div id="all-tickets" class="tab-content">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
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
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-9 w-9 rounded-full bg-gradient-to-br from-gray-300 to-gray-400 dark:from-gray-600 dark:to-gray-700 flex items-center justify-center text-white dark:text-gray-300 font-medium shadow-sm">
                                                        {{ substr($ticket->user->name, 0, 1) }}
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="text-sm font-medium">{{ $ticket->user->name }}</div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $ticket->user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                <a href="{{ route('ticket.view', $ticket->id) }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                                    {{ $ticket->title }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                                @if($ticket->assignedTo)
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 dark:from-blue-500 dark:to-blue-700 flex items-center justify-center text-white font-medium shadow-sm">
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
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                        Not assigned
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-1.5 rounded-md text-xs font-medium
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
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="flex items-center justify-center space-x-2">
                                                    <a href="{{ route('ticket.view', $ticket->id) }}"
                                                       class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                        View
                                                    </a>
                                                    @if(auth()->user()->role === 'Admin' || auth()->user()->id === $ticket->user->id)
                                                        @if($ticket->status !== 'closed')
                                                            <form action="{{ route('ticket.close', $ticket->id) }}" method="POST" class="inline">
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
                                <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <a href="{{ route('ticket.view', $ticket->id) }}" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                                {{ $ticket->title }}
                                            </a>
                                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $ticket->created_at->format('M d, Y h:i A') }}
                                            </div>
                                        </div>
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium
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

                                    <div class="mt-3 grid grid-cols-2 gap-2 text-sm">
                                        <div>
                                            <div class="text-xs font-medium text-gray-500 dark:text-gray-400">Creator</div>
                                            <div class="flex items-center mt-1">
                                                <div class="flex-shrink-0 h-6 w-6 rounded-full bg-gradient-to-br from-gray-300 to-gray-400 dark:from-gray-600 dark:to-gray-700 flex items-center justify-center text-white dark:text-gray-300 text-xs font-medium">
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
                                                    <div class="flex-shrink-0 h-6 w-6 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 dark:from-blue-500 dark:to-blue-700 flex items-center justify-center text-white text-xs font-medium">
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
                                        @if($ticket->status !== 'closed' && (auth()->user()->role === 'Admin' || auth()->user()->id === $ticket->user->id))
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
                    
                    <!-- Pagination -->
                    <div class="px-6 py-3 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">{{ count($tickets) }}</span> of <span class="font-medium">{{ count($tickets) }}</span> tickets
                            </div>
                            <div class="flex space-x-1">
                                <button class="px-3 py-1 rounded-md bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    Previous
                                </button>
                                <button class="px-3 py-1 rounded-md bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assigned Tickets Tab Content -->
            @if(auth()->user()->role === 'Admin' || auth()->user()->role === 'Staff')
                <div id="assigned-tickets" class="tab-content hidden">
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
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
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-9 w-9 rounded-full bg-gradient-to-br from-gray-300 to-gray-400 dark:from-gray-600 dark:to-gray-700 flex items-center justify-center text-white dark:text-gray-300 font-medium shadow-sm">
                                                        {{ substr($ticket->user->name, 0, 1) }}
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="text-sm font-medium">{{ $ticket->user->name }}</div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $ticket->user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                <a href="{{ route('ticket.view', $ticket->id) }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                                    {{ $ticket->title }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-1.5 rounded-md text-xs font-medium
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
                                    <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <a href="{{ route('ticket.view', $ticket->id) }}" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                                    {{ $ticket->title }}
                                                </a>
                                                <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ $ticket->created_at->format('M d, Y h:i A') }}
                                                </div>
                                            </div>
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium
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
                                                <div class="flex-shrink-0 h-6 w-6 rounded-full bg-gradient-to-br from-gray-300 to-gray-400 dark:from-gray-600 dark:to-gray-700 flex items-center justify-center text-white dark:text-gray-300 text-xs font-medium">
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
                        
                        <!-- Pagination -->
                        <div class="px-6 py-3 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    Showing assigned tickets
                                </div>
                                <div class="flex space-x-1">
                                    <button class="px-3 py-1 rounded-md bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        Previous
                                    </button>
                                    <button class="px-3 py-1 rounded-md bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        Next
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- My Tickets Tab Content -->
            <div id="my-tickets" class="tab-content hidden">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                    <!-- Desktop Table View -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-700">
                            <tr>
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
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                            <a href="{{ route('ticket.view', $ticket->id) }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                                {{ $ticket->title }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            @if($ticket->assignedTo)
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 dark:from-blue-500 dark:to-blue-700 flex items-center justify-center text-white font-medium shadow-sm">
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
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                    Not assigned
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-1.5 rounded-md text-xs font-medium
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
                                <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <a href="{{ route('ticket.view', $ticket->id) }}" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                                {{ $ticket->title }}
                                            </a>
                                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $ticket->created_at->format('M d, Y h:i A') }}
                                            </div>
                                        </div>
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium
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
                                                <div class="flex-shrink-0 h-6 w-6 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 dark:from-blue-500 dark:to-blue-700 flex items-center justify-center text-white text-xs font-medium">
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
                    
                    <!-- Pagination -->
                    <div class="px-6 py-3 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                Showing your tickets
                            </div>
                            <div class="flex space-x-1">
                                <button class="px-3 py-1 rounded-md bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    Previous
                                </button>
                                <button class="px-3 py-1 rounded-md bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Button for Create Ticket (Mobile) -->
    <div class="fixed bottom-6 right-6 z-50 md:hidden">
        <a href="{{ route('ticket.new') }}"
           class="flex items-center justify-center w-14 h-14 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-full shadow-lg hover:shadow-xl transition transform hover:scale-105">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </a>
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
        
        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-tickets');
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const searchValue = this.value.toLowerCase();
                    const rows = document.querySelectorAll('tbody tr');
                    const cards = document.querySelectorAll('.md\\:hidden > div');
                    
                    // Filter table rows
                    rows.forEach(row => {
                        const title = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                        if (title.includes(searchValue)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                    
                    // Filter mobile cards
                    cards.forEach(card => {
                        const title = card.querySelector('a').textContent.toLowerCase();
                        if (title.includes(searchValue)) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }
            
            // Status filter functionality
            const statusFilter = document.getElementById('status-filter');
            if (statusFilter) {
                statusFilter.addEventListener('change', function() {
                    const statusValue = this.value.toLowerCase();
                    const rows = document.querySelectorAll('tbody tr');
                    const cards = document.querySelectorAll('.md\\:hidden > div');
                    
                    if (statusValue === '') {
                        // Show all if no filter selected
                        rows.forEach(row => row.style.display = '');
                        cards.forEach(card => card.style.display = '');
                        return;
                    }
                    
                    // Filter table rows
                    rows.forEach(row => {
                        const statusText = row.querySelector('td:nth-child(4) span').textContent.toLowerCase();
                        const matches = statusText.includes(statusValue) || 
                                      (statusValue === 'awaiting_client_reply' && statusText.includes('awaiting client')) ||
                                      (statusValue === 'awaiting_staff_reply' && statusText.includes('awaiting staff'));
                        
                        if (matches) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                    
                    // Filter mobile cards
                    cards.forEach(card => {
                        const statusText = card.querySelector('.inline-flex.items-center').textContent.trim().toLowerCase();
                        const matches = statusText.includes(statusValue) || 
                                      (statusValue === 'awaiting_client_reply' && statusText.includes('awaiting client')) ||
                                      (statusValue === 'awaiting_staff_reply' && statusText.includes('awaiting staff'));
                        
                        if (matches) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>
</x-app-layout>

