@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #4F46E5;
        --secondary: #7C3AED;
        --success: #10B981;
        --dark: #1F2937;
    }

    body {
        background: 
            linear-gradient(135deg, rgba(16, 185, 129, 0.9) 0%, rgba(5, 150, 105, 0.9) 100%),
            url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1920&q=80') center/cover fixed;
        min-height: 100vh;
        font-family: 'Inter', 'Segoe UI', sans-serif;
        padding: 40px 20px;
    }

    .payment-container {
        max-width: 800px;
        margin: 0 auto;
    }

    /* Header */
    .payment-header {
        text-align: center;
        margin-bottom: 40px;
        animation: fadeInDown 0.8s ease;
    }

    .payment-title {
        font-size: 2.8rem;
        font-weight: 800;
        color: white;
        text-shadow: 0 4px 20px rgba(0,0,0,0.4);
        margin-bottom: 10px;
    }

    .payment-subtitle {
        color: rgba(255,255,255,0.9);
        font-size: 1.2rem;
    }

    /* Main Card */
    .payment-card {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        animation: fadeInUp 0.8s ease;
    }

    /* Card Header */
    .card-header-payment {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        padding: 40px;
        position: relative;
        overflow: hidden;
    }

    .card-header-payment::before {
        content: '💳';
        position: absolute;
        font-size: 200px;
        opacity: 0.15;
        right: -30px;
        top: -50px;
        transform: rotate(-15deg);
    }

    .header-content {
        position: relative;
        z-index: 1;
        text-align: center;
    }

    .header-icon {
        width: 80px;
        height: 80px;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        margin: 0 auto 20px;
    }

    .header-title {
        font-size: 2rem;
        font-weight: 800;
        color: white;
        margin: 0;
    }

    /* Booking Summary */
    .booking-summary {
        padding: 40px;
        background: linear-gradient(135deg, #F0FDF4 0%, #DCFCE7 100%);
        border-bottom: 2px dashed #CBD5E1;
    }

    .summary-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .booking-code-display {
        display: inline-block;
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        letter-spacing: 1px;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .summary-item {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .summary-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .summary-label {
        font-size: 0.85rem;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .summary-value {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dark);
    }

    .price-value {
        font-size: 2rem;
        color: var(--success);
    }

    /* Payment Form */
    .payment-form {
        padding: 40px;
    }

    .form-section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .payment-methods {
        display: grid;
        gap: 15px;
        margin-bottom: 30px;
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
        padding: 20px 25px;
        background: #F9FAFB;
        border: 3px solid #E5E7EB;
        border-radius: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .payment-method-option input[type="radio"]:checked + .payment-method-label {
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        border-color: var(--success);
        box-shadow: 0 5px 20px rgba(16, 185, 129, 0.2);
    }

    .method-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        margin-right: 20px;
        flex-shrink: 0;
    }

    .method-info {
        flex: 1;
    }

    .method-name {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 5px;
    }

    .method-description {
        font-size: 0.9rem;
        color: #6B7280;
    }

    .method-checkmark {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 3px solid #E5E7EB;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .payment-method-option input[type="radio"]:checked + .payment-method-label .method-checkmark {
        background: var(--success);
        border-color: var(--success);
        color: white;
    }

    /* Security Badge */
    .security-badge {
        background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
        border-left: 5px solid #F59E0B;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .security-icon {
        width: 50px;
        height: 50px;
        background: #F59E0B;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        flex-shrink: 0;
    }

    .security-text {
        flex: 1;
    }

    .security-text h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #92400E;
        margin: 0 0 5px 0;
    }

    .security-text p {
        font-size: 0.9rem;
        color: #78350F;
        margin: 0;
    }

    /* Action Buttons */
    .form-actions {
        display: flex;
        gap: 15px;
        padding-top: 30px;
        border-top: 2px solid #E5E7EB;
    }

    .btn-custom {
        flex: 1;
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

    /* Responsive */
    @media (max-width: 768px) {
        .payment-title {
            font-size: 2rem;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }

        .payment-form {
            padding: 25px;
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

            <div style="text-align: center; margin-bottom: 25px;">
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
                    Quay lại
                </a>
                <button type="submit" class="btn-custom btn-success-custom">
                    <span>✓</span>
                    Xác nhận thanh toán
                </button>
            </div>
        </form>
    </div>
</div>

@endsection