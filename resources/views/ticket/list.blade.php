<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ticket - List') }}
        </h2>
    </x-slot>

    @if(session('status') === 'ticket-closed')
        <div id="toast-success"
             class="fixed bottom-6 right-6 flex items-center w-full max-w-sm p-4 text-gray-100 bg-red-500 rounded-xl shadow-lg z-50 transition-all duration-300"
             role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
            </div>
            <div class="ml-3 text-sm font-medium">Ticket has been closed.</div>
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

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow-lg rounded-xl p-6">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <div class="mb-6 text-right">
                        <a href="{{ route('ticket.new') }}">
                            <button type="button"
                                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 shadow-md shadow-blue-500/50 dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-4 py-2">
                                Create a New Ticket
                            </button>
                        </a>
                    </div>

                    <!-- Desktop Table View -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-left border-collapse shadow-md">
                            <thead class="bg-gray-100 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Ticket ID</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Ticket Creator</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Title</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Status</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Created At</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">
                            @foreach ($tickets as $ticket)
                                @if(auth()->user()->role === 'Admin' || auth()->user()->role === 'Staff' || auth()->user()->id === $ticket->user->id)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 whitespace-nowrap">{{ $ticket->id }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                            {{ $ticket->user->name }} ({{ $ticket->user->email }})
                                            <span class="@if($ticket->user->role === 'Admin') bg-blue-500 text-white @elseif($ticket->user->role === 'Staff') bg-green-500 text-white @else bg-gray-400 text-gray-900 @endif px-2 py-1 rounded-full text-xs ml-2">
                                                {{ $ticket->user->role }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 whitespace-nowrap">{{ $ticket->title }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                            <span class="@if($ticket->status === 'open') bg-green-500 text-white @elseif($ticket->status === 'awaiting_client_reply') bg-yellow-400 text-white @elseif($ticket->status === 'awaiting_staff_reply') bg-blue-500 text-white @else bg-red-500 text-white @endif px-2 py-1 rounded-full text-xs">
                                                @if($ticket->status === 'awaiting_client_reply')
                                                    Awaiting Client Reply
                                                @elseif($ticket->status === 'awaiting_staff_reply')
                                                    Awaiting Staff Reply
                                                @else
                                                    {{ ucfirst($ticket->status) }}
                                                @endif
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 whitespace-nowrap">{{ $ticket->created_at }}</td>
                                        <td class="px-6 py-4 text-center flex justify-center items-center space-x-2">
                                            <a href="{{ route('ticket.view', $ticket->id) }}"
                                               class="px-3 py-1 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 shadow">
                                                View
                                            </a>
                                            @if($ticket->status !== 'closed')
                                                <form action="{{ route('ticket.close', $ticket) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="px-3 py-1 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 shadow">
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
                    <div class="md:hidden space-y-6">
                        @foreach ($tickets as $ticket)
                            @if(auth()->user()->role === 'Admin' || auth()->user()->role === 'Staff' || auth()->user()->id === $ticket->user->id)
                                <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-xl shadow-lg">
                                    <div class="text-gray-900 dark:text-gray-100 text-sm space-y-2">
                                        <p><strong>Ticket ID:</strong> {{ $ticket->id }}</p>
                                        <p><strong>Creator:</strong> {{ $ticket->user->name }} ({{ $ticket->user->email }})
                                            <span class="@if($ticket->user->role === 'Admin') bg-blue-500 text-white @elseif($ticket->user->role === 'Staff') bg-green-500 text-white @else bg-gray-400 text-gray-900 @endif px-2 py-1 rounded-full text-xs">
                                                {{ $ticket->user->role }}
                                            </span>
                                        </p>
                                        <p><strong>Title:</strong> {{ $ticket->title }}</p>
                                        <p><strong>Status:</strong>
                                            <span class="@if($ticket->status === 'open') bg-green-500 text-white @elseif($ticket->status === 'awaiting_client_reply') bg-yellow-400 text-white @elseif($ticket->status === 'awaiting_staff_reply') bg-blue-500 text-white @else bg-red-500 text-white @endif px-2 py-1 rounded-full text-xs">
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
                                           class="px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 shadow w-full text-center">
                                            View
                                        </a>
                                        @if($ticket->status !== 'closed')
                                            <form action="{{ route('ticket.close', $ticket) }}" method="POST" class="w-full">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-3 py-2 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 shadow w-full">
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
</x-app-layout>
