<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">\
                {{ __('User Management') }}
            </h2>

            <a href="{{ route('user.new') }}">
                <button type="button"
                        class="text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-sm font-medium rounded-lg text-sm px-4 py-2.5 inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create New User
                </button>
            </a>
        </div>
    </x-slot>

    <!-- Toast Notification for User Deleted -->
    @if(session('status') === 'user-deleted')
        <div id="toast-success"
             class="fixed bottom-6 right-6 flex items-center w-full max-w-sm p-4 text-white bg-gradient-to-r from-red-500 to-red-600 rounded-lg shadow-lg z-50 transition-all duration-300 backdrop-blur-sm bg-opacity-90"
             role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
            </div>
            <div class="ml-3 text-sm font-medium">User has been deleted successfully.</div>
            <button onclick="document.getElementById('toast-success').style.display = 'none';"
                    class="ml-auto text-white hover:text-gray-300 focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path>
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

    <!-- Toast Notification for User Not Found -->
    @if(session('status') === 'user-not-found')
        <div id="toast-warning"
             class="fixed bottom-6 right-6 flex items-center w-full max-w-sm p-4 text-white bg-gradient-to-r from-amber-500 to-amber-600 rounded-lg shadow-lg z-50 transition-all duration-300 backdrop-blur-sm bg-opacity-90"
             role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-amber-500 bg-amber-100 rounded-lg dark:bg-amber-800 dark:text-amber-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                </svg>
            </div>
            <div class="ml-3 text-sm font-medium">User could not be found.</div>
            <button onclick="document.getElementById('toast-warning').style.display = 'none';"
                    class="ml-auto text-white hover:text-gray-300 focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('toast-warning');
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
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl overflow-hidden">
                <!-- Search and Filter Bar -->
                <div class="p-4 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
                    <div class="flex items-center">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="text" id="search-users" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white dark:bg-gray-800 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Search users...">
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <select id="role-filter" class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2">
                            <option value="">All Roles</option>
                            <option value="Admin">Admin</option>
                            <option value="Staff">Staff</option>
                            <option value="User">User</option>
                        </select>
                        <button type="button" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none dark:focus:ring-blue-700">Filter</button>
                    </div>
                </div>

                <!-- Desktop Table View -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">User ID</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                    #{{ $user->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                            @if($user->role === 'Admin')
                                                bg-blue-100 text-blue-800 dark:bg-blue-900/60 dark:text-blue-300
                                            @elseif($user->role === 'Staff')
                                                bg-green-100 text-green-800 dark:bg-green-900/60 dark:text-green-300
                                            @else
                                                bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                            @endif
                                        ">
                                            {{ $user->role }}
                                        </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}
                                    <div class="text-xs">{{ \Carbon\Carbon::parse($user->created_at)->format('h:i A') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('user.edit', $user->id) }}"
                                           class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('user.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <button type="submit"
                                                    class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> <!-- End Desktop Table View -->

                <!-- Mobile Card View -->
                <div class="md:hidden divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($users as $user)
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center mb-1">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300 mr-2">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $user->name }}
                                        </div>
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">
                                        ID: #{{ $user->id }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                                        {{ $user->email }}
                                    </div>
                                </div>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                    @if($user->role === 'Admin')
                                        bg-blue-100 text-blue-800 dark:bg-blue-900/60 dark:text-blue-300
                                    @elseif($user->role === 'Staff')
                                        bg-green-100 text-green-800 dark:bg-green-900/60 dark:text-green-300
                                    @else
                                        bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                    @endif
                                ">
                                    {{ $user->role }}
                                </span>
                            </div>

                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-2 mb-3">
                                <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Created: {{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y h:i A') }}
                            </div>

                            <div class="flex space-x-2">
                                <a href="{{ route('user.edit', $user->id) }}"
                                   class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('user.destroy', $user) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button type="submit"
                                            class="w-full inline-flex justify-center items-center px-3 py-2 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div> <!-- End Mobile Card View -->

                <!-- Pagination -->
                <div class="px-6 py-3 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">{{ count($users) }}</span> of <span class="font-medium">{{ count($users) }}</span> users
                        </div>
                        <div class="flex space-x-1">
                            <button disabled class="px-3 py-1 rounded-md bg-gray-200 dark:bg-gray-600 text-gray-400 dark:text-gray-500 cursor-not-allowed">
                                Previous
                            </button>
                            <button disabled class="px-3 py-1 rounded-md bg-gray-200 dark:bg-gray-600 text-gray-400 dark:text-gray-500 cursor-not-allowed">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Button for Create User (Mobile) -->
    <div class="fixed bottom-6 right-6 z-50 md:hidden">
        <a href="{{ route('user.new') }}"
           class="flex items-center justify-center w-14 h-14 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-full shadow-lg hover:shadow-xl transition transform hover:scale-105">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </a>
    </div>

    <script>
        // Search functionality
        document.getElementById('search-users').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            const cards = document.querySelectorAll('.md\\:hidden > div');

            // Filter table rows
            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                if (name.includes(searchValue) || email.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Filter mobile cards
            cards.forEach(card => {
                const name = card.querySelector('.text-sm.font-medium').textContent.toLowerCase();
                const email = card.querySelector('.text-xs.text-gray-500.dark\\:text-gray-400.mb-2').textContent.toLowerCase();
                if (name.includes(searchValue) || email.includes(searchValue)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Role filter functionality
        document.getElementById('role-filter').addEventListener('change', function() {
            const roleValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            const cards = document.querySelectorAll('.md\\:hidden > div');

            if (roleValue === '') {
                // Show all if no filter selected
                rows.forEach(row => row.style.display = '');
                cards.forEach(card => card.style.display = '');
                return;
            }

            // Filter table rows
            rows.forEach(row => {
                const role = row.querySelector('td:nth-child(4) span').textContent.toLowerCase();
                if (role === roleValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Filter mobile cards
            cards.forEach(card => {
                const role = card.querySelector('.inline-flex.items-center').textContent.trim().toLowerCase();
                if (role === roleValue) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>

