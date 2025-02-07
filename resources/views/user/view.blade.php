<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User - List') }}
        </h2>
    </x-slot>

    <!-- Toast Notification -->
    @if(session('status') === 'user-deleted')
        <div id="toast-danger"
             class="fixed bottom-6 right-6 flex items-center w-full max-w-sm p-4 text-gray-100 bg-red-500 rounded-xl shadow-lg z-50 transition-all duration-300"
             role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ml-3 text-sm font-medium">User has been deleted successfully.</div>
            <button onclick="document.getElementById('toast-danger').style.display = 'none';"
                    class="ml-auto text-white hover:text-gray-300">
                ✖
            </button>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('toast-danger').style.opacity = '0';
                setTimeout(() => document.getElementById('toast-danger').remove(), 300);
            }, 4000);
        </script>
    @endif
    <!-- Toast Notification -->
    @if(session('status') === 'user-not-found')
        <div id="toast-user"
             class="fixed bottom-6 right-6 flex items-center w-full max-w-sm p-4 text-gray-100 bg-red-500 rounded-xl shadow-lg z-50 transition-all duration-300"
             role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                </svg>
                <span class="sr-only">Warning icon</span>
            </div>
            <div class="ml-3 text-sm font-medium">User could not be found.</div>
            <button onclick="document.getElementById('toast-user').style.display = 'none';"
                    class="ml-auto text-white hover:text-gray-300">
                ✖
            </button>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('toast-user').style.opacity = '0';
                setTimeout(() => document.getElementById('toast-user').remove(), 300);
            }, 4000);
        </script>
    @endif

    <!-- Create User Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="{{ route('user.new') }}"
           class="flex items-center px-5 py-3 bg-blue-600 text-white text-sm font-semibold rounded-full shadow-lg hover:bg-blue-700 transition transform hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
            </svg>
            Create User
        </a>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow-xl rounded-xl p-6">
                <div class="text-gray-900 dark:text-gray-100">

                    <!-- User Table -->
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
                                        <span class="@if($user->role === 'Admin') bg-blue-500 text-white
                                            @elseif($user->role === 'Staff') bg-green-500 text-white
                                            @else bg-gray-400 text-gray-900 @endif px-2 py-1 rounded-full text-xs">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $user->created_at }}</td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                        <a href="{{ route('user.edit', $user->id) }}"
                                           class="px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 shadow">Edit</a>
                                        <form action="{{ route('user.destroy', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <button type="submit"
                                                    class="px-3 py-2 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 shadow">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="md:hidden space-y-6">
                        @foreach ($users as $user)
                            <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                                <div class="text-gray-900 dark:text-gray-100 text-sm space-y-2">
                                    <p><strong>User ID:</strong> {{ $user->id }}</p>
                                    <p><strong>Name:</strong> {{ $user->name }}</p>
                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                    <p><strong>Role:</strong>
                                        <span class="@if($user->role === 'Admin') bg-blue-500 text-white
                                            @elseif($user->role === 'Staff') bg-green-500 text-white
                                            @else bg-gray-400 text-gray-900 @endif px-2 py-1 rounded-full text-xs">
                                            {{ $user->role }}
                                        </span>
                                    </p>
                                    <p><strong>Created At:</strong> {{ $user->created_at }}</p>
                                </div>
                                <div class="mt-4 flex space-x-2">
                                    <a href="{{ route('user.edit', $user->id) }}"
                                       class="px-4 py-2 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 shadow w-full text-center">
                                        Edit
                                    </a>
                                    <form action="{{ route('user.destroy', $user) }}" method="POST" class="w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-4 py-2 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 shadow w-full">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
