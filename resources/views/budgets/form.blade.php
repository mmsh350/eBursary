@extends('layouts.poly', ['title' => isset($item) ? 'Edit Budget' : 'New Budget'])

@section('content')
    <form method="POST"
          action="{{ isset($item) ? route('budgets.update', $item) : route('budgets.store') }}"
          class="max-w-xl rounded border bg-white p-4">
        @csrf
        @if (isset($item))
            @method('PUT')
        @endif

        <label class="block text-sm text-slate-600">Year</label>
        <input name="year"
               value="{{ old('year', $item->year ?? date('Y')) }}"
               class="w-full rounded border px-3 py-2"
               required>

        <label class="mt-2 block text-sm text-slate-600">Department</label>
        <select name="department_id"
                class="w-full rounded border px-3 py-2"
                required>
            @foreach ($departments as $d)
                <option value="{{ $d->id }}"
                        @selected(($item->department_id ?? '') == $d->id)>
                    {{ $d->name }}
                </option>
            @endforeach
        </select>

        <label class="mt-2 block text-sm text-slate-600">Total Amount (₦)</label>
        <input type="number"
               step="0.01"
               name="total_amount"
               value="{{ old('total_amount', $item->total_amount ?? '') }}"
               required
               class="w-full rounded border px-3 py-2">

        <label class="mt-2 block text-sm text-slate-600">Description</label>
        <textarea name="description"
                  rows="3"
                  class="w-full rounded border px-3 py-2">
    {{ old('description', $item->description ?? '') }}
  </textarea>

        <div class="mt-4 flex gap-2">
            <button class="rounded bg-emerald-700 px-4 py-2 text-white">
                {{ isset($item) ? 'Update' : 'Create' }}
            </button>
            <a href="{{ route('budgets.index') }}"
               class="rounded border px-4 py-2">Cancel</a>
        </div>
    </form>
@endsection
