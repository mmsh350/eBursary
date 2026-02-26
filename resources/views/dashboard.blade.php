<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        <!-- New Quick Action Card -->
        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-gray-500">New Request</div>
                    <div class="mt-1 text-2xl font-bold text-gray-900">Create</div>
                </div>
                <div class="h-12 w-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-700">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('requests.create') }}"
                    class="text-sm font-medium text-blue-700 hover:text-blue-900 flex items-center gap-1">
                    Start a new request <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>

        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
            <div class="text-sm font-medium text-gray-500">My Spending (YTD)</div>
            <div class="mt-1 text-2xl font-bold text-gray-900">₦{{ number_format($mySpending, 2) }}</div>
        </div>

        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
            @if ($isApprover && $pendingApprovalsCount > 0)
                <div class="text-sm font-medium text-gray-500">Pending Approvals</div>
                <div class="mt-1 text-2xl font-bold text-orange-600">{{ $pendingApprovalsCount }}</div>
            @else
                <div class="text-sm font-medium text-gray-500">My Pending Requests</div>
                <div class="mt-1 text-2xl font-bold text-blue-600">{{ $myPendingRequestsCount }}</div>
            @endif
        </div>
    </div>

    @if (isset($charts) && count($charts) > 0)
        <!-- Dashboard Charts -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mt-8">
            <!-- Chart 1 -->
            <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold leading-6 text-gray-900 mb-4">
                    {{ $isApprover ? 'Applications by Department' : 'My Requests Status' }}
                </h3>
                <div class="relative h-64">
                    <canvas id="chart1"></canvas>
                </div>
            </div>

            <!-- Chart 2 -->
            <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold leading-6 text-gray-900 mb-4">
                    {{ $isApprover ? 'Monthly Request Volume' : 'Monthly Spending (Last 6 Months)' }}
                </h3>
                <div class="relative h-64">
                    <canvas id="chart2"></canvas>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx1 = document.getElementById('chart1');
                const ctx2 = document.getElementById('chart2');

                @if ($isApprover)
                    // Admin/Approver Charts

                    // 1. Applications by Department (Doughnut)
                    new Chart(ctx1, {
                        type: 'doughnut',
                        data: {
                            labels: @json($charts['dept_labels']),
                            datasets: [{
                                label: 'Requests',
                                data: @json($charts['dept_data']),
                                backgroundColor: [
                                    '#3b82f6', '#ef4444', '#f59e0b', '#10b981', '#6366f1', '#8b5cf6'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'right',
                                }
                            }
                        }
                    });

                    // 2. Monthly Volume (Bar)
                    new Chart(ctx2, {
                        type: 'bar',
                        data: {
                            labels: @json($charts['volume_labels']),
                            datasets: [{
                                label: 'Total Requests',
                                data: @json($charts['volume_data']),
                                backgroundColor: '#dbeafe',
                                borderColor: '#3b82f6',
                                borderWidth: 1,
                                borderRadius: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        precision: 0
                                    }
                                }
                            }
                        }
                    });
                @else
                    // User Charts

                    // 1. Status Breakdown (Bar/Pie)
                    new Chart(ctx1, {
                        type: 'doughnut',
                        data: {
                            labels: @json($charts['status_labels']),
                            datasets: [{
                                label: 'Count',
                                data: @json($charts['status_data']),
                                backgroundColor: [
                                    '#94a3b8', // Draft/Other
                                    '#f59e0b', // Pending
                                    '#10b981', // Approved/Paid
                                    '#ef4444' // Rejected
                                ],
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'right',
                                }
                            }
                        }
                    });

                    // 2. Spending Trends (Line)
                    new Chart(ctx2, {
                        type: 'line',
                        data: {
                            labels: @json($charts['spending_labels']),
                            datasets: [{
                                label: 'Expenditure (₦)',
                                data: @json($charts['spending_data']),
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                @endif
            });
        </script>
    @endif

    <!-- Recent Requests Section -->
    <div class="mt-8">
        <h3 class="text-lg font-semibold leading-6 text-gray-900 mb-4">Recent Financial Requests</h3>

        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Purpose</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Amount</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">View</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentRequests as $req)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#{{ $req->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 capitalize">
                                {{ $req->type }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ Str::limit($req->purpose, 30) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                ₦{{ number_format($req->amount, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                {{ match ($req->status) {
                                    'APPROVED_FOR_PAYMENT', 'PAID' => 'bg-green-100 text-green-800',
                                    'REJECTED_BY_RECTOR', 'REJECTED_BY_BURSAR' => 'bg-red-100 text-red-800',

                                    default => 'bg-yellow-100 text-yellow-800',
                                } }}">
                                    {{ str_replace('_', ' ', $req->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $req->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('requests.show', $req) }}"
                                    class="text-blue-600 hover:text-blue-900">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-sm text-gray-500">
                                No requests found. <a href="{{ route('requests.create') }}"
                                    class="text-blue-600 hover:underline">Create one now</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
