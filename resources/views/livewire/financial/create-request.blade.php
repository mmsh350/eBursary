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
                            @foreach ($requestTypes as $reqType)
                                <option value="{{ $reqType->code }}">{{ $reqType->name }}</option>
                            @endforeach
                        </x-select-input>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="required_date" class="block text-sm font-semibold leading-6 text-gray-900">Required
                        Date</label>
                    <div class="mt-2 relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <x-text-input type="date" wire:model="required_date" id="required_date" class="pl-10" />
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
                        <div class="mt-2 relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <x-text-input type="date" wire:model="expected_retirement_date"
                                id="expected_retirement_date"
                                class="pl-10 border-blue-300 focus:border-blue-500 focus:ring-blue-500" />
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
                        </x-select-input>
                    </div>
                    @error('currency')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="sm:col-span-4">
                    <label for="amount" class="block text-sm font-semibold leading-6 text-gray-900">Amount</label>
                    <div class="mt-2 relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="text-gray-500 sm:text-sm font-bold">&#8358;</span>
                        </div>
                        <x-text-input type="number" step="0.01" wire:model="amount" id="amount"
                            class="pl-8 font-semibold text-lg" placeholder="0.00" />
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
                    <label for="attachments" class="block text-sm font-semibold leading-6 text-gray-900">Attachments
                        (Optional)</label>
                    <div
                        class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-4 hover:bg-gray-50 transition-colors cursor-pointer relative">
                        <div class="text-center">
                            <svg class="mx-auto h-10 w-10 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div class="mt-2 flex text-sm leading-6 text-gray-600 justify-center">
                                <label for="attachments"
                                    class="relative cursor-pointer rounded-md bg-white font-semibold text-blue-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-600 focus-within:ring-offset-2 hover:text-blue-500">
                                    <span>Upload files</span>
                                    <input id="attachments" wire:model="attachments" type="file" multiple
                                        class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs leading-5 text-gray-600">PDF, PNG, JPG up to 10MB</p>

                            <!-- Loading Indicator -->
                            <div wire:loading wire:target="attachments" class="mt-2">
                                <span class="text-sm text-blue-600 flex items-center justify-center gap-2">
                                    <svg class="animate-spin h-4 w-4 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    Uploading...
                                </span>
                            </div>
                        </div>
                    </div>
                    @error('attachments.*')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror

                    <!-- Previews -->
                    @if ($attachments)
                        <div class="mt-4 grid grid-cols-2 gap-4 sm:grid-cols-3">
                            @foreach ($attachments as $file)
                                <div class="relative group rounded-lg overflow-hidden border border-gray-200">
                                    @if (in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp']))
                                        <img src="{{ $file->temporaryUrl() }}" class="h-24 w-full object-cover"
                                            alt="Preview">
                                    @else
                                        <div class="h-24 w-full bg-gray-50 flex items-center justify-center">
                                            <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="bg-white p-2 text-xs text-gray-700 truncate">
                                        {{ $file->getClientOriginalName() }}
                                    </div>
                                    <button type="button" wire:click="removeAttachment({{ $loop->index }})"
                                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 shadow hover:bg-red-600 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="border-t border-gray-100 pt-8"></div>

            <!-- Details -->
            <div>
                <label for="purpose" class="block text-sm font-semibold leading-6 text-gray-900">Purpose
                    (Title)</label>
                <div class="mt-2 relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <x-text-input type="text" wire:model="purpose" id="purpose" class="pl-10"
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
                        class="block w-full rounded-lg border-gray-300 py-2.5 px-3 text-gray-900 placeholder-gray-400 focus:border-blue-700 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        placeholder="Provide a detailed explanation..."></textarea>
                </div>
                @error('description')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Payment Info -->
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                <div class="flex items-center mb-4">
                    <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <h4 class="text-sm font-bold text-gray-900">Payment Details (Beneficiary)</h4>
                </div>

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-2">
                        <label for="bank_name" class="block text-sm font-medium leading-6 text-gray-900">Bank
                            Name</label>
                        <div class="mt-2 relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <x-text-input type="text" wire:model="bank_name" id="bank_name" class="pl-9"
                                placeholder="Bank Name" />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="account_number" class="block text-sm font-medium leading-6 text-gray-900">Account
                            Number</label>
                        <div class="mt-2 relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                </svg>
                            </div>
                            <x-text-input type="text" wire:model="account_number" id="account_number"
                                class="pl-9" placeholder="0123456789" />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="account_name" class="block text-sm font-medium leading-6 text-gray-900">Account
                            Name</label>
                        <div class="mt-2 relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <x-text-input type="text" wire:model="account_name" id="account_name" class="pl-9"
                                placeholder="Account Name" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-x-6 border-t border-gray-100 pt-8">
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>

                <button type="submit"
                    class="rounded-lg bg-blue-900 px-8 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all">Submit
                    Request</button>
            </div>
        </form>
    </div>
</div>
