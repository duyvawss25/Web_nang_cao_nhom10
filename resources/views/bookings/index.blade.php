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
        --light: #F9FAFB;
    }

    body {
        background: 
            linear-gradient(135deg, rgba(102, 126, 234, 0.85) 0%, rgba(118, 75, 162, 0.85) 100%),
            url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1920&q=80') center/cover fixed;
        min-height: 100vh;
        font-family: 'Inter', 'Segoe UI', sans-serif;
        backdrop-filter: blur(3px);
    }

    .bookings-wrapper {
        padding: 60px 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Header Section */
    .page-header {
        text-align: center;
        margin-bottom: 60px;
        animation: fadeInDown 0.8s ease;
    }

    .page-title {
        font-size: 3rem;
        font-weight: 800;
        color: white;
        text-shadow: 0 4px 20px rgba(0,0,0,0.3);
        margin-bottom: 15px;
        letter-spacing: -1px;
    }

    .page-subtitle {
        font-size: 1.2rem;
        color: rgba(255,255,255,0.9);
        font-weight: 300;
    }

    /* Alert Messages */
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

    .alert-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--success);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 50px;
        color: white;
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
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

    /* Booking Card */
    .booking-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 30px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        animation: fadeInUp 0.6s ease;
        animation-fill-mode: both;
    }

    .booking-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.25);
    }

    .booking-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 25px 30px;
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
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .flight-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .flight-icon {
        width: 50px;
        height: 50px;
        background: rgba(255,255,255,0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .status-badge {
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-confirmed {
        background: var(--success);
        color: white;
    }

    .status-pending {
        background: var(--warning);
        color: white;
    }

    .status-cancelled {
        background: var(--danger);
        color: white;
    }

    .booking-body {
        padding: 30px;
    }

    .booking-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 25px;
        margin-bottom: 25px;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .detail-label {
        font-size: 0.85rem;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .detail-value {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .detail-icon {
        width: 35px;
        height: 35px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
    }

    .price-highlight {
        color: var(--primary);
        font-size: 1.8rem;
    }

    /* Action Buttons */
    .booking-actions {
        display: flex;
        gap: 15px;
        padding-top: 20px;
        border-top: 2px solid #E5E7EB;
    }

    .btn-custom {
        flex: 1;
        padding: 15px 30px;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        color: white;
    }

    .btn-outline-custom {
        background: transparent;
        color: var(--primary);
        border: 2px solid var(--primary);
    }

    .btn-outline-custom:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
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

        .booking-header {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .booking-details {
            grid-template-columns: 1fr;
        }

        .booking-actions {
            flex-direction: column;
        }
    }

    /* Stagger Animation for Cards */
    .booking-card:nth-child(1) { animation-delay: 0.1s; }
    .booking-card:nth-child(2) { animation-delay: 0.2s; }
    .booking-card:nth-child(3) { animation-delay: 0.3s; }
    .booking-card:nth-child(4) { animation-delay: 0.4s; }
    .booking-card:nth-child(5) { animation-delay: 0.5s; }
</style>

<div class="bookings-wrapper">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">✈️ Chuyến Bay Của Tôi</h1>
        <p class="page-subtitle">Quản lý và theo dõi các chuyến bay của bạn</p>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert-custom alert-success-custom">
            <div class="alert-icon">✓</div>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <!-- Empty State -->
    @if($bookings->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">✈️</div>
            <h2 class="empty-title">Chưa có chuyến bay nào</h2>
            <p class="empty-text">Bạn chưa đặt vé nào. Hãy bắt đầu khám phá những chuyến bay tuyệt vời!</p>
            <a href="{{ route('flights.index') }}" class="btn-custom btn-primary-custom" style="max-width: 300px; margin: 0 auto;">
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
                    <div class="booking-details">
                        <!-- Departure -->
                        <div class="detail-item">
                            <span class="detail-label">🛫 Khởi hành</span>
                            <div class="detail-value">
                                <div class="detail-icon">📍</div>
                                <span>{{ $booking->flight->departure ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <!-- Arrival -->
                        <div class="detail-item">
                            <span class="detail-label">🛬 Đến</span>
                            <div class="detail-value">
                                <div class="detail-icon">📍</div>
                                <span>{{ $booking->flight->arrival ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <!-- Seats -->
                        <div class="detail-item">
                            <span class="detail-label">💺 Số ghế</span>
                            <div class="detail-value">
                                <div class="detail-icon">🎫</div>
                                <span>{{ $booking->seats }}</span>
                            </div>
                        </div>

                        <!-- Total Price -->
                        <div class="detail-item">
                            <span class="detail-label">💰 Tổng tiền</span>
                            <div class="detail-value price-highlight">
                                ${{ number_format($booking->total_price, 2) }}
                            </div>
                        </div>

                        <!-- Booking Date -->
                        <div class="detail-item">
                            <span class="detail-label">📅 Ngày đặt</span>
                            <div class="detail-value">
                                <div class="detail-icon">📆</div>
                                <span>{{ $booking->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>

                        <!-- Flight Date -->
                        <div class="detail-item">
                            <span class="detail-label">🕐 Ngày bay</span>
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
                            Đặt thêm chuyến
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection