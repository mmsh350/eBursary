@extends('layouts.poly', ['title' => 'Vendors'])

@section('content')
    <div class="mb-3 flex justify-between">
        <h2 class="text-lg font-semibold">Vendors</h2>
        <a href="{{ route('vendors.create') }}"
           class="rounded bg-emerald-700 px-3 py-2 text-sm text-white">+ New Vendor</a>
    </div>

    <form class="mb-3"
          method="GET">
        <input name="q"
               value="{{ $q }}"
               placeholder="Search vendor or TIN"
               class="w-full rounded border px-3 py-2 md:w-80" />
    </form>

    <div class="overflow-x-auto rounded border bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="border-b px-3 py-2">Name</th>
                    <th class="border-b px-3 py-2">TIN</th>
                    <th class="border-b px-3 py-2">Bank</th>
                    <th class="border-b px-3 py-2">Account</th>
                    <th class="border-b px-3 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td class="border-b px-3 py-2">{{ $item->name }}</td>
                        <td class="border-b px-3 py-2">{{ $item->tin }}</td>
                        <td class="border-b px-3 py-2">{{ $item->bank_name }}</td>
                        <td class="border-b px-3 py-2">{{ $item->account_number }}</td>
                        <td class="border-b px-3 py-2 text-right">
                            <a class="mr-2 text-emerald-700"
                               href="{{ route('vendors.edit', $item) }}">Edit</a>
                            <form action="{{ route('vendors.destroy', $item) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Delete vendor?')">
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
