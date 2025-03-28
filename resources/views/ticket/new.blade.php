<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <h2 class="text-2xl leading-tight font-semibold text-gray-800 dark:text-gray-200">
                {{ __('Create a Support Ticket') }}
            </h2>
            <a
                href="{{ route('ticket.list') }}"
                class="mt-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none md:mt-0 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800"
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
                Back to Tickets
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-xl dark:bg-gray-800">
                <!-- Form Header -->
                <div
                    class="border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-5 dark:border-gray-700 dark:from-blue-900/20 dark:to-indigo-900/20"
                >
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="rounded-full bg-blue-100 p-2 dark:bg-blue-900/50">
                                <svg
                                    class="h-6 w-6 text-blue-600 dark:text-blue-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"
                                    ></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">
                                Submit a New Support Request
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                                Please provide as much detail as possible so we can help you quickly.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="px-6 py-6 md:px-10 md:py-8">
                    <form method="POST" action="{{ route('ticket.create') }}" class="space-y-6">
                        @csrf

                        <!-- Priority Selection -->
                        <div class="mb-6">
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Priority Level
                            </label>
                            <div class="flex flex-wrap gap-3">
                                <label
                                    class="relative flex cursor-pointer items-center rounded-lg border border-gray-200 p-3 transition-all duration-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-300 dark:border-gray-700 dark:peer-checked:bg-blue-900/20 dark:hover:border-gray-600"
                                >
                                    <input type="radio" name="priority" value="low" class="peer sr-only" checked />
                                    <div class="flex items-center">
                                        <div class="mr-3 rounded-full bg-green-100 p-1.5 dark:bg-green-900/50">
                                            <svg
                                                class="h-4 w-4 text-green-600 dark:text-green-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z"
                                                ></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                Low
                                            </span>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">General questions</p>
                                        </div>
                                    </div>
                                    <div
                                        class="absolute top-3 right-3 h-5 w-5 text-blue-600 opacity-0 transition-opacity duration-200 peer-checked:opacity-100 dark:text-blue-400"
                                    >
                                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </div>
                                </label>

                                <label
                                    class="relative flex cursor-pointer items-center rounded-lg border border-gray-200 p-3 transition-all duration-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-300 dark:border-gray-700 dark:peer-checked:bg-blue-900/20 dark:hover:border-gray-600"
                                >
                                    <input type="radio" name="priority" value="medium" class="peer sr-only" />
                                    <div class="flex items-center">
                                        <div class="mr-3 rounded-full bg-yellow-100 p-1.5 dark:bg-yellow-900/50">
                                            <svg
                                                class="h-4 w-4 text-yellow-600 dark:text-yellow-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                                                ></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                Medium
                                            </span>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Minor issues</p>
                                        </div>
                                    </div>
                                    <div
                                        class="absolute top-3 right-3 h-5 w-5 text-blue-600 opacity-0 transition-opacity duration-200 peer-checked:opacity-100 dark:text-blue-400"
                                    >
                                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </div>
                                </label>

                                <label
                                    class="relative flex cursor-pointer items-center rounded-lg border border-gray-200 p-3 transition-all duration-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-300 dark:border-gray-700 dark:peer-checked:bg-blue-900/20 dark:hover:border-gray-600"
                                >
                                    <input type="radio" name="priority" value="high" class="peer sr-only" />
                                    <div class="flex items-center">
                                        <div class="mr-3 rounded-full bg-red-100 p-1.5 dark:bg-red-900/50">
                                            <svg
                                                class="h-4 w-4 text-red-600 dark:text-red-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                ></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                High
                                            </span>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Critical problems</p>
                                        </div>
                                    </div>
                                    <div
                                        class="absolute top-3 right-3 h-5 w-5 text-blue-600 opacity-0 transition-opacity duration-200 peer-checked:opacity-100 dark:text-blue-400"
                                    >
                                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Title Field -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Ticket Title
                                    <span class="text-red-500">*</span>
                                </label>
                                <span class="text-xs text-gray-500 dark:text-gray-400">Required</span>
                            </div>
                            <div class="relative rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg
                                        class="h-5 w-5 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </div>
                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    value="{{ old('title') }}"
                                    class="block w-full rounded-md border-gray-300 pl-10 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    placeholder="Ex: Receiving an error when connecting"
                                    required
                                />
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Provide a clear and concise title for your issue
                            </p>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Product Field -->
                        <div class="space-y-2">
                            <label for="product" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Product or Service
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg
                                        class="h-5 w-5 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm3.293 1.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L7.586 10 5.293 7.707a1 1 0 010-1.414zM11 12a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </div>
                                <select
                                    id="product"
                                    name="product"
                                    class="block w-full rounded-md border-gray-300 pl-10 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                >
                                    <option value="">Select a product</option>
                                    <option value="VPS" {{ old('product') == 'VPS' ? 'selected' : '' }}>
                                        VPS Hosting
                                    </option>
                                    <option value="Minecraft" {{ old('product') == 'Minecraft' ? 'selected' : '' }}>
                                        Minecraft Server
                                    </option>
                                    <option
                                        value="Discord Bot"
                                        {{ old('product') == 'Discord Bot' ? 'selected' : '' }}
                                    >
                                        Discord Bot
                                    </option>
                                    <option
                                        value="Web Hosting"
                                        {{ old('product') == 'Web Hosting' ? 'selected' : '' }}
                                    >
                                        Web Hosting
                                    </option>
                                    <option value="Domain" {{ old('product') == 'Domain' ? 'selected' : '' }}>
                                        Domain Name
                                    </option>
                                    <option value="Other" {{ old('product') == 'Other' ? 'selected' : '' }}>
                                        Other
                                    </option>
                                </select>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Select the product or service related to your issue
                            </p>
                            @error('product')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Server Info Field -->
                        <div class="space-y-2">
                            <label for="server_info" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Server ID / IP Address
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg
                                        class="h-5 w-5 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M2 5a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm14 1a1 1 0 11-2 0 1 1 0 012 0zM2 13a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2zm14 1a1 1 0 11-2 0 1 1 0 012 0z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </div>
                                <input
                                    type="text"
                                    id="server_info"
                                    name="server_info"
                                    value="{{ old('server_info') }}"
                                    class="block w-full rounded-md border-gray-300 pl-10 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    placeholder="Ex: 81fe309b / 198.109.209.1"
                                />
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                If applicable, provide your server ID or IP address
                            </p>
                            @error('server_info')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message Field -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Detailed Description
                                    <span class="text-red-500">*</span>
                                </label>
                                <span class="text-xs text-gray-500 dark:text-gray-400">Required</span>
                            </div>
                            <div class="mt-1">
                                <textarea
                                    id="message"
                                    name="message"
                                    rows="6"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    placeholder="Please describe your issue in detail. Include any error messages, steps to reproduce the problem, and what you've already tried."
                                    required
                                >
{{ old('message') }}</textarea
                                >
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                The more details you provide, the faster we can help you
                            </p>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Attachments Field -->
                        {{-- TODO: Fix Attachments --}}
                        {{--
                            <div class="space-y-2">
                            <label for="attachments" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Attachments (Optional)
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-700 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 dark:text-gray-400">
                            <label for="file-upload" class="relative cursor-pointer bg-white dark:bg-gray-800 rounded-md font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                            <span>Upload files</span>
                            <input id="file-upload" name="attachments[]" type="file" class="sr-only" multiple>
                            </label>
                            <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                            PNG, JPG, GIF, PDF up to 10MB
                            </p>
                            </div>
                            </div>
                            </div>
                        --}}

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end pt-4">
                            <button
                                type="button"
                                onclick="window.history.back()"
                                class="mr-3 inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none dark:focus:ring-offset-gray-800"
                            >
                                <svg
                                    class="mr-2 -ml-1 h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                                    ></path>
                                </svg>
                                Submit Ticket
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Help Section -->
                {{--
                    <div class="px-6 py-5 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-start">
                    <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    </div>
                    <div class="ml-3">
                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Need help?</h4>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Before submitting a ticket, you might want to check our <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">knowledge base</a> for quick solutions to common problems.
                    </p>
                    <div class="mt-3 flex space-x-4">
                    <a href="#" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                    <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    FAQs
                    </a>
                    <a href="#" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                    <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Contact Support
                    </a>
                    </div>
                    </div>
                    </div>
                    </div>
                --}}
            </div>
        </div>
    </div>
</x-app-layout>
