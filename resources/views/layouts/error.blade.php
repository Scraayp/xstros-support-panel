<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ $title ?? 'Error' }} - {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .animated-background {
                background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
                background-size: 400% 400%;
                animation: gradient 15s ease infinite;
            }

            @keyframes gradient {
                0% {
                    background-position: 0% 50%;
                }
                50% {
                    background-position: 100% 50%;
                }
                100% {
                    background-position: 0% 50%;
                }
            }

            .error-number {
                text-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }

            .blob {
                position: absolute;
                border-radius: 50%;
                filter: blur(60px);
                z-index: 0;
                animation: float 8s ease-in-out infinite;
                opacity: 0.5;
            }

            @keyframes float {
                0%,
                100% {
                    transform: translateY(0) scale(1);
                }
                50% {
                    transform: translateY(-20px) scale(1.05);
                }
            }
        </style>
    </head>
    <body class="h-full font-sans antialiased">
        @include('layouts.navigation')

        <div
            class="relative flex min-h-screen flex-col items-center justify-center overflow-hidden bg-gray-50 px-6 dark:bg-gray-900"
        >
            <!-- Decorative blobs -->
            <div class="blob top-0 -left-20 h-64 w-64 bg-blue-300 dark:bg-blue-600"></div>
            <div class="blob -right-20 bottom-0 h-80 w-80 bg-purple-300 dark:bg-purple-600"></div>

            <!-- Logo -->
            <div class="z-10 mb-8">
                <a href="{{ url('/') }}" class="flex items-center justify-center">
                    @if (file_exists(public_path('no-bg-logo.png')))
                        <img
                            src="/no-bg-logo.png"
                            alt="{{ config('app.name', 'Laravel') }}"
                            class="h-16 w-auto drop-shadow-md"
                        />
                    @else
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ config('app.name', 'Laravel') }}
                        </span>
                    @endif
                </a>
            </div>

            <!-- Error Card -->
            <div
                class="z-10 w-full max-w-2xl overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-700 dark:bg-gray-800"
            >
                <div class="p-8 md:p-10">
                    <!-- Error Header -->
                    <div class="mb-8 flex flex-col items-center justify-between md:flex-row">
                        <div class="mb-6 flex flex-col items-center text-center md:mb-0 md:items-start md:text-left">
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $title }}</h1>
                            <p class="mt-2 text-lg text-gray-600 dark:text-gray-300">{{ $message }}</p>
                        </div>
                        <div
                            class="bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 flex h-24 w-24 flex-shrink-0 items-center justify-center rounded-full"
                        >
                            {{ $icon }}
                        </div>
                    </div>

                    <!-- Error Code -->
                    <div class="mb-8 flex items-center justify-center">
                        <div class="relative">
                            <div class="error-number text-8xl font-extrabold text-black md:text-9xl dark:text-white">
                                {{ $code }}
                            </div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-primary-500 dark:bg-primary-400 h-1 w-24 rounded-full"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Error Description -->
                    <div class="mb-8">
                        <p class="text-center text-base text-gray-600 dark:text-gray-300">{{ $description }}</p>
                    </div>

                    <!-- Help Section -->
                    <div class="mb-8 rounded-xl bg-gray-50 p-6 dark:bg-gray-700/50">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg
                                    class="text-primary-500 h-6 w-6"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    ></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900 dark:text-white">Helpful Information</h3>
                                <div class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                    {{ $help }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-center">
                        {{ $action }}
                    </div>
                </div>

                <!-- Footer -->
                <div
                    class="border-t border-gray-200 bg-gray-50 px-8 py-4 text-center dark:border-gray-700 dark:bg-gray-700/30"
                >
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        If you need assistance, please
                        <a
                            href="{{ route('ticket.create') ?? '#' }}"
                            class="text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300 font-medium"
                        >
                            contact our support team
                        </a>
                        .
                    </p>
                </div>
            </div>

            <!-- Copyright -->
            <div class="z-10 mt-8 mb-4 text-center text-sm text-gray-500 dark:text-gray-400">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
            </div>

            <!-- Theme Toggle Button -->
        </div>
    </body>
</html>
