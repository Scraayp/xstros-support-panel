<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <h2 class="text-2xl leading-tight font-semibold text-gray-800 dark:text-gray-200">
                {{ __('Payments & Transactions') }}
            </h2>
            <div class="mt-3 flex space-x-3 md:mt-0"></div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Summary Cards -->
            <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">
                <!-- Total Paid -->
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-xl dark:border-gray-700 dark:bg-gray-800"
                >
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="mr-4 rounded-full bg-green-100 p-3 dark:bg-green-900">
                                <svg
                                    class="h-8 w-8 text-green-600 dark:text-green-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    ></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Paid</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                    €{{ number_format($completedTransactions->sum('amount') / 100, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Payments -->
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-xl dark:border-gray-700 dark:bg-gray-800"
                >
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="mr-4 rounded-full bg-yellow-100 p-3 dark:bg-yellow-900">
                                <svg
                                    class="h-8 w-8 text-yellow-600 dark:text-yellow-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                    ></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pending Payments</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                    €{{ number_format($incompleteTransactions->sum('amount') / 100, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Unpaid Invoices -->
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-xl dark:border-gray-700 dark:bg-gray-800"
                >
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="mr-4 rounded-full bg-red-100 p-3 dark:bg-red-900">
                                <svg
                                    class="h-8 w-8 text-red-600 dark:text-red-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                    ></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Unpaid Invoices</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                    €{{ number_format($invoices->where('paid', false)->sum('total') / 100, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div x-data="{ activeTab: 'completed' }" class="mb-8">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="-mb-px flex space-x-8">
                        <button
                            @click="activeTab = 'completed'"
                            :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'completed', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'completed' }"
                            class="border-b-2 px-1 py-4 text-sm font-medium whitespace-nowrap"
                        >
                            Completed Transactions
                        </button>
                        <button
                            @click="activeTab = 'incomplete'"
                            :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'incomplete', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'incomplete' }"
                            class="border-b-2 px-1 py-4 text-sm font-medium whitespace-nowrap"
                        >
                            Incomplete Transactions
                        </button>
                        <button
                            @click="activeTab = 'invoices'"
                            :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'invoices', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'invoices' }"
                            class="border-b-2 px-1 py-4 text-sm font-medium whitespace-nowrap"
                        >
                            Invoices
                        </button>
                    </nav>
                </div>

                <!-- Completed Transactions Tab -->
                <div
                    x-show="activeTab === 'completed'"
                    class="mt-6 overflow-hidden rounded-xl bg-white shadow-xl dark:bg-gray-900"
                >
                    <div class="border-b border-gray-200 bg-gray-50 px-6 py-5 dark:border-gray-700 dark:bg-gray-800">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">
                            Completed Transactions
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            A list of all your successfully processed payments.
                        </p>
                    </div>

                    @if ($completedTransactions->isEmpty())
                        <div class="flex flex-col items-center justify-center py-12">
                            <svg
                                class="mb-4 h-16 w-16 text-gray-400 dark:text-gray-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                ></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                No completed transactions
                            </h3>
                            <p class="mt-2 text-gray-500 dark:text-gray-400">
                                Your completed transactions will appear here.
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                        >
                                            Date
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                        >
                                            Transaction ID
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                        >
                                            Amount
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                        >
                                            Status
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                        >
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                                    @foreach ($completedTransactions as $transaction)
                                        <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800">
                                            <td
                                                class="px-6 py-4 text-sm whitespace-nowrap text-gray-900 dark:text-gray-200"
                                            >
                                                {{ \Carbon\Carbon::createFromTimestamp($transaction->created)->format('M d, Y') }}
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ \Carbon\Carbon::createFromTimestamp($transaction->created)->format('h:i A') }}
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400"
                                            >
                                                {{ substr($transaction->id, 0, 8) }}...
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm font-medium whitespace-nowrap text-gray-900 dark:text-gray-200"
                                            >
                                                €{{ number_format($transaction->amount / 100, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-200"
                                                >
                                                    <svg
                                                        class="mr-1.5 h-2 w-2 text-green-400"
                                                        fill="currentColor"
                                                        viewBox="0 0 8 8"
                                                    >
                                                        <circle cx="4" cy="4" r="3" />
                                                    </svg>
                                                    {{ ucfirst($transaction->status) }}
                                                </span>
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400"
                                            >
                                                <a
                                                    href="{{ $transaction->receipt_url }}"
                                                    target="_blank"
                                                    class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-1.5 text-xs font-medium text-white shadow-sm transition-colors hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none dark:focus:ring-offset-gray-800"
                                                >
                                                    <svg
                                                        class="mr-1 h-4 w-4"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                                        ></path>
                                                    </svg>
                                                    Receipt
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- Incomplete Transactions Tab -->
                <div
                    x-show="activeTab === 'incomplete'"
                    class="mt-6 overflow-hidden rounded-xl bg-white shadow-xl dark:bg-gray-900"
                >
                    <div class="border-b border-gray-200 bg-gray-50 px-6 py-5 dark:border-gray-700 dark:bg-gray-800">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">
                            Incomplete Transactions
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Payments that are still being processed or require action.
                        </p>
                    </div>

                    @if ($incompleteTransactions->isEmpty())
                        <div class="flex flex-col items-center justify-center py-12">
                            <svg
                                class="mb-4 h-16 w-16 text-gray-400 dark:text-gray-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                ></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                No incomplete transactions
                            </h3>
                            <p class="mt-2 text-gray-500 dark:text-gray-400">
                                All your transactions have been processed.
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                        >
                                            Date
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                        >
                                            Transaction ID
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                        >
                                            Amount
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                        >
                                            Status
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                        >
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                                    @foreach ($incompleteTransactions as $transaction)
                                        <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800">
                                            <td
                                                class="px-6 py-4 text-sm whitespace-nowrap text-gray-900 dark:text-gray-200"
                                            >
                                                {{ \Carbon\Carbon::createFromTimestamp($transaction->created)->format('M d, Y') }}
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ \Carbon\Carbon::createFromTimestamp($transaction->created)->format('h:i A') }}
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400"
                                            >
                                                {{ substr($transaction->id, 0, 8) }}...
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm font-medium whitespace-nowrap text-gray-900 dark:text-gray-200"
                                            >
                                                €{{ number_format($transaction->amount / 100, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200"
                                                >
                                                    <svg
                                                        class="mr-1.5 h-2 w-2 text-yellow-400"
                                                        fill="currentColor"
                                                        viewBox="0 0 8 8"
                                                    >
                                                        <circle cx="4" cy="4" r="3" />
                                                    </svg>
                                                    {{ ucfirst($transaction->status) }}
                                                </span>
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400"
                                            >
                                                <button
                                                    class="inline-flex items-center rounded-md border border-transparent bg-yellow-600 px-3 py-1.5 text-xs font-medium text-white shadow-sm transition-colors hover:bg-yellow-700 focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 focus:outline-none dark:focus:ring-offset-gray-800"
                                                >
                                                    <svg
                                                        class="mr-1 h-4 w-4"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                                                        ></path>
                                                    </svg>
                                                    Retry Payment
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- Invoices Tab -->
                <div
                    x-show="activeTab === 'invoices'"
                    class="mt-6 overflow-hidden rounded-xl bg-white shadow-xl dark:bg-gray-900"
                >
                    <div class="border-b border-gray-200 bg-gray-50 px-6 py-5 dark:border-gray-700 dark:bg-gray-800">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Invoices</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">View and manage all your invoices.</p>
                    </div>

                    @if ($invoices->isEmpty())
                        <div class="flex flex-col items-center justify-center py-12">
                            <svg
                                class="mb-4 h-16 w-16 text-gray-400 dark:text-gray-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                ></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">No invoices found</h3>
                            <p class="mt-2 text-gray-500 dark:text-gray-400">
                                Your invoices will appear here once generated.
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                        >
                                            Date
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                        >
                                            Invoice #
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                        >
                                            Amount
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                        >
                                            Status
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                        >
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                                    @foreach ($invoices as $invoice)
                                        <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800">
                                            <td
                                                class="px-6 py-4 text-sm whitespace-nowrap text-gray-900 dark:text-gray-200"
                                            >
                                                {{ \Carbon\Carbon::createFromTimestamp($invoice->created)->format('M d, Y') }}
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ \Carbon\Carbon::createFromTimestamp($invoice->created)->format('h:i A') }}
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400"
                                            >
                                                {{ $invoice->number }}
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm font-medium whitespace-nowrap text-gray-900 dark:text-gray-200"
                                            >
                                                €{{ number_format($invoice->total / 100, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($invoice->paid)
                                                    <span
                                                        class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-200"
                                                    >
                                                        <svg
                                                            class="mr-1.5 h-2 w-2 text-green-400"
                                                            fill="currentColor"
                                                            viewBox="0 0 8 8"
                                                        >
                                                            <circle cx="4" cy="4" r="3" />
                                                        </svg>
                                                        Paid
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-200"
                                                    >
                                                        <svg
                                                            class="mr-1.5 h-2 w-2 text-red-400"
                                                            fill="currentColor"
                                                            viewBox="0 0 8 8"
                                                        >
                                                            <circle cx="4" cy="4" r="3" />
                                                        </svg>
                                                        Unpaid
                                                    </span>
                                                @endif
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400"
                                            >
                                                <div class="flex space-x-2">
                                                    @if (! $invoice->paid)
                                                        <a
                                                            href="{{ $invoice->hosted_invoice_url }}"
                                                            target="_blank"
                                                            class="inline-flex items-center rounded-md border border-transparent bg-green-600 px-3 py-1.5 text-xs font-medium text-white shadow-sm transition-colors hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:outline-none dark:focus:ring-offset-gray-800"
                                                        >
                                                            <svg
                                                                class="mr-1 h-4 w-4"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"
                                                                ></path>
                                                            </svg>
                                                            Pay
                                                        </a>
                                                    @endif

                                                    <a
                                                        href="{{ $invoice->invoice_pdf }}"
                                                        target="_blank"
                                                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800"
                                                    >
                                                        <svg
                                                            class="mr-1 h-4 w-4"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"
                                                            ></path>
                                                        </svg>
                                                        Download
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Payment History -->
            <div class="mt-8 overflow-hidden rounded-xl bg-white shadow-xl dark:bg-gray-900">
                <div
                    class="flex items-center justify-between border-b border-gray-200 bg-gray-50 px-6 py-5 dark:border-gray-700 dark:bg-gray-800"
                >
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Payment History</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            A complete history of all your payment activities.
                        </p>
                    </div>
                </div>

                <div class="px-6 py-5">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <div class="mb-6 rounded-lg bg-gray-50 p-4 dark:bg-gray-800">
                                        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                                            <div class="flex flex-col gap-4 md:flex-row md:items-center">
                                                <div>
                                                    <label
                                                        for="date-range"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                                                    >
                                                        Date Range
                                                    </label>
                                                    <select
                                                        id="date-range"
                                                        name="date-range"
                                                        class="mt-1 block w-full rounded-md border-gray-300 py-2 pr-10 pl-3 text-base focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none sm:text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                                    >
                                                        <option>Last 30 days</option>
                                                        <option>Last 90 days</option>
                                                        <option>This year</option>
                                                        <option>All time</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label
                                                        for="status-filter"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                                                    >
                                                        Status
                                                    </label>
                                                    <select
                                                        id="status-filter"
                                                        name="status-filter"
                                                        class="mt-1 block w-full rounded-md border-gray-300 py-2 pr-10 pl-3 text-base focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none sm:text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                                    >
                                                        <option>All statuses</option>
                                                        <option>Paid</option>
                                                        <option>Pending</option>
                                                        <option>Failed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div>
                                                <label
                                                    for="search"
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                                                >
                                                    Search
                                                </label>
                                                <div class="relative mt-1 rounded-md shadow-sm">
                                                    <div
                                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                                                    >
                                                        <svg
                                                            class="h-5 w-5 text-gray-400"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                                            ></path>
                                                        </svg>
                                                    </div>
                                                    <input
                                                        type="text"
                                                        name="search"
                                                        id="search"
                                                        class="block w-full rounded-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:border-gray-600 dark:bg-gray-700"
                                                        placeholder="Search transactions..."
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Timeline of all transactions -->
                                    <div class="flow-root">
                                        <ul role="list" class="-mb-8">
                                            @foreach (array_merge($completedTransactions->toArray(), $incompleteTransactions->toArray()) as $index => $transaction)
                                                <li>
                                                    <div class="relative pb-8">
                                                        @if ($index < count(array_merge($completedTransactions->toArray(), $incompleteTransactions->toArray())) - 1)
                                                            <span
                                                                class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-700"
                                                                aria-hidden="true"
                                                            ></span>
                                                        @endif

                                                        <div class="relative flex space-x-3">
                                                            <div>
                                                                <span
                                                                    class="{{ $transaction->status === 'succeeded' ? 'bg-green-500' : 'bg-yellow-500' }} flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white dark:ring-gray-900"
                                                                >
                                                                    @if ($transaction->status === 'succeeded')
                                                                        <svg
                                                                            class="h-5 w-5 text-white"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                stroke-width="2"
                                                                                d="M5 13l4 4L19 7"
                                                                            ></path>
                                                                        </svg>
                                                                    @else
                                                                        <svg
                                                                            class="h-5 w-5 text-white"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                stroke-width="2"
                                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                                                            ></path>
                                                                        </svg>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                            <div
                                                                class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5"
                                                            >
                                                                <div>
                                                                    <p class="text-sm text-gray-900 dark:text-gray-100">
                                                                        {{ $transaction->status === 'succeeded' ? 'Payment completed' : 'Payment pending' }}
                                                                        <span class="font-medium">
                                                                            €{{ number_format($transaction->amount / 100, 2) }}
                                                                        </span>
                                                                    </p>
                                                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                                                        Transaction ID:
                                                                        {{ substr($transaction->id, 0, 8) }}...
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="text-right text-sm whitespace-nowrap text-gray-500 dark:text-gray-400"
                                                                >
                                                                    <time
                                                                        datetime="{{ \Carbon\Carbon::createFromTimestamp($transaction->created)->toIso8601String() }}"
                                                                    >
                                                                        {{ \Carbon\Carbon::createFromTimestamp($transaction->created)->format('M d, Y') }}
                                                                    </time>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
