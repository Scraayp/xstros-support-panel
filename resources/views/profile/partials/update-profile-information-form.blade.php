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
        <div class="flex flex-col items-center sm:flex-row sm:items-start space-y-4 sm:space-y-0 sm:space-x-6">
            <div class="relative group">
                <div class="w-24 h-24 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600">
                    @if($user->profile_photo_path)
                        <img src="{{ Storage::url($user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-gray-500 text-3xl font-medium">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <label for="photo" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-full opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </label>
                <input id="photo" name="photo" type="file" accept="image/*" class="sr-only">
            </div>
            
            <div class="text-center sm:text-left">
                <h3 class="text-base font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                    Click on the avatar to upload a new photo
                </p>
                <div class="mt-2 flex flex-wrap gap-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/60 dark:text-blue-300">
                        {{ $user->role ?? 'User' }}
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/60 dark:text-green-300">
                        Member since {{ $user->created_at->format('M Y') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Name -->
        <div class="space-y-2">
            <x-input-label for="name" :value="__('Full name')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
            <div class="relative rounded-md shadow-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
                <x-text-input 
                    id="name" 
                    name="name" 
                    type="text" 
                    class="block w-full rounded-md border-gray-300 dark:border-gray-700 pl-10 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:text-white sm:text-sm" 
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
            <x-input-label for="email" :value="__('Email address')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
            <div class="relative rounded-md shadow-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
                <x-text-input 
                    id="email" 
                    name="email" 
                    type="email" 
                    class="block w-full rounded-md border-gray-300 dark:border-gray-700 pl-10 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:text-white sm:text-sm" 
                    :value="old('email', $user->email)" 
                    required 
                    autocomplete="username" 
                />
            </div>
            <x-input-error class="mt-1" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 rounded-md bg-yellow-50 dark:bg-yellow-900/30 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700 dark:text-yellow-300">
                                {{ __('Your email address is unverified.') }}
                                <button form="send-verification" class="font-medium text-yellow-700 underline hover:text-yellow-600 dark:text-yellow-300 dark:hover:text-yellow-200 transition-colors">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>
                        </div>
                    </div>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <div class="mt-3 rounded-md bg-green-50 dark:bg-green-900/30 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
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
            <x-primary-button class="relative group overflow-hidden px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-600 transition-all duration-200">
                <span class="absolute inset-0 bg-blue-600 opacity-0 group-hover:opacity-20 transition-opacity duration-200"></span>
                <span class="relative flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ __('Save Changes') }}
                </span>
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-x-2"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-x-0"
                    x-transition:leave-end="opacity-0 transform translate-x-2"
                    x-init="setTimeout(() => show = false, 3000)"
                    class="inline-flex items-center px-3 py-1.5 rounded-md bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-300"
                >
                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ __('Saved') }}
                </div>
            @endif
        </div>
    </form>
</section>

