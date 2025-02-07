<!-- resources/views/ticket/view.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Ticket - #') }} {{ $ticket->id }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-6">
                <!-- Ticket Information -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Ticket Information</h3>
                    <div class="mt-4">
                        <p class="text-gray-900 dark:text-gray-300"><strong>Title:</strong> {{ $ticket->title }}</p>
                        <p class="text-gray-900 dark:text-gray-300"><strong>Description:</strong> {{ $ticket->description }}</p>
                        <p class="text-gray-900 dark:text-gray-300">
                            <strong>Status:</strong>
                            <span class="
        @if($ticket->status === 'open')
            text-green-500
        @elseif($ticket->status === 'awaiting_client_reply')
            text-yellow-500
        @elseif($ticket->status === 'awaiting_staff_reply')
            text-blue-500
        @else
            text-red-500
        @endif">

        @if($ticket->status === 'awaiting_client_reply')
                                    Awaiting Client Reply
                                @elseif($ticket->status === 'awaiting_staff_reply')
                                    Awaiting Staff Reply
                                @else
                                    {{ ucfirst($ticket->status) }}
                                @endif
    </span>
                        </p>

                        <p class="text-gray-900 dark:text-gray-300"><strong>Created by:</strong> {{ $ticket->user->name }} ({{$ticket->user->email}}) | <span class="@if($ticket->user->role === "Admin") text-blue-400 @elseif($ticket->user->role === "Staff") text-green-500 @else text-white @endif">{{$ticket->user->role}}</span></p>
                        <p class="text-gray-900 dark:text-gray-300"><strong>Created at:</strong> {{ $ticket->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                </div>

                <!-- Replies Section -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Replies</h3>
                    <div class="mt-4 space-y-4">
                        @foreach($ticket->replies as $reply)
                            <div class="border rounded-lg p-4
                                @if($reply->user->role == 'Admin')
                                    bg-blue-900 dark:bg-blue-900
                                @elseif($reply->user->role == 'Staff')
                                    bg-green-900 dark:bg-green-900
                                @else
                                    bg-gray-700 dark:bg-gray-800
                                @endif
                            ">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-gray-900 dark:text-gray-200">{{ $reply->user->name }} | <span class="@if($reply->user->role === 'Admin') bg-blue-400 text-white @elseif($reply->user->role === 'Staff') bg-green-200 text-green-800 @else bg-gray-200 text-gray-800 @endif px-2 py-1 rounded">{{$reply->user->role}}</span></span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $reply->created_at->format('M d, Y h:i A') }}</span>
                                </div>
                                <p class="mt-2 text-gray-800 dark:text-gray-200">{{ $reply->message }}</p>
                            </div>
                        @endforeach
                        @if($ticket->status === "closed")
                                <div class="border rounded-lg p-4 border-red-600 dark:border-red-600">
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-gray-900 dark:text-gray-200"> <span class="bg-red-600 text-white-800 px-2 py-1 rounded">System</span></span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $ticket->closed_at}}</span>
                                    </div>
                                    <p class="mt-2 text-gray-800 dark:text-gray-200">Ticket has been closed by: {{$ticket->closer->name}} | <span class="@if($ticket->closer->role === 'Admin') bg-blue-400 text-white @elseif($ticket->closer->role === 'Staff') bg-green-200 text-green-800 @else bg-gray-200 text-gray-800 @endif px-2 py-1 rounded">{{$ticket->closer->role}}</span></p>
                                </div>
                        @endif
                    </div>
                </div>
            </div>

            @if($ticket->status !== "closed")
                <!-- Reply Form -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Post a Reply</h3>
                    <form action="{{ route('ticket.replies.store', $ticket) }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <textarea name="message" rows="4" class="w-full p-3 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 rounded-lg" placeholder="Type your reply here..." required></textarea>
                        </div>
                        @error('message')
                            <p class="mt-1 mb-4 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, snapp!</span> {{ $message }}</p>
                        @enderror
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">Post Reply</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
