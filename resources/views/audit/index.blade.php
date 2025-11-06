@extends('layouts.poly', ['title' => 'Audit Logs'])

@section('content')
    <h2 class="mb-3 text-lg font-semibold">Audit Trail</h2>

    <div class="overflow-x-auto rounded border bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="border-b px-3 py-2">User</th>
                    <th class="border-b px-3 py-2">Action</th>
                    <th class="border-b px-3 py-2">Model</th>
                    <th class="border-b px-3 py-2">Model ID</th>
                    <th class="border-b px-3 py-2">Details</th>
                    <th class="border-b px-3 py-2">IP</th>
                    <th class="border-b px-3 py-2">Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $log)
                    <tr>
                        <td class="border-b px-3 py-2">{{ $log->user->name ?? 'System' }}</td>
                        <td class="border-b px-3 py-2">{{ $log->action }}</td>
                        <td class="border-b px-3 py-2">{{ $log->model }}</td>
                        <td class="border-b px-3 py-2">{{ $log->model_id }}</td>
                        <td class="border-b px-3 py-2">{{ Str::limit($log->details, 60) }}</td>
                        <td class="border-b px-3 py-2">{{ $log->ip }}</td>
                        <td class="border-b px-3 py-2">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $items->links() }}</div>
@endsection
