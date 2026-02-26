<div class="space-y-6">
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                My Requests
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                View and track the status of your financial requests.
            </p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ route('requests.create') }}"
                class="block rounded-md bg-blue-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                New Request
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div
        class="flex flex-col sm:flex-row gap-4 justify-between items-center bg-white p-4 rounded-lg shadow-sm border border-gray-100">
        <div class="w-full sm:w-96 relative">
            <x-text-input wire:model.live.debounce.300ms="search" placeholder="Search requests..." />
        </div>
        <div class="w-full sm:w-48">
            <x-select-input wire:model.live="filterStatus">
                <option value="">All Statuses</option>
                <option value="SUBMITTED">Submitted</option>
                <option value="PENDING_RECTOR">Pending Rector</option>
                <option value="PENDING_BURSAR">Pending Bursar</option>
                <option value="APPROVED_FOR_PAYMENT">Approved</option>
                <option value="PAID">Paid</option>
                <option value="REJECTED">Rejected</option>
            </x-select-input>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow ring-1 ring-gray-900/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ID</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Type</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Purpose
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Amount</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($requests as $req)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-6">
                                #{{ $req->id }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900 capitalize">
                                {{ $req->type }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ Str::limit($req->purpose, 40) }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                ₦{{ number_format($req->amount, 2) }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm">
                                <span
                                    class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                    {{ match ($req->status) {
                                        'APPROVED_FOR_PAYMENT', 'PAID' => 'bg-green-100 text-green-800',
                                        'REJECTED_BY_RECTOR', 'REJECTED_BY_BURSAR' => 'bg-red-100 text-red-800',
                                        'DRAFT' => 'bg-gray-100 text-gray-800',
                                        default => 'bg-yellow-100 text-yellow-800',
                                    } }}">
                                    {{ str_replace('_', ' ', $req->status) }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $req->created_at->format('M d, Y') }}
                            </td>
                            <td
                                class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <a href="{{ route('requests.show', $req) }}"
                                    class="text-blue-600 hover:text-blue-900">View<span class="sr-only">,
                                        {{ $req->purpose }}</span></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-3 py-8 text-center text-sm text-gray-500">
                                No requests found. <a href="{{ route('requests.create') }}"
                                    class="text-blue-600 hover:underline">Create one</a> to get started.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-200 bg-gray-50 px-4 py-3 sm:px-6">
            {{ $requests->links() }}
        </div>
    </div>
</div>
