<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="mt-3 md:mt-0 flex space-x-2">
                <span class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-medium bg-gradient-to-r 
                    @if(Auth::user()->role === 'Admin') from-blue-600 to-blue-500 text-white
                    @elseif(Auth::user()->role === 'Staff') from-green-600 to-green-500 text-white
                    @else from-gray-600 to-gray-500 text-white @endif">
                    {{ Auth::user()->role }} Dashboard
                </span>
                <span class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-medium bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200">
                    {{ now()->format('F j, Y') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Total Tickets -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6 relative overflow-hidden">
                        <div class="absolute right-0 top-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-blue-500 opacity-10"></div>
                        <div class="absolute right-0 bottom-0 -mb-4 -mr-4 h-24 w-24 rounded-full bg-blue-500 opacity-10"></div>
                        
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Tickets</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $ticketStats['total']}}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Open Tickets -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6 relative overflow-hidden">
                        <div class="absolute right-0 top-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-yellow-500 opacity-10"></div>
                        <div class="absolute right-0 bottom-0 -mb-4 -mr-4 h-24 w-24 rounded-full bg-yellow-500 opacity-10"></div>
                        
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-300 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Open Tickets</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $ticketStats['open'] }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-yellow-500 h-2.5 rounded-full" style="width: {{ ($ticketStats['open']) / ($ticketStats['total'] ?? 24) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Closed Tickets -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6 relative overflow-hidden">
                        <div class="absolute right-0 top-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-green-500 opacity-10"></div>
                        <div class="absolute right-0 bottom-0 -mb-4 -mr-4 h-24 w-24 rounded-full bg-green-500 opacity-10"></div>
                        
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-300 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Closed Tickets</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $ticketStats['closed'] }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ ($ticketStats['closed']) / ($ticketStats['total']) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Users or Assigned Tickets -->
                @if(Auth::user()->role === 'Admin')
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl border border-gray-200 dark:border-gray-700">
                        <div class="p-6 relative overflow-hidden">
                            <div class="absolute right-0 top-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-purple-500 opacity-10"></div>
                            <div class="absolute right-0 bottom-0 -mb-4 -mr-4 h-24 w-24 rounded-full bg-purple-500 opacity-10"></div>
                            
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-300 mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Users</p>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ App\Models\User::all()->count(); }}</p>
                                </div>
                            </div>

                            {{-- TODO: SETUP --}}
                            
                            {{-- <div class="mt-4 flex items-center text-sm">
                                <span class="text-green-500 dark:text-green-400 flex items-center mr-2">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                    {{ $newUsers ?? 3 }} new
                                </span>
                                <span class="text-gray-500 dark:text-gray-400">this week</span>
                            </div> --}}
                        </div>
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl border border-gray-200 dark:border-gray-700">
                        <div class="p-6 relative overflow-hidden">
                            <div class="absolute right-0 top-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-indigo-500 opacity-10"></div>
                            <div class="absolute right-0 bottom-0 -mb-4 -mr-4 h-24 w-24 rounded-full bg-indigo-500 opacity-10"></div>
                            
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-300 mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">My Tickets</p>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $ticketStats['total'] }}</p>
                                </div>
                            </div>
                            
                            <div class="mt-4 flex items-center text-sm">
                                <span class="text-yellow-500 dark:text-yellow-400 flex items-center mr-2">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $ticketStats['open'] }} open
                                </span>
                                <span class="text-gray-500 dark:text-gray-400">ticket(s)</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Tickets Chart -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl border border-gray-200 dark:border-gray-700">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    {{ Auth::user()->role === 'Admin' ? 'Recent Tickets' : 'My Recent Tickets' }}
                                </h3>
                                <a href="{{ route('ticket.list') }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">View All</a>
                            </div>
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead>
                                        <tr>
                                            @if(Auth::user()->role === 'Admin')
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">User</th>
                                            @endif
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Title</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Assigned To</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Created</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($tickets as $ticket)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer"
                                                onclick="window.location='{{ route('ticket.view', $ticket) }}'">
                                                @if(Auth::user()->role === 'Admin')
                                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                                        {{ $ticket->user->name }}
                                                    </td>
                                                @endif
                                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400">
                                                    {{ $ticket->title }}
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
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
                                                @if($ticket->assigned_to !== null)
                                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
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
                                                    </td>
                                                @else
                                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                        Unassigned
                                                    </td>
                                                @endif
                                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $ticket->created_at->format('d-m H:i') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Tickets -->
                    
                </div>
                
                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- User Profile Card -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl border border-gray-200 dark:border-gray-700">
                        <div class="p-6">
                            <div class="flex flex-col items-center">
                                <div class="relative">
                                    @if(Auth::user()->profile_photo_path)
                                        <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" class="w-24 h-24 rounded-full border-2 border-gray-200 dark:border-gray-700 shadow-md">
                                    @else
                                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-3xl font-medium shadow-md">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div class="absolute bottom-0 right-0 h-6 w-6 rounded-full bg-green-500 border-2 border-white dark:border-gray-800"></div>
                                </div>
                                
                                <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ Auth::user()->email }}</p>
                                
                                <div class="mt-3 flex space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if(Auth::user()->role === 'Admin') bg-blue-100 text-blue-800 dark:bg-blue-900/60 dark:text-blue-300
                                        @elseif(Auth::user()->role === 'Staff') bg-green-100 text-green-800 dark:bg-green-900/60 dark:text-green-300
                                        @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @endif">
                                        {{ Auth::user()->role }}
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/60 dark:text-purple-300">
                                        Member since {{ Auth::user()->created_at->format('M Y') }}
                                    </span>
                                </div>
                                
                                <div class="mt-6 w-full">
                                    <a href="{{ route('profile.edit') }}" class="w-full flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl border border-gray-200 dark:border-gray-700">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Quick Actions</h3>
                            
                            <div class="space-y-3">
                                <a href="{{ route('ticket.create') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-md bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Create New Ticket</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Submit a new support request</p>
                                    </div>
                                </a>
                                
                                <a href="{{ route('ticket.list') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-md bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">View All Tickets</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Browse and manage tickets</p>
                                    </div>
                                </a>
                                
                                @if(Auth::user()->role === 'Admin')
                                    <a href="{{ route('user.list') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-md bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">Manage Users</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">View and edit user accounts</p>
                                        </div>
                                    </a>
                                    
                                    <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-md bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h  stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">System Reports</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">View analytics and statistics</p>
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- System Status or Recent Activity -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl border border-gray-200 dark:border-gray-700">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                                {{ Auth::user()->role === 'Admin' ? 'System Status' : 'Recent Activity' }}
                            </h3>
                            
                            @if(Auth::user()->role === 'Admin')
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            <div class="h-3 w-3 rounded-full bg-green-500 mr-2"></div>
                                            <span class="text-sm text-gray-700 dark:text-gray-300">Server Status</span>
                                        </div>
                                        <span class="text-sm font-medium text-green-600 dark:text-green-400">Operational</span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            <div class="h-3 w-3 rounded-full bg-green-500 mr-2"></div>
                                            <span class="text-sm text-gray-700 dark:text-gray-300">Database</span>
                                        </div>
                                        <span class="text-sm font-medium text-green-600 dark:text-green-400">Operational</span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            <div class="h-3 w-3 rounded-full bg-yellow-500 mr-2"></div>
                                            <span class="text-sm text-gray-700 dark:text-gray-300">API</span>
                                        </div>
                                        <span class="text-sm font-medium text-yellow-600 dark:text-yellow-400">Degraded</span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            <div class="h-3 w-3 rounded-full bg-green-500 mr-2"></div>
                                            <span class="text-sm text-gray-700 dark:text-gray-300">Storage</span>
                                        </div>
                                        <span class="text-sm font-medium text-green-600 dark:text-green-400">Operational</span>
                                    </div>
                                    
                                    <div class="pt-2">
                                        <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">View detailed status</a>
                                    </div>
                                </div>
                            @else
                            <div class="space-y-4">
                                @forelse(Auth::user()->notifications as $notification)
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-300">
                                            @if($notification->type === 'App\Notifications\TicketUpdated')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                                </svg>
                                            @elseif($notification->type === 'App\Notifications\NewComment')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $notification->data['title']  }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center text-gray-500 dark:text-gray-400 py-4">
                                        <p class="text-sm font-medium">No notifications yet</p>
                                        <p class="text-xs">Your recent activity will show up here.</p>
                                    </div>
                                @endforelse
                                
                               
                            </div>

                            
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ChartJS Script -->
    
</x-app-layout>

