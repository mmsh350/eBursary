<div class="max-w-4xl mx-auto">

    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">New
                Financial Request</h2>
            <p class="mt-1 text-sm text-gray-500">Submit a request for advance, claim, or expenditure approval.</p>
        </div>
    </div>

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
        <div class="px-8 py-6 bg-gradient-to-r from-blue-50 to-white border-b border-gray-100">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <span
                        class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-blue-100 text-blue-700">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </span>
                </div>
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Request Details</h3>
                    <p class="mt-1 text-sm text-gray-500">Please fill out the form entirely.</p>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="mx-8 mt-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul role="list" class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <form wire:submit.prevent="submit" class="p-8 space-y-8">
            <!-- Request Type -->
            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="type" class="block text-sm font-semibold leading-6 text-gray-900">Request
                        Type</label>
                    <div class="mt-2">
                        <x-select-input wire:model.live="type" id="type">
                            <option value="expenditure">Expenditure</option>
                            <option value="advance">Staff Advance</option>
                            <option value="claim">Claim / Reimbursement</option>
                            <option value="project">Project Capital</option>
                        </x-select-input>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="required_date" class="block text-sm font-semibold leading-6 text-gray-900">Required
                        Date</label>
                    <div class="mt-2">
                        <x-text-input type="date" wire:model="required_date" id="required_date" />
                    </div>
                    @error('required_date')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                @if ($type === 'advance')
                    <div class="sm:col-span-6 bg-blue-50 p-4 rounded-lg border border-blue-100">
                        <label for="expected_retirement_date"
                            class="block text-sm font-semibold leading-6 text-blue-900">Expected Retirement Date
                            (Deadline)</label>
                        <p class="text-xs text-blue-700 mb-2">When do you expect to account for these funds?</p>
                        <div class="mt-2">
                            <x-text-input type="date" wire:model="expected_retirement_date"
                                id="expected_retirement_date" />
                        </div>
                        @error('expected_retirement_date')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                @endif
            </div>

            <div class="border-t border-gray-100 pt-8"></div>

            <!-- Financials -->
            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                <div class="sm:col-span-2">
                    <label for="currency" class="block text-sm font-semibold leading-6 text-gray-900">Currency</label>
                    <div class="mt-2">
                        <x-select-input wire:model="currency" id="currency">
                            <option value="NGN">NGN (Naira)</option>
                            <option value="USD">USD (Dollar)</option>
                            <option value="GBP">GBP (Pounds)</option>
                            <option value="EUR">EUR (Euro)</option>
                        </x-select-input>
                    </div>
                    @error('currency')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="sm:col-span-4">
                    <label for="amount" class="block text-sm font-semibold leading-6 text-gray-900">Amount</label>
                    <div class="mt-2 relative rounded-md shadow">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="text-gray-500 sm:text-sm">&#8358;</span>
                        </div>
                        <x-text-input type="number" step="0.01" wire:model="amount" id="amount" class="pl-7"
                            placeholder="0.00" />
                    </div>
                    @error('amount')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Classification -->
            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="department_id"
                        class="block text-sm font-semibold leading-6 text-gray-900">Department</label>
                    <div class="mt-2">
                        <x-select-input wire:model="department_id" id="department_id">
                            <option value="">Select Department</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </x-select-input>
                    </div>
                    @error('department_id')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="sm:col-span-3">
                    <label for="budget_head_id" class="block text-sm font-semibold leading-6 text-gray-900">Budget Head
                        (Vote)</label>
                    <div class="mt-2">
                        <x-select-input wire:model="budget_head_id" id="budget_head_id">
                            <option value="">Select Budget Head</option>
                            @foreach ($budgetHeads as $head)
                                <option value="{{ $head->id }}">{{ $head->name ?? $head->code }}</option>
                            @endforeach
                        </x-select-input>
                    </div>
                    @error('budget_head_id')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="border-t border-gray-100 pt-8"></div>

            <!-- Details -->
            <div>
                <label for="purpose" class="block text-sm font-semibold leading-6 text-gray-900">Purpose
                    (Title)</label>
                <div class="mt-2">
                    <x-text-input type="text" wire:model="purpose" id="purpose"
                        placeholder="e.g. Purchase of Office Supplies" />
                </div>
                @error('purpose')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold leading-6 text-gray-900">Detailed
                    Description / Justification</label>
                <div class="mt-2">
                    <textarea wire:model="description" id="description" rows="4"
                        class="block w-full rounded-md border-gray-400 shadow focus:border-blue-600 focus:ring-blue-600 sm:text-sm py-2.5 px-3 text-gray-900"></textarea>
                </div>
                @error('description')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Payment Info -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-sm font-semibold text-gray-900 mb-4">Payment Details (Beneficiary)</h4>
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-2">
                        <label for="bank_name" class="block text-sm font-medium leading-6 text-gray-900">Bank
                            Name</label>
                        <div class="mt-2">
                            <x-text-input type="text" wire:model="bank_name" id="bank_name" />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="account_number" class="block text-sm font-medium leading-6 text-gray-900">Account
                            Number</label>
                        <div class="mt-2">
                            <x-text-input type="text" wire:model="account_number" id="account_number" />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="account_name" class="block text-sm font-medium leading-6 text-gray-900">Account
                            Name</label>
                        <div class="mt-2">
                            <x-text-input type="text" wire:model="account_name" id="account_name" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-x-6 border-t border-gray-100 pt-8">
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                <button type="button" wire:click="saveDraft"
                    class="rounded-lg bg-gray-600 px-8 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 transition-all">Save
                    as Draft</button>
                <button type="submit"
                    class="rounded-lg bg-blue-900 px-8 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all">Submit
                    Request</button>
            </div>
        </form>
    </div>
</div>
