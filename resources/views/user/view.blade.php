<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User - List') }}
        </h2>
    </x-slot>

    <!-- Toast Notification -->
    @if(session('status') === 'user-deleted')
        <div id="toast-danger" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800 fixed bottom-4 right-4" role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
            </div>
            <div class="ms-3 text-sm font-normal">User has been deleted.</div>
            <button onclick="document.getElementById('toast-danger').style.display = 'none';" class="ms-auto text-gray-400 hover:text-gray-900 dark:hover:text-white">
                ✖
            </button>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xs sm:rounded-lg p-4">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <!-- Desktop Table View -->
                    <div class="hidden md:block">
                        <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">User ID</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Name</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Email</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Role</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Created At</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-4 py-3 text-sm">{{ $user->id }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $user->name }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $user->email }}</td>
                                    <td class="px-4 py-3 text-sm">
                                            <span class="@if($user->role === 'Admin') bg-blue-400 text-white @elseif($user->role === 'Staff') bg-green-200 text-green-800 @else bg-gray-200 text-gray-800 @endif px-2 py-1 rounded text-xs">
                                                {{$user->role}}
                                            </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">{{ $user->created_at }}</td>
                                    <td class="px-4 py-3 text-center flex justify-center items-center space-x-2">
                                        <a href="{{route('user.edit', $user->id)}}" class="px-3 py-1 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700">Edit</a>
                                        <form action="{{ route('user.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div> <!-- End Desktop Table View -->

                    <!-- Mobile Card View -->
                    <div class="md:hidden space-y-4">
                        @foreach ($users as $user)
                            <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow">
                                <div class="text-gray-900 dark:text-gray-100 text-sm">
                                    <p><strong>User ID:</strong> {{ $user->id }}</p>
                                    <p><strong>Name:</strong> {{ $user->name }}</p>
                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                    <p><strong>Role:</strong>
                                        <span class="@if($user->role === 'Admin') bg-blue-400 text-white @elseif($user->role === 'Staff') bg-green-200 text-green-800 @else bg-gray-200 text-gray-800 @endif px-2 py-1 rounded text-xs">
                                            {{$user->role}}
                                        </span>
                                    </p>
                                    <p><strong>Created At:</strong> {{ $user->created_at }}</p>
                                </div>
                                <div class="mt-3 flex flex-col space-y-2">
                                    <a href="{{route('user.edit', $user->id)}}" class="px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 text-center">Edit</a>
                                    <form action="{{ route('user.destroy', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-2 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700 w-full">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div> <!-- End Mobile Card View -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
