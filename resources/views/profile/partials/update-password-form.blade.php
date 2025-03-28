<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <div class="rounded-md bg-blue-50 p-4 dark:bg-blue-900/30">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg
                    class="h-5 w-5 text-blue-400"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    aria-hidden="true"
                >
                    <path
                        fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"
                    />
                </svg>
            </div>
            <div class="ml-3 flex-1 md:flex md:justify-between">
                <p class="text-sm text-blue-700 dark:text-blue-300">
                    Strong passwords include a mix of letters, numbers, and symbols and are at least 12 characters long.
                </p>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="space-y-2">
            <x-input-label
                for="update_password_current_password"
                :value="__('Current Password')"
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
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </div>
                <div class="password-container">
                    <x-text-input
                        id="update_password_current_password"
                        name="current_password"
                        type="password"
                        class="block w-full rounded-md border-gray-300 pr-10 pl-10 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                        autocomplete="current-password"
                        placeholder="••••••••"
                    />
                    <button
                        type="button"
                        class="toggle-password absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-500 focus:outline-none dark:hover:text-gray-300"
                    >
                        <svg
                            class="eye-open h-5 w-5"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path
                                fill-rule="evenodd"
                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <svg
                            class="eye-closed hidden h-5 w-5"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                clip-rule="evenodd"
                            />
                            <path
                                d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"
                            />
                        </svg>
                    </button>
                </div>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1" />
        </div>

        <!-- New Password -->
        <div class="space-y-2">
            <x-input-label
                for="update_password_password"
                :value="__('New Password')"
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
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </div>
                <div class="password-container">
                    <x-text-input
                        id="update_password_password"
                        name="password"
                        type="password"
                        class="password-strength block w-full rounded-md border-gray-300 pr-10 pl-10 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                        autocomplete="new-password"
                        placeholder="••••••••"
                    />
                    <button
                        type="button"
                        class="toggle-password absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-500 focus:outline-none dark:hover:text-gray-300"
                    >
                        <svg
                            class="eye-open h-5 w-5"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path
                                fill-rule="evenodd"
                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <svg
                            class="eye-closed hidden h-5 w-5"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                clip-rule="evenodd"
                            />
                            <path
                                d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"
                            />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="mt-1">
                <div class="password-strength-meter flex h-1 w-full space-x-1 overflow-hidden rounded-full">
                    <div class="strength-segment flex-1 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                    <div class="strength-segment flex-1 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                    <div class="strength-segment flex-1 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                    <div class="strength-segment flex-1 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                </div>
                <p class="password-strength-text mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Password strength:
                    <span>Too weak</span>
                </p>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1" />
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Must be at least 8 characters and include a number and a symbol
            </p>
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <x-input-label
                for="update_password_password_confirmation"
                :value="__('Confirm Password')"
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
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </div>
                <div class="password-container">
                    <x-text-input
                        id="update_password_password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="block w-full rounded-md border-gray-300 pr-10 pl-10 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                        autocomplete="new-password"
                        placeholder="••••••••"
                    />
                    <button
                        type="button"
                        class="toggle-password absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-500 focus:outline-none dark:hover:text-gray-300"
                    >
                        <svg
                            class="eye-open h-5 w-5"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path
                                fill-rule="evenodd"
                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <svg
                            class="eye-closed hidden h-5 w-5"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                clip-rule="evenodd"
                            />
                            <path
                                d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"
                            />
                        </svg>
                    </button>
                </div>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1" />
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
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"
                        ></path>
                    </svg>
                    {{ __('Update Password') }}
                </span>
            </x-primary-button>

            @if (session('status') === 'password-updated')
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
                    {{ __('Password Updated') }}
                </div>
            @endif
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle password visibility
            document.querySelectorAll('.toggle-password').forEach((button) => {
                button.addEventListener('click', function () {
                    const container = this.closest('.password-container');
                    const input = container.querySelector('input');
                    const eyeOpen = this.querySelector('.eye-open');
                    const eyeClosed = this.querySelector('.eye-closed');

                    if (input.type === 'password') {
                        input.type = 'text';
                        eyeOpen.classList.add('hidden');
                        eyeClosed.classList.remove('hidden');
                    } else {
                        input.type = 'password';
                        eyeOpen.classList.remove('hidden');
                        eyeClosed.classList.add('hidden');
                    }
                });
            });

            // Password strength meter
            const passwordInput = document.querySelector('.password-strength');
            const strengthSegments = document.querySelectorAll('.strength-segment');
            const strengthText = document.querySelector('.password-strength-text span');

            if (passwordInput) {
                passwordInput.addEventListener('input', function () {
                    const password = this.value;
                    let strength = 0;

                    // Reset all segments
                    strengthSegments.forEach((segment) => {
                        segment.className = 'strength-segment bg-gray-200 dark:bg-gray-700 flex-1 rounded-full';
                    });

                    // Check password strength
                    if (password.length >= 8) strength++;
                    if (password.match(/[A-Z]/)) strength++;
                    if (password.match(/[0-9]/)) strength++;
                    if (password.match(/[^A-Za-z0-9]/)) strength++;

                    // Update strength meter
                    for (let i = 0; i < strength; i++) {
                        if (strengthSegments[i]) {
                            if (strength === 1) {
                                strengthSegments[i].className = 'strength-segment bg-red-500 flex-1 rounded-full';
                            } else if (strength === 2) {
                                strengthSegments[i].className = 'strength-segment bg-orange-500 flex-1 rounded-full';
                            } else if (strength === 3) {
                                strengthSegments[i].className = 'strength-segment bg-yellow-500 flex-1 rounded-full';
                            } else if (strength === 4) {
                                strengthSegments[i].className = 'strength-segment bg-green-500 flex-1 rounded-full';
                            }
                        }
                    }

                    // Update strength text
                    if (strength === 0) strengthText.textContent = 'Too weak';
                    else if (strength === 1) strengthText.textContent = 'Weak';
                    else if (strength === 2) strengthText.textContent = 'Fair';
                    else if (strength === 3) strengthText.textContent = 'Good';
                    else if (strength === 4) strengthText.textContent = 'Strong';

                    // Update text color
                    if (strength <= 1) strengthText.className = 'text-red-500 dark:text-red-400';
                    else if (strength === 2) strengthText.className = 'text-orange-500 dark:text-orange-400';
                    else if (strength === 3) strengthText.className = 'text-yellow-500 dark:text-yellow-400';
                    else if (strength === 4) strengthText.className = 'text-green-500 dark:text-green-400';
                });
            }
        });
    </script>
</section>
