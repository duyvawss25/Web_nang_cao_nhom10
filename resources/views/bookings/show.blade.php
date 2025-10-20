@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #4F46E5;
        --secondary: #7C3AED;
        --success: #10B981;
        --warning: #F59E0B;
        --danger: #EF4444;
        --dark: #1F2937;
    }

    body {
        background: 
            linear-gradient(135deg, rgba(79, 70, 229, 0.9) 0%, rgba(124, 58, 237, 0.9) 100%),
            url('https://images.unsplash.com/photo-1569629743817-70d8db6c323b?w=1920&q=80') center/cover fixed;
        min-height: 100vh;
        font-family: 'Inter', 'Segoe UI', sans-serif;
        padding: 40px 20px;
    }

    .detail-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    /* Header Section */
    .detail-header {
        text-align: center;
        margin-bottom: 40px;
        animation: fadeInDown 0.8s ease;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: white;
        text-shadow: 0 4px 20px rgba(0,0,0,0.4);
        margin-bottom: 15px;
    }

    .booking-code-badge {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        padding: 15px 35px;
        border-radius: 50px;
        color: white;
        font-size: 1.5rem;
        font-weight: 700;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        letter-spacing: 2px;
    }

    /* Main Card */
    .detail-card {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        animation: fadeInUp 0.8s ease;
        margin-bottom: 30px;
    }

    /* Flight Info Section */
    .flight-info-section {
        background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        padding: 40px;
        position: relative;
        overflow: hidden;
    }

    .flight-info-section::before {
        content: '✈️';
        position: absolute;
        font-size: 250px;
        opacity: 0.1;
        right: -50px;
        top: -80px;
        transform: rotate(-15deg);
    }

    .flight-route {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 30px;
        margin-bottom: 30px;
        position: relative;
        z-index: 1;
    }

    .route-point {
        text-align: center;
    }

    .route-label {
        color: rgba(255,255,255,0.8);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .route-value {
        color: white;
        font-size: 2rem;
        font-weight: 800;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .route-arrow {
        color: white;
        font-size: 3rem;
        opacity: 0.6;
        animation: slideRight 2s infinite;
    }

    .flight-number-display {
        text-align: center;
        color: white;
        font-size: 1.3rem;
        font-weight: 600;
        position: relative;
        z-index: 1;
    }

    /* Booking Details Grid */
    .details-grid {
        padding: 40px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }

    .detail-box {
        background: linear-gradient(135deg, #F9FAFB 0%, #E5E7EB 100%);
        border-radius: 15px;
        padding: 25px;
        border-left: 5px solid var(--primary);
        transition: all 0.3s ease;
    }

    .detail-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .detail-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        margin-bottom: 15px;
    }

    .detail-label {
        font-size: 0.85rem;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .detail-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--dark);
    }

    .price-highlight {
        color: var(--success);
        font-size: 2rem;
    }

    /* Status Badge */
    .status-display {
        text-align: center;
        padding: 15px;
        border-radius: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 1.1rem;
    }

    .status-confirmed {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
    }

    .status-pending {
        background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
        color: white;
    }

    .status-cancelled {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
        color: white;
    }

    /* Payment Section */
    .payment-section {
        padding: 40px;
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        border-top: 3px dashed #CBD5E1;
    }

    .payment-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .payment-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }

    .payment-info {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .payment-detail {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .payment-label {
        font-size: 0.85rem;
        color: #6B7280;
        text-transform: uppercase;
    }

    .payment-value {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dark);
    }

    .payment-status-badge {
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    .payment-completed {
        background: var(--success);
        color: white;
    }

    .payment-pending {
        background: var(--warning);
        color: white;
    }

    /* No Payment Alert */
    .no-payment-alert {
        background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
        border-left: 5px solid var(--warning);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .alert-icon {
        width: 50px;
        height: 50px;
        background: var(--warning);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        flex-shrink: 0;
    }

    .alert-content h3 {
        color: #92400E;
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .alert-content p {
        color: #78350F;
        margin: 0;
    }

    /* Action Buttons */
    .action-buttons {
        padding: 30px 40px;
        background: #F9FAFB;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .btn-custom {
        flex: 1;
        min-width: 200px;
        padding: 18px 35px;
        border: none;
        border-radius: 15px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .btn-success-custom {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
    }

    .btn-success-custom:hover {
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

    /* Boarding Pass Style */
    .boarding-pass {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(0,0,0,0.2);
        margin-top: 30px;
        position: relative;
    }

    .boarding-pass::before {
        content: '';
        position: absolute;
        top: 50%;
        left: -15px;
        width: 30px;
        height: 30px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
        border-radius: 50%;
        transform: translateY(-50%);
    }

    .boarding-pass::after {
        content: '';
        position: absolute;
        top: 50%;
        right: -15px;
        width: 30px;
        height: 30px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
        border-radius: 50%;
        transform: translateY(-50%);
    }

    .pass-divider {
        border-top: 2px dashed #CBD5E1;
        margin: 0 40px;
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

    @keyframes slideRight {
        0%, 100% {
            transform: translateX(0);
        }
        50% {
            transform: translateX(10px);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.8rem;
        }

        .flight-route {
            flex-direction: column;
            gap: 15px;
        }

        .route-arrow {
            transform: rotate(90deg);
        }

        .details-grid {
            grid-template-columns: 1fr;
            padding: 25px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-custom {
            min-width: auto;
        }
    }
</style>

<div class="detail-container">
    <!-- Header -->
    <div class="detail-header">
        <h1 class="page-title">🎫 Chi Tiết Đặt Vé</h1>
        <div class="booking-code-badge">{{ $booking->booking_code }}</div>
    </div>

    <!-- Main Detail Card -->
    <div class="detail-card boarding-pass">
        <!-- Flight Info Section -->
        <div class="flight-info-section">
            <div class="flight-route">
                <div class="route-point">
                    <div class="route-label">🛫 Khởi hành</div>
                    <div class="route-value">{{ $booking->flight->departure ?? 'N/A' }}</div>
                </div>
                
                <div class="route-arrow">→</div>
                
                <div class="route-point">
                    <div class="route-label">🛬 Đến</div>
                    <div class="route-value">{{ $booking->flight->arrival ?? 'N/A' }}</div>
                </div>
            </div>
            
            <div class="flight-number-display">
                ✈️ Chuyến bay {{ $booking->flight->flight_number }}
            </div>
        </div>

        <div class="pass-divider"></div>

        <!-- Booking Details Grid -->
        <div class="details-grid">
            <div class="detail-box">
                <div class="detail-icon">💺</div>
                <div class="detail-label">Số ghế đặt</div>
                <div class="detail-value">{{ $booking->seats }}</div>
            </div>

            <div class="detail-box">
                <div class="detail-icon">💰</div>
                <div class="detail-label">Tổng tiền</div>
                <div class="detail-value price-highlight">
                    ${{ number_format($booking->total_price, 2) }}
                </div>
            </div>

            <div class="detail-box">
                <div class="detail-icon">📅</div>
                <div class="detail-label">Ngày đặt vé</div>
                <div class="detail-value">{{ $booking->created_at->format('d/m/Y') }}</div>
            </div>

            <div class="detail-box">
                <div class="detail-icon">🕐</div>
                <div class="detail-label">Giờ khởi hành</div>
                <div class="detail-value">{{ $booking->flight->departure_time ?? 'TBA' }}</div>
            </div>

            <div class="detail-box" style="grid-column: span 2;">
                <div class="detail-label">📊 Trạng thái đặt vé</div>
                <div class="status-display status-{{ strtolower($booking->status) }}">
                    @if($booking->status == 'confirmed')
                        ✓ Đã xác nhận
                    @elseif($booking->status == 'pending')
                        ⏳ Đang chờ
                    @else
                        ✕ {{ $booking->status }}
                    @endif
                </div>
            </div>
        </div>

        <!-- Payment Section -->
        <div class="payment-section">
            <h2 class="payment-title">
                <div class="payment-icon">💳</div>
                Thông Tin Thanh Toán
            </h2>

            @if(!$booking->payment)
                <div class="no-payment-alert">
                    <div class="alert-icon">⚠️</div>
                    <div class="alert-content">
                        <h3>Chưa thanh toán</h3>
                        <p>Vui lòng thanh toán để hoàn tất đặt vé của bạn</p>
                    </div>
                </div>
            @else
                <div class="payment-info">
                    <div class="payment-detail">
                        <span class="payment-label">💵 Số tiền</span>
                        <span class="payment-value">${{ number_format($booking->payment->amount, 2) }}</span>
                    </div>
                    
                    <div class="payment-detail">
                        <span class="payment-label">📅 Ngày thanh toán</span>
                        <span class="payment-value">{{ $booking->payment->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    
                    <div class="payment-detail">
                        <span class="payment-label">🔖 Trạng thái</span>
                        <span class="payment-status-badge payment-{{ strtolower($booking->payment->status) }}">
                            {{ $booking->payment->status }}
                        </span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            @if(!$booking->payment)
                <a href="{{ route('payments.create', $booking->id) }}" class="btn-custom btn-success-custom">
                    <span>💳</span>
                    Thanh toán ngay
                </a>
            @endif
            
            <a href="{{ route('bookings.index') }}" class="btn-custom btn-secondary-custom">
                <span>←</span>
                Quay lại danh sách
            </a>
        </div>
    </div>
</div>

@endsection