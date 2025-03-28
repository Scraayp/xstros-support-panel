<x-error-layout>
    <x-slot name="title">Server Error</x-slot>
    <x-slot name="code">500</x-slot>
    <x-slot name="message">Something went wrong on our end</x-slot>
    <x-slot name="description">
        We're experiencing some technical difficulties on our servers. Our team has been notified and is working to fix the issue as soon as possible.
    </x-slot>
    <x-slot name="icon">
        <svg class="w-16 h-16 text-primary-600 dark:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
    </x-slot>
    <x-slot name="help">
        <p>In the meantime, you can try:</p>
        <ul class="list-disc list-inside mt-2 space-y-1 text-sm">
            <li>Refreshing the page</li>
            <li>Coming back later</li>
            <li>Contacting our support team if the problem persists</li>
        </ul>
    </x-slot>
    <x-slot name="action">
        <div class="flex flex-col sm:flex-row gap-4 sm:gap-3 mt-6">
            <a href="javascript:window.location.reload()" class="inline-flex justify-center items-center px-5 py-2.5 text-center text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Refresh Page
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
