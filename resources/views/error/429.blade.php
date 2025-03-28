<x-error-layout>
    <x-slot name="title">Too Many Requests</x-slot>
    <x-slot name="code">429</x-slot>
    <x-slot name="message">You've made too many requests</x-slot>
    <x-slot name="description">
        Our systems have detected that you're sending too many requests in a short period of time. Please wait a moment
        before trying again.
    </x-slot>
    <x-slot name="icon">
        <svg
            class="h-16 w-16 text-black dark:text-white"
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
    </x-slot>
    <x-slot name="help">
        <p>This error typically occurs when:</p>
        <ul class="mt-2 list-inside list-disc space-y-1 text-sm">
            <li>You've submitted a form multiple times</li>
            <li>You're making API requests too quickly</li>
            <li>You're refreshing the page too frequently</li>
        </ul>
    </x-slot>
    <x-slot name="action">
        <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:gap-3">
            <a
                href="javascript:window.location.reload()"
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
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                    ></path>
                </svg>
                Try Again
            </a>
            <a
                href="{{ url('/') }}"
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
                        d="M3 12l2-2m0 0l7-7 7 7m-7-7v14"
                    ></path>
                </svg>
                Go Home
            </a>
        </div>
    </x-slot>
</x-error-layout>
