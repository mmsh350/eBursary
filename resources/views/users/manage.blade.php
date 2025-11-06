@extends('layouts.poly', ['title' => 'User Management'])

@section('content')
    <h2 class="mb-4 text-lg font-semibold">User Management</h2>

    @if (session('ok'))
        <div class="mb-3 rounded border border-emerald-300 bg-emerald-100 p-2 text-emerald-800">
            {{ session('ok') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded border bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="border-b px-3 py-2 text-left">Name</th>
                    <th class="border-b px-3 py-2 text-left">Email</th>
                    <th class="border-b px-3 py-2 text-left">Role</th>
                    <th class="border-b px-3 py-2 text-center">Status</th>
                    <th class="border-b px-3 py-2 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border-b px-3 py-2">{{ $user->name }}</td>
                        <td class="border-b px-3 py-2">{{ $user->email }}</td>

                        <td class="border-b px-3 py-2">
                            <form method="POST"
                                  action="{{ route('users.updateRole', $user) }}">
                                @csrf
                                <select name="role"
                                        onchange="this.form.submit()"
                                        class="rounded border px-2 py-1 text-sm">
                                    <option value="">-- none --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                                {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>

                        <td class="border-b px-3 py-2 text-center">
                            @if ($user->is_active)
                                <span class="rounded bg-emerald-100 px-2 py-1 text-xs text-emerald-700">Active</span>
                            @else
                                <span class="rounded bg-red-100 px-2 py-1 text-xs text-red-700">Inactive</span>
                            @endif
                        </td>

                        <td class="space-x-1 border-b px-3 py-2 text-right">
                            <form method="POST"
                                  action="{{ route('users.toggle', $user) }}"
                                  class="inline">
                                @csrf
                                <button
                                        class="{{ $user->is_active ? 'text-red-700' : 'text-emerald-700' }} rounded border px-2 py-1 text-xs">
                                    {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>

                            <form method="POST"
                                  action="{{ route('users.reset', $user) }}"
                                  class="inline">
                                @csrf
                                <button class="rounded border px-2 py-1 text-xs text-blue-700">Reset</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $users->links() }}</div>
@endsection
