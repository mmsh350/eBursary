@extends('layouts.poly', ['title' => isset($item) ? 'Edit Source' : 'New Revenue Source'])

@section('content')
    <form method="POST"
          action="{{ isset($item) ? route('revenue-sources.update', $item) : route('revenue-sources.store') }}"
          class="max-w-xl rounded border bg-white p-4">
        @csrf
        @if (isset($item))
            @method('PUT')
        @endif

        <label class="block text-sm text-slate-600">Name</label>
        <input name="name"
               value="{{ old('name', $item->name ?? '') }}"
               required
               class="w-full rounded border px-3 py-2">

        <label class="mt-2 block text-sm text-slate-600">Description</label>
        <textarea name="description"
                  rows="3"
                  class="w-full rounded border px-3 py-2">{{ old('description', $item->description ?? '') }}</textarea>

        <div class="mt-4 flex gap-2">
            <button class="rounded bg-emerald-700 px-4 py-2 text-white">
                {{ isset($item) ? 'Update' : 'Create' }}
            </button>
            <a href="{{ route('revenue-sources.index') }}"
               class="rounded border px-4 py-2">Cancel</a>
        </div>
    </form>
@endsection
