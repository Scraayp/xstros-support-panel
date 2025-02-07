<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Payments - Transactions & Invoices') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto p-6 bg-white dark:bg-gray-900 shadow-lg rounded-lg">
            <!-- Completed Transactions -->
            <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Completed Transactions</h2>

            @if($completedTransactions->isEmpty())
                <p class="text-gray-600 dark:text-gray-300">No completed transactions found.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                        <thead>
                        <tr class="bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-gray-200">
                            <th class="p-3 border dark:border-gray-700">Date</th>
                            <th class="p-3 border dark:border-gray-700">Amount</th>
                            <th class="p-3 border dark:border-gray-700">Status</th>
                            <th class="p-3 border dark:border-gray-700">Receipt</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($completedTransactions as $transaction)
                            <tr class="border dark:border-gray-700 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                <td class="p-3 border dark:border-gray-700 text-gray-900 dark:text-gray-200">
                                    {{ \Carbon\Carbon::createFromTimestamp($transaction->created)->toFormattedDateString() }}
                                </td>
                                <td class="p-3 border dark:border-gray-700 text-gray-900 dark:text-gray-200">
                                    €{{ number_format($transaction->amount / 100, 2) }}
                                </td>
                                <td class="p-3 border dark:border-gray-700">
                                    <span class="px-2 py-1 text-sm font-semibold text-white bg-green-500 rounded">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                <td class="p-3 border dark:border-gray-700">
                                    <a href="{{ $transaction->receipt_url }}" target="_blank" class="text-blue-500 dark:text-blue-400 hover:underline">
                                        View Receipt
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Incomplete Transactions -->
            <h2 class="text-2xl font-semibold mt-8 mb-4 text-gray-900 dark:text-gray-100">Incomplete Transactions</h2>

            @if($incompleteTransactions->isEmpty())
                <p class="text-gray-600 dark:text-gray-300">No incomplete transactions found.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                        <thead>
                        <tr class="bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-gray-200">
                            <th class="p-3 border dark:border-gray-700">Date</th>
                            <th class="p-3 border dark:border-gray-700">Amount</th>
                            <th class="p-3 border dark:border-gray-700">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($incompleteTransactions as $transaction)
                            <tr class="border dark:border-gray-700 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                <td class="p-3 border dark:border-gray-700 text-gray-900 dark:text-gray-200">
                                    {{ \Carbon\Carbon::createFromTimestamp($transaction->created)->toFormattedDateString() }}
                                </td>
                                <td class="p-3 border dark:border-gray-700 text-gray-900 dark:text-gray-200">
                                    €{{ number_format($transaction->amount / 100, 2) }}
                                </td>
                                <td class="p-3 border dark:border-gray-700">
                                    <span class="px-2 py-1 text-sm font-semibold text-white bg-yellow-500 rounded">
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
            <h2 class="text-2xl font-semibold mt-8 mb-4 text-gray-900 dark:text-gray-100">Invoices</h2>

            @if($invoices->isEmpty())
                <p class="text-gray-600 dark:text-gray-300">No invoices found.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                        <thead>
                        <tr class="bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-gray-200">
                            <th class="p-3 border dark:border-gray-700">Date</th>
                            <th class="p-3 border dark:border-gray-700">Amount</th>
                            <th class="p-3 border dark:border-gray-700">Status</th>
                            <th class="p-3 border dark:border-gray-700">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                            <tr class="border dark:border-gray-700 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                <td class="p-3 border dark:border-gray-700 text-gray-900 dark:text-gray-200">
                                    {{ \Carbon\Carbon::createFromTimestamp($invoice->created)->toFormattedDateString() }}
                                </td>
                                <td class="p-3 border dark:border-gray-700 text-gray-900 dark:text-gray-200">
                                    €{{ number_format($invoice->total / 100, 2) }}
                                </td>
                                <td class="p-3 border dark:border-gray-700 text-gray-900 dark:text-gray-200">
                                    @if($invoice->paid)
                                        <span class="px-2 py-1 text-sm font-semibold text-white bg-green-500 rounded">
                                Paid
                            </span>
                                    @else
                                        <span class="px-2 py-1 text-sm font-semibold text-white bg-red-500 rounded">
                                Unpaid
                            </span>
                                    @endif
                                </td>
                                <td class="p-3 border dark:border-gray-700 text-gray-900 dark:text-gray-200">
                                    @if(!$invoice->paid)
                                        <a href="{{ $invoice->hosted_invoice_url }}" target="_blank" class="text-yellow-500 dark:text-yellow-400 hover:underline mr-4">
                                            Pay Now
                                        </a>
                                    @endif
                                        <a href="{{ $invoice->invoice_pdf }}" target="_blank" class="text-blue-500 dark:text-blue-400 hover:underline">
                                            Download
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
</x-app-layout>
