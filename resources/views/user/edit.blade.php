<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User - Edit') }}
        </h2>
    </x-slot>

    <!-- Toast Notification -->
    @if(session('status') === 'user-updated')
        <div id="toast-success"
             class="fixed bottom-6 right-6 flex items-center w-full max-w-sm p-4 text-gray-100 bg-green-500 rounded-xl shadow-lg z-50 transition-all duration-300"
             role="alert">
            <div class="flex items-center justify-center w-8 h-8 text-white bg-green-700 rounded-full">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
            </div>
            <div class="ml-3 text-sm font-medium">User has been updated successfully.</div>
            <button onclick="document.getElementById('toast-success').style.display = 'none';"
                    class="ml-auto text-white hover:text-gray-300">
                ✖
            </button>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('toast-success').style.opacity = '0';
                setTimeout(() => document.getElementById('toast-success').remove(), 300);
            }, 4000);
        </script>
    @endif

    <!-- User Edit Form -->
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow-2xl rounded-2xl p-10">
                <form method="POST" action="{{ route('user.update', $user->id) }}">
                    @csrf
                    @method('PATCH')

                    <!-- Name Field -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-semibold text-gray-900 dark:text-gray-200">Name</label>
                        <input type="text" id="name" name="name"
                               class="w-full mt-2 p-3 rounded-lg shadow-md text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-800 focus:ring-2 focus:ring-blue-500 outline-none"
                               value="{{ $user->name }}">
                        @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-semibold text-gray-900 dark:text-gray-200">Email</label>
                        <input type="email" id="email" name="email"
                               class="w-full mt-2 p-3 rounded-lg shadow-md text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-800 focus:ring-2 focus:ring-blue-500 outline-none"
                               value="{{ $user->email }}">
                        @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-semibold text-gray-900 dark:text-gray-200">
                            Password (Leave blank to keep current password)
                        </label>
                        <input type="password" id="password" name="password"
                               class="w-full mt-2 p-3 rounded-lg shadow-md text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-800 focus:ring-2 focus:ring-blue-500 outline-none"
                               placeholder="New Password (optional)">
                        @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Verified & Role Selector -->
                    <div class="mb-6 flex flex-col md:flex-row md:space-x-6">
                        <!-- Email Verified -->
                        <div class="w-full">
                            <label for="email_verified" class="block text-sm font-semibold text-gray-900 dark:text-gray-200">
                                Email Verified
                            </label>
                            <select id="email_verified" name="email_verified"
                                    class="w-full mt-2 p-3 rounded-lg shadow-md text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-800 focus:ring-2 focus:ring-blue-500 outline-none">
                                <option value="1" {{ $user->email_verified_at ? 'selected' : '' }}>
                                    Yes @if( $user->email_verified_at ) | {{ $user->email_verified_at }}@endif
                                </option>
                                <option value="0" {{ !$user->email_verified_at ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <!-- Role -->
                        <div class="w-full mt-6 md:mt-0">
                            <label for="role" class="block text-sm font-semibold text-gray-900 dark:text-gray-200">Role</label>
                            <select id="role" name="role"
                                    class="w-full mt-2 p-3 rounded-lg shadow-md text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-800 focus:ring-2 focus:ring-blue-500 outline-none">
                                <option value="User" {{ $user->role === 'User' ? 'selected' : '' }}>User</option>
                                <option value="Staff" {{ $user->role === 'Staff' ? 'selected' : '' }}>Staff</option>
                                <option value="Admin" {{ $user->role === 'Admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-6 py-3 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 rounded-lg hover:scale-105 transition transform shadow-lg">
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
