@extends('layouts.admin')

@section('title', 'Activity Logs')
@section('page-title', 'Activity Logs')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-3">Waktu</th>
                <th class="p-3">User</th>
                <th class="p-3">Aktivitas</th>
                <th class="p-3">IP</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($logs as $log)
            <tr class="border-b hover:bg-gray-100">
                <td class="p-3">{{ $log->created_at }}</td>
                <td class="p-3">{{ $log->user_id }}</td>
                <td class="p-3">{{ $log->activity }}</td>
                <td class="p-3">{{ $log->ip_address }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-5 text-center text-gray-500">
                    Tidak ada activity logs.
                </td>
            </tr>
            @endforelse

        </tbody>
    </table>

    <div class="mt-5">
        {{ $logs->links() }}
    </div>

</div>

@endsection