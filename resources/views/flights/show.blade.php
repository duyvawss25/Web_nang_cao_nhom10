@extends('layouts.app')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: 
            linear-gradient(135deg, rgba(10, 25, 47, 0.7) 0%, rgba(20, 40, 70, 0.75) 50%, rgba(15, 52, 96, 0.7) 100%),
            url('https://images.unsplash.com/photo-1464037866556-6812c9d1c72e?w=1920&q=80') center/cover fixed;
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        padding: 30px 20px;
        position: relative;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 50%, rgba(14, 165, 233, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(59, 130, 246, 0.15) 0%, transparent 50%);
        pointer-events: none;
        z-index: 0;
    }

    .container-fluid {
        max-width: 1400px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    /* Header */
    .page-header {
        text-align: center;
        margin-bottom: 35px;
        animation: slideDown 0.7s ease;
    }

    .page-title {
        font-size: 2.8rem;
        font-weight: 800;
        background: linear-gradient(135deg, #ffffff 0%, #e0f2fe 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 15px;
        letter-spacing: -0.5px;
        text-shadow: 0 0 30px rgba(255, 255, 255, 0.3);
    }

    .subtitle {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.1rem;
        font-weight: 500;
    }

    /* Main Grid Layout */
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 25px;
        margin-bottom: 25px;
    }

    /* Glass Card Base */
    .glass-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(25px) saturate(180%);
        -webkit-backdrop-filter: blur(25px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 24px;
        box-shadow: 
            0 8px 32px rgba(0, 0, 0, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        overflow: hidden;
        animation: fadeInUp 0.7s ease;
    }

    /* Main Flight Card */
    .main-flight-card {
        padding: 40px;
    }

    .flight-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, rgba(14, 165, 233, 0.25) 0%, rgba(59, 130, 246, 0.25) 100%);
        backdrop-filter: blur(10px);
        padding: 10px 20px;
        border-radius: 50px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 1px;
        margin-bottom: 30px;
    }

    /* Route Section */
    .route-display {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 40px;
        padding: 35px;
        background: linear-gradient(135deg, rgba(14, 165, 233, 0.15) 0%, rgba(59, 130, 246, 0.15) 100%);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .airport-box {
        flex: 1;
        text-align: center;
    }

    .airport-code {
        font-size: 3.5rem;
        font-weight: 900;
        color: white;
        margin-bottom: 10px;
        letter-spacing: 3px;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .airport-name {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.85);
        font-weight: 500;
    }

    .route-middle {
        flex: 0 0 200px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }

    .plane-animated {
        font-size: 3rem;
        animation: planeMove 3s ease-in-out infinite;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
    }

    .flight-path-line {
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, 
            rgba(255, 255, 255, 0.3) 0%, 
            rgba(255, 255, 255, 0.9) 50%, 
            rgba(255, 255, 255, 0.3) 100%
        );
        position: relative;
    }

    .flight-path-line::after {
        content: '';
        position: absolute;
        right: -3px;
        top: -6px;
        width: 0;
        height: 0;
        border-left: 12px solid rgba(255, 255, 255, 0.9);
        border-top: 7px solid transparent;
        border-bottom: 7px solid transparent;
    }

    .flight-type {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Info Grid */
    .info-section {
        margin-bottom: 30px;
    }

    .section-label {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 15px;
    }

    .info-item {
        background: rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(10px);
        padding: 20px;
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(14, 165, 233, 0.2);
    }

    .info-item-icon {
        font-size: 1.8rem;
        margin-bottom: 10px;
    }

    .info-item-label {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.7);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .info-item-value {
        font-size: 1.5rem;
        color: white;
        font-weight: 800;
    }

    /* Features Grid */
    .features-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .feature-badge {
        background: rgba(16, 185, 129, 0.15);
        backdrop-filter: blur(10px);
        padding: 15px;
        border-radius: 12px;
        border: 1px solid rgba(16, 185, 129, 0.3);
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.3s ease;
    }

    .feature-badge:hover {
        background: rgba(16, 185, 129, 0.25);
        transform: translateX(5px);
    }

    .feature-icon {
        font-size: 1.5rem;
    }

    .feature-text {
        color: rgba(255, 255, 255, 0.95);
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* Sidebar */
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* Price Card */
    .price-card {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.25) 0%, rgba(5, 150, 105, 0.25) 100%);
        backdrop-filter: blur(25px);
        border: 1px solid rgba(16, 185, 129, 0.3);
        padding: 35px;
        border-radius: 24px;
        text-align: center;
        box-shadow: 0 8px 32px rgba(16, 185, 129, 0.15);
    }

    .price-label {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .price-amount {
        font-size: 3.5rem;
        font-weight: 900;
        color: white;
        text-shadow: 0 4px 20px rgba(16, 185, 129, 0.4);
        margin-bottom: 15px;
    }

    .price-note {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
    }

    /* Availability Card */
    .availability-card {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.2) 100%);
        backdrop-filter: blur(25px);
        border: 1px solid rgba(59, 130, 246, 0.3);
        padding: 30px;
        border-radius: 24px;
        text-align: center;
    }

    .availability-title {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .seats-number {
        font-size: 4rem;
        font-weight: 900;
        color: white;
        text-shadow: 0 4px 20px rgba(59, 130, 246, 0.5);
        margin-bottom: 10px;
        line-height: 1;
    }

    .seats-text {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
        font-weight: 600;
    }

    /* Quick Info */
    .quick-info {
        background: rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        padding: 25px;
        border-radius: 20px;
    }

    .quick-info-title {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .quick-info-list {
        list-style: none;
    }

    .quick-info-list li {
        color: rgba(255, 255, 255, 0.85);
        padding: 10px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .quick-info-list li:last-child {
        border-bottom: none;
    }

    /* Action Buttons */
    .action-section {
        margin-top: 30px;
    }

    .alert-auth {
        background: linear-gradient(135deg, rgba(251, 191, 36, 0.2) 0%, rgba(245, 158, 11, 0.2) 100%);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(251, 191, 36, 0.3);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .alert-icon {
        width: 45px;
        height: 45px;
        background: rgba(251, 191, 36, 0.3);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .alert-text p {
        margin: 0;
        color: rgba(255, 255, 255, 0.95);
        font-size: 0.95rem;
    }

    .alert-text a {
        color: white;
        font-weight: 700;
        text-decoration: underline;
    }

    .btn-group {
        display: flex;
        gap: 12px;
    }

    .btn {
        flex: 1;
        padding: 18px 30px;
        border: none;
        border-radius: 16px;
        font-size: 1.05rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        position: relative;
        overflow: hidden;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn span {
        position: relative;
        z-index: 1;
    }

    .btn-book {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
    }

    .btn-book:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(16, 185, 129, 0.5);
        color: white;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.15);
        color: white;
    }

    /* Similar Flights */
    .similar-flights {
        margin-top: 35px;
    }

    .similar-header {
        color: rgba(255, 255, 255, 0.95);
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-align: center;
    }

    .flights-carousel {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 20px;
    }

    .flight-mini-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 20px;
        padding: 25px;
        transition: all 0.4s ease;
        cursor: pointer;
    }

    .flight-mini-card:hover {
        background: rgba(255, 255, 255, 0.12);
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(14, 165, 233, 0.25);
    }

    .mini-route {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .mini-airport {
        font-size: 1.8rem;
        font-weight: 900;
        color: white;
    }

    .mini-arrow {
        font-size: 1.5rem;
        color: rgba(255, 255, 255, 0.6);
    }

    .mini-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .mini-price {
        font-size: 1.8rem;
        font-weight: 800;
        color: #10B981;
    }

    .mini-seats {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.85rem;
    }

    /* Animations */
    @keyframes slideDown {
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

    @keyframes planeMove {
        0%, 100% {
            transform: translateX(0) translateY(0);
        }
        50% {
            transform: translateX(12px) translateY(-8px);
        }
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }

        .sidebar {
            grid-template-columns: repeat(2, 1fr);
            display: grid;
        }
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .route-display {
            flex-direction: column;
            gap: 25px;
            padding: 25px;
        }

        .route-middle {
            order: 2;
        }

        .plane-animated {
            transform: rotate(90deg);
            font-size: 2.5rem;
        }

        .flight-path-line {
            width: 3px;
            height: 70px;
        }

        .flight-path-line::after {
            left: -6px;
            bottom: -3px;
            top: auto;
            right: auto;
            border-left: 7px solid transparent;
            border-right: 7px solid transparent;
            border-top: 12px solid rgba(255, 255, 255, 0.9);
            border-bottom: none;
        }

        .airport-code {
            font-size: 2.5rem;
        }

        .info-row {
            grid-template-columns: 1fr;
        }

        .features-grid {
            grid-template-columns: 1fr;
        }

        .sidebar {
            grid-template-columns: 1fr;
        }

        .btn-group {
            flex-direction: column;
        }

        .flights-carousel {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container-fluid">
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">✈️ Chi Tiết Chuyến Bay</h1>
        <p class="subtitle">Thông tin đầy đủ về chuyến bay của bạn</p>
    </div>

    <!-- Main Layout -->
    <div class="detail-grid">
        <!-- Main Content -->
        <div class="glass-card main-flight-card">
            <div class="flight-badge">
                <span>✈️</span>
                <span>{{ $flight->flight_number }}</span>
            </div>

            <!-- Route Display -->
            <div class="route-display">
                <div class="airport-box">
                    <div class="airport-code">{{ $flight->departureAirport->code }}</div>
                    <div class="airport-name">{{ $flight->departureAirport->name }}</div>
                </div>

                <div class="route-middle">
                    <div class="plane-animated">✈️</div>
                    <div class="flight-path-line"></div>
                    <div class="flight-type">Direct Flight</div>
                </div>

                <div class="airport-box">
                    <div class="airport-code">{{ $flight->arrivalAirport->code }}</div>
                    <div class="airport-name">{{ $flight->arrivalAirport->name }}</div>
                </div>
            </div>

            <!-- Flight Info -->
            <div class="info-section">
                <div class="section-label">📋 Thông tin chuyến bay</div>
                <div class="info-row">
                    <div class="info-item">
                        <div class="info-item-icon">🛫</div>
                        <div class="info-item-label">Khởi hành</div>
                        <div class="info-item-value">{{ $flight->departure_time }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-item-icon">🛬</div>
                        <div class="info-item-label">Hạ cánh</div>
                        <div class="info-item-value">{{ $flight->arrival_time }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-item-icon">⏱️</div>
                        <div class="info-item-label">Thời gian bay</div>
                        <div class="info-item-value">2h 30m</div>
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="info-section">
                <div class="section-label">✨ Tiện ích chuyến bay</div>
                <div class="features-grid">
                    <div class="feature-badge">
                        <span class="feature-icon">🎒</span>
                        <span class="feature-text">Hành lý xách tay 7kg</span>
                    </div>
                    <div class="feature-badge">
                        <span class="feature-icon">🧳</span>
                        <span class="feature-text">Hành lý ký gửi 20kg</span>
                    </div>
                    <div class="feature-badge">
                        <span class="feature-icon">🍽️</span>
                        <span class="feature-text">Bữa ăn miễn phí</span>
                    </div>
                    <div class="feature-badge">
                        <span class="feature-icon">📶</span>
                        <span class="feature-text">WiFi trên máy bay</span>
                    </div>
                    <div class="feature-badge">
                        <span class="feature-icon">🎬</span>
                        <span class="feature-text">Giải trí cá nhân</span>
                    </div>
                    <div class="feature-badge">
                        <span class="feature-icon">🔌</span>
                        <span class="feature-text">Cổng sạc USB</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-section">
                @auth
                    <div class="btn-group">
                        <a href="{{ route('bookings.create', $flight->id) }}" class="btn btn-book">
                            <span>🎫 Đặt vé ngay</span>
                        </a>
                        <a href="{{ route('flights.index') }}" class="btn btn-back">
                            <span>← Quay lại</span>
                        </a>
                    </div>
                @else
                    <div class="alert-auth">
                        <div class="alert-icon">⚠️</div>
                        <div class="alert-text">
                            <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để đặt vé chuyến bay này</p>
                        </div>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('login') }}" class="btn btn-book">
                            <span>🔐 Đăng nhập</span>
                        </a>
                        <a href="{{ route('flights.index') }}" class="btn btn-back">
                            <span>← Quay lại</span>
                        </a>
                    </div>
                @endauth
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Price Card -->
            <div class="glass-card price-card">
                <div class="price-label">Giá vé</div>
                <div class="price-amount">${{ number_format($flight->price, 2) }}</div>
                <div class="price-note">Đã bao gồm thuế và phí</div>
            </div>

            <!-- Availability -->
            <div class="glass-card availability-card">
                <div class="availability-title">Số ghế còn lại</div>
                <div class="seats-number">{{ $flight->available_seats }}</div>
                <div class="seats-text">Ghế trống</div>
            </div>

            <!-- Quick Info -->
            <div class="glass-card quick-info">
                <div class="quick-info-title">📌 Lưu ý quan trọng</div>
                <ul class="quick-info-list">
                    <li>✓ Check-in trước 2 giờ</li>
                    <li>✓ Mang theo CMND/CCCD</li>
                    <li>✓ Có thể đổi vé trước 24h</li>
                    <li>✓ Hoàn tiền 70% nếu hủy</li>
                    <li>✓ Tích điểm thành viên</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Similar Flights -->
    <div class="similar-flights">
        <h2 class="similar-header">🔥 Chuyến bay tương tự</h2>
        <div class="flights-carousel">
            <div class="glass-card flight-mini-card">
                <div class="mini-route">
                    <span class="mini-airport">HAN</span>
                    <span class="mini-arrow">→</span>
                    <span class="mini-airport">SGN</span>
                </div>
                <div class="mini-details">
                    <div class="mini-price">$85.00</div>
                    <div class="mini-seats">45 ghế trống</div>
                </div>
            </div>

            <div class="glass-card flight-mini-card">
                <div class="mini-route">
                    <span class="mini-airport">HAN</span>
                    <span class="mini-arrow">→</span>
                    <span class="mini-airport">DAD</span>
                </div>
                <div class="mini-details">
                    <div class="mini-price">$72.00</div>
                    <div class="mini-seats">38 ghế trống</div>
                </div>
            </div>

            <div class="glass-card flight-mini-card">
                <div class="mini-route">
                    <span class="mini-airport">HAN</span>
                    <span class="mini-arrow">→</span>
                    <span class="mini-airport">PQC</span>
                </div>
                <div class="mini-details">
                    <div class="mini-price">$95.00</div>
                    <div class="mini-seats">52 ghế trống</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection