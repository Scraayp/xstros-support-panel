<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-2xl leading-tight font-semibold text-gray-800 dark:text-gray-200">
                {{ __("User Management") }}
            </h2>

            <a href="{{ route("user.new") }}" class="group">
                <button
                    type="button"
                    class="inline-flex items-center rounded-lg bg-gradient-to-r from-blue-600 to-blue-500 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition-all duration-200 group-hover:shadow-md hover:from-blue-500 hover:to-blue-600 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800"
                >
                    <svg
                        class="mr-2 h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                        ></path>
                    </svg>
                    Create New User
                </button>
            </a>
        </div>
    </x-slot>

    <!-- Toast Notifications -->
    <div id="toast-container" class="fixed right-6 bottom-6 z-50 space-y-4"></div>

    <!-- Toast Notification for User Deleted -->
    @if (session("status") === "user-deleted")
        <div
            id="toast-success"
            class="bg-opacity-90 fixed right-6 bottom-6 z-50 flex w-full max-w-sm translate-y-0 transform items-center rounded-lg bg-gradient-to-r from-green-500 to-green-600 p-4 text-white opacity-100 shadow-lg backdrop-blur-sm transition-all duration-300"
            role="alert"
        >
            <div
                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-green-100 text-green-500 dark:bg-green-800 dark:text-green-200"
            >
                <svg
                    class="h-5 w-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
                    />
                </svg>
            </div>
            <div class="ml-3 text-sm font-medium">User has been deleted successfully.</div>
            <button
                onclick="document.getElementById('toast-success').style.display = 'none';"
                class="ml-auto text-white hover:text-gray-300 focus:outline-none"
            >
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    ></path>
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
    @if (session("status") === "user-not-found")
        <div
            id="toast-warning"
            class="bg-opacity-90 fixed right-6 bottom-6 z-50 flex w-full max-w-sm translate-y-0 transform items-center rounded-lg bg-gradient-to-r from-amber-500 to-amber-600 p-4 text-white opacity-100 shadow-lg backdrop-blur-sm transition-all duration-300"
            role="alert"
        >
            <div
                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-amber-100 text-amber-500 dark:bg-amber-800 dark:text-amber-200"
            >
                <svg
                    class="h-5 w-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"
                    />
                </svg>
            </div>
            <div class="ml-3 text-sm font-medium">User could not be found.</div>
            <button
                onclick="document.getElementById('toast-warning').style.display = 'none';"
                class="ml-auto text-white hover:text-gray-300 focus:outline-none"
            >
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    ></path>
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
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Stats Overview -->
            <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-3">
                <!-- Total Users -->
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-800"
                >
                    <div class="relative overflow-hidden p-6">
                        <div
                            class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-blue-500 opacity-10"
                        ></div>
                        <div
                            class="absolute right-0 bottom-0 -mr-4 -mb-4 h-24 w-24 rounded-full bg-blue-500 opacity-10"
                        ></div>

                        <div class="flex items-center">
                            <div
                                class="mr-4 rounded-full bg-blue-100 p-3 text-blue-600 dark:bg-blue-900/30 dark:text-blue-300"
                            >
                                <svg
                                    class="h-6 w-6"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                    ></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Users</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ count($users) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Admin Users -->
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-800"
                >
                    <div class="relative overflow-hidden p-6">
                        <div
                            class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-indigo-500 opacity-10"
                        ></div>
                        <div
                            class="absolute right-0 bottom-0 -mr-4 -mb-4 h-24 w-24 rounded-full bg-indigo-500 opacity-10"
                        ></div>

                        <div class="flex items-center">
                            <div
                                class="mr-4 rounded-full bg-indigo-100 p-3 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-300"
                            >
                                <svg
                                    class="h-6 w-6"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                                    ></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Admin Users</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ $users->where("role", "Admin")->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Staff Users -->
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-800"
                >
                    <div class="relative overflow-hidden p-6">
                        <div
                            class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-green-500 opacity-10"
                        ></div>
                        <div
                            class="absolute right-0 bottom-0 -mr-4 -mb-4 h-24 w-24 rounded-full bg-green-500 opacity-10"
                        ></div>

                        <div class="flex items-center">
                            <div
                                class="mr-4 rounded-full bg-green-100 p-3 text-green-600 dark:bg-green-900/30 dark:text-green-300"
                            >
                                <svg
                                    class="h-6 w-6"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                    ></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Staff Users</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ $users->where("role", "Staff")->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-md dark:border-gray-700 dark:bg-gray-800"
            >
                <!-- Search and Filter Bar -->
                <div class="border-b border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-700">
                    <div
                        class="flex flex-col items-start justify-between space-y-3 sm:flex-row sm:items-center sm:space-y-0"
                    >
                        <div class="relative w-full sm:w-64">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg
                                    class="h-4 w-4 text-gray-500 dark:text-gray-400"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                                    />
                                </svg>
                            </div>
                            <input
                                type="text"
                                id="search-users"
                                class="block w-full rounded-lg border border-gray-300 bg-white p-2 pl-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white"
                                placeholder="Search users by name or email..."
                            />
                        </div>
                        <div class="flex w-full items-center space-x-2 sm:w-auto">
                            <select
                                id="role-filter"
                                class="block rounded-lg border border-gray-300 bg-white p-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white"
                            >
                                <option value="">All Roles</option>
                                <option value="Admin">Admin</option>
                                <option value="Staff">Staff</option>
                                <option value="User">User</option>
                            </select>
                            <button
                                type="button"
                                id="filter-button"
                                class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700"
                            >
                                <span class="flex items-center">
                                    <svg
                                        class="mr-1.5 h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"
                                        ></path>
                                    </svg>
                                    Filter
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Desktop Table View -->
                <div class="hidden overflow-x-auto md:block">
                    <table class="w-full text-left">
                        <thead class="border-b border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                >
                                    User ID
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                >
                                    Name
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                >
                                    Email
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                >
                                    Role
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                >
                                    Created
                                </th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                >
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($users as $user)
                                <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="px-6 py-4 text-sm font-medium whitespace-nowrap text-gray-900 dark:text-white"
                                    >
                                        #{{ $user->id }}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-700 dark:text-gray-300">
                                        <div class="flex items-center">
                                            <div
                                                class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-gray-300 to-gray-400 font-medium text-white shadow-sm dark:from-gray-600 dark:to-gray-700 dark:text-gray-300"
                                            >
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-700 dark:text-gray-300">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="@if ($user->role === "Admin")
                                                bg-blue-100
                                                text-blue-800
                                                dark:bg-blue-900/60
                                                dark:text-blue-300
                                            @elseif ($user->role === "Staff")
                                                bg-green-100
                                                text-green-800
                                                dark:bg-green-900/60
                                                dark:text-green-300
                                            @else
                                                bg-gray-100
                                                text-gray-800
                                                dark:bg-gray-700
                                                dark:text-gray-300
                                            @endif inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium"
                                        >
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                        {{ \Carbon\Carbon::parse($user->created_at)->format("M d, Y") }}
                                        <div class="text-xs">
                                            {{ \Carbon\Carbon::parse($user->created_at)->format("h:i A") }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a
                                                href="{{ route("user.edit", $user->id) }}"
                                                class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-2.5 py-1.5 text-xs font-medium text-white transition-colors hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
                                            >
                                                <svg
                                                    class="mr-1 h-3.5 w-3.5"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                                    ></path>
                                                </svg>
                                                Edit
                                            </a>
                                            <button
                                                type="button"
                                                onclick="confirmDelete('{{ $user->id }}', '{{ $user->name }}')"
                                                class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-2.5 py-1.5 text-xs font-medium text-white transition-colors hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:outline-none"
                                            >
                                                <svg
                                                    class="mr-1 h-3.5 w-3.5"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                    ></path>
                                                </svg>
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Desktop Table View -->

                <!-- Mobile Card View -->
                <div class="divide-y divide-gray-200 md:hidden dark:divide-gray-700">
                    @foreach ($users as $user)
                        <div class="p-4 transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div class="mb-1 flex items-center">
                                        <div
                                            class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-gray-300 to-gray-400 font-medium text-white shadow-sm dark:from-gray-600 dark:to-gray-700 dark:text-gray-300"
                                        >
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $user->name }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span
                                    class="@if ($user->role === "Admin")
                                        bg-blue-100
                                        text-blue-800
                                        dark:bg-blue-900/60
                                        dark:text-blue-300
                                    @elseif ($user->role === "Staff")
                                        bg-green-100
                                        text-green-800
                                        dark:bg-green-900/60
                                        dark:text-green-300
                                    @else
                                        bg-gray-100
                                        text-gray-800
                                        dark:bg-gray-700
                                        dark:text-gray-300
                                    @endif inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium"
                                >
                                    {{ $user->role }}
                                </span>
                            </div>

                            <div class="mt-2 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                <svg
                                    class="mr-1 h-3.5 w-3.5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"
                                    ></path>
                                </svg>
                                ID: #{{ $user->id }}
                            </div>

                            <div class="mt-1 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                <svg
                                    class="mr-1 h-3.5 w-3.5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                    ></path>
                                </svg>
                                Created: {{ \Carbon\Carbon::parse($user->created_at)->format("M d, Y h:i A") }}
                            </div>

                            <div class="mt-3 flex space-x-2">
                                <a
                                    href="{{ route("user.edit", $user->id) }}"
                                    class="inline-flex flex-1 items-center justify-center rounded-md border border-transparent bg-blue-600 px-3 py-2 text-xs font-medium text-white transition-colors hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
                                >
                                    <svg
                                        class="mr-1 h-3.5 w-3.5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                        ></path>
                                    </svg>
                                    Edit
                                </a>
                                <button
                                    type="button"
                                    onclick="confirmDelete('{{ $user->id }}', '{{ $user->name }}')"
                                    class="inline-flex flex-1 items-center justify-center rounded-md border border-transparent bg-red-600 px-3 py-2 text-xs font-medium text-white transition-colors hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:outline-none"
                                >
                                    <svg
                                        class="mr-1 h-3.5 w-3.5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0016.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                        ></path>
                                    </svg>
                                    Delete
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- End Mobile Card View -->

                <!-- Pagination -->
                <div class="border-t border-gray-200 bg-gray-50 px-6 py-3 dark:border-gray-700 dark:bg-gray-700">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Showing
                            <span class="font-medium">1</span>
                            to
                            <span class="font-medium">{{ count($users) }}</span>
                            of
                            <span class="font-medium">{{ count($users) }}</span>
                            users
                        </div>
                        <div class="flex space-x-1">
                            <button
                                disabled
                                class="cursor-not-allowed rounded-md bg-gray-200 px-3 py-1 text-gray-400 dark:bg-gray-600 dark:text-gray-500"
                            >
                                Previous
                            </button>
                            <button
                                disabled
                                class="cursor-not-allowed rounded-md bg-gray-200 px-3 py-1 text-gray-400 dark:bg-gray-600 dark:text-gray-500"
                            >
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Button for Create User (Mobile) -->
    <div class="fixed right-6 bottom-6 z-50 md:hidden">
        <a
            href="{{ route("user.new") }}"
            class="flex h-14 w-14 transform items-center justify-center rounded-full bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg transition hover:scale-105 hover:shadow-xl"
        >
            <svg
                class="h-6 w-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                ></path>
            </svg>
        </a>
    </div>

    <!-- Delete Confirmation Modal -->
    <div
        id="delete-modal"
        class="fixed inset-0 z-50 hidden overflow-y-auto"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true"
    >
        <div class="flex min-h-screen items-end justify-center px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div
                class="bg-opacity-75 dark:bg-opacity-75 fixed inset-0 bg-gray-500 transition-opacity dark:bg-gray-900"
                aria-hidden="true"
            ></div>

            <!-- Modal panel -->
            <div
                class="inline-block transform overflow-hidden rounded-lg bg-white text-left align-bottom shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:align-middle dark:bg-gray-800"
            >
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 dark:bg-gray-800">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10 dark:bg-red-900/30"
                        >
                            <svg
                                class="h-6 w-6 text-red-600 dark:text-red-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                                ></path>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                                Delete User
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Are you sure you want to delete
                                    <span
                                        id="delete-user-name"
                                        class="font-medium text-gray-700 dark:text-gray-300"
                                    ></span>
                                    ? This action cannot be undone.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 dark:bg-gray-700">
                    <form id="delete-form" action="" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="hidden" name="user_id" id="delete-user-id" />
                        <button
                            type="submit"
                            class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm transition-colors hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm"
                        >
                            Delete
                        </button>
                    </form>
                    <button
                        type="button"
                        onclick="closeModal()"
                        class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Search functionality
        document.getElementById('search-users').addEventListener('keyup', function () {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            const cards = document.querySelectorAll('.md\\:hidden > div');

            // Filter table rows
            rows.forEach((row) => {
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                if (name.includes(searchValue) || email.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Filter mobile cards
            cards.forEach((card) => {
                const name = card.querySelector('.text-sm.font-medium').textContent.toLowerCase();
                const email = card.querySelector('.text-xs.text-gray-500').textContent.toLowerCase();
                if (name.includes(searchValue) || email.includes(searchValue)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Role filter functionality
        document.getElementById('filter-button').addEventListener('click', function () {
            const roleValue = document.getElementById('role-filter').value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            const cards = document.querySelectorAll('.md\\:hidden > div');

            if (roleValue === '') {
                // Show all if no filter selected
                rows.forEach((row) => (row.style.display = ''));
                cards.forEach((card) => (card.style.display = ''));
                return;
            }

            // Filter table rows
            rows.forEach((row) => {
                const role = row.querySelector('td:nth-child(4) span').textContent.toLowerCase();
                if (role === roleValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Filter mobile cards
            cards.forEach((card) => {
                const role = card.querySelector('.inline-flex.items-center').textContent.trim().toLowerCase();
                if (role === roleValue) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Delete confirmation modal
        function confirmDelete(userId, userName) {
            document.getElementById('delete-user-id').value = userId;
            document.getElementById('delete-user-name').textContent = userName;
            document.getElementById('delete-form').action = '{{ route("user.destroy", "") }}/' + userId;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }

        // Close modal when clicking outside
        window.addEventListener('click', function (event) {
            const modal = document.getElementById('delete-modal');
            if (event.target === modal) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && !document.getElementById('delete-modal').classList.contains('hidden')) {
                closeModal();
            }
        });
    </script>
</x-app-layout>
