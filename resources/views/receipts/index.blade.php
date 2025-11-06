@extends('layouts.poly', ['title' => 'Receipts'])

@section('content')
    <div class="mb-3 flex justify-between">
        <h2 class="text-lg font-semibold">Receipts</h2>
        <a href="{{ route('receipts.create') }}"
           class="rounded bg-emerald-700 px-3 py-2 text-sm text-white">
            + New Receipt
        </a>
    </div>

    <div class="overflow-x-auto rounded border bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="border-b px-3 py-2">Source</th>
                    <th class="border-b px-3 py-2">Amount</th>
                    <th class="border-b px-3 py-2">Reference</th>
                    <th class="border-b px-3 py-2">Date</th>
                    <th class="border-b px-3 py-2">File</th>
                    <th class="border-b px-3 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td class="border-b px-3 py-2">{{ $item->revenueSource->name }}</td>
                        <td class="border-b px-3 py-2">₦{{ number_format($item->amount, 2) }}</td>
                        <td class="border-b px-3 py-2">{{ $item->reference }}</td>
                        <td class="border-b px-3 py-2">{{ $item->receipt_date }}</td>
                        <td class="border-b px-3 py-2">
                            @if ($item->file)
                                <a href="{{ asset('storage/' . $item->file) }}"
                                   class="text-blue-600"
                                   target="_blank">View</a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="border-b px-3 py-2 text-right">
                            <form method="POST"
                                  action="{{ route('receipts.destroy', $item) }}"
                                  onsubmit="return confirm('Delete receipt?')">
                                @csrf @method('DELETE')
                                <button class="text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $items->links() }}</div>
@endsection
