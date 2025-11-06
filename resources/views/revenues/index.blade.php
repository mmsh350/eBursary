@extends('layouts.poly', ['title' => 'Revenues'])

@section('content')
    <div class="mb-3 flex justify-between">
        <h2 class="text-lg font-semibold">Revenues</h2>
        <a href="{{ route('revenues.create') }}"
           class="rounded bg-emerald-700 px-3 py-2 text-sm text-white">
            + Record Revenue
        </a>
    </div>

    <div class="overflow-x-auto rounded border bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="border-b px-3 py-2">Source</th>
                    <th class="border-b px-3 py-2">Amount</th>
                    <th class="border-b px-3 py-2">Ref</th>
                    <th class="border-b px-3 py-2">Date</th>
                    <th class="border-b px-3 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td class="border-b px-3 py-2">{{ $item->source->name }}</td>
                        <td class="border-b px-3 py-2">₦{{ number_format($item->amount, 2) }}</td>
                        <td class="border-b px-3 py-2">{{ $item->reference }}</td>
                        <td class="border-b px-3 py-2">{{ $item->payment_date }}</td>
                        <td class="border-b px-3 py-2 text-right">
                            <a class="mr-2 text-emerald-700"
                               href="{{ route('revenues.edit', $item) }}">Edit</a>
                            <form class="inline"
                                  method="POST"
                                  onsubmit="return confirm('Delete revenue entry?')"
                                  action="{{ route('revenues.destroy', $item) }}">
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
