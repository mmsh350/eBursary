<div class="max-w-5xl mx-auto pb-12">
    <!-- Header -->
    <div class="md:flex md:items-center md:justify-between mb-6">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Request #{{ $financialRequest->id }}
            </h2>
            <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    {{ $financialRequest->user->name ?? 'Unknown User' }}
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z"
                            clip-rule="evenodd" />
                    </svg>
                    Submitted on {{ $financialRequest->created_at->format('M d, Y') }}
                </div>
            </div>
        </div>
        <div class="mt-4 flex md:ml-4 md:mt-0">
            <span
                class="inline-flex items-center rounded-full px-4 py-1.5 text-sm font-semibold
                {{ match ($financialRequest->status) {
                    'APPROVED_FOR_PAYMENT', 'PAID' => 'bg-green-100 text-green-800',
                    'REJECTED_BY_RECTOR', 'REJECTED_BY_BURSAR' => 'bg-red-100 text-red-800',
                    'DRAFT' => 'bg-gray-100 text-gray-600',
                    default => 'bg-blue-100 text-blue-800',
                } }}">
                {{ str_replace('_', ' ', $financialRequest->status) }}
            </span>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 rounded-md bg-green-50 p-4 border border-green-200">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Request Information</h3>
                    <span
                        class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10 uppercase tracking-wider">
                        {{ $financialRequest->type }}
                    </span>
                </div>
                <div class="px-6 py-6">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Purpose</dt>
                            <dd class="mt-1 text-base text-gray-900 font-semibold">{{ $financialRequest->purpose }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                {{ $financialRequest->description }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Amount</dt>
                            <dd class="mt-1 text-xl font-bold text-gray-900 flex items-baseline">
                                <span
                                    class="text-sm font-normal text-gray-500 mr-1">{{ $financialRequest->currency }}</span>
                                {{ number_format($financialRequest->amount, 2) }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Required Date</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $financialRequest->required_date->format('M d, Y') }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Department</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $financialRequest->department->name ?? 'N/A' }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Budget Head</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $financialRequest->budgetHead->name ?? 'N/A' }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            @if ($this->budgetStats)
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Budget Utilization
                        ({{ $financialRequest->budgetHead->name }})</h4>
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div class="bg-white p-2 rounded shadow-sm border border-gray-200">
                            <span class="block text-xs text-gray-400">Allocated</span>
                            <span
                                class="block text-sm font-bold text-gray-700">₦{{ number_format($this->budgetStats['allocated'], 2) }}</span>
                        </div>
                        <div class="bg-white p-2 rounded shadow-sm border border-gray-200">
                            <span class="block text-xs text-gray-400">Spent (Approved)</span>
                            <span
                                class="block text-sm font-bold text-blue-600">₦{{ number_format($this->budgetStats['used'], 2) }}</span>
                        </div>
                        <div class="bg-white p-2 rounded shadow-sm border border-gray-200">
                            <span class="block text-xs text-gray-400">Remaining</span>
                            <span
                                class="block text-sm font-bold {{ $this->budgetStats['remaining'] < 0 ? 'text-red-600' : 'text-green-600' }}">
                                ₦{{ number_format($this->budgetStats['remaining'], 2) }}
                            </span>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Approval Actions (Only Visible if actionable) -->
        @php
            $canApproveRector = auth()->user()->can('approveAsRector', $financialRequest);
            $canApproveBursar = auth()->user()->can('approveAsBursar', $financialRequest);
            $canProcessFinance = auth()->user()->can('processAsFinance', $financialRequest);
            $canPay = auth()->user()->can('pay', $financialRequest);
            $isActionable = $canApproveRector || $canApproveBursar || $canProcessFinance || $canPay;
        @endphp

        @if ($isActionable)
            <div class="bg-blue-50/50 shadow-sm rounded-xl overflow-hidden border border-blue-100 p-6">
                <h3 class="text-lg font-medium leading-6 text-blue-900 mb-4">Actions Required</h3>

                <textarea wire:model="comment" rows="2"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 mb-4"
                    placeholder="Enter comments or reason for rejection..."></textarea>
                @error('comment')
                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                @enderror

                <div class="flex gap-3">
                    @if ($canApproveRector)
                        <button wire:click="approveRector"
                            class="rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">Approve
                            Request (Rector)</button>
                        <button wire:click="rejectRector"
                            class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-red-600 shadow-sm ring-1 ring-inset ring-red-300 hover:bg-red-50">Reject</button>
                    @endif

                    @if ($canApproveBursar)
                        <button wire:click="approveBursar"
                            class="rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">Approve
                            Request (Bursar)</button>
                        <button wire:click="rejectBursar"
                            class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-red-600 shadow-sm ring-1 ring-inset ring-red-300 hover:bg-red-50">Reject</button>
                    @endif

                    @if ($canProcessFinance)
                        <button wire:click="processFinance"
                            class="rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">Mark
                            Ready for Payment</button>
                    @endif

                    @if ($canPay)
                        <button wire:click="recordPayment"
                            class="rounded-md bg-green-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-500">Record
                            Payment & Close</button>
                    @endif

                    @if ($financialRequest->status === 'AWAITING_RETIREMENT' && auth()->id() === $financialRequest->user_id)
                        <button wire:click="submitRetirement"
                            class="rounded-md bg-purple-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-purple-500">Submit
                            Retirement / Close</button>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Sidebar Timeline -->
    <div class="lg:col-span-1">
        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Workflow Timeline</h3>
        <div class="flow-root">
            <ul role="list" class="-mb-8">
                @foreach ($financialRequest->lifecycleLogs->sortBy('created_at') as $log)
                    <li>
                        <div class="relative pb-8">
                            @if (!$loop->last)
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                    aria-hidden="true"></span>
                            @endif
                            <div class="relative flex space-x-3">
                                <div>
                                    <span
                                        class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white
                                        {{ match ($log->action) {
                                            'APPROVED', 'APPROVED_FOR_PAYMENT', 'PAID' => 'bg-green-500',
                                            'REJECTED', 'ON_HOLD', 'RETURNED' => 'bg-red-500',
                                            'SUBMITTED' => 'bg-blue-500',
                                            default => 'bg-gray-400',
                                        } }}">
                                        @if ($log->action == 'APPROVED' || $log->action == 'PAID')
                                            <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        @elseif($log->action == 'REJECTED')
                                            <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        @else
                                            <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                        @endif
                                    </span>
                                </div>
                                <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                    <div>
                                        <p class="text-sm text-gray-500">
                                            <span class="font-medium text-gray-900">{{ $log->action }}</span>
                                            by <span
                                                class="font-medium text-gray-900">{{ $log->actor->name ?? 'Unknown' }}</span>
                                        </p>
                                        @if ($log->comment)
                                            <p
                                                class="mt-1 text-sm text-gray-600 bg-gray-50 p-2 rounded border border-gray-100 italic">
                                                "{{ $log->comment }}"
                                            </p>
                                        @endif
                                    </div>
                                    <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                        <time
                                            datetime="{{ $log->created_at }}">{{ $log->created_at->format('M d, H:i') }}</time>
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
