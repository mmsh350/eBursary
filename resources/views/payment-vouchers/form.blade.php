@extends('layouts.poly', ['title' => 'New Payment Voucher'])

@section('content')
    <form method="POST"
          action="{{ route('payment-vouchers.store') }}"
          class="max-w-xl rounded border bg-white p-4">
        @csrf

        <label class="text-sm">Approved Request</label>
        <select name="expenditure_request_id"
                class="w-full rounded border px-3 py-2"
                required>
            @foreach ($approvedRequests as $r)
                <option value="{{ $r->id }}">
                    {{ $r->user->name }} — ₦{{ number_format($r->amount, 2) }}
                </option>
            @endforeach
        </select>

        <label class="mt-2 text-sm">Vendor</label>
        <select name="vendor_id"
                class="w-full rounded border px-3 py-2"
                required>
            @foreach ($vendors as $v)
                <option value="{{ $v->id }}">{{ $v->name }}</option>
            @endforeach
        </select>

        <label class="mt-2 text-sm">PV Number</label>
        <input name="pv_number"
               class="w-full rounded border px-3 py-2"
               required>

        <label class="mt-2 text-sm">Payment Date (optional)</label>
        <input type="date"
               name="payment_date"
               class="w-full rounded border px-3 py-2">

        <div class="mt-4 flex gap-2">
            <button class="rounded bg-emerald-700 px-4 py-2 text-white">Save</button>
            <a href="{{ route('payment-vouchers.index') }}"
               class="rounded border px-4 py-2">Cancel</a>
        </div>
    </form>
@endsection
