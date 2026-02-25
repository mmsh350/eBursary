<li>
    <a href="{{ route('dashboard') }}"
        class="{{ request()->routeIs('dashboard') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:text-white hover:bg-blue-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-blue-200 group-hover:text-white' }}"
            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
        </svg>
        Dashboard
    </a>
</li>

<li>
    <div class="text-xs font-semibold leading-6 text-blue-200 uppercase tracking-wider mt-6 mb-2">Financials</div>
</li>

<li>
    <a href="{{ route('requests.create') }}"
        class="{{ request()->routeIs('requests.create') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:text-white hover:bg-blue-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('requests.create') ? 'text-white' : 'text-blue-200 group-hover:text-white' }}"
            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        New Request
    </a>
</li>

<li>
    <a href="{{ route('requests.index') }}"
        class="{{ request()->routeIs('requests.index') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:text-white hover:bg-blue-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('requests.index') ? 'text-white' : 'text-blue-200 group-hover:text-white' }}"
            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
        </svg>
        My Requests
    </a>
</li>

@if (auth()->user()?->hasRole('rector') ||
        auth()->user()?->hasRole('audit') ||
        auth()->user()?->hasRole('bursar') ||
        auth()->user()?->hasRole('cashier'))
    <li>
        <div class="text-xs font-semibold leading-6 text-blue-200 uppercase tracking-wider mt-6 mb-2">Approvals</div>
    </li>

    <li>
        <a href="{{ route('approvals.index') }}"
            class="{{ request()->routeIs('approvals.index') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:text-white hover:bg-blue-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
            <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('approvals.index') ? 'text-white' : 'text-blue-200 group-hover:text-white' }}"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12.75L11.25 15 15 9.75M21 12c0 5.523-4.477 10-10 10S1 17.523 1 12 5.477 2 11 2s10 4.477 10 10z" />
            </svg>
            Pending Approval
            @if (isset($pendingApprovalsCount) && $pendingApprovalsCount > 0)
                <span
                    class="ml-auto w-6 min-w-max whitespace-nowrap rounded-full bg-blue-600 px-2.5 py-0.5 text-center text-xs font-medium leading-5 text-white ring-1 ring-inset ring-blue-500"
                    aria-hidden="true">{{ $pendingApprovalsCount }}</span>
            @endif
        </a>
    </li>
@endif

@if (auth()->user()?->hasRole('admin'))
    <li>
        <div class="text-xs font-semibold leading-6 text-blue-200 uppercase tracking-wider mt-6 mb-2">Administration
        </div>
    </li>

    <li>
        <a href="{{ route('users.index') }}"
            class="{{ request()->routeIs('users.index') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:text-white hover:bg-blue-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
            <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('users.index') ? 'text-white' : 'text-blue-200 group-hover:text-white' }}"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
            Manage Users
        </a>
    </li>

    <li>
        <a href="{{ route('departments.index') }}"
            class="{{ request()->routeIs('departments.index') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:text-white hover:bg-blue-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
            <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('departments.index') ? 'text-white' : 'text-blue-200 group-hover:text-white' }}"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
            </svg>
            Departments
        </a>
    </li>

    {{-- <li>
        <a href="{{ route('units.index') }}"
            class="{{ request()->routeIs('units.index') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:text-white hover:bg-blue-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
            <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('units.index') ? 'text-white' : 'text-blue-200 group-hover:text-white' }}"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
            </svg>
            Units
        </a>
    </li> --}}



    <li>
        <a href="{{ route('request-types.index') }}"
            class="{{ request()->routeIs('request-types.index') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:text-white hover:bg-blue-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
            <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('request-types.index') ? 'text-white' : 'text-blue-200 group-hover:text-white' }}"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3zM6 6h.008v.008H6V6z" />
            </svg>
            Request Types
        </a>
    </li>
@endif
