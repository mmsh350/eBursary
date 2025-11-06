@extends('layouts.poly', ['title' => 'Departments'])

@section('content')
    <div class="mb-3 flex items-center justify-between">
        <h2 class="text-lg font-semibold">Departments</h2>
        <a href="{{ route('departments.create') }}"
           class="rounded bg-emerald-700 px-3 py-2 text-sm text-white">
            + New Department
        </a>
    </div>

    <form method="GET"
          class="mb-3">
        <input name="q"
               value="{{ $q }}"
               placeholder="Search name or code"
               class="w-full rounded border px-3 py-2 md:w-80" />
    </form>

    <div class="overflow-x-auto rounded border bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="border-b px-3 py-2 text-left">Name</th>
                    <th class="border-b px-3 py-2 text-left">Code</th>
                    <th class="border-b px-3 py-2 text-left">Description</th>
                    <th class="border-b px-3 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td class="border-b px-3 py-2">{{ $item->name }}</td>
                        <td class="border-b px-3 py-2">{{ $item->code }}</td>
                        <td class="border-b px-3 py-2">{{ Str::limit($item->description, 80) }}</td>
                        <td class="border-b px-3 py-2 text-right">
                            <a class="mr-2 text-emerald-700"
                               href="{{ route('departments.edit', $item) }}">Edit</a>
                            <form method="POST"
                                  action="{{ route('departments.destroy', $item) }}"
                                  class="inline"
                                  onsubmit="return confirm('Delete this department?')">
                                @csrf @method('DELETE')
                                <button class="text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-3 py-3"
                            colspan="4">No records</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $items->links() }}</div>
@endsection
