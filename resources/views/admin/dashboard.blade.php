@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Example Card -->
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold">Total Produk</h3>
        <p class="text-4xl font-bold mt-3">{{ $totalProducts ?? 0 }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold">Activity Logs</h3>
        <p class="text-4xl font-bold mt-3">{{ $totalLogs ?? 0 }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold">Pengguna Login</h3>
        <p class="text-4xl font-bold mt-3">{{ auth()->user()->name }}</p>
    </div>

</div>
@endsection