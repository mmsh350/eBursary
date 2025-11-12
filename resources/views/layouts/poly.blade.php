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
                        bursary: {
                            50: '#eaf1ff',
                            100: '#d3e2ff',
                            200: '#a8c4ff',
                            500: '#1d4ed8',
                            600: '#153eaa',
                            700: '#0b2e7a',
                            800: '#072261',
                            900: '#04184d',
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
        <aside class="from-bursary-900 to-bursary-700 fixed inset-y-0 left-0 z-40 flex w-64 transform flex-col border-r bg-gradient-to-b text-white shadow-lg transition-transform duration-300 ease-in-out md:translate-x-0"
               :class="{ '-translate-x-full': !sidebarOpen }">

            {{-- Sidebar Header --}}
            <div class="border-bursary-700 flex flex-shrink-0 items-center justify-between border-b px-5 py-4">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('assets/images/nictm_logo2.png') }}"
                         alt="Logo"
                         class="h-15 w-10 rounded border border-white/30">
                    <span class="text-lg font-bold">E-Bursary</span>
                </div>
                <button @click="sidebarOpen = false"
                        class="text-xl text-gray-200 md:hidden">✕</button>
            </div>

            {{-- Scrollable Navigation --}}
            <nav class="flex-1 overflow-y-auto p-4 text-sm">
                <a href="{{ route('dashboard') }}"
                   class="{{ request()->is('dashboard') ? 'bg-bursary-800 text-white font-semibold' : 'text-gray-200 hover:bg-bursary-800 hover:text-white' }} mb-1 block rounded-md px-3 py-2 transition">
                    Dashboard
                </a>

                {{-- Rector --}}
                @role('rector')
                    <p class="mb-1 mt-4 text-xs font-semibold uppercase tracking-wide text-gray-300">Rector</p>
                    <a href="/reports"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">Reports &
                        Analytics</a>
                @endrole

                {{-- Bursar / Deputy Bursar --}}
                @hasanyrole('bursar|deputy_bursar')
                    <p class="mb-1 mt-4 text-xs font-semibold uppercase tracking-wide text-gray-300">Approvals</p>
                    <a href="/expenditures"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">Approve
                        Expenditures</a>
                    <a href="/payment-vouchers"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">Payment
                        Vouchers</a>
                @endhasanyrole

                {{-- Accountant --}}
                @role('accountant')
                    <p class="mb-1 mt-4 text-xs font-semibold uppercase tracking-wide text-gray-300">Accounting</p>
                    <a href="/revenues"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">Revenues</a>
                    <a href="/receipts"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">Receipts</a>
                @endrole

                {{-- Cashier --}}
                @role('cashier')
                    <p class="mb-1 mt-4 text-xs font-semibold uppercase tracking-wide text-gray-300">Cash Office</p>
                    <a href="/cashbook"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">Cash Book</a>
                @endrole

                {{-- Auditor --}}
                @role('auditor')
                    <p class="mb-1 mt-4 text-xs font-semibold uppercase tracking-wide text-gray-300">Audit</p>
                    <a href="/audit-logs"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">Audit Logs</a>
                @endrole

                {{-- Dept Officer --}}
                @role('dept_officer')
                    <p class="mb-1 mt-4 text-xs font-semibold uppercase tracking-wide text-gray-300">Department</p>
                    <a href="/expenditures"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">Submit
                        Expenditure Request</a>
                @endrole

                {{-- Admin --}}
                @role('admin')
                    <p class="mb-1 mt-4 text-xs font-semibold uppercase tracking-wide text-gray-300">Administration</p>
                    <a href="/users"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">Users</a>
                    <a href="/departments"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">Departments</a>
                    <a href="/units"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">Units</a>
                    <a href="/vendors"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">Vendors</a>
                    <a href="{{ route('users.manage') }}"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">User
                        Management</a>
                @endrole

                {{-- Shared --}}
                @hasanyrole('admin|bursar|deputy_bursar')
                    <p class="mb-1 mt-4 text-xs font-semibold uppercase tracking-wide text-gray-300">Financial Control</p>
                    <a href="/revenues"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">Revenues</a>
                    <a href="/revenue-sources"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">Revenue
                        Sources</a>
                    <a href="/budgets"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">Budgets</a>
                    <a href="/budget-heads"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">Budget Heads</a>
                    <a href="/receipts"
                       class="hover:bg-bursary-800 block rounded-md px-3 py-2 transition hover:text-white">Receipts</a>
                @endhasanyrole
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="flex flex-1 flex-col md:pl-64">

            {{-- Topbar --}}
            <header
                    class="sticky top-0 z-30 flex items-center justify-between border-b bg-white/80 px-5 py-3 backdrop-blur">
                <button @click="sidebarOpen = !sidebarOpen"
                        class="text-bursary-700 text-2xl md:hidden">☰</button>
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
                                class="bg-bursary-700 hover:bg-bursary-600 rounded-md px-3 py-1.5 text-sm font-medium text-white transition">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 overflow-y-auto p-6">
                @if (session('ok'))
                    <div class="border-bursary-200 bg-bursary-50 text-bursary-800 mb-4 rounded-md border p-3 text-sm">
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
