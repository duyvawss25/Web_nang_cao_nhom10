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
        background: url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1920&q=80') center/cover fixed no-repeat;
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
        background: linear-gradient(135deg, rgba(15, 23, 41, 0.85) 0%, rgba(26, 31, 58, 0.9) 100%);
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
        animation: float 20s infinite ease-in-out;
    }

    .particle:nth-child(1) { left: 10%; top: 20%; animation-delay: 0s; animation-duration: 15s; }
    .particle:nth-child(2) { left: 20%; top: 80%; animation-delay: 3s; animation-duration: 18s; }
    .particle:nth-child(3) { left: 30%; top: 40%; animation-delay: 6s; animation-duration: 22s; }
    .particle:nth-child(4) { left: 40%; top: 60%; animation-delay: 2s; animation-duration: 16s; }
    .particle:nth-child(5) { left: 50%; top: 30%; animation-delay: 5s; animation-duration: 19s; }
    .particle:nth-child(6) { left: 60%; top: 70%; animation-delay: 8s; animation-duration: 21s; }
    .particle:nth-child(7) { left: 70%; top: 50%; animation-delay: 4s; animation-duration: 17s; }
    .particle:nth-child(8) { left: 80%; top: 40%; animation-delay: 7s; animation-duration: 20s; }
    .particle:nth-child(9) { left: 90%; top: 60%; animation-delay: 1s; animation-duration: 23s; }
    .particle:nth-child(10) { left: 15%; top: 90%; animation-delay: 9s; animation-duration: 18s; }

    @keyframes float {
        0%, 100% {
            transform: translateY(0) translateX(0) scale(1);
            opacity: 0.6;
        }
        25% {
            transform: translateY(-120px) translateX(60px) scale(1.3);
            opacity: 0.9;
        }
        50% {
            transform: translateY(-200px) translateX(-40px) scale(0.9);
            opacity: 1;
        }
        75% {
            transform: translateY(-120px) translateX(-90px) scale(1.2);
            opacity: 0.8;
        }
    }

    .payment-container {
        max-width: 900px;
        margin: 0 auto;
        perspective: 1200px;
    }

    /* Header */
    .payment-header {
        text-align: center;
        margin-bottom: 50px;
        animation: fadeInDown 1s ease;
    }

    .payment-title {
        font-size: 3.5rem;
        font-weight: 900;
        background: linear-gradient(135deg, var(--gold) 0%, var(--platinum) 50%, var(--gold) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 15px;
        text-shadow: 0 0 30px rgba(212, 175, 55, 0.5);
        letter-spacing: -1px;
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

    .payment-subtitle {
        color: var(--platinum);
        font-size: 1.3rem;
        font-weight: 300;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    /* Main Card */
    .payment-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        border-radius: 35px;
        border: 2px solid rgba(212, 175, 55, 0.3);
        overflow: hidden;
        box-shadow: 
            0 25px 70px rgba(0, 0, 0, 0.6),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        animation: fadeInUp 1s ease;
        transition: all 0.5s ease;
    }

    .payment-card:hover {
        transform: translateY(-10px);
        box-shadow: 
            0 35px 90px rgba(0, 0, 0, 0.7),
            0 0 50px rgba(212, 175, 55, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }

    /* Card Header */
    .card-header-payment {
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.3) 0%, rgba(184, 148, 31, 0.3) 100%);
        backdrop-filter: blur(10px);
        padding: 50px 40px;
        position: relative;
        overflow: hidden;
        border-bottom: 2px solid rgba(212, 175, 55, 0.3);
    }

    .card-header-payment::before {
        content: '💳';
        position: absolute;
        font-size: 250px;
        opacity: 0.05;
        right: -40px;
        top: -80px;
        transform: rotate(-15deg);
        animation: float-icon 15s infinite ease-in-out;
    }

    @keyframes float-icon {
        0%, 100% {
            transform: rotate(-15deg) translateY(0);
        }
        50% {
            transform: rotate(-15deg) translateY(-30px);
        }
    }

    .header-content {
        position: relative;
        z-index: 1;
        text-align: center;
    }

    .header-icon {
        width: 90px;
        height: 90px;
        background: rgba(212, 175, 55, 0.2);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(212, 175, 55, 0.5);
        border-radius: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 45px;
        margin: 0 auto 25px;
        box-shadow: 0 10px 40px rgba(212, 175, 55, 0.4);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 10px 40px rgba(212, 175, 55, 0.4);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 0 15px 50px rgba(212, 175, 55, 0.6);
        }
    }

    .header-title {
        font-size: 2.2rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--gold), var(--platinum));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
    }

    /* Booking Summary */
    .booking-summary {
        padding: 50px;
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border-bottom: 2px dashed rgba(212, 175, 55, 0.3);
    }

    .summary-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--gold);
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
        text-shadow: 0 2px 15px rgba(212, 175, 55, 0.3);
    }

    .booking-code-display {
        display: inline-block;
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.3), rgba(184, 148, 31, 0.3));
        backdrop-filter: blur(15px);
        border: 2px solid rgba(212, 175, 55, 0.5);
        color: var(--gold);
        padding: 12px 35px;
        border-radius: 60px;
        font-weight: 800;
        letter-spacing: 3px;
        font-size: 1.3rem;
        box-shadow: 
            0 10px 30px rgba(212, 175, 55, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        animation: glow 2s infinite alternate;
    }

    @keyframes glow {
        0% {
            box-shadow: 
                0 10px 30px rgba(212, 175, 55, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }
        100% {
            box-shadow: 
                0 15px 40px rgba(212, 175, 55, 0.5),
                0 0 30px rgba(212, 175, 55, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .summary-item {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(15px);
        border: 2px solid rgba(212, 175, 55, 0.2);
        padding: 25px;
        border-radius: 18px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .summary-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.2), transparent);
        transition: left 0.5s;
    }

    .summary-item:hover::before {
        left: 100%;
    }

    .summary-item:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 
            0 20px 50px rgba(0, 0, 0, 0.5),
            0 0 30px rgba(212, 175, 55, 0.3);
        border-color: rgba(212, 175, 55, 0.5);
        background: rgba(255, 255, 255, 0.12);
    }

    .summary-label {
        font-size: 0.85rem;
        color: var(--platinum);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .summary-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: white;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .price-value {
        font-size: 2.3rem;
        background: linear-gradient(135deg, var(--gold), var(--platinum));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Payment Form */
    .payment-form {
        padding: 50px;
    }

    .form-section-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--gold);
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
        text-shadow: 0 2px 15px rgba(212, 175, 55, 0.3);
    }

    /* Security Badge */
    .security-badge {
        background: rgba(212, 175, 55, 0.1);
        backdrop-filter: blur(15px);
        border: 2px solid rgba(212, 175, 55, 0.3);
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 35px;
        display: flex;
        align-items: center;
        gap: 20px;
        animation: securityPulse 3s infinite;
    }

    @keyframes securityPulse {
        0%, 100% {
            border-color: rgba(212, 175, 55, 0.3);
        }
        50% {
            border-color: rgba(212, 175, 55, 0.6);
        }
    }

    .security-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.8), rgba(184, 148, 31, 0.8));
        backdrop-filter: blur(10px);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        flex-shrink: 0;
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
    }

    .security-text h4 {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--gold);
        margin: 0 0 8px 0;
    }

    .security-text p {
        font-size: 0.95rem;
        color: var(--platinum);
        margin: 0;
    }

    /* Payment Methods */
    .payment-methods {
        display: grid;
        gap: 18px;
        margin-bottom: 35px;
    }

    .payment-method-option {
        position: relative;
    }

    .payment-method-option input[type="radio"] {
        position: absolute;
        opacity: 0;
    }

    .payment-method-label {
        display: flex;
        align-items: center;
        padding: 25px 30px;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(15px);
        border: 2px solid rgba(212, 175, 55, 0.2);
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .payment-method-label::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), rgba(184, 148, 31, 0.1));
        opacity: 0;
        transition: opacity 0.4s;
    }

    .payment-method-option input[type="radio"]:checked + .payment-method-label {
        background: rgba(212, 175, 55, 0.15);
        border-color: var(--gold);
        box-shadow: 
            0 10px 40px rgba(212, 175, 55, 0.4),
            0 0 30px rgba(212, 175, 55, 0.2),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        transform: scale(1.02);
    }

    .payment-method-option input[type="radio"]:checked + .payment-method-label::before {
        opacity: 1;
    }

    .payment-method-label:hover {
        transform: translateY(-3px);
        border-color: rgba(212, 175, 55, 0.5);
        background: rgba(255, 255, 255, 0.08);
    }

    .method-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.8), rgba(184, 148, 31, 0.8));
        backdrop-filter: blur(10px);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        margin-right: 25px;
        flex-shrink: 0;
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.3);
        transition: all 0.3s ease;
    }

    .payment-method-label:hover .method-icon {
        transform: rotateY(180deg) scale(1.1);
        box-shadow: 0 12px 35px rgba(212, 175, 55, 0.5);
    }

    .method-info {
        flex: 1;
    }

    .method-name {
        font-size: 1.3rem;
        font-weight: 800;
        color: white;
        margin-bottom: 6px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .method-description {
        font-size: 0.95rem;
        color: var(--platinum);
    }

    .method-checkmark {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        border: 3px solid rgba(212, 175, 55, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
        font-size: 18px;
        color: transparent;
    }

    .payment-method-option input[type="radio"]:checked + .payment-method-label .method-checkmark {
        background: linear-gradient(135deg, var(--gold), var(--dark-gold));
        border-color: var(--gold);
        color: white;
        box-shadow: 0 0 20px rgba(212, 175, 55, 0.6);
        transform: scale(1.1);
    }

    /* Action Buttons */
    .form-actions {
        display: flex;
        gap: 20px;
        padding-top: 35px;
        border-top: 2px solid rgba(212, 175, 55, 0.2);
    }

    .btn-custom {
        flex: 1;
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

    .btn-success-custom {
        background: linear-gradient(135deg, var(--gold) 0%, var(--dark-gold) 100%);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.2);
        box-shadow: 
            0 15px 40px rgba(212, 175, 55, 0.5),
            0 0 30px rgba(212, 175, 55, 0.3);
    }

    .btn-success-custom:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 
            0 20px 60px rgba(212, 175, 55, 0.7),
            0 0 50px rgba(212, 175, 55, 0.5);
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

    /* Responsive */
    @media (max-width: 768px) {
        body {
            padding: 30px 15px;
        }

        .payment-title {
            font-size: 2.5rem;
        }

        .payment-subtitle {
            font-size: 1rem;
        }

        .booking-summary {
            padding: 30px;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }

        .payment-form {
            padding: 30px;
        }

        .form-actions {
            flex-direction: column;
        }

        .payment-method-label {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }

        .method-icon {
            margin-right: 0;
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

<div class="payment-container">
    <!-- Header -->
    <div class="payment-header">
        <h1 class="payment-title">💳 Thanh Toán</h1>
        <p class="payment-subtitle">Hoàn tất đặt vé của bạn</p>
    </div>

    <!-- Main Payment Card -->
    <div class="payment-card">
        <!-- Card Header -->
        <div class="card-header-payment">
            <div class="header-content">
                <div class="header-icon">💰</div>
                <h2 class="header-title">Xác nhận thanh toán</h2>
            </div>
        </div>

        <!-- Booking Summary -->
        <div class="booking-summary">
            <div class="summary-title">
                📋 Thông tin đặt vé
            </div>

            <div style="text-align: center; margin-bottom: 35px;">
                <span class="booking-code-display">{{ $booking->booking_code }}</span>
            </div>

            <div class="summary-grid">
                <div class="summary-item">
                    <div class="summary-label">✈️ Chuyến bay</div>
                    <div class="summary-value">{{ $booking->flight->flight_number ?? 'N/A' }}</div>
                </div>

                <div class="summary-item">
                    <div class="summary-label">🛫 Khởi hành</div>
                    <div class="summary-value">{{ $booking->flight->departure ?? 'N/A' }}</div>
                </div>

                <div class="summary-item">
                    <div class="summary-label">🛬 Đến</div>
                    <div class="summary-value">{{ $booking->flight->arrival ?? 'N/A' }}</div>
                </div>

                <div class="summary-item">
                    <div class="summary-label">💺 Số ghế</div>
                    <div class="summary-value">{{ $booking->seats }}</div>
                </div>

                <div class="summary-item" style="grid-column: span 2;">
                    <div class="summary-label">💰 Tổng thanh toán</div>
                    <div class="summary-value price-value">${{ number_format($booking->total_price, 2) }}</div>
                </div>
            </div>
        </div>

        <!-- Payment Form -->
        <form action="{{ route('payments.store') }}" method="POST" class="payment-form">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
            <input type="hidden" name="amount" value="{{ $booking->total_price }}">

            <div class="form-section-title">
                💳 Chọn phương thức thanh toán
            </div>

            <!-- Security Badge -->
            <div class="security-badge">
                <div class="security-icon">🔒</div>
                <div class="security-text">
                    <h4>Giao dịch bảo mật</h4>
                    <p>Thông tin của bạn được mã hóa và bảo vệ an toàn</p>
                </div>
            </div>

            <!-- Payment Methods -->
            <div class="payment-methods">
                <!-- Credit Card -->
                <div class="payment-method-option">
                    <input type="radio" name="method" id="credit_card" value="credit_card" checked>
                    <label for="credit_card" class="payment-method-label">
                        <div class="method-icon">💳</div>
                        <div class="method-info">
                            <div class="method-name">Thẻ tín dụng</div>
                            <div class="method-description">Visa, Mastercard, American Express</div>
                        </div>
                        <div class="method-checkmark">✓</div>
                    </label>
                </div>

                <!-- PayPal -->
                <div class="payment-method-option">
                    <input type="radio" name="method" id="paypal" value="paypal">
                    <label for="paypal" class="payment-method-label">
                        <div class="method-icon">🅿️</div>
                        <div class="method-info">
                            <div class="method-name">PayPal</div>
                            <div class="method-description">Thanh toán nhanh và an toàn</div>
                        </div>
                        <div class="method-checkmark">✓</div>
                    </label>
                </div>

                <!-- Bank Transfer -->
                <div class="payment-method-option">
                    <input type="radio" name="method" id="bank_transfer" value="bank_transfer">
                    <label for="bank_transfer" class="payment-method-label">
                        <div class="method-icon">🏦</div>
                        <div class="method-info">
                            <div class="method-name">Chuyển khoản ngân hàng</div>
                            <div class="method-description">Chuyển khoản trực tiếp từ tài khoản</div>
                        </div>
                        <div class="method-checkmark">✓</div>
                    </label>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="form-actions">
                <a href="{{ route('bookings.index') }}" class="btn-custom btn-secondary-custom">
                    <span>←</span>
                    <span>Quay lại</span>
                </a>
                <button type="submit" class="btn-custom btn-success-custom">
                    <span>✓</span>
                    <span>Xác nhận thanh toán</span>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection