<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-2xl leading-tight font-semibold text-gray-800 dark:text-gray-200">
                {{ __('Create New User') }}
            </h2>

            <a
                href="{{ route('user.list') }}"
                class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
            >
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
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                    ></path>
                </svg>
                Back to Users
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-xl bg-white shadow-xl dark:bg-gray-800">
                <!-- Header -->
                <div
                    class="border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 dark:border-gray-700 dark:from-blue-900/20 dark:to-indigo-900/20"
                >
                    <h3 class="flex items-center text-lg font-semibold text-gray-900 dark:text-gray-100">
                        <svg
                            class="mr-2 h-5 w-5 text-blue-600 dark:text-blue-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"
                            ></path>
                        </svg>
                        User Information
                    </h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Create a new user account with the following information.
                    </p>
                </div>

                <!-- Form -->
                <form action="{{ route('user.create') }}" method="POST" class="p-6">
                    @csrf

                    <!-- Name Field -->
                    <div class="mb-5">
                        <label for="name" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Full Name
                        </label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg
                                    class="h-5 w-5 text-gray-400 dark:text-gray-500"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </div>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                class="block w-full rounded-lg border border-gray-300 bg-white py-3 pr-3 pl-10 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                placeholder="Enter full name"
                                required
                            />
                        </div>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="mb-5">
                        <label for="email" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Email Address
                        </label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg
                                    class="h-5 w-5 text-gray-400 dark:text-gray-500"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                class="block w-full rounded-lg border border-gray-300 bg-white py-3 pr-3 pl-10 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                placeholder="Enter email address"
                                required
                            />
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-5">
                        <label for="password" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Password
                        </label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg
                                    class="h-5 w-5 text-gray-400 dark:text-gray-500"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </div>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="password-input block w-full rounded-lg border border-gray-300 bg-white py-3 pr-10 pl-10 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                placeholder="Enter password"
                                required
                            />
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <button
                                    type="button"
                                    class="toggle-password text-gray-400 hover:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:text-gray-400"
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
                        @error('password')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role Selection -->
                    <div class="mb-6">
                        <label for="role" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            User Role
                        </label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg
                                    class="h-5 w-5 text-gray-400 dark:text-gray-500"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"
                                    />
                                </svg>
                            </div>
                            <select
                                name="role"
                                id="role"
                                class="block w-full appearance-none rounded-lg border border-gray-300 bg-white py-3 pr-3 pl-10 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                            >
                                <option value="User" {{ old('role') == 'User' ? 'selected' : '' }}>User</option>
                                <option value="Staff" {{ old('role') == 'Staff' ? 'selected' : '' }}>Staff</option>
                                <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg
                                    class="h-5 w-5 text-gray-400 dark:text-gray-500"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </div>
                        </div>
                        @error('role')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Verification -->
                    <div class="mb-6">
                        <div class="flex items-center">
                            <input
                                id="email_verified"
                                name="email_verified"
                                type="checkbox"
                                value="1"
                                {{ old('email_verified') ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600"
                            />
                            <label for="email_verified" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                Mark email as verified
                            </label>
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            If checked, the user won't need to verify their email address.
                        </p>
                    </div>

                    <!-- Submit and Cancel Buttons -->
                    <div class="flex items-center justify-end space-x-3">
                        <a
                            href="{{ route('user.list') }}"
                            class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                        >
                            Cancel
                        </a>
                        <button
                            type="submit"
                            class="rounded-lg bg-gradient-to-r from-blue-600 to-blue-500 px-4 py-2 text-sm font-medium text-white shadow-sm transition-all duration-200 hover:from-blue-500 hover:to-blue-600 hover:shadow focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
                        >
                            <span class="flex items-center">
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
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"
                                    ></path>
                                </svg>
                                Create User
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle password visibility
            const toggleButtons = document.querySelectorAll('.toggle-password');
            toggleButtons.forEach((button) => {
                button.addEventListener('click', function () {
                    const input = this.closest('div').previousElementSibling;
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
            const passwordInput = document.querySelector('.password-input');
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
</x-app-layout>
