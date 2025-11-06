@extends('layouts.poly', ['title' => 'Expenditure Requests'])

@section('content')
    <div class="mb-3 flex justify-between">
        <h2 class="text-lg font-semibold">Expenditure Requests</h2>
        <a href="{{ route('expenditures.create') }}"
           class="rounded bg-emerald-700 px-3 py-2 text-sm text-white">
            + New Request
        </a>
    </div>

    <div class="overflow-x-auto rounded border bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="border-b px-3 py-2">User</th>
                    <th class="border-b px-3 py-2">Dept</th>
                    <th class="border-b px-3 py-2">Head</th>
                    <th class="border-b px-3 py-2">Amount</th>
                    <th class="border-b px-3 py-2">Status</th>
                    <th class="border-b px-3 py-2">File</th>
                    <th class="border-b px-3 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td class="border-b px-3 py-2">{{ $item->user->name }}</td>
                        <td class="border-b px-3 py-2">{{ $item->department->name }}</td>
                        <td class="border-b px-3 py-2">{{ $item->budgetHead->name }}</td>
                        <td class="border-b px-3 py-2">₦{{ number_format($item->amount, 2) }}</td>
                        <td class="border-b px-3 py-2">
                            <span
                                  class="{{ $item->status == 'approved' ? 'bg-emerald-100 text-emerald-700' : ($item->status == 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-800') }} rounded px-2 py-1 text-xs">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="border-b px-3 py-2">
                            @if ($item->supporting_file)
                                <a href="{{ asset('storage/' . $item->supporting_file) }}"
                                   target="_blank"
                                   class="text-blue-600">View</a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="border-b px-3 py-2 text-right">
                            @if ($item->status == 'pending')
                                <form action="{{ route('expenditures.approve', $item) }}"
                                      method="POST"
                                      class="inline">
                                    @csrf
                                    <button class="mr-2 text-emerald-700">Approve</button>
                                </form>
                                <form action="{{ route('expenditures.reject', $item) }}"
                                      method="POST"
                                      class="inline">
                                    @csrf
                                    <button class="text-red-700">Reject</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $items->links() }}</div>
@endsection
