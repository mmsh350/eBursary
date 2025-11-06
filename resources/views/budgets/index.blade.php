@extends('layouts.poly', ['title' => 'Budgets'])

@section('content')
    <div class="mb-3 flex justify-between">
        <h2 class="text-lg font-semibold">Budgets</h2>
        <a href="{{ route('budgets.create') }}"
           class="rounded bg-emerald-700 px-3 py-2 text-sm text-white">
            + New Budget
        </a>
    </div>

    <div class="overflow-x-auto rounded border bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="border-b px-3 py-2">Year</th>
                    <th class="border-b px-3 py-2">Department</th>
                    <th class="border-b px-3 py-2">Total (₦)</th>
                    <th class="border-b px-3 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $b)
                    <tr>
                        <td class="border-b px-3 py-2">{{ $b->year }}</td>
                        <td class="border-b px-3 py-2">{{ $b->department->name }}</td>
                        <td class="border-b px-3 py-2">₦{{ number_format($b->total_amount, 2) }}</td>
                        <td class="border-b px-3 py-2 text-right">
                            <a class="mr-2 text-emerald-700"
                               href="{{ route('budgets.edit', $b) }}">Edit</a>
                            <form class="inline"
                                  method="POST"
                                  action="{{ route('budgets.destroy', $b) }}"
                                  onsubmit="return confirm('Delete budget?')">
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
