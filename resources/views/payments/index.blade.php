@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #4F46E5;
        --success: #10B981;
        --warning: #F59E0B;
        --danger: #EF4444;
        --dark: #1F2937;
    }

    body {
        background: 
            linear-gradient(135deg, rgba(16, 185, 129, 0.9) 0%, rgba(5, 150, 105, 0.9) 100%),
            url('https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=1920&q=80') center/cover fixed;
        min-height: 100vh;
        font-family: 'Inter', 'Segoe UI', sans-serif;
        padding: 40px 20px;
    }

    .payments-wrapper {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Header */
    .page-header {
        text-align: center;
        margin-bottom: 40px;
        animation: fadeInDown 0.8s ease;
    }

    .page-title {
        font-size: 3rem;
        font-weight: 800;
        color: white;
        text-shadow: 0 4px 20px rgba(0,0,0,0.4);
        margin-bottom: 10px;
    }

    .page-subtitle {
        color: rgba(255,255,255,0.9);
        font-size: 1.2rem;
    }

    /* Alerts */
    .alert-custom {
        background: white;
        border-radius: 15px;
        padding: 20px 25px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        gap: 15px;
        animation: slideInRight 0.5s ease;
    }

    .alert-success-custom {
        border-left: 5px solid var(--success);
    }

    .alert-danger-custom {
        border-left: 5px solid var(--danger);
    }

    .alert-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
        flex-shrink: 0;
    }

    .alert-success-custom .alert-icon {
        background: var(--success);
    }

    .alert-danger-custom .alert-icon {
        background: var(--danger);
    }

    /* Empty State */
    .empty-state {
        background: white;
        border-radius: 25px;
        padding: 80px 40px;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        animation: fadeInUp 0.8s ease;
    }

    .empty-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 30px;
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 50px;
        color: white;
        box-shadow: 0 15px 40px rgba(16, 185, 129, 0.4);
    }

    .empty-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 15px;
    }

    .empty-text {
        color: #6B7280;
        font-size: 1.1rem;
        margin-bottom: 30px;
    }

    /* Table Container */
    .table-container {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        animation: fadeInUp 0.8s ease;
    }

    .table-header {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        padding: 25px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-title {
        color: white;
        font-size: 1.5rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .table-count {
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        padding: 6px 15px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* Table */
    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .custom-table thead {
        background: #F9FAFB;
    }

    .custom-table th {
        padding: 20px 15px;
        text-align: left;
        font-size: 0.85rem;
        font-weight: 700;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #E5E7EB;
    }

    .custom-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #F3F4F6;
    }

    .custom-table tbody tr:hover {
        background: linear-gradient(135deg, #F0FDF4 0%, #DCFCE7 100%);
        transform: scale(1.01);
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .custom-table td {
        padding: 20px 15px;
        color: var(--dark);
        font-weight: 500;
    }

    /* Index Column */
    .index-cell {
        width: 60px;
        text-align: center;
        font-weight: 700;
        color: #6B7280;
    }

    /* Booking Code */
    .booking-code {
        font-family: 'Courier New', monospace;
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
        color: var(--primary);
        display: inline-block;
    }

    /* Flight Info */
    .flight-info {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
    }

    /* Amount */
    .amount-cell {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--success);
    }

    /* Status Badge */
    .status-badge {
        padding: 6px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .status-completed {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
    }

    .status-pending {
        background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
        color: white;
    }

    .status-failed {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
        color: white;
    }

    /* Action Button */
    .action-btn {
        padding: 8px 20px;
        background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
        color: white;
    }

    /* Bottom Actions */
    .bottom-actions {
        padding: 30px;
        background: #F9FAFB;
        text-align: center;
        border-top: 2px solid #E5E7EB;
    }

    .btn-custom {
        padding: 15px 35px;
        border: none;
        border-radius: 15px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
    }

    .btn-primary-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(16, 185, 129, 0.6);
        color: white;
    }

    .btn-secondary-custom {
        background: white;
        color: var(--dark);
        border: 2px solid #E5E7EB;
    }

    .btn-secondary-custom:hover {
        background: #F9FAFB;
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        color: var(--dark);
    }

    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .table-container {
            overflow-x: auto;
        }

        .custom-table {
            min-width: 800px;
        }

        .custom-table th,
        .custom-table td {
            padding: 12px 10px;
            font-size: 0.85rem;
        }
    }
</style>

<div class="payments-wrapper">
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">💳 Lịch Sử Thanh Toán</h1>
        <p class="page-subtitle">Quản lý tất cả giao dịch của bạn</p>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert-custom alert-success-custom">
            <div class="alert-icon">✓</div>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <!-- Error Alert -->
    @if(session('error'))
        <div class="alert-custom alert-danger-custom">
            <div class="alert-icon">✕</div>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    <!-- Empty State -->
    @if($payments->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">💳</div>
            <h2 class="empty-title">Chưa có giao dịch nào</h2>
            <p class="empty-text">Bạn chưa thực hiện thanh toán nào. Hãy đặt vé để bắt đầu hành trình!</p>
            <a href="{{ route('flights.index') }}" class="btn-custom btn-primary-custom">
                <span>🛫</span>
                Đặt chuyến bay ngay
            </a>
        </div>
    @else
        <!-- Table Container -->
        <div class="table-container">
            <!-- Table Header -->
            <div class="table-header">
                <div class="table-title">
                    <span>📊</span>
                    Danh sách giao dịch
                </div>
                <div class="table-count">
                    {{ $payments->count() }} giao dịch
                </div>
            </div>

            <!-- Table -->
            <table class="custom-table">
                <thead>
                    <tr>
                        <th class="index-cell">#</th>
                        <th>Mã đặt vé</th>
                        <th>Chuyến bay</th>
                        <th>Số ghế</th>
                        <th>Số tiền</th>
                        <th>Trạng thái</th>
                        <th>Thời gian</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $index => $payment)
                        <tr>
                            <td class="index-cell">{{ $index + 1 }}</td>
                            <td>
                                <span class="booking-code">
                                    #{{ $payment->booking->id ?? '—' }}
                                </span>
                            </td>
                            <td>
                                <div class="flight-info">
                                    <span>✈️</span>
                                    {{ $payment->booking->flight->code ?? 'Không xác định' }}
                                </div>
                            </td>
                            <td>
                                <strong>{{ $payment->booking->seat_number ?? '—' }}</strong>
                            </td>
                            <td class="amount-cell">
                                ${{ number_format($payment->amount, 2) }}
                            </td>
                            <td>
                                @if($payment->status === 'completed')
                                    <span class="status-badge status-completed">
                                        ✓ Đã thanh toán
                                    </span>
                                @elseif($payment->status === 'pending')
                                    <span class="status-badge status-pending">
                                        ⏳ Đang chờ
                                    </span>
                                @else
                                    <span class="status-badge status-failed">
                                        ✕ {{ ucfirst($payment->status) }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div style="font-size: 0.9rem; color: #6B7280;">
                                    📅 {{ $payment->created_at->format('d/m/Y') }}<br>
                                    🕐 {{ $payment->created_at->format('H:i') }}
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('bookings.show', $payment->booking->id) }}" class="action-btn">
                                    <span>👁️</span>
                                    Xem vé
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Bottom Actions -->
            <div class="bottom-actions">
                <a href="{{ route('bookings.index') }}" class="btn-custom btn-secondary-custom">
                    <span>←</span>
                    Quay lại danh sách đặt vé
                </a>
            </div>
        </div>
    @endif
</div>

@endsection