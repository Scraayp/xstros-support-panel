<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Ticket Overview -->
            <div class="bg-white dark:bg-gray-900 shadow-lg rounded-xl p-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Tickets Overview</h3>
                <div class="relative w-full max-h-64">
                    <canvas id="ticketChart"></canvas>
                </div>
            </div>

            <!-- Transactions Overview -->
            <div class="bg-white dark:bg-gray-900 shadow-lg rounded-xl p-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Transaction Overview</h3>
                <div class="relative w-full max-h-64">
                    <canvas id="transactionChart"></canvas>
                </div>
            </div>

            <!-- User Information -->
            <div class="shadow-lg rounded-xl p-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">User Information</h3>
                <div class="flex items-center space-x-4">
                    <img src="{{ Auth::user()->profile_image ?? '/pfp-placeholder.png' }}" class="w-16 h-16 rounded-full border border-gray-300 dark:border-gray-700 shadow-md" alt="Profile Image">
                    <div>
                        <p class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ Auth::user()->email }}</p>
                        <span class="px-3 py-1 text-xs font-medium rounded-lg
                            @if(Auth::user()->role === 'Admin') bg-blue-500 text-white
                            @elseif(Auth::user()->role === 'Staff') bg-green-500 text-white
                            @else bg-gray-500 text-white @endif">
                            {{ Auth::user()->role }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-900  shadow-xl rounded-xl p-6 text-white flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span class="text-3xl">💰</span>
                    <div>
                        <h3 class="text-xl font-semibold">Completed Transactions</h3>
                        <p class="text-lg font-bold mt-1">+ {{$completedTransactionsMoney}} EUR</p>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- ChartJS Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Ticket Chart
        const ticketCtx = document.getElementById('ticketChart').getContext('2d');
        new Chart(ticketCtx, {
            type: 'doughnut',
            data: {
                labels: ['Open Tickets', 'Closed Tickets'],
                datasets: [{
                    data: [{{ $openTickets }}, {{ $closedTickets }}],
                    backgroundColor: ['#3B82F6', '#EF4444'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Transactions Chart
        const transactionCtx = document.getElementById('transactionChart').getContext('2d');
        new Chart(transactionCtx, {
            type: 'doughnut',
            data: {
                labels: ['Completed Transactions', 'Incomplete Transactions'],
                datasets: [{
                    data: [{{ $completedTransactions }}, {{ $incompleteTransactions }}],
                    backgroundColor: ['#10B981', '#F59E0B'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</x-app-layout>
