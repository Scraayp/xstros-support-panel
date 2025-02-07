<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User - List') }}
        </h2>
    </x-slot>

    <!-- Toast Notification -->
    @if(session('status') === 'user-deleted')
        <div id="toast-danger" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg dark:text-gray-400 dark:bg-gray-800 fixed bottom-4 right-4 z-50" role="alert">
            <div class="inline-flex items-center justify-center w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
            </div>
            <div class="ml-3 text-sm font-normal">User has been deleted.</div>
            <button onclick="document.getElementById('toast-danger').style.display = 'none';" class="ml-auto text-gray-400 hover:text-gray-900 dark:hover:text-white">
                ✖
            </button>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow-xl rounded-xl p-6">
                <div class="text-gray-900 dark:text-gray-100">
                    <!-- Desktop Table View -->
                    <div class="hidden md:block">
                        <table class="w-full divide-y divide-gray-200 dark:divide-gray-700 shadow-sm">
                            <thead class="bg-gray-100 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">User ID</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Created At</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $user->id }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $user->email }}</td>
                                    <td class="px-6 py-4 text-sm">
                                            <span class="@if($user->role === 'Admin') bg-blue-500 text-white @elseif($user->role === 'Staff') bg-green-500 text-white @else bg-gray-400 text-gray-900 @endif px-2 py-1 rounded-full text-xs">
                                                {{ $user->role }}
                                            </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $user->created_at }}</td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                        <a href="{{ route('user.edit', $user->id) }}" class="px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 shadow">Edit</a>
                                        <form action="{{ route('user.destroy', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-2 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 shadow">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div> <!-- End Desktop Table View -->

                    <!-- Mobile Card View -->
                    <div class="md:hidden space-y-6">
                        @foreach ($users as $user)
                            <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                                <div class="text-gray-900 dark:text-gray-100 text-sm space-y-2">
                                    <p><strong>User ID:</strong> {{ $user->id }}</p>
                                    <p><strong>Name:</strong> {{ $user->name }}</p>
                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                    <p><strong>Role:</strong>
                                        <span class="@if($user->role === 'Admin') bg-blue-500 text-white @elseif($user->role === 'Staff') bg-green-500 text-white @else bg-gray-400 text-gray-900 @endif px-2 py-1 rounded-full text-xs">
                                            {{ $user->role }}
                                        </span>
                                    </p>
                                    <p><strong>Created At:</strong> {{ $user->created_at }}</p>
                                </div>
                                <div class="mt-4 flex space-x-2">
                                    <a href="{{ route('user.edit', $user->id) }}" class="px-4 py-2 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 shadow w-full text-center">Edit</a>
                                    <form action="{{ route('user.destroy', $user) }}" method="POST" class="w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 shadow w-full">Delete</button>
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
