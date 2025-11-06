@extends('layouts.poly', ['title' => 'Revenue Sources'])

@section('content')
    <div class="mb-3 flex justify-between">
        <h2 class="text-lg font-semibold">Revenue Sources</h2>
        <a href="{{ route('revenue-sources.create') }}"
           class="rounded bg-emerald-700 px-3 py-2 text-sm text-white">
            + New Source
        </a>
    </div>

    <form method="GET"
          class="mb-3">
        <input name="q"
               value="{{ $q }}"
               placeholder="Search name or description"
               class="w-full rounded border px-3 py-2 md:w-80">
    </form>

    <div class="overflow-x-auto rounded border bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="border-b px-3 py-2">Name</th>
                    <th class="border-b px-3 py-2">Description</th>
                    <th class="border-b px-3 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td class="border-b px-3 py-2">{{ $item->name }}</td>
                        <td class="border-b px-3 py-2">{{ Str::limit($item->description, 80) }}</td>
                        <td class="border-b px-3 py-2 text-right">
                            <a class="mr-2 text-emerald-700"
                               href="{{ route('revenue-sources.edit', $item) }}">Edit</a>
                            <form action="{{ route('revenue-sources.destroy', $item) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Delete revenue source?')">
                                @csrf @method('DELETE')
                                <button class="text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3"
                            class="px-3 py-2 text-center">No Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $items->links() }}</div>
@endsection
