<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'e-Bursary') }}</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
            defer></script>

    {{-- Chart.js (optional) --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Tailwind Custom Config --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                        },
                    },
                },
            },
        };
    </script>
</head>

<body x-data="{ sidebarOpen: false }"
      class="bg-gray-50 text-gray-800 antialiased">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="fixed inset-y-0 left-0 z-40 flex w-64 transform flex-col border-r bg-white shadow-md transition-transform duration-300 ease-in-out md:translate-x-0"
               :class="{ '-translate-x-full': !sidebarOpen }">

            {{-- Sidebar Header --}}
            <div class="flex flex-shrink-0 items-center justify-between border-b px-5 py-4">
                <div class="flex items-center space-x-2">
                    <img src="/logo.png"
                         alt="Logo"
                         class="h-9 w-9 rounded border">
                    <span class="text-lg font-bold text-emerald-700">e-Bursary</span>
                </div>
                <button @click="sidebarOpen = false"
                        class="text-xl text-gray-500 md:hidden">✕</button>
            </div>

            {{-- Scrollable Navigation --}}
            <nav class="flex-1 overflow-y-auto p-4 text-sm">
                <a href="{{ route('dashboard') }}"
                   class="{{ request()->is('dashboard') ? 'bg-emerald-100 text-emerald-800 font-semibold' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700' }} mb-1 block rounded-md px-3 py-2">
                    Dashboard
                </a>

                {{-- Rector --}}
                @role('rector')
                    <p class="mb-1 mt-4 text-xs font-semibold uppercase tracking-wide text-gray-400">Rector</p>
                    <a href="/reports"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">Reports & Analytics</a>
                @endrole

                {{-- Bursar / Deputy Bursar --}}
                @hasanyrole('bursar|deputy_bursar')
                    <p class="mb-1 mt-4 text-xs font-semibold uppercase tracking-wide text-gray-400">Approvals</p>
                    <a href="/expenditures"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">Approve
                        Expenditures</a>
                    <a href="/payment-vouchers"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">Payment Vouchers</a>
                @endhasanyrole

                {{-- Accountant --}}
                @role('accountant')
                    <p class="mb-1 mt-4 text-xs font-semibold uppercase tracking-wide text-gray-400">Accounting</p>
                    <a href="/revenues"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">Revenues</a>
                    <a href="/receipts"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">Receipts</a>
                @endrole

                {{-- Cashier --}}
                @role('cashier')
                    <p class="mb-1 mt-4 text-xs font-semibold uppercase tracking-wide text-gray-400">Cash Office</p>
                    <a href="/cashbook"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">Cash Book</a>
                @endrole

                {{-- Auditor --}}
                @role('auditor')
                    <p class="mb-1 mt-4 text-xs font-semibold uppercase tracking-wide text-gray-400">Audit</p>
                    <a href="/audit-logs"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">Audit Logs</a>
                @endrole

                {{-- Dept Officer --}}
                @role('dept_officer')
                    <p class="mb-1 mt-4 text-xs font-semibold uppercase tracking-wide text-gray-400">Department</p>
                    <a href="/expenditures"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">Submit Expenditure
                        Request</a>
                @endrole

                {{-- Admin --}}
                @role('admin')
                    <p class="mb-1 mt-4 text-xs font-semibold uppercase tracking-wide text-gray-400">Administration</p>
                    <a href="/users"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">Users</a>
                    <a href="/departments"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">Departments</a>
                    <a href="/units"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">Units</a>
                    <a href="/vendors"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">Vendors</a>
                    <a href="{{ route('users.manage') }}"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">User Management</a>
                @endrole

                {{-- Shared --}}
                @hasanyrole('admin|bursar|deputy_bursar')
                    <p class="mb-1 mt-4 text-xs font-semibold uppercase tracking-wide text-gray-400">Financial Control</p>
                    <a href="/revenues"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">Revenues</a>
                    <a href="/revenue-sources"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">Revenue Sources</a>
                    <a href="/budgets"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">Budgets</a>
                    <a href="/budget-heads"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">Budget Heads</a>
                    <a href="/receipts"
                       class="block rounded-md px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">Receipts</a>
                @endhasanyrole
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="flex flex-1 flex-col md:pl-64">

            {{-- Topbar --}}
            <header
                    class="sticky top-0 z-30 flex items-center justify-between border-b bg-white/80 px-5 py-3 backdrop-blur">
                <button @click="sidebarOpen = !sidebarOpen"
                        class="text-2xl text-emerald-700 md:hidden">☰</button>
                <div class="truncate font-semibold text-gray-700">{{ $title ?? 'Dashboard' }}</div>

                <div class="flex items-center gap-3">
                    @auth
                        <div class="hidden text-sm text-gray-600 sm:block">
                            {{ auth()->user()->name }}
                            @if (auth()->user()->roles->first())
                                <small class="text-gray-400">
                                    ({{ ucfirst(str_replace('_', ' ', auth()->user()->roles->first()->name)) }})
                                </small>
                            @endif
                            @unless (auth()->user()->is_active)
                                <span class="ml-1 text-xs text-red-600">(Inactive)</span>
                            @endunless
                        </div>
                    @endauth

                    <form method="POST"
                          action="{{ route('logout') }}">
                        @csrf
                        <button
                                class="rounded-md bg-emerald-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-emerald-700">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 overflow-y-auto p-6">
                @if (session('ok'))
                    <div class="mb-4 rounded-md border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-800">
                        {{ session('ok') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 rounded-md border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{ $slot ?? '' }}
                @yield('content')

            </main>
        </div>
    </div>
    @yield('scripts')
</body>

</html>
