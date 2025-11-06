@extends('layouts.poly', ['title' => 'Edit User'])

@section('content')
    <form method="POST"
          action="{{ route('users.update', $user) }}"
          class="max-w-xl rounded border bg-white p-4">
        @csrf @method('PUT')

        <label class="block text-sm text-slate-600">Name</label>
        <input name="name"
               value="{{ old('name', $user->name) }}"
               class="w-full rounded border px-3 py-2"
               required>

        <label class="mt-2 block text-sm text-slate-600">Email</label>
        <input name="email"
               value="{{ old('email', $user->email) }}"
               class="w-full rounded border px-3 py-2"
               required>

        <label class="mt-2 block text-sm text-slate-600">Department</label>
        <select name="department_id"
                class="w-full rounded border px-3 py-2">
            <option value="">-- None --</option>
            @foreach ($departments as $d)
                <option value="{{ $d->id }}"
                        @selected($user->department_id == $d->id)>{{ $d->name }}</option>
            @endforeach
        </select>

        <label class="mt-2 block text-sm text-slate-600">Unit</label>
        <select name="unit_id"
                class="w-full rounded border px-3 py-2">
            <option value="">-- None --</option>
            @foreach ($units as $u)
                <option value="{{ $u->id }}"
                        @selected($user->unit_id == $u->id)>{{ $u->name }}</option>
            @endforeach
        </select>

        <label class="mt-2 block text-sm text-slate-600">Status</label>
        <select name="is_active"
                class="w-full rounded border px-3 py-2">
            <option value="1"
                    @selected($user->is_active)>Active</option>
            <option value="0"
                    @selected(!$user->is_active)>Inactive</option>
        </select>

        <div class="mt-4 flex gap-2">
            <button class="rounded bg-emerald-700 px-4 py-2 text-white">Save</button>
            <a href="{{ route('users.index') }}"
               class="rounded border px-4 py-2">Back</a>
        </div>
    </form>
@endsection
