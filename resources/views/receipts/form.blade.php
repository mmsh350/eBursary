@extends('layouts.poly', ['title' => 'New Receipt'])

@section('content')
    <form method="POST"
          enctype="multipart/form-data"
          action="{{ route('receipts.store') }}"
          class="max-w-xl rounded border bg-white p-4">
        @csrf

        <label class="text-sm">Revenue Source</label>
        <select name="revenue_source_id"
                class="w-full rounded border px-3 py-2"
                required>
            @foreach ($sources as $s)
                <option value="{{ $s->id }}">{{ $s->name }}</option>
            @endforeach
        </select>

        <label class="mt-2 text-sm">Amount (₦)</label>
        <input type="number"
               step="0.01"
               name="amount"
               class="w-full rounded border px-3 py-2"
               required>

        <label class="mt-2 text-sm">Reference</label>
        <input name="reference"
               class="w-full rounded border px-3 py-2"
               required>

        <label class="mt-2 text-sm">Receipt Date</label>
        <input type="date"
               name="receipt_date"
               value="{{ date('Y-m-d') }}"
               class="w-full rounded border px-3 py-2"
               required>

        <label class="mt-2 text-sm">Receipt File (optional)</label>
        <input type="file"
               name="file"
               class="w-full rounded border px-3 py-2">

        <div class="mt-4 flex gap-2">
            <button class="rounded bg-emerald-700 px-4 py-2 text-white">Save</button>
            <a href="{{ route('receipts.index') }}"
               class="rounded border px-4 py-2">Cancel</a>
        </div>
    </form>
@endsection
