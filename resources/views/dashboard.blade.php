@extends('layouts.poly', ['title' => 'Dashboard'])

@section('content')
    <h2 class="mb-4 text-xl font-bold">Dashboard</h2>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        <div class="rounded border bg-white p-4">
            <div class="text-xs text-slate-500">Total Revenue</div>
            <div class="text-lg font-semibold">₦{{ number_format($totalRevenue, 2) }}</div>
        </div>

        <div class="rounded border bg-white p-4">
            <div class="text-xs text-slate-500">Total Receipts</div>
            <div class="text-lg font-semibold">₦{{ number_format($totalReceipts, 2) }}</div>
        </div>

        <div class="rounded border bg-white p-4">
            <div class="text-xs text-slate-500">Total Budget</div>
            <div class="text-lg font-semibold">₦{{ number_format($totalBudget, 2) }}</div>
        </div>

        <div class="rounded border bg-white p-4">
            <div class="text-xs text-slate-500">Approved Expenses</div>
            <div class="text-lg font-semibold">₦{{ number_format($approvedExpenses, 2) }}</div>
        </div>

        <div class="rounded border bg-white p-4">
            <div class="text-xs text-slate-500">Paid Vouchers</div>
            <div class="text-lg font-semibold">₦{{ number_format($paidVouchers, 2) }}</div>
        </div>

        <div class="rounded border bg-white p-4">
            <div class="text-xs text-slate-500">Remaining Budget</div>
            <div class="text-lg font-bold text-emerald-700">
                ₦{{ number_format($budgetBalance, 2) }}
            </div>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2">

        <div class="rounded border bg-white p-4">
            <h3 class="mb-2 text-sm font-semibold">Revenue by Source</h3>
            <canvas id="revChart"
                    height="140"></canvas>
        </div>

        <div class="rounded border bg-white p-4">
            <h3 class="mb-2 text-sm font-semibold">Expenses by Head</h3>
            <canvas id="expChart"
                    height="140"></canvas>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const revCtx = document.getElementById('revChart');
        new Chart(revCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($revenueBySource->pluck('source.name')) !!},
                datasets: [{
                    data: {!! json_encode($revenueBySource->pluck('total')) !!},
                    borderWidth: 1
                }]
            },
        });

        const expCtx = document.getElementById('expChart');
        new Chart(expCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($expenseByHead->pluck('budgetHead.name')) !!},
                datasets: [{
                    data: {!! json_encode($expenseByHead->pluck('total')) !!},
                    borderWidth: 1
                }]
            },
        });
    </script>
@endsection
