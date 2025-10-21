@extends('layouts.app')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --gold: #D4AF37;
        --dark-gold: #B8941F;
        --platinum: #E5E4E2;
        --dark-blue: #1A1F3A;
        --navy: #0F1729;
        --silver: #C0C0C0;
    }

    body {
        background: url('https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=1920&q=80') center/cover fixed no-repeat;
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        padding: 60px 20px;
        position: relative;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(15, 23, 41, 0.88) 0%, rgba(26, 31, 58, 0.92) 100%);
        z-index: -1;
    }

    /* Animated Particles */
    .particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        pointer-events: none;
    }

    .particle {
        position: absolute;
        width: 3px;
        height: 3px;
        background: linear-gradient(135deg, var(--gold), var(--platinum));
        border-radius: 50%;
        box-shadow: 0 0 10px var(--gold);
        animation: float 25s infinite ease-in-out;
    }

    .particle:nth-child(1) { left: 5%; top: 15%; animation-delay: 0s; animation-duration: 20s; }
    .particle:nth-child(2) { left: 25%; top: 85%; animation-delay: 4s; animation-duration: 22s; }
    .particle:nth-child(3) { left: 35%; top: 35%; animation-delay: 8s; animation-duration: 24s; }
    .particle:nth-child(4) { left: 45%; top: 65%; animation-delay: 3s; animation-duration: 18s; }
    .particle:nth-child(5) { left: 55%; top: 25%; animation-delay: 6s; animation-duration: 21s; }
    .particle:nth-child(6) { left: 65%; top: 75%; animation-delay: 10s; animation-duration: 23s; }
    .particle:nth-child(7) { left: 75%; top: 45%; animation-delay: 5s; animation-duration: 19s; }
    .particle:nth-child(8) { left: 85%; top: 35%; animation-delay: 9s; animation-duration: 25s; }
    .particle:nth-child(9) { left: 95%; top: 55%; animation-delay: 2s; animation-duration: 26s; }
    .particle:nth-child(10) { left: 12%; top: 92%; animation-delay: 11s; animation-duration: 20s; }

    @keyframes float {
        0%, 100% {
            transform: translateY(0) translateX(0) scale(1);
            opacity: 0.6;
        }
        25% {
            transform: translateY(-130px) translateX(70px) scale(1.4);
            opacity: 0.9;
        }
        50% {
            transform: translateY(-220px) translateX(-50px) scale(0.9);
            opacity: 1;
        }
        75% {
            transform: translateY(-130px) translateX(-100px) scale(1.3);
            opacity: 0.8;
        }
    }

    .payments-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        perspective: 1200px;
    }

    /* Header */
    .page-header {
        text-align: center;
        margin-bottom: 50px;
        animation: fadeInDown 1s ease;
    }

    .page-title {
        font-size: 3.8rem;
        font-weight: 900;
        background: linear-gradient(135deg, var(--gold) 0%, var(--platinum) 50%, var(--gold) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 15px;
        text-shadow: 0 0 40px rgba(212, 175, 55, 0.6);
        letter-spacing: -2px;
        animation: shimmer 3s infinite;
        background-size: 200% auto;
    }

    @keyframes shimmer {
        0% {
            background-position: 0% center;
        }
        100% {
            background-position: 200% center;
        }
    }

    .page-subtitle {
        color: var(--platinum);
        font-size: 1.3rem;
        font-weight: 300;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    /* Alerts */
    .alert-custom {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 25px 30px;
        margin-bottom: 35px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        display: flex;
        align-items: center;
        gap: 20px;
        animation: slideInRight 0.6s ease;
        border: 2px solid;
    }

    .alert-success-custom {
        border-color: rgba(212, 175, 55, 0.5);
    }

    .alert-danger-custom {
        border-color: rgba(239, 68, 68, 0.5);
    }

    .alert-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        flex-shrink: 0;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
    }

    .alert-success-custom .alert-icon {
        background: linear-gradient(135deg, var(--gold), var(--dark-gold));
    }

    .alert-danger-custom .alert-icon {
        background: linear-gradient(135deg, #EF4444, #DC2626);
    }

    .alert-custom div:last-child {
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
    }

    /* Empty State */
    .empty-state {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        border: 2px solid rgba(212, 175, 55, 0.3);
        border-radius: 35px;
        padding: 100px 50px;
        text-align: center;
        box-shadow: 
            0 25px 70px rgba(0, 0, 0, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        animation: fadeInUp 1s ease;
    }

    .empty-icon {
        width: 140px;
        height: 140px;
        margin: 0 auto 40px;
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.3), rgba(184, 148, 31, 0.3));
        backdrop-filter: blur(10px);
        border: 3px solid rgba(212, 175, 55, 0.5);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
        box-shadow: 0 20px 60px rgba(212, 175, 55, 0.4);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 20px 60px rgba(212, 175, 55, 0.4);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 0 25px 70px rgba(212, 175, 55, 0.6);
        }
    }

    .empty-title {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--gold), var(--platinum));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 20px;
    }

    .empty-text {
        color: var(--platinum);
        font-size: 1.2rem;
        margin-bottom: 40px;
        line-height: 1.6;
    }

    /* Table Container */
    .table-container {
        background: rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        border: 2px solid rgba(212, 175, 55, 0.3);
        border-radius: 35px;
        overflow: hidden;
        box-shadow: 
            0 25px 70px rgba(0, 0, 0, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        animation: fadeInUp 1s ease;
        transition: all 0.5s ease;
    }

    .table-container:hover {
        transform: translateY(-5px);
        box-shadow: 
            0 35px 90px rgba(0, 0, 0, 0.6),
            0 0 50px rgba(212, 175, 55, 0.2);
    }

    .table-header {
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.25), rgba(184, 148, 31, 0.25));
        backdrop-filter: blur(10px);
        padding: 35px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid rgba(212, 175, 55, 0.3);
    }

    .table-title {
        font-size: 1.8rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--gold), var(--platinum));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .table-count {
        background: rgba(212, 175, 55, 0.2);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(212, 175, 55, 0.4);
        padding: 10px 25px;
        border-radius: 60px;
        font-size: 1rem;
        font-weight: 700;
        color: var(--gold);
        box-shadow: 0 5px 20px rgba(212, 175, 55, 0.3);
    }

    /* Table */
    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .custom-table thead {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
    }

    .custom-table th {
        padding: 25px 20px;
        text-align: left;
        font-size: 0.9rem;
        font-weight: 800;
        color: var(--gold);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        border-bottom: 2px solid rgba(212, 175, 55, 0.2);
    }

    .custom-table tbody tr {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        position: relative;
    }

    .custom-table tbody tr::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), rgba(184, 148, 31, 0.1));
        opacity: 0;
        transition: opacity 0.4s;
        pointer-events: none;
    }

    .custom-table tbody tr:hover::before {
        opacity: 1;
    }

    .custom-table tbody tr:hover {
        transform: scale(1.01);
        box-shadow: 0 8px 30px rgba(212, 175, 55, 0.2);
    }

    .custom-table td {
        padding: 25px 20px;
        color: white;
        font-weight: 500;
        font-size: 1rem;
    }

    /* Index Column */
    .index-cell {
        width: 70px;
        text-align: center;
        font-weight: 800;
        font-size: 1.1rem;
        color: var(--gold);
    }

    /* Booking Code */
    .booking-code {
        font-family: 'Courier New', monospace;
        background: rgba(212, 175, 55, 0.15);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(212, 175, 55, 0.3);
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 800;
        color: var(--gold);
        display: inline-block;
        letter-spacing: 1px;
        box-shadow: 0 5px 15px rgba(212, 175, 55, 0.2);
    }

    /* Flight Info */
    .flight-info {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 700;
        color: var(--platinum);
    }

    /* Amount */
    .amount-cell {
        font-size: 1.4rem;
        font-weight: 900;
        background: linear-gradient(135deg, var(--gold), var(--platinum));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Status Badge */
    .status-badge {
        padding: 10px 20px;
        border-radius: 60px;
        font-weight: 800;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: inline-block;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
    }

    .status-completed {
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.8), rgba(184, 148, 31, 0.8));
        color: white;
    }

    .status-pending {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.8), rgba(217, 119, 6, 0.8));
        color: white;
    }

    .status-failed {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.8), rgba(220, 38, 38, 0.8));
        color: white;
    }

    /* Action Button */
    .action-btn {
        padding: 12px 24px;
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.3), rgba(184, 148, 31, 0.3));
        backdrop-filter: blur(10px);
        border: 2px solid rgba(212, 175, 55, 0.5);
        color: var(--gold);
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.4s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4);
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.5), rgba(184, 148, 31, 0.5));
        color: var(--gold);
    }

    /* Bottom Actions */
    .bottom-actions {
        padding: 40px;
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        text-align: center;
        border-top: 2px solid rgba(212, 175, 55, 0.2);
    }

    .btn-custom {
        padding: 20px 45px;
        border: none;
        border-radius: 18px;
        font-size: 1.2rem;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        position: relative;
        overflow: hidden;
    }

    .btn-custom::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-custom:hover::before {
        width: 400px;
        height: 400px;
    }

    .btn-custom span {
        position: relative;
        z-index: 1;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, var(--gold), var(--dark-gold));
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 15px 40px rgba(212, 175, 55, 0.5);
    }

    .btn-primary-custom:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 20px 60px rgba(212, 175, 55, 0.7);
        color: white;
    }

    .btn-secondary-custom {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(15px);
        color: white;
        border: 2px solid rgba(212, 175, 55, 0.3);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    }

    .btn-secondary-custom:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        background: rgba(255, 255, 255, 0.12);
        border-color: rgba(212, 175, 55, 0.5);
        color: white;
    }

    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(70px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        body {
            padding: 30px 15px;
        }

        .page-title {
            font-size: 2.5rem;
        }

        .page-subtitle {
            font-size: 1rem;
        }

        .table-container {
            overflow-x: auto;
        }

        .custom-table {
            min-width: 900px;
        }

        .custom-table th,
        .custom-table td {
            padding: 15px 12px;
            font-size: 0.85rem;
        }

        .empty-state {
            padding: 60px 30px;
        }

        .empty-icon {
            width: 100px;
            height: 100px;
            font-size: 45px;
        }
    }
</style>

<!-- Animated Particles -->
<div class="particles">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
</div>

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
                <span>Đặt chuyến bay ngay</span>
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
                                <strong style="color: var(--platinum); font-size: 1.1rem;">{{ $payment->booking->seat_number ?? '—' }}</strong>
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
                                <div style="font-size: 0.95rem; color: var(--platinum);">
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
                    <span>Quay lại danh sách đặt vé</span>
                </a>
            </div>
        </div>
    @endif
</div>

@endsection