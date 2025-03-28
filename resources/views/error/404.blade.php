<x-error-layout>
    <x-slot name="title">Page Not Found</x-slot>
    <x-slot name="code">404</x-slot>
    <x-slot name="message">The page you're looking for doesn't exist</x-slot>
    <x-slot name="description">
        Sorry, we couldn't find the page you're looking for. The page might have been removed, had its name changed, or
        is temporarily unavailable.
    </x-slot>
    <x-slot name="icon">
        <svg
            class="text-primary-600 dark:text-primary-500 h-16 w-16"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
            ></path>
        </svg>
    </x-slot>
    <x-slot name="help">
        <p>You might want to check if:</p>
        <ul class="mt-2 list-inside list-disc space-y-1 text-sm">
            <li>The URL was typed correctly</li>
            <li>The page has been moved or deleted</li>
            <li>You have the necessary permissions to access this page</li>
        </ul>
    </x-slot>
    <x-slot name="action">
        <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:gap-3">
            <a
                href="{{ url('/') }}"
                class="bg-primary-600 hover:bg-primary-700 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 inline-flex items-center justify-center rounded-lg px-5 py-2.5 text-center font-medium text-white focus:ring-4"
            >
                <svg
                    class="mr-2 h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7m-7-7v14"
                    ></path>
                </svg>
                Go Home
            </a>
            <a
                href="javascript:history.back()"
                class="hover:text-primary-700 inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-200 focus:outline-none dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
            >
                <svg
                    class="mr-2 h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                    ></path>
                </svg>
                Go Back
            </a>
        </div>
    </x-slot>
</x-error-layout>
