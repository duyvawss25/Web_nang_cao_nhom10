@extends('layouts.app')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --primary: #6366F1;
        --secondary: #8B5CF6;
        --success: #10B981;
        --warning: #F59E0B;
        --danger: #EF4444;
        --glass-bg: rgba(255, 255, 255, 0.1);
        --glass-border: rgba(255, 255, 255, 0.2);
    }

    body {
        background: url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1920&q=80') center/cover fixed no-repeat;
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
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.4) 100%);
        z-index: -1;
    }

    /* Animated Background Particles */
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
        width: 4px;
        height: 4px;
        background: rgba(255, 255, 255, 0.6);
        border-radius: 50%;
        animation: float 15s infinite ease-in-out;
    }

    .particle:nth-child(1) { left: 10%; top: 20%; animation-delay: 0s; animation-duration: 12s; }
    .particle:nth-child(2) { left: 20%; top: 80%; animation-delay: 2s; animation-duration: 15s; }
    .particle:nth-child(3) { left: 30%; top: 40%; animation-delay: 4s; animation-duration: 18s; }
    .particle:nth-child(4) { left: 40%; top: 60%; animation-delay: 1s; animation-duration: 14s; }
    .particle:nth-child(5) { left: 50%; top: 30%; animation-delay: 3s; animation-duration: 16s; }
    .particle:nth-child(6) { left: 60%; top: 70%; animation-delay: 5s; animation-duration: 13s; }
    .particle:nth-child(7) { left: 70%; top: 50%; animation-delay: 2.5s; animation-duration: 17s; }
    .particle:nth-child(8) { left: 80%; top: 40%; animation-delay: 4.5s; animation-duration: 15s; }
    .particle:nth-child(9) { left: 90%; top: 60%; animation-delay: 1.5s; animation-duration: 19s; }
    .particle:nth-child(10) { left: 15%; top: 90%; animation-delay: 3.5s; animation-duration: 14s; }

    @keyframes float {
        0%, 100% {
            transform: translateY(0) translateX(0) scale(1);
            opacity: 0.6;
        }
        25% {
            transform: translateY(-100px) translateX(50px) scale(1.2);
            opacity: 0.8;
        }
        50% {
            transform: translateY(-200px) translateX(-30px) scale(0.8);
            opacity: 1;
        }
        75% {
            transform: translateY(-100px) translateX(-80px) scale(1.1);
            opacity: 0.7;
        }
    }

    .detail-container {
        max-width: 1200px;
        margin: 0 auto;
        perspective: 1000px;
    }

    /* Glass Morphism Header */
    .detail-header {
        text-align: center;
        margin-bottom: 50px;
        animation: fadeInDown 1s ease;
    }

    .page-title {
        font-size: 3.5rem;
        font-weight: 900;
        background: linear-gradient(135deg, #FFFFFF 0%, #F0F9FF 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 25px;
        text-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        letter-spacing: -1px;
    }

    .booking-code-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 2px solid rgba(255, 255, 255, 0.25);
        padding: 20px 50px;
        border-radius: 60px;
        color: white;
        font-size: 1.8rem;
        font-weight: 800;
        box-shadow: 
            0 15px 45px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
        letter-spacing: 3px;
        animation: pulse 3s infinite ease-in-out;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            box-shadow: 
                0 15px 45px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
        }
    }

    /* Main Glass Card */
    .detail-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        border-radius: 35px;
        border: 2px solid rgba(255, 255, 255, 0.18);
        overflow: hidden;
        box-shadow: 
            0 25px 70px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        animation: fadeInUp 1s ease;
        margin-bottom: 40px;
        transition: all 0.5s ease;
    }

    .detail-card:hover {
        transform: translateY(-10px);
        box-shadow: 
            0 35px 90px rgba(0, 0, 0, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }

    /* Flight Info Section */
    .flight-info-section {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.4) 0%, rgba(139, 92, 246, 0.4) 100%);
        backdrop-filter: blur(10px);
        padding: 50px 40px;
        position: relative;
        overflow: hidden;
    }

    .flight-info-section::before {
        content: '✈️';
        position: absolute;
        font-size: 300px;
        opacity: 0.08;
        right: -60px;
        top: -100px;
        transform: rotate(-20deg);
        animation: float-plane 20s infinite ease-in-out;
    }

    @keyframes float-plane {
        0%, 100% {
            transform: rotate(-20deg) translateY(0);
        }
        50% {
            transform: rotate(-20deg) translateY(-30px);
        }
    }

    .flight-route {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 50px;
        margin-bottom: 35px;
        position: relative;
        z-index: 1;
    }

    .route-point {
        text-align: center;
        animation: fadeInScale 1s ease;
    }

    .route-label {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 12px;
        font-weight: 600;
    }

    .route-value {
        color: white;
        font-size: 2.8rem;
        font-weight: 900;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        background: linear-gradient(135deg, #FFFFFF 0%, #E0E7FF 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .route-arrow {
        color: white;
        font-size: 3.5rem;
        opacity: 0.8;
        animation: slideRight 2.5s infinite ease-in-out;
        filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.3));
    }

    @keyframes slideRight {
        0%, 100% {
            transform: translateX(0);
        }
        50% {
            transform: translateX(15px);
        }
    }

    .flight-number-display {
        text-align: center;
        color: white;
        font-size: 1.5rem;
        font-weight: 700;
        position: relative;
        z-index: 1;
        text-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
    }

    /* Details Grid */
    .details-grid {
        padding: 50px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
    }

    .detail-box {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        padding: 30px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        animation: fadeInScale 0.8s ease backwards;
    }

    .detail-box:nth-child(1) { animation-delay: 0.1s; }
    .detail-box:nth-child(2) { animation-delay: 0.2s; }
    .detail-box:nth-child(3) { animation-delay: 0.3s; }
    .detail-box:nth-child(4) { animation-delay: 0.4s; }
    .detail-box:nth-child(5) { animation-delay: 0.5s; }

    .detail-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .detail-box:hover::before {
        left: 100%;
    }

    .detail-box:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 
            0 20px 50px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
        border-color: rgba(255, 255, 255, 0.4);
        background: rgba(255, 255, 255, 0.18);
    }

    .detail-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.8) 0%, rgba(139, 92, 246, 0.8) 100%);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        margin-bottom: 20px;
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        transition: all 0.3s ease;
    }

    .detail-box:hover .detail-icon {
        transform: rotateY(360deg) scale(1.1);
        box-shadow: 0 12px 35px rgba(99, 102, 241, 0.6);
    }

    .detail-label {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.8);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .detail-value {
        font-size: 1.8rem;
        font-weight: 900;
        color: white;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .price-highlight {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 2.2rem;
    }

    /* Status Display */
    .status-display {
        text-align: center;
        padding: 18px;
        border-radius: 15px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-size: 1.2rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        animation: statusPulse 2s infinite ease-in-out;
    }

    @keyframes statusPulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.85;
        }
    }

    .status-confirmed {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.9) 0%, rgba(5, 150, 105, 0.9) 100%);
        color: white;
    }

    .status-pending {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.9) 0%, rgba(217, 119, 6, 0.9) 100%);
        color: white;
    }

    .status-cancelled {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.9) 0%, rgba(220, 38, 38, 0.9) 100%);
        color: white;
    }

    /* Payment Section */
    .payment-section {
        padding: 50px;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border-top: 2px dashed rgba(255, 255, 255, 0.3);
    }

    .payment-title {
        font-size: 2rem;
        font-weight: 800;
        color: white;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 20px;
        text-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
    }

    .payment-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.8) 0%, rgba(5, 150, 105, 0.8) 100%);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
    }

    .payment-info {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(15px);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 30px;
        transition: all 0.4s ease;
    }

    .payment-info:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4);
        background: rgba(255, 255, 255, 0.18);
    }

    .payment-detail {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .payment-label {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.8);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .payment-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: white;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .payment-status-badge {
        padding: 12px 30px;
        border-radius: 60px;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 1rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        letter-spacing: 1px;
    }

    .payment-completed {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
    }

    .payment-pending {
        background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
        color: white;
    }

    /* No Payment Alert */
    .no-payment-alert {
        background: rgba(254, 243, 199, 0.2);
        backdrop-filter: blur(15px);
        border: 2px solid rgba(245, 158, 11, 0.4);
        border-radius: 20px;
        padding: 30px;
        display: flex;
        align-items: center;
        gap: 25px;
        animation: alertShake 3s infinite ease-in-out;
    }

    @keyframes alertShake {
        0%, 100% {
            transform: translateX(0);
        }
        25% {
            transform: translateX(-5px);
        }
        75% {
            transform: translateX(5px);
        }
    }

    .alert-icon {
        width: 60px;
        height: 60px;
        background: rgba(245, 158, 11, 0.8);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        flex-shrink: 0;
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .alert-content h3 {
        color: white;
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 8px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .alert-content p {
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
        font-size: 1.1rem;
    }

    /* Action Buttons */
    .action-buttons {
        padding: 40px 50px;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .btn-custom {
        flex: 1;
        min-width: 220px;
        padding: 22px 40px;
        border: none;
        border-radius: 18px;
        font-size: 1.2rem;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
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
        width: 300px;
        height: 300px;
    }

    .btn-custom span {
        position: relative;
        z-index: 1;
    }

    .btn-success-custom {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
        box-shadow: 0 15px 40px rgba(16, 185, 129, 0.5);
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .btn-success-custom:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 20px 60px rgba(16, 185, 129, 0.7);
        color: white;
    }

    .btn-secondary-custom {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(15px);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    }

    .btn-secondary-custom:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        background: rgba(255, 255, 255, 0.2);
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

    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        body {
            padding: 30px 15px;
        }

        .page-title {
            font-size: 2.2rem;
        }

        .booking-code-badge {
            font-size: 1.3rem;
            padding: 15px 35px;
        }

        .flight-route {
            flex-direction: column;
            gap: 20px;
        }

        .route-arrow {
            transform: rotate(90deg);
        }

        .route-value {
            font-size: 2rem;
        }

        .details-grid {
            grid-template-columns: 1fr;
            padding: 30px;
            gap: 20px;
        }

        .action-buttons {
            flex-direction: column;
            padding: 30px;
        }

        .btn-custom {
            min-width: auto;
        }

        .payment-section {
            padding: 30px;
        }

        .payment-info {
            flex-direction: column;
            align-items: flex-start;
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

<div class="detail-container">
    <!-- Header -->
    <div class="detail-header">
        <h1 class="page-title">🎫 Chi Tiết Đặt Vé</h1>
        <div class="booking-code-badge">{{ $booking->booking_code }}</div>
    </div>

    <!-- Main Detail Card -->
    <div class="detail-card">
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
                    <span>Thanh toán ngay</span>
                </a>
            @endif
            
            <a href="{{ route('bookings.index') }}" class="btn-custom btn-secondary-custom">
                <span>←</span>
                <span>Quay lại danh sách</span>
            </a>
        </div>
    </div>
</div>

@endsection