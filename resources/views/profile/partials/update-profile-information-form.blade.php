<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Profile Picture -->
        <div class="flex flex-col items-center space-y-4 sm:flex-row sm:items-start sm:space-y-0 sm:space-x-6">
            <div class="group relative">
                <div
                    class="h-24 w-24 overflow-hidden rounded-full border-2 border-gray-200 bg-gray-100 dark:border-gray-600 dark:bg-gray-700"
                >
                    @if ($user->avatar)
                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="h-full w-full object-cover" />
                    @else
                        <div
                            class="flex h-full w-full items-center justify-center text-3xl font-medium text-gray-400 dark:text-gray-500"
                        >
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="text-center sm:text-left">
                <h3 class="text-base font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>

                <div class="mt-2 flex flex-wrap gap-2">
                    <span
                        class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900/60 dark:text-blue-300"
                    >
                        {{ $user->role ?? 'User' }}
                    </span>
                    <span
                        class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900/60 dark:text-green-300"
                    >
                        Member since {{ $user->created_at->format('M Y') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Name -->
        <div class="space-y-2">
            <x-input-label
                for="name"
                :value="__('Full name')"
                class="text-sm font-medium text-gray-700 dark:text-gray-300"
            />
            <div class="relative rounded-md shadow-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg
                        class="h-5 w-5 text-gray-400 dark:text-gray-500"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </div>
                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="block w-full rounded-md border-gray-300 pl-10 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                    :value="old('name', $user->name)"
                    required
                    autofocus
                    autocomplete="name"
                />
            </div>
            <x-input-error class="mt-1" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div class="space-y-2">
            <x-input-label
                for="email"
                :value="__('Email address')"
                class="text-sm font-medium text-gray-700 dark:text-gray-300"
            />
            <div class="relative rounded-md shadow-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg
                        class="h-5 w-5 text-gray-400 dark:text-gray-500"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true"
                    >
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
                <x-text-input
                    id="email"
                    name="email"
                    type="email"
                    class="block w-full rounded-md border-gray-300 pl-10 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                    :value="old('email', $user->email)"
                    required
                    autocomplete="username"
                />
            </div>
            <x-input-error class="mt-1" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 rounded-md bg-yellow-50 p-4 dark:bg-yellow-900/30">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg
                                class="h-5 w-5 text-yellow-400"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700 dark:text-yellow-300">
                                {{ __('Your email address is unverified.') }}
                                <button
                                    form="send-verification"
                                    class="font-medium text-yellow-700 underline transition-colors hover:text-yellow-600 dark:text-yellow-300 dark:hover:text-yellow-200"
                                >
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>
                        </div>
                    </div>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <div class="mt-3 rounded-md bg-green-50 p-4 dark:bg-green-900/30">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg
                                    class="h-5 w-5 text-green-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800 dark:text-green-300">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>

        <div class="flex items-center justify-end gap-4 pt-2">
            <x-primary-button
                class="group relative overflow-hidden bg-gradient-to-r from-blue-600 to-blue-500 px-4 py-2.5 transition-all duration-200 hover:from-blue-500 hover:to-blue-600"
            >
                <span
                    class="absolute inset-0 bg-blue-600 opacity-0 transition-opacity duration-200 group-hover:opacity-20"
                ></span>
                <span class="relative flex items-center">
                    <svg
                        class="mr-2 h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ __('Save Changes') }}
                </span>
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:enter="transition duration-300 ease-out"
                    x-transition:enter-start="translate-x-2 transform opacity-0"
                    x-transition:enter-end="translate-x-0 transform opacity-100"
                    x-transition:leave="transition duration-200 ease-in"
                    x-transition:leave-start="translate-x-0 transform opacity-100"
                    x-transition:leave-end="translate-x-2 transform opacity-0"
                    x-init="setTimeout(() => (show = false), 3000)"
                    class="inline-flex items-center rounded-md bg-green-50 px-3 py-1.5 text-green-700 dark:bg-green-900/30 dark:text-green-300"
                >
                    <svg
                        class="mr-1.5 h-4 w-4"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                    {{ __('Saved') }}
                </div>
            @endif
        </div>
    </form>
</section>
