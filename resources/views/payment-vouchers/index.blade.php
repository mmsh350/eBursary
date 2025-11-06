@extends('layouts.poly', ['title' => 'Payment Vouchers'])

@section('content')
    <div class="mb-3 flex justify-between">
        <h2 class="text-lg font-semibold">Payment Vouchers</h2>
        <a href="{{ route('payment-vouchers.create') }}"
           class="rounded bg-emerald-700 px-3 py-2 text-sm text-white">
            + New Voucher
        </a>
    </div>

    <div class="overflow-x-auto rounded border bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="border-b px-3 py-2">PV Number</th>
                    <th class="border-b px-3 py-2">Request By</th>
                    <th class="border-b px-3 py-2">Vendor</th>
                    <th class="border-b px-3 py-2">Amount</th>
                    <th class="border-b px-3 py-2">Status</th>
                    <th class="border-b px-3 py-2">Date</th>
                    <th class="border-b px-3 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $v)
                    <tr>
                        <td class="border-b px-3 py-2">{{ $v->pv_number }}</td>
                        <td class="border-b px-3 py-2">{{ $v->request->user->name }}</td>
                        <td class="border-b px-3 py-2">{{ $v->vendor->name }}</td>
                        <td class="border-b px-3 py-2">₦{{ number_format($v->amount, 2) }}</td>
                        <td class="border-b px-3 py-2">
                            <span
                                  class="{{ $v->status == 'paid'
                                      ? 'bg-emerald-100 text-emerald-700'
                                      : ($v->status == 'cancelled'
                                          ? 'bg-red-100 text-red-700'
                                          : 'bg-yellow-100 text-yellow-800') }} rounded px-2 py-1 text-xs">
                                {{ ucfirst($v->status) }}
                            </span>
                        </td>
                        <td class="border-b px-3 py-2">{{ $v->payment_date ?? '-' }}</td>
                        <td class="border-b px-3 py-2 text-right">
                            @if ($v->status == 'pending')
                                <form action="{{ route('payment-vouchers.paid', $v) }}"
                                      method="POST">
                                    @csrf
                                    <button class="text-emerald-700">Mark Paid</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $items->links() }}</div>
@endsection
