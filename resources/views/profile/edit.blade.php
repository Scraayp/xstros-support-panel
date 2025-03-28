<x-app-layout>
    @if (session('status') === 'oath-connection')
        <div
            id="toast-success"
            class="bg-opacity-90 fixed right-6 bottom-6 z-50 flex w-full max-w-sm translate-y-0 transform items-center rounded-lg bg-gradient-to-r from-green-500 to-emerald-600 p-4 text-white opacity-100 shadow-lg backdrop-blur-sm transition-all duration-300"
            role="alert"
        >
            <div
                class="bg-opacity-90 fixed right-6 bottom-6 z-50 flex w-full max-w-sm translate-y-0 transform items-center rounded-lg bg-gradient-to-r from-green-500 to-emerald-600 p-4 text-white opacity-100 shadow-lg backdrop-blur-sm transition-all duration-300"
                role="alert"
            >
                <svg
                    class="h-5 w-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"
                    />
                </svg>
            </div>
            <div class="ml-3 text-sm font-medium">Your account has been succesfully added!</div>
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

    <x-slot name="header">
        <h2 class="text-xl leading-tight font-semibold text-gray-800 dark:text-gray-200">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white p-4 shadow-sm sm:rounded-lg sm:p-8 dark:bg-gray-800">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white p-4 shadow-sm sm:rounded-lg sm:p-8 dark:bg-gray-800">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white p-4 shadow-sm sm:rounded-lg sm:p-8 dark:bg-gray-800">
                <div class="max-w-xl">
                    @include('profile.partials.oath-form')
                </div>
            </div>

            <div class="bg-white p-4 shadow-sm sm:rounded-lg sm:p-8 dark:bg-gray-800">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
