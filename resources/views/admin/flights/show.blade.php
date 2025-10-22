{{-- resources/views/admin/flights/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-primary">Chi tiết chuyến bay: {{ $flight->flight_number }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Mã chuyến bay:</strong> {{ $flight->flight_number }}</p>
            <p><strong>Điểm đi:</strong> {{ $flight->departureAirport->name }} ({{ $flight->departureAirport->code }})</p>
            <p><strong>Điểm đến:</strong> {{ $flight->arrivalAirport->name }} ({{ $flight->arrivalAirport->code }})</p>
            <p><strong>Thời gian khởi hành:</strong> {{ \Carbon\Carbon::parse($flight->departure_time)->format('d/m/Y H:i') }}</p>
            <p><strong>Thời gian đến:</strong> {{ \Carbon\Carbon::parse($flight->arrival_time)->format('d/m/Y H:i') }}</p>
            <p><strong>Giá vé:</strong> {{ number_format($flight->price, 0, ',', '.') }} VNĐ</p>
            <p><strong>Số ghế còn lại:</strong> {{ $flight->available_seats }}</p>
            <p><strong>Ngày tạo:</strong> {{ $flight->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Ngày cập nhật:</strong> {{ $flight->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('admin.flights.index') }}" class="btn btn-secondary">
            ← Quay lại danh sách
        </a>

        <div>
            <a href="{{ route('admin.flights.edit', $flight->id) }}" class="btn btn-warning">
                ✏️ Sửa chuyến bay
            </a>

            <form action="{{ route('admin.flights.destroy', $flight->id) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa chuyến bay này không?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    🗑 Xóa chuyến bay
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
