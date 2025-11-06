@extends('layouts.poly', ['title' => 'Budget Heads'])

@section('content')
    <div class="mb-3 flex justify-between">
        <h2 class="text-lg font-semibold">Budget Heads</h2>
        <a href="{{ route('budget-heads.create') }}"
           class="rounded bg-emerald-700 px-3 py-2 text-sm text-white">+ Add Head</a>
    </div>

    <div class="overflow-x-auto rounded border bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="border-b px-3 py-2">Department</th>
                    <th class="border-b px-3 py-2">Year</th>
                    <th class="border-b px-3 py-2">Head</th>
                    <th class="border-b px-3 py-2">Allocated (₦)</th>
                    <th class="border-b px-3 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td class="border-b px-3 py-2">{{ $item->budget->department->name }}</td>
                        <td class="border-b px-3 py-2">{{ $item->budget->year }}</td>
                        <td class="border-b px-3 py-2">{{ $item->name }}</td>
                        <td class="border-b px-3 py-2">₦{{ number_format($item->allocated_amount, 2) }}</td>
                        <td class="border-b px-3 py-2 text-right">
                            <a class="mr-2 text-emerald-700"
                               href="{{ route('budget-heads.edit', $item) }}">Edit</a>
                            <form method="POST"
                                  action="{{ route('budget-heads.destroy', $item) }}"
                                  class="inline"
                                  onsubmit="return confirm('Delete head?')">
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
