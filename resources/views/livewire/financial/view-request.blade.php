<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="min-w-0 flex-1">
            <div class="flex items-center gap-x-3">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    Request #{{ $financialRequest->id }}
                </h2>
                <span
                    class="inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold ring-1 ring-inset
                {{ match ($financialRequest->status) {
                    'APPROVED_FOR_PAYMENT', 'PAID' => 'bg-green-50 text-green-700 ring-green-600/20',
                    'REJECTED_BY_RECTOR', 'REJECTED_BY_BURSAR' => 'bg-red-50 text-red-700 ring-red-600/20',
                    'DRAFT' => 'bg-gray-50 text-gray-600 ring-gray-500/10',
                    default => 'bg-blue-50 text-blue-700 ring-blue-700/10',
                } }}">
                    {{ ucwords(str_replace('_', ' ', strtolower($financialRequest->status))) }}
                </span>
            </div>
            <div class="mt-2 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6">
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A9.916 9.916 0 0010 18c2.722 0 5.177-1.052 6.792-2.39a5.99 5.99 0 00-9.584-1.22z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $financialRequest->user->name ?? 'Unknown User' }}
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z"
                            clip-rule="evenodd" />
                    </svg>
                    Submitted on {{ $financialRequest->created_at->format('M d, Y') }}
                </div>
            </div>
        </div>
        <div class="mt-4 flex md:ml-4 md:mt-0">
            <div class="text-right">
                <p class="text-sm font-medium text-gray-500">Total Amount</p>
                <p class="text-3xl font-bold text-gray-900 flex items-baseline justify-end">
                    <span class="text-lg font-medium text-gray-500 mr-1">{{ $financialRequest->currency }}</span>
                    {{ number_format($financialRequest->amount, 2) }}
                </p>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 ring-1 ring-inset ring-green-600/20">
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
        <div class="lg:col-span-2 space-y-8">
            <!-- Request Details Card -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">Request Information</h3>
                    <span
                        class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10 uppercase tracking-wider">
                        {{ $financialRequest->type }}
                    </span>
                </div>
                <div class="px-6 py-6">
                    <div class="space-y-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Purpose (Title)</h4>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $financialRequest->purpose }}</p>
                        </div>

                        <div
                            class="prose prose-sm max-w-none text-gray-600 bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Description /
                                Justification</h4>
                            {{ $financialRequest->description }}
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                <dt class="text-sm font-medium text-gray-500">Department</dt>
                                <dd class="mt-1 text-sm font-semibold text-gray-900">
                                    {{ $financialRequest->department->name ?? 'N/A' }}</dd>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                <dt class="text-sm font-medium text-gray-500">Required Date</dt>
                                <dd class="mt-1 text-sm font-semibold text-gray-900">
                                    {{ $financialRequest->required_date->format('M d, Y') }}
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attachments Card -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">Attachments</h3>
                </div>
                <div class="px-6 py-6">
                    @if ($financialRequest->attachments && count($financialRequest->attachments) > 0)
                        <ul role="list" class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2">
                            @foreach ($financialRequest->attachments as $file)
                                <li
                                    class="relative flex items-center space-x-4 rounded-lg border border-gray-300 bg-white px-4 py-3 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                                    <div class="flex-shrink-0">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <a href="{{ Storage::url($file) }}" target="_blank" class="focus:outline-none">
                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                            <p class="text-sm font-medium text-gray-900">Attachment
                                                {{ $loop->iteration }}</p>
                                            <p class="truncate text-sm text-gray-500">Click to view file</p>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center py-6">
                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No attachments</h3>
                            <p class="mt-1 text-sm text-gray-500">There are no files attached to this request.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Approval Actions (Only Visible if actionable) -->
            @php
                $canApproveRector = auth()->user()->can('approveAsRector', $financialRequest);
                $canVerifyAudit = auth()->user()->can('verifyAsAudit', $financialRequest);
                $canApproveRectorFinal = auth()->user()->can('approveAsRectorFinal', $financialRequest);
                $canApproveBursar = auth()->user()->can('approveAsBursar', $financialRequest);
                $canPay = auth()->user()->can('pay', $financialRequest);
                $isActionable =
                    $canApproveRector || $canVerifyAudit || $canApproveRectorFinal || $canApproveBursar || $canPay;
            @endphp

            @if ($isActionable)
                <div
                    class="bg-white shadow-lg ring-1 ring-gray-900/10 rounded-xl overflow-hidden border-t-4 border-blue-600">
                    <div class="px-6 py-5 bg-blue-50/50 border-b border-blue-100">
                        <h3 class="text-lg font-bold leading-6 text-blue-900 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Actions Required
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="mb-6">
                            <textarea wire:model="comment" rows="3"
                                class="block w-full rounded-xl border-0 py-4 px-6  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2   text-lg leading-relaxed bg-gray-50/30"
                                placeholder="Enter your verification notes or comments here..." spellcheck="false"></textarea>
                            @error('comment')
                                <p class="mt-2 text-red-600 text-sm font-medium flex items-center">
                                    <svg class="h-4 w-4 mr-1.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap gap-3">
                            @if ($canApproveRector)
                                <button wire:click="approveRector"
                                    class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                    Approve and Send to Audit
                                </button>
                                <button wire:click="rejectRector"
                                    class="inline-flex items-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-red-600 shadow-sm ring-1 ring-inset ring-red-300 hover:bg-red-50">
                                    Reject Request
                                </button>
                            @endif

                            @if ($canVerifyAudit)
                                <button wire:click="verifyAudit"
                                    class="inline-flex items-center rounded-md bg-amber-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-amber-500">
                                    Verify Price (Audit)
                                </button>
                            @endif

                            @if ($canApproveRectorFinal)
                                <button wire:click="approveRectorFinal"
                                    class="inline-flex items-center rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500">
                                    Final Approval (Rector)
                                </button>
                            @endif

                            @if ($canApproveBursar)
                                <button wire:click="approveBursar"
                                    class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">
                                    Approved by Bursar
                                </button>
                            @endif


                            @if ($canPay)
                                <button wire:click="recordPayment"
                                    class="inline-flex items-center rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500">
                                    Record Payment & Close
                                </button>
                            @endif

                            @if ($financialRequest->status === 'AWAITING_RETIREMENT' && auth()->id() === $financialRequest->user_id)
                                <button wire:click="submitRetirement"
                                    class="inline-flex items-center rounded-md bg-purple-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-500">
                                    Submit Retirement / Close
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar Timeline -->
        <div class="lg:col-span-1">
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl overflow-hidden sticky top-8">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">Workflow Timeline</h3>
                </div>
                <div class="p-6">
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
                                                        'APPROVED', 'APPROVED_FOR_PAYMENT', 'PAID', 'FINAL_APPROVED', 'APPROVED_BY_BURSAR' => 'bg-green-500',
                                                        'REJECTED', 'ON_HOLD', 'RETURNED' => 'bg-red-500 top-1',
                                                        'SUBMITTED', 'SUBMITTED_TO_AUDIT', 'AUDIT_VERIFIED' => 'bg-blue-500',
                                                        default => 'bg-gray-400',
                                                    } }}">
                                                    @if ($log->action == 'APPROVED' || $log->action == 'PAID' || $log->action == 'APPROVED_FOR_PAYMENT')
                                                        <svg class="h-4 w-4 text-white" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    @elseif(str_contains($log->action, 'REJECTED'))
                                                        <svg class="h-4 w-4 text-white" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    @else
                                                        <svg class="h-4 w-4 text-white" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                        </svg>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">
                                                        {{ ucwords(str_replace('_', ' ', strtolower($log->action))) }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">by
                                                        {{ $log->actor->name ?? 'System' }}</p>

                                                    @if ($log->comment)
                                                        <div
                                                            class="mt-2 text-sm text-gray-700 bg-gray-50 p-2.5 rounded-lg border border-gray-200 italic leading-relaxed">
                                                            "{{ $log->comment }}"
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="whitespace-nowrap text-right text-xs text-gray-500">
                                                    <time
                                                        datetime="{{ $log->created_at }}">{{ $log->created_at->format('M d') }}</time>
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
