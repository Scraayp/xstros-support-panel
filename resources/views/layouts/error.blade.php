<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Error' }} - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
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
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-20px) scale(1.05);
            }
        }
    </style>
</head>
<body class="font-sans antialiased h-full">
    @include('layouts.navigation')

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 flex flex-col justify-center items-center px-6 relative overflow-hidden">
        
        <!-- Decorative blobs -->
        <div class="blob bg-blue-300 dark:bg-blue-600 w-64 h-64 top-0 -left-20"></div>
        <div class="blob bg-purple-300 dark:bg-purple-600 w-80 h-80 bottom-0 -right-20"></div>
        
        <!-- Logo -->
        <div class="mb-8 z-10">
            <a href="{{ url('/') }}" class="flex items-center justify-center">
                @if(file_exists(public_path('no-bg-logo.png')))
                    <img src="/no-bg-logo.png" alt="{{ config('app.name', 'Laravel') }}" class="h-16 w-auto drop-shadow-md" />
                @else
                    <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ config('app.name', 'Laravel') }}</span>
                @endif
            </a>
        </div>

        <!-- Error Card -->
        <div class="w-full max-w-2xl bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700 z-10">
            <div class="p-8 md:p-10">
                <!-- Error Header -->
                <div class="flex flex-col md:flex-row items-center justify-between mb-8">
                    <div class="flex flex-col items-center md:items-start text-center md:text-left mb-6 md:mb-0">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $title }}</h1>
                        <p class="mt-2 text-lg text-gray-600 dark:text-gray-300">{{ $message }}</p>
                    </div>
                    <div class="flex-shrink-0 flex items-center justify-center w-24 h-24 rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400">
                        {{ $icon }}
                    </div>
                </div>

                <!-- Error Code -->
                <div class="flex items-center justify-center mb-8">
                    <div class="relative">
                        <div class="error-number text-8xl md:text-9xl font-extrabold text-black dark:text-white">{{ $code }}</div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="h-1 w-24 bg-primary-500 dark:bg-primary-400 rounded-full"></div>
                        </div>
                    </div>
                </div>

                <!-- Error Description -->
                <div class="mb-8">
                    <p class="text-base text-gray-600 dark:text-gray-300 text-center">{{ $description }}</p>
                </div>

                <!-- Help Section -->
                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6 mb-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
            <div class="px-8 py-4 bg-gray-50 dark:bg-gray-700/30 border-t border-gray-200 dark:border-gray-700 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    If you need assistance, please <a href="{{ route('ticket.create') ?? '#' }}" class="font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">contact our support team</a>.
                </p>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-8 mb-4 text-center text-sm text-gray-500 dark:text-gray-400 z-10">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
        </div>

        <!-- Theme Toggle Button -->
    </div>
</body>
</html>
