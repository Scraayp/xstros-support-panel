<nav class="bg-gray-900 p-4 rounded-md shadow-sm" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2">
        <!-- Home Link -->
        <li>
            <a href="/" class="flex items-center text-sm font-medium text-gray-300 hover:text-white transition-colors duration-300">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M10 2.5l7 7V17a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-4H9v4a1 1 0 0 1-1 1H5a2 2 0 0 1-2-2V9.5l7-7z"/>
                </svg>
            </a>
        </li>
        <!-- Dashboard Link -->
        <li class="flex items-center">
            <svg class="w-4 h-4 text-gray-500 mx-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-300 hover:text-white transition-colors duration-300" aria-current="page">
                Dashboard
            </a>
        </li>
    </ol>
</nav>
