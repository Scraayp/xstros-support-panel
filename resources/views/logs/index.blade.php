<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl leading-tight font-semibold text-gray-800 dark:text-gray-200">
            {{ __('Logs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="text-lg font-medium mb-2 sm:mb-0">
                            Activity Logs
                        </h3>
                        <div class="flex items-center space-x-2">
                            <select id="log-filter" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                                <option value="" {{ $selectedFilter == '' ? 'selected' : '' }}>All activities</option>
                                <option value="created" {{ $selectedFilter == 'created' ? 'selected' : '' }}>Created</option>
                                <option value="updated" {{ $selectedFilter == 'updated' ? 'selected' : '' }}>Updated</option>
                                <option value="deleted" {{ $selectedFilter == 'deleted' ? 'selected' : '' }}>Deleted</option>
                            </select>
                            <select id="role-filter" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                                <option value="" {{ $selectedRole == '' ? 'selected' : '' }}>All roles</option>
                                <option value="User" {{ $selectedRole == 'User' ? 'selected' : '' }}>User</option>
                                <option value="Staff" {{ $selectedRole == 'Staff' ? 'selected' : '' }}>Staff</option>
                                <option value="Admin" {{ $selectedRole == 'Admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @forelse ($logs as $log)
                            <div class="border dark:border-gray-700 rounded-lg overflow-hidden
                                @if ($log->causer && $log->causer->role)
                                    @if ($log->causer->role == 'Admin')
                                        border-l-4 border-l-red-500 dark:border-l-red-600
                                    @elseif ($log->causer->role == 'Staff')
                                        border-l-4 border-l-blue-500 dark:border-l-blue-600
                                    @elseif ($log->causer->role == 'User')
                                        border-l-4 border-l-green-500 dark:border-l-green-600
                                    @endif
                                @endif
                            ">
                                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 flex items-center justify-between">
                                    <div class="flex items-center">
                                        @if ($log->causer)
                                            <div class="flex-shrink-0">
                                                <div class="relative">
                                                    <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($log->causer->name) }}&color=7F9CF5&background=EBF4FF" alt="{{ $log->causer->name }}">
                                                    @if ($log->causer->role)
                                                        <div class="absolute -bottom-1 -right-1 h-4 w-4 rounded-full 
                                                            @if ($log->causer->role == 'Admin')
                                                                bg-red-500
                                                            @elseif ($log->causer->role == 'Staff')
                                                                bg-blue-500
                                                            @elseif ($log->causer->role == 'User')
                                                                bg-green-500
                                                            @endif
                                                            border-2 border-white dark:border-gray-700"></div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <div class="flex items-center">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ $log->causer->name }}
                                                    </p>
                                                    @if ($log->causer->role)
                                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                                            @if ($log->causer->role == 'Admin')
                                                                bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                                                            @elseif ($log->causer->role == 'Staff')
                                                                bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                                            @elseif ($log->causer->role == 'User')
                                                                bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                                            @endif
                                                        ">
                                                            {{ $log->causer->role }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $log->causer->email }}
                                                </p>
                                            </div>
                                        @else
                                            <div class="flex-shrink-0">
                                                <div class="h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                                    <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                    System
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $log->created_at->diffForHumans() }}
                                        <span class="text-gray-400 dark:text-gray-500 ml-1" title="{{ $log->created_at }}">
                                            ({{ $log->created_at->format('M j, Y g:i A') }})
                                        </span>
                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-white dark:bg-gray-800
                                    @if ($log->causer && $log->causer->role)
                                        @if ($log->causer->role == 'Admin')
                                            bg-red-50 dark:bg-red-900/10
                                        @elseif ($log->causer->role == 'Staff')
                                            bg-blue-50 dark:bg-blue-900/10
                                        @elseif ($log->causer->role == 'User')
                                            bg-green-50 dark:bg-green-900/10
                                        @endif
                                    @endif
                                ">
                                    <div class="mb-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            @if($log->description == 'created') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                            @elseif($log->description == 'updated') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                            @elseif($log->description == 'deleted') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                                            @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                            @endif">
                                            {{ ucfirst($log->description) }}
                                        </span>
                                    </div>
                                    
                                    <p class="text-sm text-gray-700 dark:text-gray-300">
                                        @if ($log->subject)
                                            <span class="font-medium">{{ class_basename($log->subject_type) }}</span>
                                            @if (method_exists($log->subject, 'name') && $log->subject->name)
                                                "{{ $log->subject->name }}"
                                            @elseif (method_exists($log->subject, 'title') && $log->subject->title)
                                                "{{ $log->subject->title }}"
                                            @elseif (isset($log->subject->id))
                                                #{{ $log->subject->id }}
                                            @endif
                                        @else
                                            <span class="font-medium">{{ class_basename($log->subject_type) ?? 'Unknown' }}</span>
                                            (deleted)
                                        @endif
                                    </p>
                                    
                                    @if (!empty($log->properties))
                                        <div class="mt-2">
                                            <button class="text-xs text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300" onclick="toggleProperties('properties-{{ $log->id }}')">
                                                Show details
                                            </button>
                                            <div id="properties-{{ $log->id }}" class="hidden mt-2 p-2 bg-gray-50 dark:bg-gray-700 rounded text-xs font-mono overflow-x-auto">
                                                <pre class="text-gray-700 dark:text-gray-300">{{ json_encode($log->properties, JSON_PRETTY_PRINT) }}</pre>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                                No activity logs found.
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleProperties(id) {
            const element = document.getElementById(id);
            if (element.classList.contains('hidden')) {
                element.classList.remove('hidden');
            } else {
                element.classList.add('hidden');
            }
        }

        document.getElementById('log-filter').addEventListener('change', function() {
            const value = this.value;
            const url = new URL(window.location);
            
            if (value) {
                url.searchParams.set('filter', value);
            } else {
                url.searchParams.delete('filter');
            }
            
            window.location = url;
        });

        document.getElementById('role-filter').addEventListener('change', function() {
            const value = this.value;
            const url = new URL(window.location);
            
            if (value) {
                url.searchParams.set('role', value);
            } else {
                url.searchParams.delete('role');
            }
            
            window.location = url;
        });
    </script>
</x-app-layout>

