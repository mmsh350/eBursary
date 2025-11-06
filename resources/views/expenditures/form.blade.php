@extends('layouts.poly', ['title' => 'New Expenditure Request'])

@section('content')
    <form method="POST"
          enctype="multipart/form-data"
          action="{{ route('expenditures.store') }}"
          class="max-w-xl rounded border bg-white p-4">
        @csrf

        <label class="text-sm">Department</label>
        <select name="department_id"
                class="w-full rounded border px-3 py-2"
                required>
            @foreach ($departments as $d)
                <option value="{{ $d->id }}">{{ $d->name }}</option>
            @endforeach
        </select>

        <label class="mt-2 text-sm">Unit</label>
        <select name="unit_id"
                class="w-full rounded border px-3 py-2">
            <option value="">-- None --</option>
            @foreach ($units as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>
            @endforeach
        </select>

        <label class="mt-2 text-sm">Budget Head</label>
        <select name="budget_head_id"
                class="w-full rounded border px-3 py-2"
                required>
            @foreach ($heads as $h)
                <option value="{{ $h->id }}">
                    {{ $h->budget->department->name }} - {{ $h->name }} ({{ $h->budget->year }})
                </option>
            @endforeach
        </select>

        <label class="mt-2 text-sm">Amount (₦)</label>
        <input type="number"
               step="0.01"
               name="amount"
               class="w-full rounded border px-3 py-2"
               required>

        <label class="mt-2 text-sm">Purpose</label>
        <textarea name="purpose"
                  rows="3"
                  class="w-full rounded border px-3 py-2"
                  required></textarea>

        <label class="mt-2 text-sm">Supporting Document (PDF/JPG) - optional</label>
        <input type="file"
               name="supporting_file"
               class="w-full rounded border px-3 py-2">

        <div class="mt-4 flex gap-2">
            <button class="rounded bg-emerald-700 px-4 py-2 text-white">Submit</button>
            <a href="{{ route('expenditures.index') }}"
               class="rounded border px-4 py-2">Cancel</a>
        </div>
    </form>
@endsection
