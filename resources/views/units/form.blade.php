@extends('layouts.poly', ['title' => isset($item) ? 'Edit Unit' : 'New Unit'])

@section('content')
    <form method="POST"
          action="{{ isset($item) ? route('units.update', $item) : route('units.store') }}"
          class="max-w-xl rounded border bg-white p-4">
        @csrf
        @if (isset($item))
            @method('PUT')
        @endif

        <label class="mt-2 block text-sm text-slate-600">Department</label>
        <select name="department_id"
                class="w-full rounded border px-3 py-2"
                required>
            <option value="">-- Select Department --</option>
            @foreach ($departments as $d)
                <option value="{{ $d->id }}"
                        @selected(old('department_id', $item->department_id ?? '') == $d->id)>
                    {{ $d->name }}
                </option>
            @endforeach
        </select>

        <label class="mt-2 block text-sm text-slate-600">Unit Name</label>
        <input name="name"
               value="{{ old('name', $item->name ?? '') }}"
               class="w-full rounded border px-3 py-2"
               required>

        <label class="mt-2 block text-sm text-slate-600">Code</label>
        <input name="code"
               value="{{ old('code', $item->code ?? '') }}"
               class="w-full rounded border px-3 py-2">

        <div class="mt-4 flex gap-2">
            <button class="rounded bg-emerald-700 px-4 py-2 text-white">
                {{ isset($item) ? 'Update' : 'Create' }}
            </button>
            <a href="{{ route('units.index') }}"
               class="rounded border px-4 py-2">Cancel</a>
        </div>
    </form>
@endsection
