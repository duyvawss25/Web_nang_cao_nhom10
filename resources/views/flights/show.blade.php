@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #4F46E5;
        --secondary: #7C3AED;
        --success: #10B981;
        --info: #3B82F6;
        --dark: #1F2937;
    }

    body {
        background: 
            linear-gradient(135deg, rgba(59, 130, 246, 0.9) 0%, rgba(79, 70, 229, 0.9) 100%),
            url('https://images.unsplash.com/photo-1583938553948-dbd756f9f8f1?w=1920&q=80') center/cover fixed;
        min-height: 100vh;
        font-family: 'Inter', 'Segoe UI', sans-serif;
        padding: 40px 20px;
    }

    .detail-wrapper {
        max-width: 1100px;
        margin: 0 auto;
    }

    /* Header */
    .page-header {
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

    .flight-number-badge {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        padding: 12px 30px;
        border-radius: 50px;
        color: white;
        font-size: 1.5rem;
        font-weight: 700;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        letter-spacing: 2px;
    }

    /* Main Card */
    .flight-card {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        animation: fadeInUp 0.8s ease;
        margin-bottom: 30px;
    }

    /* Flight Route Section */
    .route-section {
        background: linear-gradient(135deg, #3B82F6 0%, #4F46E5 100%);
        padding: 50px 40px;
        position: relative;
        overflow: hidden;
    }

    .route-section::before {
        content: '✈️';
        position: absolute;
        font-size: 300px;
        opacity: 0.1;
        right: -80px;
        top: -100px;
        transform: rotate(-20deg);
    }

    .flight-route {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        z-index: 1;
        max-width: 900px;
        margin: 0 auto;
    }

    .airport-info {
        text-align: center;
        flex: 1;
    }

    .airport-code {
        font-size: 3.5rem;
        font-weight: 900;
        color: white;
        text-shadow: 0 4px 15px rgba(0,0,0,0.3);
        margin-bottom: 10px;
        letter-spacing: 3px;
    }

    .airport-name {
        color: rgba(255,255,255,0.9);
        font-size: 1.1rem;
        font-weight: 500;
    }

    .route-visual {
        flex: 0 0 200px;
        text-align: center;
        position: relative;
    }

    .plane-icon {
        font-size: 3rem;
        color: white;
        animation: flyPlane 3s infinite;
    }

    .route-line {
        height: 3px;
        background: linear-gradient(90deg, 
            rgba(255,255,255,0.3) 0%, 
            rgba(255,255,255,0.8) 50%, 
            rgba(255,255,255,0.3) 100%
        );
        margin: 15px 0;
        position: relative;
    }

    .route-line::after {
        content: '';
        position: absolute;
        right: 0;
        top: -5px;
        width: 0;
        height: 0;
        border-left: 10px solid rgba(255,255,255,0.8);
        border-top: 6px solid transparent;
        border-bottom: 6px solid transparent;
    }

    .flight-duration {
        color: rgba(255,255,255,0.9);
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* Flight Details Grid */
    .details-section {
        padding: 50px 40px;
        background: #F9FAFB;
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .detail-card {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        border-left: 5px solid var(--info);
        transition: all 0.3s ease;
    }

    .detail-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .detail-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #3B82F6 0%, #4F46E5 100%);
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
        margin-bottom: 8px;
        font-weight: 600;
    }

    .detail-value {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--dark);
    }

    .price-card {
        grid-column: span 2;
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
        border: none;
    }

    .price-card .detail-icon {
        background: rgba(255,255,255,0.2);
    }

    .price-card .detail-label {
        color: rgba(255,255,255,0.9);
    }

    .price-card .detail-value {
        color: white;
        font-size: 2.5rem;
    }

    /* Availability Card */
    .availability-card {
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        margin-bottom: 30px;
    }

    .availability-title {
        font-size: 1.1rem;
        color: #6B7280;
        margin-bottom: 10px;
    }

    .seats-display {
        font-size: 3rem;
        font-weight: 900;
        background: linear-gradient(135deg, #3B82F6 0%, #4F46E5 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .seats-label {
        font-size: 1.2rem;
        color: var(--dark);
        font-weight: 600;
    }

    /* Action Section */
    .action-section {
        padding: 40px;
        background: white;
        border-top: 2px dashed #CBD5E1;
    }

    .auth-alert {
        background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
        border-left: 5px solid #F59E0B;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .alert-icon {
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

    .alert-text {
        flex: 1;
    }

    .alert-text p {
        color: #78350F;
        margin: 0;
        font-size: 1.1rem;
    }

    .alert-text a {
        color: #92400E;
        font-weight: 700;
        text-decoration: underline;
    }

    .action-buttons {
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

    /* Additional Info */
    .info-section {
        padding: 40px;
        background: linear-gradient(135deg, #F0FDF4 0%, #DCFCE7 100%);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .info-item {
        text-align: center;
        padding: 20px;
        background: white;
        border-radius: 12px;
    }

    .info-item-icon {
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .info-item-text {
        font-size: 0.9rem;
        color: #6B7280;
        font-weight: 600;
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

    @keyframes flyPlane {
        0%, 100% {
            transform: translateX(0) translateY(0);
        }
        50% {
            transform: translateX(10px) translateY(-5px);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.8rem;
        }

        .flight-route {
            flex-direction: column;
            gap: 30px;
        }

        .route-visual {
            order: 2;
        }

        .plane-icon {
            transform: rotate(90deg);
        }

        .route-line {
            width: 3px;
            height: 80px;
            margin: 0 auto;
        }

        .route-line::after {
            left: -5px;
            bottom: 0;
            top: auto;
            right: auto;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 10px solid rgba(255,255,255,0.8);
            border-bottom: none;
        }

        .airport-code {
            font-size: 2.5rem;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }

        .price-card {
            grid-column: span 1;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-custom {
            min-width: auto;
        }
    }
</style>

<div class="detail-wrapper">
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">✈️ Chi Tiết Chuyến Bay</h1>
        <div class="flight-number-badge">{{ $flight->flight_number }}</div>
    </div>

    <!-- Main Flight Card -->
    <div class="flight-card">
        <!-- Route Section -->
        <div class="route-section">
            <div class="flight-route">
                <!-- Departure -->
                <div class="airport-info">
                    <div class="airport-code">{{ $flight->departureAirport->code }}</div>
                    <div class="airport-name">{{ $flight->departureAirport->name }}</div>
                </div>

                <!-- Flight Visual -->
                <div class="route-visual">
                    <div class="plane-icon">✈️</div>
                    <div class="route-line"></div>
                    <div class="flight-duration">Direct Flight</div>
                </div>

                <!-- Arrival -->
                <div class="airport-info">
                    <div class="airport-code">{{ $flight->arrivalAirport->code }}</div>
                    <div class="airport-name">{{ $flight->arrivalAirport->name }}</div>
                </div>
            </div>
        </div>

        <!-- Details Section -->
        <div class="details-section">
            <div class="section-title">
                📋 Thông tin chuyến bay
            </div>

            <div class="details-grid">
                <!-- Departure Time -->
                <div class="detail-card">
                    <div class="detail-icon">🛫</div>
                    <div class="detail-label">Thời gian khởi hành</div>
                    <div class="detail-value">{{ $flight->departure_time }}</div>
                </div>

                <!-- Arrival Time -->
                <div class="detail-card">
                    <div class="detail-icon">🛬</div>
                    <div class="detail-label">Thời gian hạ cánh</div>
                    <div class="detail-value">{{ $flight->arrival_time }}</div>
                </div>

                <!-- Available Seats -->
                <div class="detail-card">
                    <div class="detail-icon">💺</div>
                    <div class="detail-label">Ghế còn trống</div>
                    <div class="detail-value">{{ $flight->available_seats }} ghế</div>
                </div>

                <!-- Price -->
                <div class="detail-card price-card">
                    <div class="detail-icon">💰</div>
                    <div class="detail-label">Giá vé</div>
                    <div class="detail-value">${{ number_format($flight->price, 2) }}</div>
                </div>
            </div>

            <!-- Availability Display -->
            <div class="availability-card">
                <div class="availability-title">Số ghế còn lại</div>
                <div class="seats-display">{{ $flight->available_seats }}</div>
                <div class="seats-label">Ghế trống</div>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="info-section">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-item-icon">🎒</div>
                    <div class="info-item-text">Hành lý xách tay: 7kg</div>
                </div>
                <div class="info-item">
                    <div class="info-item-icon">🧳</div>
                    <div class="info-item-text">Hành lý ký gửi: 20kg</div>
                </div>
                <div class="info-item">
                    <div class="info-item-icon">🍽️</div>
                    <div class="info-item-text">Bữa ăn miễn phí</div>
                </div>
                <div class="info-item">
                    <div class="info-item-icon">📶</div>
                    <div class="info-item-text">WiFi trên máy bay</div>
                </div>
            </div>
        </div>

        <!-- Action Section -->
        <div class="action-section">
            @auth
                <div class="action-buttons">
                    <a href="{{ route('bookings.create', $flight->id) }}" class="btn-custom btn-success-custom">
                        <span>🎫</span>
                        Đặt vé ngay
                    </a>
                    <a href="{{ route('flights.index') }}" class="btn-custom btn-secondary-custom">
                        <span>←</span>
                        Quay lại danh sách
                    </a>
                </div>
            @else
                <div class="auth-alert">
                    <div class="alert-icon">⚠️</div>
                    <div class="alert-text">
                        <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để đặt vé chuyến bay này.</p>
                    </div>
                </div>
                <div class="action-buttons">
                    <a href="{{ route('login') }}" class="btn-custom btn-success-custom">
                        <span>🔐</span>
                        Đăng nhập ngay
                    </a>
                    <a href="{{ route('flights.index') }}" class="btn-custom btn-secondary-custom">
                        <span>←</span>
                        Quay lại danh sách
                    </a>
                </div>
            @endauth
        </div>
    </div>
</div>

@endsection