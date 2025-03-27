<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
            <!-- Background Pattern -->
            <div class="absolute inset-0 z-0 bg-[url('/public/grid-pattern.svg')] bg-center opacity-5 dark:opacity-10"></div>
            
            <!-- Content Container -->
            <div class="z-10 w-full sm:max-w-md px-6 py-8 flex flex-col items-center">
                <!-- Logo -->
                <div class="mb-6 transform hover:scale-105 transition-transform duration-300">
                    <a href="/" class="flex items-center justify-center">
                        <img src="/no-bg-logo.png" alt="Logo" class="h-24 w-auto drop-shadow-md" />
                    </a>
                </div>

                <!-- Card -->
                <div class="w-full bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                    <!-- Card Content -->
                    <div class="px-6 py-6 sm:px-8 sm:py-7">
                        {{ $slot }}
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
                    <div class="mt-2 flex justify-center space-x-4">
                        <a href="#" class="hover:text-gray-700 dark:hover:text-gray-300 transition-colors">Privacy Policy</a>
                        <a href="#" class="hover:text-gray-700 dark:hover:text-gray-300 transition-colors">Terms of Service</a>
                    </div>
                </div>
            </div>
            
            <!-- Theme Toggle Button -->
            <button id="theme-toggle" type="button" class="fixed bottom-4 right-4 z-20 text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-full text-sm p-2.5 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm shadow-md">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <script>
            // Theme toggle functionality
            document.addEventListener('DOMContentLoaded', function() {
                const themeToggleBtn = document.getElementById('theme-toggle');
                const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
                const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

                // Change the icons inside the button based on previous settings
                if (localStorage.getItem('color-theme') === 'dark' || 
                    (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    themeToggleLightIcon.classList.remove('hidden');
                    document.documentElement.classList.add('dark');
                } else {
                    themeToggleDarkIcon.classList.remove('hidden');
                    document.documentElement.classList.remove('dark');
                }

                themeToggleBtn.addEventListener('click', function() {
                    // Toggle icons
                    themeToggleDarkIcon.classList.toggle('hidden');
                    themeToggleLightIcon.classList.toggle('hidden');

                    // Toggle dark mode class
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                });
            });
        </script>
    </body>
</html>

