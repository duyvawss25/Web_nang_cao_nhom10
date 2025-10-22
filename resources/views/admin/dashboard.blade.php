@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Admin Dashboard</h1>

    {{-- ====== Nút điều hướng nhanh ====== --}}
    <div class="mb-4">
        <a href="{{ route('admin.flights.index') }}" class="btn btn-primary me-2">
            ✈️ Quản lý chuyến bay
        </a>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-success me-2">
            📘 Quản lý đặt vé
        </a>
        {{-- Nếu sau này có thêm quản lý người dùng, thêm ở đây --}}
        {{-- <a href="{{ route('admin.users.index') }}" class="btn btn-warning">👤 Quản lý người dùng</a> --}}
    </div>

    {{-- ====== Thống kê tổng quan ====== --}}
    <div class="row">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h4>{{ $stats['totalFlights'] ?? 0 }}</h4>
                    <p>Flights</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h4>{{ $stats['totalBookings'] ?? 0 }}</h4>
                    <p>Bookings</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h4>{{ $stats['totalPayments'] ?? 0 }}</h4>
                    <p>Total Payments</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h4>{{ $stats['totalUsers'] ?? 0 }}</h4>
                    <p>Users</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ====== Danh sách đặt vé gần đây ====== --}}
    <h3 class="mt-5">Recent Bookings</h3>
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Flight</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentBookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->user->name ?? 'N/A' }}</td>
                    <td>{{ $booking->flight->flight_number ?? 'N/A' }}</td>
                    <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Chưa có đặt vé nào gần đây</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
