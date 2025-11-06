@extends('layouts.poly', ['title' => 'Users'])

@section('content')
    <div class="mb-4 flex justify-between">
        <h2 class="text-lg font-semibold">Users</h2>
    </div>

    <div class="overflow-x-auto rounded border bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="border-b px-3 py-2">Name</th>
                    <th class="border-b px-3 py-2">Email</th>
                    <th class="border-b px-3 py-2">Department</th>
                    <th class="border-b px-3 py-2">Unit</th>
                    <th class="border-b px-3 py-2">Status</th>
                    <th class="border-b px-3 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td class="border-b px-3 py-2">{{ $item->name }}</td>
                        <td class="border-b px-3 py-2">{{ $item->email }}</td>
                        <td class="border-b px-3 py-2">{{ $item->department->name ?? '-' }}</td>
                        <td class="border-b px-3 py-2">{{ $item->unit->name ?? '-' }}</td>
                        <td class="border-b px-3 py-2">
                            <span
                                  class="{{ $item->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }} rounded px-2 py-1 text-xs">
                                {{ $item->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="border-b px-3 py-2 text-right">
                            <a class="text-emerald-700"
                               href="{{ route('users.edit', $item) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $items->links() }}</div>
@endsection
