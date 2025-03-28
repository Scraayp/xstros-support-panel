<x-error-layout>
    <x-slot name="title">Access Denied</x-slot>
    <x-slot name="code">403</x-slot>
    <x-slot name="message">You don't have permission to access this page</x-slot>
    <x-slot name="description">
        Sorry, but you don't have the necessary permissions to view this page. If you believe this is an error, please contact your administrator.
    </x-slot>
    <x-slot name="icon">
        <svg class="w-16 h-16 text-primary-600 dark:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
        </svg>
    </x-slot>
    <x-slot name="help">
        <p>This might be because:</p>
        <ul class="list-disc list-inside mt-2 space-y-1 text-sm">
            <li>You need to log in to access this page</li>
            <li>Your account doesn't have the required permissions</li>
            <li>The resource is restricted to specific users</li>
        </ul>
    </x-slot>
    <x-slot name="action">
        <div class="flex flex-col sm:flex-row gap-4 sm:gap-3 mt-6">
            <a href="{{ route('login') }}" class="inline-flex justify-center items-center px-5 py-2.5 text-center text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Log In
            </a>
            <a href="{{ url('/') }}" class="inline-flex justify-center items-center px-5 py-2.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-7-7v14"></path>
                </svg>
                Go Home
            </a>
        </div>
    </x-slot>
</x-error-layout>
