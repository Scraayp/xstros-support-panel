<x-app-layout>
    @if(session('status') === 'oath-connection')
        <div id="toast-success"
            class="fixed bottom-6 right-6 flex items-center w-full max-w-sm p-4 text-white bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg shadow-lg z-50 transition-all duration-300 backdrop-blur-sm bg-opacity-90 transform translate-y-0 opacity-100"
            role="alert">
            <div class="fixed bottom-6 right-6 flex items-center w-full max-w-sm p-4 text-white bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg shadow-lg backdrop-blur-sm bg-opacity-90 z-50 transition-all duration-300 transform translate-y-0 opacity-100"
            role="alert">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
            </div>
            <div class="ml-3 text-sm font-medium">Your account has been succesfully added!</div>
            <button onclick="document.getElementById('toast-success').style.display = 'none';"
                    class="ml-auto text-white hover:text-gray-300 focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
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
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.oath-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
