<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') . ' — eBursary' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
            defer></script>

    <style>
        .menu-link {
            display: block;
            padding: 10px 12px;
            border-radius: 6px;
            font-size: 14px;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .menu-link:hover,
        .menu-link.active {
            background-color: #d1fae5;
            color: #065f46;
            font-weight: 500;
        }

        .section-title {
            margin-top: 1rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #64748b;
            font-weight: 600;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased"
      x-data="{ open: false }">
    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="fixed inset-y-0 left-0 z-40 w-64 transform border-r bg-white p-4 transition-transform duration-200 md:relative md:translate-x-0"
               :class="open ? 'translate-x-0' : '-translate-x-full'">

            {{-- Logo + Title --}}
            <div class="mb-6 flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <img src="/logo.png"
                         class="h-10 w-10 rounded border">
                    <span class="text-lg font-bold text-emerald-800">e-Bursary</span>
                </div>
                <button @click="open = false"
                        class="text-slate-600 md:hidden">✕</button>
            </div>

            <a href="{{ route('dashboard') }}"
               class="menu-link {{ request()->is('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>

            {{-- Rector --}}
            @role('rector')
                <div class="section-title">Rector</div>
                <a href="/reports"
                   class="menu-link">Reports & Analytics</a>
            @endrole

            {{-- Bursar + Deputy Bursar --}}
            @hasanyrole('bursar|deputy_bursar')
                <div class="section-title">Approvals</div>
                <a href="/expenditures"
                   class="menu-link">Approve Expenditures</a>
                <a href="/payment-vouchers"
                   class="menu-link">Payment Vouchers</a>
            @endhasanyrole

            {{-- Accountant --}}
            @role('accountant')
                <div class="section-title">Accounting</div>
                <a href="/revenues"
                   class="menu-link">Revenues</a>
                <a href="/receipts"
                   class="menu-link">Receipts</a>
            @endrole

            {{-- Cashier --}}
            @role('cashier')
                <div class="section-title">Cash Office</div>
                <a href="/cashbook"
                   class="menu-link">Cash Book</a>
            @endrole

            {{-- Auditor --}}
            @role('auditor')
                <div class="section-title">Audit</div>
                <a href="/audit-logs"
                   class="menu-link">Audit Logs</a>
            @endrole

            {{-- Dept Officer --}}
            @role('dept_officer')
                <div class="section-title">Department</div>
                <a href="/expenditures"
                   class="menu-link">Submit Expenditure Request</a>
            @endrole

            {{-- Admin --}}
            @role('admin')
                <div class="section-title">Administration</div>
                <a href="/users"
                   class="menu-link">Users</a>
                <a href="/departments"
                   class="menu-link">Departments</a>
                <a href="/units"
                   class="menu-link">Units</a>
                <a href="/vendors"
                   class="menu-link">Vendors</a>
                <a href="{{ route('users.manage') }}"
                   class="menu-link">User Management</a>
            @endrole

            {{-- Shared: Admin + Bursar + Deputy Bursar --}}
            @hasanyrole('admin|bursar|deputy_bursar')
                <div class="section-title">Financial Control</div>
                <a href="/revenues"
                   class="menu-link">Revenues</a>
                <a href="/revenue-sources"
                   class="menu-link">Revenue Sources</a>
                <a href="/budgets"
                   class="menu-link">Budgets</a>
                <a href="/budget-heads"
                   class="menu-link">Budget Heads</a>
                <a href="/receipts"
                   class="menu-link">Receipts</a>
            @endhasanyrole
        </aside>

        {{-- Main --}}
        <div class="flex flex-1 flex-col md:ml-64">
            {{-- Topbar --}}
            <header class="flex h-14 items-center justify-between border-b border-slate-200 bg-white px-4">
                <button @click="open = !open"
                        class="text-xl font-bold text-emerald-700 md:hidden">☰</button>

                <div class="truncate font-semibold">{{ $title ?? '' }}</div>

                <div class="flex items-center gap-3">
                    <span class="hidden text-sm text-slate-600 sm:block">
                        {{ auth()->user()->name ?? '' }}
                        @if (auth()->check() && auth()->user()->roles->first())
                            <small class="text-slate-400">
                                ({{ ucfirst(str_replace('_', ' ', auth()->user()->roles->first()->name)) }})
                            </small>
                        @endif
                        @if (auth()->check() && !auth()->user()->is_active)
                            <span class="ml-1 text-xs text-red-600">(Inactive)</span>
                        @endif
                    </span>
                    <form method="POST"
                          action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded bg-emerald-700 px-3 py-1.5 text-sm text-white hover:bg-emerald-800">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 overflow-y-auto p-4">
                @if (session('ok'))
                    <div class="mb-3 rounded border border-emerald-200 bg-emerald-100 p-2 text-emerald-800">
                        {{ session('ok') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-3 rounded border border-red-200 bg-red-100 p-2 text-red-800">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{ $slot ?? '' }}
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
