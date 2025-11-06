@extends('layouts.poly', ['title' => isset($item) ? 'Edit Budget Head' : 'New Budget Head'])

@section('content')
    <form method="POST"
          action="{{ isset($item) ? route('budget-heads.update', $item) : route('budget-heads.store') }}"
          class="max-w-xl rounded border bg-white p-4">
        @csrf
        @if (isset($item))
            @method('PUT')
        @endif

        <label class="text-sm text-slate-600">Department Budget</label>
        <select name="budget_id"
                class="w-full rounded border px-3 py-2"
                required>
            @foreach ($budgets as $b)
                <option value="{{ $b->id }}"
                        @selected(($item->budget_id ?? '') == $b->id)>
                    {{ $b->department->name }} — {{ $b->year }}
                </option>
            @endforeach
        </select>

        <label class="mt-2 block text-sm text-slate-600">Head Name</label>
        <input name="name"
               value="{{ old('name', $item->name ?? '') }}"
               class="w-full rounded border px-3 py-2"
               required>

        <label class="mt-2 block text-sm text-slate-600">Amount (₦)</label>
        <input type="number"
               step="0.01"
               name="allocated_amount"
               value="{{ old('allocated_amount', $item->allocated_amount ?? '') }}"
               class="w-full rounded border px-3 py-2"
               required>

        <label class="mt-2 block text-sm text-slate-600">Description</label>
        <textarea name="description"
                  rows="3"
                  class="w-full rounded border px-3 py-2">{{ old('description', $item->description ?? '') }}</textarea>

        <div class="mt-4 flex gap-2">
            <button class="rounded bg-emerald-700 px-4 py-2 text-white">{{ isset($item) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('budget-heads.index') }}"
               class="rounded border px-4 py-2">Cancel</a>
        </div>
    </form>
@endsection
