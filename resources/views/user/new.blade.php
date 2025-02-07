<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User - Create') }}
        </h2>
    </x-slot>



        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-900 shadow-2xl rounded-xl p-8">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-6">User Information</h3>

                    <!-- Form -->
                    <form action="{{ route('user.create') }}" method="POST">
                        @csrf

                        <!-- Name Field -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Full Name
                            </label>
                            <input type="text" name="name" id="name"
                                   class="w-full mt-1 p-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Enter full name" required>
                        </div>

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Email Address
                            </label>
                            <input type="email" name="email" id="email"
                                   class="w-full mt-1 p-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Enter email" required>
                        </div>

                        <!-- Password Field -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Password
                            </label>
                            <input type="password" name="password" id="password"
                                   class="w-full mt-1 p-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Enter password" required>
                        </div>

                        <!-- Role Selection -->
                        <div class="mb-6">
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Select Role
                            </label>
                            <select name="role" id="role"
                                    class="w-full mt-1 p-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500">
                                <option value="User">User</option>
                                <option value="Staff">Staff</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end">
                            <button type="submit"
                                    class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-200">
                                Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


</x-app-layout>
