<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <div class="rounded-md bg-red-50 dark:bg-red-900/30 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-red-700 dark:text-red-300">
                    This action is permanent and cannot be undone. All your data will be erased.
                </p>
            </div>
        </div>
    </div>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="group relative px-4 py-2.5 overflow-hidden rounded-md bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-600 transition-all duration-200"
    >
        <span class="absolute inset-0 bg-red-600 opacity-0 group-hover:opacity-20 transition-opacity duration-200"></span>
        <span class="relative flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            {{ __('Delete Account') }}
        </span>
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-6">
            <div class="flex items-center justify-center mb-6 text-red-600 dark:text-red-400">
                <div class="rounded-full bg-red-100 dark:bg-red-900/50 p-3">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 100-16 8 8 0 000 16zm-1-5h2v2h-2v-2zm0-8h2v6h-2V7z"/>
                    </svg>
                </div>
            </div>
            
            <h2 class="text-xl font-bold text-center text-gray-900 dark:text-gray-100 mb-4">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <div class="mb-6 text-center">
                <div class="inline-flex items-center justify-center px-4 py-2 bg-red-100 dark:bg-red-900/30 rounded-full text-red-600 dark:text-red-400 font-medium text-sm mb-4">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    This action cannot be undone
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. To confirm, please enter your email address below.') }}
                </p>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="mb-6">
                    <div class="text-center mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Your email: <span class="font-bold">{{ auth()->user()->email }}</span>
                    </div>
                    
                    <div class="relative rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <x-text-input
                            id="email_confirmation"
                            name="email_confirmation"
                            type="email"
                            class="block w-full rounded-md border-gray-300 dark:border-gray-700 pl-10 shadow-sm focus:border-red-500 focus:ring-red-500 dark:bg-gray-800 dark:text-white sm:text-sm"
                            placeholder="{{ __('Type your email to confirm') }}"
                            required
                        />
                    </div>

                </div>

                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                    <x-secondary-button x-on:click="$dispatch('close')" class="w-full sm:w-auto justify-center px-4 py-2 border border-gray-300 dark:border-gray-600">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                    <x-danger-button type="submit">
                        {{ __('Permanently Delete Account') }}
                    </x-danger-button>
                    
                    
                </div>
            </form>
        </div>
    </x-modal>
</section>

