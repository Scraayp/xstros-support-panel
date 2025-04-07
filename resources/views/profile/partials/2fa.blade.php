<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Two-Factor Authentication') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Add additional security to your account using two-factor authentication.') }}
        </p>
    </header>

    @if(!auth()->user()->google2fa_secret)
        <div class="rounded-md bg-yellow-50 p-4 dark:bg-yellow-900/30">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700 dark:text-yellow-300">
                        {{ __('You have not enabled two-factor authentication. Enable it to add an extra layer of security to your account.') }}
                    </p>
                </div>
            </div>
        </div>

        <x-primary-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'enable-2fa')"
            class="group relative overflow-hidden rounded-md bg-gradient-to-r from-indigo-600 to-indigo-500 px-4 py-2.5 transition-all duration-200 hover:from-indigo-500 hover:to-indigo-600"
        >
            <span class="absolute inset-0 bg-indigo-600 opacity-0 transition-opacity duration-200 group-hover:opacity-20"></span>
            <span class="relative flex items-center">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                {{ __('Enable Two-Factor Authentication') }}
            </span>
        </x-primary-button>
    @else
        <div class="rounded-md bg-green-50 p-4 dark:bg-green-900/30">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700 dark:text-green-300">
                        {{ __('You have enabled two-factor authentication. Your account is now more secure.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h3 class="text-md font-medium text-gray-900 dark:text-gray-100 mb-2">
                {{ __('Recovery Codes') }}
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two-factor authentication device is lost.') }}
            </p>
            
            @if(session('recovery_codes'))
                <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded-md mb-4">
                    <div class="grid grid-cols-2 gap-2">
                        @foreach(session('recovery_codes') as $code)
                            <div class="font-mono text-sm">{{ $code }}</div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <x-secondary-button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'regenerate-recovery-codes')"
                class="mr-3"
            >
                {{ __('Regenerate Recovery Codes') }}
            </x-secondary-button>
        </div>

        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'disable-2fa')"
            class="group relative overflow-hidden rounded-md bg-gradient-to-r from-red-600 to-red-500 px-4 py-2.5 transition-all duration-200 hover:from-red-500 hover:to-red-600 mt-4"
        >
            <span class="absolute inset-0 bg-red-600 opacity-0 transition-opacity duration-200 group-hover:opacity-20"></span>
            <span class="relative flex items-center">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                </svg>
                {{ __('Disable Two-Factor Authentication') }}
            </span>
        </x-danger-button>
    @endif

    <!-- Enable 2FA Modal -->
    <x-modal name="enable-2fa" :show="$errors->enableTwoFactor->isNotEmpty()" focusable>
        <div class="p-6">
            <div class="mb-6 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                <div class="rounded-full bg-indigo-100 p-3 dark:bg-indigo-900/50">
                    <svg class="h-12 w-12" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-4-8v2h8v-2h-8zm0-4v2h8V10H8zm0-4v2h8V6H8z" />
                    </svg>
                </div>
            </div>

            <h2 class="mb-4 text-center text-xl font-bold text-gray-900 dark:text-gray-100">
                {{ __('Set Up Two-Factor Authentication') }}
            </h2>

            <div class="mb-6">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                    {{ __('Scan the QR code below with your authenticator app (like Google Authenticator, Authy, or Microsoft Authenticator) and enter the verification code to enable two-factor authentication.') }}
                </p>
                
                <div class="flex justify-center mb-4">
                    @if(isset($qrCodeUrl))
                        <img src="{{ $qrCodeUrl }}" alt="QR Code" class="border dark:border-gray-700 p-2 bg-white">
                    @endif
                </div>

                <form method="POST" action="{{ route('verify-2fa') }}" class="space-y-4">
                    @csrf
                    
                    <div class="relative rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-text-input
                            id="2fa_code"
                            name="2fa_code"
                            type="text"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            class="block w-full rounded-md border-gray-300 pl-10 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                            placeholder="{{ __('Enter 6-digit verification code') }}"
                            required
                        />
                    </div>

                    <div class="flex flex-col justify-end space-y-3 sm:flex-row sm:space-y-0 sm:space-x-3">
                        <x-secondary-button
                            x-on:click="$dispatch('close')"
                            class="w-full justify-center border border-gray-300 px-4 py-2 sm:w-auto dark:border-gray-600"
                        >
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button type="submit">
                            {{ __('Verify and Enable') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </x-modal>

    <!-- Disable 2FA Modal -->
    <x-modal name="disable-2fa" :show="$errors->disableTwoFactor->isNotEmpty()" focusable>
        <div class="p-6">
            <div class="mb-6 flex items-center justify-center text-red-600 dark:text-red-400">
                <div class="rounded-full bg-red-100 p-3 dark:bg-red-900/50">
                    <svg class="h-12 w-12" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 100-16 8 8 0 000 16zm-1-5h2v2h-2v-2zm0-8h2v6h-2V7z" />
                    </svg>
                </div>
            </div>

            <h2 class="mb-4 text-center text-xl font-bold text-gray-900 dark:text-gray-100">
                {{ __('Disable Two-Factor Authentication?') }}
            </h2>

            <div class="mb-6 text-center">
                <div class="mb-4 inline-flex items-center justify-center rounded-full bg-red-100 px-4 py-2 text-sm font-medium text-red-600 dark:bg-red-900/30 dark:text-red-400">
                    <svg class="mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ __('This will reduce your account security') }}
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Disabling two-factor authentication will make your account less secure. Anyone with your password will be able to log in without the second verification step.') }}
                </p>
            </div>

            <form method="POST" action="{{ route('disable-2fa') }}">
                @csrf
                @method('delete')

                <div class="flex flex-col justify-end space-y-3 sm:flex-row sm:space-y-0 sm:space-x-3">
                    <x-secondary-button
                        x-on:click="$dispatch('close')"
                        class="w-full justify-center border border-gray-300 px-4 py-2 sm:w-auto dark:border-gray-600"
                    >
                        {{ __('Cancel') }}
                    </x-secondary-button>
                    <x-danger-button type="submit">
                        {{ __('Disable Two-Factor Authentication') }}
                    </x-danger-button>
                </div>
            </form>
        </div>
    </x-modal>

    <!-- Regenerate Recovery Codes Modal -->
    <x-modal name="regenerate-recovery-codes" focusable>
        <div class="p-6">
            <div class="mb-6 flex items-center justify-center text-amber-600 dark:text-amber-400">
                <div class="rounded-full bg-amber-100 p-3 dark:bg-amber-900/50">
                    <svg class="h-12 w-12" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-7v2h2v-2h-2zm0-8v6h2V7h-2z" />
                    </svg>
                </div>
            </div>

            <h2 class="mb-4 text-center text-xl font-bold text-gray-900 dark:text-gray-100">
                {{ __('Regenerate Recovery Codes?') }}
            </h2>

            <div class="mb-6 text-center">
                <div class="mb-4 inline-flex items-center justify-center rounded-full bg-amber-100 px-4 py-2 text-sm font-medium text-amber-600 dark:bg-amber-900/30 dark:text-amber-400">
                    <svg class="mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ __('Your old recovery codes will no longer work') }}
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Regenerating recovery codes will invalidate your old codes. Make sure to save the new codes in a secure location.') }}
                </p>
            </div>

            <form method="POST" action="{{ route('regenerate-recovery-codes') }}">
                @csrf

                <div class="flex flex-col justify-end space-y-3 sm:flex-row sm:space-y-0 sm:space-x-3">
                    <x-secondary-button
                        x-on:click="$dispatch('close')"
                        class="w-full justify-center border border-gray-300 px-4 py-2 sm:w-auto dark:border-gray-600"
                    >
                        {{ __('Cancel') }}
                    </x-secondary-button>
                    <x-primary-button type="submit">
                        {{ __('Regenerate Recovery Codes') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
</section>
