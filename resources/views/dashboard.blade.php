<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard - Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xs sm:rounded-lg p-4">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <div class="mb-4 text-right">
                        <a href="{{ route('ticket.new') }}">
                            <button type="button"
                                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-4 py-2">
                                Create a new ticket
                            </button>
                        </a>
                    </div>

                    <!-- Desktop Table View -->
                    <div class="hidden md:block">
                        <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Ticket ID</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Ticket Creator</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Title</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Status</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Created At</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($tickets as $ticket)
                                @if(auth()->user()->role === 'Admin' || auth()->user()->role === 'Staff' || auth()->user()->id === $ticket->user->id)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100 whitespace-nowrap">{{ $ticket->id }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                            {{ $ticket->user->name }} ({{$ticket->user->email}})
                                            <span class="@if($ticket->user->role === 'Admin') bg-blue-400 text-white @elseif($ticket->user->role === 'Staff') bg-green-200 text-green-800 @else bg-gray-200 text-gray-800 @endif px-2 py-1 rounded text-xs">
                                                    {{$ticket->user->role}}
                                                </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100 whitespace-nowrap">{{ $ticket->title }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                                <span class="@if($ticket->status === 'open') bg-green-500 text-white @elseif($ticket->status === 'awaiting_client_reply') bg-yellow-400 text-white @elseif($ticket->status === 'awaiting_staff_reply') bg-blue-400 text-white @else bg-red-500 text-white @endif px-2 py-1 rounded text-xs">
                                                    @if($ticket->status === 'awaiting_client_reply')
                                                        Awaiting Client Reply
                                                    @elseif($ticket->status === 'awaiting_staff_reply')
                                                        Awaiting Staff Reply
                                                    @else
                                                        {{ ucfirst($ticket->status) }}
                                                    @endif
                                                </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100 whitespace-nowrap">{{ $ticket->created_at }}</td>
                                        <td class="px-4 py-3 text-center flex justify-center items-center space-x-2">
                                            <a href="{{ route('ticket.view', $ticket->id) }}"
                                               class="px-3 py-1 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700">View</a>
                                            @if($ticket->status !== 'closed')
                                                <form action="{{ route('ticket.close', $ticket) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="px-3 py-1 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700">
                                                        Close
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div> <!-- End Desktop Table View -->

                    <!-- Mobile Card View -->
                    <div class="md:hidden space-y-4">
                        @foreach ($tickets as $ticket)
                            @if(auth()->user()->role === 'Admin' || auth()->user()->role === 'Staff' || auth()->user()->id === $ticket->user->id)
                                <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow">
                                    <div class="text-gray-900 dark:text-gray-100 text-sm">
                                        <p><strong>Ticket ID:</strong> {{ $ticket->id }}</p>
                                        <p><strong>Creator:</strong> {{ $ticket->user->name }} ({{$ticket->user->email}})</p>
                                        <p><strong>Title:</strong> {{ $ticket->title }}</p>
                                        <p><strong>Status:</strong>
                                            <span class="@if($ticket->status === 'open') bg-green-500 text-white @elseif($ticket->status === 'awaiting_client_reply') bg-yellow-400 text-white @elseif($ticket->status === 'awaiting_staff_reply') bg-blue-400 text-white @else bg-red-500 text-white @endif px-2 py-1 rounded text-xs">
                                                @if($ticket->status === 'awaiting_client_reply')
                                                    Awaiting Client Reply
                                                @elseif($ticket->status === 'awaiting_staff_reply')
                                                    Awaiting Staff Reply
                                                @else
                                                    {{ ucfirst($ticket->status) }}
                                                @endif
                                            </span>
                                        </p>
                                        <p><strong>Created At:</strong> {{ $ticket->created_at }}</p>
                                    </div>
                                    <div class="mt-3 flex space-x-2">
                                        <a href="{{ route('ticket.view', $ticket->id) }}"
                                           class="px-3 py-1 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 w-full text-center">View</a>
                                        @if($ticket->status !== 'closed')
                                            <form action="{{ route('ticket.close', $ticket) }}" method="POST" class="w-full">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-3 py-1 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700 w-full">
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
</x-app-layout>
