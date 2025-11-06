@extends('layouts.poly', ['title' => isset($item) ? 'Edit Revenue' : 'Record Revenue'])

@section('content')
    <form method="POST"
          action="{{ isset($item) ? route('revenues.update', $item) : route('revenues.store') }}"
          class="max-w-xl rounded border bg-white p-4">
        @csrf @if (isset($item))
            @method('PUT')
        @endif

        <label class="block text-sm text-slate-600">Source</label>
        <select name="revenue_source_id"
                class="w-full rounded border px-3 py-2"
                required>
            @foreach ($sources as $s)
                <option value="{{ $s->id }}"
                        @selected(($item->revenue_source_id ?? '') == $s->id)>{{ $s->name }}</option>
            @endforeach
        </select>

        <label class="mt-2 block text-sm text-slate-600">Amount (₦)</label>
        <input type="number"
               step="0.01"
               name="amount"
               value="{{ old('amount', $item->amount ?? '') }}"
               required
               class="w-full rounded border px-3 py-2">

        <label class="mt-2 block text-sm text-slate-600">Reference</label>
        <input name="reference"
               value="{{ old('reference', $item->reference ?? '') }}"
               class="w-full rounded border px-3 py-2">

        <label class="mt-2 block text-sm text-slate-600">Payment Date</label>
        <input type="date"
               name="payment_date"
               value="{{ old('payment_date', $item->payment_date ?? date('Y-m-d')) }}"
               class="w-full rounded border px-3 py-2"
               required>

        <label class="mt-2 block text-sm text-slate-600">Description</label>
        <textarea name="description"
                  rows="3"
                  class="w-full rounded border px-3 py-2">{{ old('description', $item->description ?? '') }}</textarea>

        <div class="mt-4 flex gap-2">
            <button class="rounded bg-emerald-700 px-4 py-2 text-white">
                {{ isset($item) ? 'Update' : 'Save' }}
            </button>
            <a href="{{ route('revenues.index') }}"
               class="rounded border px-4 py-2">Cancel</a>
        </div>
    </form>
@endsection
