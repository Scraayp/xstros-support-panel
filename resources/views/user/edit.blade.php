<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User - Edit') }}
        </h2>
    </x-slot>

    @if(session('status') === 'user-updated')
        <div id="toast-danger" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800 fixed bottom-4 right-4" role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <span class="sr-only">Icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">User has been edited.</div>
            <a onclick="document.getElementById('toast-danger').style.display = 'none';" class="ms-auto" href="#toast-danger">
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </a>
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('toast-danger').style.display = 'none';
            }, 7000); // Hide the toast after 7 seconds
        </script>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg p-6">
                <form method="POST" action="{{ route('user.update', $user->id) }}">
                    @csrf
                    @method('PATCH')

                    <!-- Name Field -->
                    <div class="mb-4">
                            <label for="name" class="@error('name') text-red-700 dark:text-red-500 @else text-black dark:text-white @enderror block mb-2 text-sm font-medium ">Name</label>
                            <input type="text" id="name" name="name" class="@error('name') bg-red-50 border-red-500 text-red-900 focus:border-red-500 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 focus:ring-red-500 @else text-black dark:text-white focus:ring-blue-400 @enderror border text-sm rounded-lg  dark:bg-gray-700  block w-full p-2.5 " value="{{$user->name}}">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, snapp!</span> {{ $message }}</p>
                            @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="mb-4">
                        <label for="email" class="@error('email') text-red-700 dark:text-red-500 @else text-black dark:text-white @enderror block mb-2 text-sm font-medium ">Email</label>
                        <input type="text" id="email" name="email" class="@error('email') bg-red-50 border-red-500 text-red-900 focus:border-red-500 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 focus:ring-red-500 @else text-black dark:text-white focus:ring-blue-400 @enderror border text-sm rounded-lg  dark:bg-gray-700  block w-full p-2.5 " value="{{$user->email}}">
                        @error('email')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, snapp!</span> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field (only for change) -->
                    <div class="mb-4">
                        <label for="password" class="@error('password') text-red-700 dark:text-red-500 @else text-black dark:text-white @enderror block mb-2 text-sm font-medium ">Password</label>
                        <input type="text" id="password" name="password" class="@error('password') text-black dark:text-white bg-red-50 border-red-500 focus:border-red-500  dark:placeholder-red-500 dark:border-red-500 focus:ring-red-500 @else text-black dark:text-white focus:ring-blue-400 @enderror border text-sm rounded-lg  dark:bg-gray-700  block w-full p-2.5 " placeholder="Leave blank to keep the current password">
                        @error('password')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, snapp!</span> {{ $message }}</p>
                        @enderror
                    </div>
{{--                    Email Verified and Role selector --}}
                    <div class="mb-4 flex items-center justify-between">
                        <div class="w-2/4 mr-2">
                            <label for="email_verified"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                                Verified</label>
                            <select id="email_verified" name="email_verified"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="1" {{ $user->email_verified_at ? 'selected' : '' }}>Yes | {{ $user->email_verified_at }}</option>
                                <option value="0" {{ !$user->email_verified_at ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div class="w-2/4">
                            <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                            <select id="role" name="role"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="User" {{ $user->role === 'User' ? 'selected' : '' }}>User</option>
                                <option value="Staff" {{ $user->role === 'Staff' ? 'selected' : '' }}>Staff</option>
                                <option value="Admin" {{ $user->role === 'Admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                    </div>
{{--                    Submit --}}
                    <div class="flex items-center justify-end">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
