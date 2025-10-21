@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #2563EB;
        --secondary: #3B82F6;
        --success: #10B981;
        --warning: #F59E0B;
        --danger: #EF4444;
        --dark: #1F2937;
    }

    body {
        background: url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1920&q=80') center/cover fixed;
        min-height: 100vh;
        font-family: 'Inter', 'Segoe UI', sans-serif;
        position: relative;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(2px);
        z-index: -1;
    }

    .bookings-wrapper {
        padding: 80px 20px;
        max-width: 1400px;
        margin: 0 auto;
        position: relative;
    }

    /* Header Section */
    .page-header {
        text-align: center;
        margin-bottom: 60px;
        animation: fadeInDown 0.8s ease;
        position: relative;
        z-index: 10;
    }

    .page-title {
        font-size: 3.5rem;
        font-weight: 900;
        color: white;
        text-shadow: 0 4px 30px rgba(0,0,0,0.5), 0 2px 10px rgba(0,0,0,0.3);
        margin-bottom: 20px;
        letter-spacing: -1px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
    }

    .page-title-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #2563EB, #3B82F6);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 35px;
        box-shadow: 0 10px 40px rgba(37, 99, 235, 0.4);
    }

    .page-subtitle {
        font-size: 1.3rem;
        color: rgba(255,255,255,0.95);
        font-weight: 400;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    /* Alert Messages */
    .alert-custom {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border-radius: 18px;
        padding: 22px 28px;
        margin-bottom: 40px;
        box-shadow: 0 15px 50px rgba(0,0,0,0.25);
        display: flex;
        align-items: center;
        gap: 18px;
        animation: slideInRight 0.6s ease;
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .alert-success-custom {
        border-left: 5px solid var(--success);
    }

    .alert-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--success), #059669);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .alert-text {
        font-size: 1.05rem;
        color: var(--dark);
        font-weight: 500;
    }

    /* Empty State */
    .empty-state {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(30px);
        border-radius: 30px;
        padding: 100px 50px;
        text-align: center;
        box-shadow: 0 25px 80px rgba(0,0,0,0.3);
        animation: fadeInUp 0.8s ease;
        border: 1px solid rgba(255, 255, 255, 0.6);
    }

    .empty-icon {
        width: 140px;
        height: 140px;
        margin: 0 auto 40px;
        background: linear-gradient(135deg, #2563EB, #3B82F6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
        color: white;
        box-shadow: 0 20px 60px rgba(37, 99, 235, 0.4);
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
    }

    .empty-title {
        font-size: 2.3rem;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 18px;
    }

    .empty-text {
        color: #6B7280;
        font-size: 1.2rem;
        margin-bottom: 40px;
        line-height: 1.6;
    }

    /* Booking Card */
    .booking-card {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(30px);
        border-radius: 24px;
        overflow: hidden;
        margin-bottom: 35px;
        box-shadow: 0 15px 60px rgba(0,0,0,0.25);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        animation: fadeInUp 0.6s ease;
        animation-fill-mode: both;
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .booking-card:hover {
        transform: translateY(-10px) scale(1.01);
        box-shadow: 0 30px 90px rgba(0,0,0,0.35);
    }

    .booking-header {
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.8) 0%, rgba(59, 130, 246, 0.8) 100%);
        backdrop-filter: blur(15px);
        padding: 30px 35px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .booking-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 250px;
        height: 250px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }

    .booking-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }

    .flight-number {
        font-size: 2rem;
        font-weight: 800;
        color: white;
        display: flex;
        align-items: center;
        gap: 18px;
        position: relative;
        z-index: 1;
    }

    .flight-icon {
        width: 60px;
        height: 60px;
        background: rgba(255,255,255,0.25);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .status-badge {
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        z-index: 1;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .status-confirmed {
        background: linear-gradient(135deg, var(--success), #059669);
        color: white;
    }

    .status-pending {
        background: linear-gradient(135deg, var(--warning), #D97706);
        color: white;
    }

    .status-cancelled {
        background: linear-gradient(135deg, var(--danger), #DC2626);
        color: white;
    }

    .booking-body {
        padding: 40px 35px;
    }

    .flight-route {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 40px;
        padding: 30px;
        background: rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 2px dashed rgba(37, 99, 235, 0.3);
    }

    .route-point {
        text-align: center;
        flex: 1;
    }

    .route-city {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 8px;
    }

    .route-label {
        font-size: 0.9rem;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .route-arrow {
        font-size: 3rem;
        color: var(--primary);
        margin: 0 30px;
        animation: slideRight 2s ease-in-out infinite;
    }

    @keyframes slideRight {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(10px); }
    }

    .booking-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 30px;
        margin-bottom: 30px;
    }

    .detail-item {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        padding: 25px;
        border-radius: 18px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        transition: all 0.3s ease;
    }

    .detail-item:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.35);
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.2);
    }

    .detail-label {
        font-size: 0.85rem;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        font-weight: 700;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .detail-value {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .detail-icon {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, #2563EB, #3B82F6);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
    }

    .price-highlight {
        color: var(--primary);
        font-size: 2rem;
        font-weight: 900;
    }

    /* Action Buttons */
    .booking-actions {
        display: flex;
        gap: 18px;
        padding-top: 25px;
        border-top: 2px solid rgba(255, 255, 255, 0.3);
    }

    .btn-custom {
        flex: 1;
        padding: 18px 35px;
        border: none;
        border-radius: 14px;
        font-weight: 700;
        font-size: 1.05rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        letter-spacing: 0.5px;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #2563EB, #3B82F6);
        color: white;
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
    }

    .btn-primary-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(37, 99, 235, 0.6);
        color: white;
    }

    .btn-outline-custom {
        background: white;
        color: var(--primary);
        border: 2px solid var(--primary);
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.15);
    }

    .btn-outline-custom:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
    }

    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(60px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 2.2rem;
            flex-direction: column;
            gap: 15px;
        }

        .page-title-icon {
            width: 60px;
            height: 60px;
            font-size: 30px;
        }

        .booking-header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .flight-route {
            flex-direction: column;
            gap: 20px;
        }

        .route-arrow {
            transform: rotate(90deg);
            margin: 10px 0;
        }

        .booking-details {
            grid-template-columns: 1fr;
        }

        .booking-actions {
            flex-direction: column;
        }

        .empty-state {
            padding: 60px 30px;
        }
    }

    /* Stagger Animation */
    .booking-card:nth-child(1) { animation-delay: 0.1s; }
    .booking-card:nth-child(2) { animation-delay: 0.2s; }
    .booking-card:nth-child(3) { animation-delay: 0.3s; }
    .booking-card:nth-child(4) { animation-delay: 0.4s; }
    .booking-card:nth-child(5) { animation-delay: 0.5s; }
</style>

<div class="bookings-wrapper">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <div class="page-title-icon">✈️</div>
            Chuyến Bay Của Tôi
        </h1>
        <p class="page-subtitle">Quản lý và theo dõi các chuyến bay của bạn</p>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert-custom alert-success-custom">
            <div class="alert-icon">✓</div>
            <div class="alert-text">{{ session('success') }}</div>
        </div>
    @endif

    <!-- Empty State -->
    @if($bookings->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">✈️</div>
            <h2 class="empty-title">Chưa có chuyến bay nào</h2>
            <p class="empty-text">Bạn chưa đặt vé nào. Hãy bắt đầu khám phá những chuyến bay tuyệt vời!</p>
            <a href="{{ route('flights.index') }}" class="btn-custom btn-primary-custom" style="max-width: 350px; margin: 0 auto;">
                <span>🔍</span>
                Tìm chuyến bay ngay
            </a>
        </div>
    @else
        <!-- Bookings List -->
        @foreach ($bookings as $booking)
            <div class="booking-card">
                <!-- Card Header -->
                <div class="booking-header">
                    <div class="flight-number">
                        <div class="flight-icon">✈️</div>
                        <span>{{ $booking->flight->flight_number }}</span>
                    </div>
                    <span class="status-badge status-{{ strtolower($booking->status) }}">
                        {{ $booking->status }}
                    </span>
                </div>

                <!-- Card Body -->
                <div class="booking-body">
                    <!-- Flight Route -->
                    <div class="flight-route">
                        <div class="route-point">
                            <div class="route-city">{{ $booking->flight->departure ?? 'N/A' }}</div>
                            <div class="route-label">🛫 Khởi hành</div>
                        </div>
                        <div class="route-arrow">→</div>
                        <div class="route-point">
                            <div class="route-city">{{ $booking->flight->arrival ?? 'N/A' }}</div>
                            <div class="route-label">🛬 Đến nơi</div>
                        </div>
                    </div>

                    <!-- Booking Details Grid -->
                    <div class="booking-details">
                        <!-- Seats -->
                        <div class="detail-item">
                            <div class="detail-label">💺 Số ghế đặt</div>
                            <div class="detail-value">
                                <div class="detail-icon">🎫</div>
                                <span>{{ $booking->seats }}</span>
                            </div>
                        </div>

                        <!-- Total Price -->
                        <div class="detail-item">
                            <div class="detail-label">💰 Tổng tiền</div>
                            <div class="detail-value price-highlight">
                                ${{ number_format($booking->total_price, 2) }}
                            </div>
                        </div>

                        <!-- Booking Date -->
                        <div class="detail-item">
                            <div class="detail-label">📅 Ngày đặt vé</div>
                            <div class="detail-value">
                                <div class="detail-icon">📆</div>
                                <span>{{ $booking->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>

                        <!-- Flight Date -->
                        <div class="detail-item">
                            <div class="detail-label">🕐 Giờ khởi hành</div>
                            <div class="detail-value">
                                <div class="detail-icon">⏰</div>
                                <span>{{ $booking->flight->departure_time ?? 'TBA' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="booking-actions">
                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn-custom btn-primary-custom">
                            <span>👁️</span>
                            Xem chi tiết
                        </a>
                        <a href="{{ route('flights.index') }}" class="btn-custom btn-outline-custom">
                            <span>🔍</span>
                            Đặt thêm chuyến bay
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection