<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Payments - Transactions & Invoices') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow-2xl rounded-2xl p-8">

                <!-- Completed Transactions -->
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Completed Transactions</h2>

                @if($completedTransactions->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">No completed transactions found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left shadow-md rounded-lg">
                            <thead class="bg-gray-100 dark:bg-gray-800">
                            <tr>
                                <th class="p-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Date</th>
                                <th class="p-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Amount</th>
                                <th class="p-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Status</th>
                                <th class="p-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($completedTransactions as $transaction)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <td class="p-4 text-sm text-gray-900 dark:text-gray-200">
                                        {{ \Carbon\Carbon::createFromTimestamp($transaction->created)->toFormattedDateString() }}
                                    </td>
                                    <td class="p-4 text-sm text-gray-900 dark:text-gray-200">
                                        €{{ number_format($transaction->amount / 100, 2) }}
                                    </td>
                                    <td class="p-4">
                                            <span class="px-2 py-1 text-xs font-semibold text-white bg-green-500 rounded-lg">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                    </td>
                                    <td class="p-4 flex space-x-2">
                                        <a href="{{ $transaction->receipt_url }}" target="_blank"
                                           class="px-3 py-1.5 text-sm font-medium text-white bg-blue-500 rounded-md shadow-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition">
                                            📜 View Receipt
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <!-- Incomplete Transactions -->
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-12 mb-6">Incomplete Transactions</h2>

                @if($incompleteTransactions->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">No incomplete transactions found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left shadow-md rounded-lg">
                            <thead class="bg-gray-100 dark:bg-gray-800">
                            <tr>
                                <th class="p-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Date</th>
                                <th class="p-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Amount</th>
                                <th class="p-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Status</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($incompleteTransactions as $transaction)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <td class="p-4 text-sm text-gray-900 dark:text-gray-200">
                                        {{ \Carbon\Carbon::createFromTimestamp($transaction->created)->toFormattedDateString() }}
                                    </td>
                                    <td class="p-4 text-sm text-gray-900 dark:text-gray-200">
                                        €{{ number_format($transaction->amount / 100, 2) }}
                                    </td>
                                    <td class="p-4">
                                            <span class="px-2 py-1 text-xs font-semibold text-white bg-yellow-500 rounded-lg">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <!-- Invoices Section -->
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-12 mb-6">Invoices</h2>

                @if($invoices->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">No invoices found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left shadow-md rounded-lg">
                            <thead class="bg-gray-100 dark:bg-gray-800">
                            <tr>
                                <th class="p-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Date</th>
                                <th class="p-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Amount</th>
                                <th class="p-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Status</th>
                                <th class="p-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($invoices as $invoice)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <td class="p-4 text-sm text-gray-900 dark:text-gray-200">
                                        {{ \Carbon\Carbon::createFromTimestamp($invoice->created)->toFormattedDateString() }}
                                    </td>
                                    <td class="p-4 text-sm text-gray-900 dark:text-gray-200">
                                        €{{ number_format($invoice->total / 100, 2) }}
                                    </td>
                                    <td class="p-4">
                                            <span class="px-2 py-1 text-xs font-semibold text-white rounded-lg
                                                @if($invoice->paid) bg-green-500 @else bg-red-500 @endif">
                                                {{ $invoice->paid ? 'Paid' : 'Unpaid' }}
                                            </span>
                                    </td>
                                    <td class="p-4 flex space-x-2">
                                        @if(!$invoice->paid)
                                            <a href="{{ $invoice->hosted_invoice_url }}" target="_blank"
                                               class="px-3 py-1.5 text-sm font-medium text-white bg-yellow-500 rounded-md shadow-md hover:bg-yellow-600 focus:ring-2 focus:ring-yellow-400 transition">
                                                💳 Pay Now
                                            </a>
                                        @endif
                                        <a href="{{ $invoice->invoice_pdf }}" target="_blank"
                                           class="px-3 py-1.5 text-sm font-medium text-white bg-gray-500 rounded-md shadow-md hover:bg-gray-600 focus:ring-2 focus:ring-gray-400 transition">
                                            📥 Download
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
