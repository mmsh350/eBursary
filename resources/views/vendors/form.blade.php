@extends('layouts.poly', ['title' => isset($item) ? 'Edit Vendor' : 'New Vendor'])

@section('content')
    <form method="POST"
          action="{{ isset($item) ? route('vendors.update', $item) : route('vendors.store') }}"
          class="max-w-xl rounded border bg-white p-4">
        @csrf @if (isset($item))
            @method('PUT')
        @endif

        <label class="block text-sm text-slate-600">Vendor Name</label>
        <input name="name"
               value="{{ old('name', $item->name ?? '') }}"
               class="w-full rounded border px-3 py-2"
               required>

        <label class="mt-2 block text-sm text-slate-600">TIN (Tax ID)</label>
        <input name="tin"
               value="{{ old('tin', $item->tin ?? '') }}"
               class="w-full rounded border px-3 py-2">

        <label class="mt-2 block text-sm text-slate-600">Bank Name</label>
        <input name="bank_name"
               value="{{ old('bank_name', $item->bank_name ?? '') }}"
               class="w-full rounded border px-3 py-2">

        <label class="mt-2 block text-sm text-slate-600">Account Number</label>
        <input name="account_number"
               value="{{ old('account_number', $item->account_number ?? '') }}"
               class="w-full rounded border px-3 py-2">

        <div class="mt-4 flex gap-2">
            <button class="rounded bg-emerald-700 px-4 py-2 text-white">{{ isset($item) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('vendors.index') }}"
               class="rounded border px-4 py-2">Cancel</a>
        </div>
    </form>
@endsection
