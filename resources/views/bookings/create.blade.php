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
            linear-gradient(135deg, rgba(79, 70, 229, 0.9) 0%, rgba(124, 58, 237, 0.9) 100%),
            url('https://images.unsplash.com/photo-1464037866556-6812c9d1c72e?w=1920&q=80') center/cover fixed;
        min-height: 100vh;
        font-family: 'Inter', 'Segoe UI', sans-serif;
        padding: 40px 20px;
    }

    .booking-container {
        max-width: 900px;
        margin: 0 auto;
    }

    /* Header Section */
    .booking-header {
        text-align: center;
        margin-bottom: 40px;
        animation: fadeInDown 0.8s ease;
    }

    .booking-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: white;
        text-shadow: 0 4px 20px rgba(0,0,0,0.4);
        margin-bottom: 10px;
    }

    .flight-badge {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        padding: 12px 30px;
        border-radius: 50px;
        color: white;
        font-size: 1.3rem;
        font-weight: 700;
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        animation: pulse 2s infinite;
    }

    /* Main Card */
    .booking-card {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        animation: fadeInUp 0.8s ease;
        margin-bottom: 30px;
    }

    .card-header-custom {
        background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        padding: 40px;
        position: relative;
        overflow: hidden;
    }

    .card-header-custom::before {
        content: '✈️';
        position: absolute;
        font-size: 200px;
        opacity: 0.1;
        right: -30px;
        top: -50px;
        transform: rotate(-15deg);
    }

    .card-header-title {
        font-size: 2rem;
        font-weight: 700;
        color: white;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .card-header-subtitle {
        color: rgba(255,255,255,0.9);
        font-size: 1.1rem;
        margin-top: 10px;
        position: relative;
        z-index: 1;
    }

    /* Form Section */
    .booking-form {
        padding: 50px;
    }

    .form-group-custom {
        margin-bottom: 35px;
    }

    .form-label-custom {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 15px;
    }

    .label-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
    }

    .form-control-custom {
        width: 100%;
        padding: 18px 25px;
        border: 2px solid #E5E7EB;
        border-radius: 15px;
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark);
        transition: all 0.3s ease;
        background: #F9FAFB;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: var(--primary);
        background: white;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        transform: scale(1.02);
    }

    /* Seat Selector */
    .seat-selector {
        display: flex;
        align-items: center;
        gap: 20px;
        background: #F9FAFB;
        padding: 25px;
        border-radius: 15px;
        border: 2px solid #E5E7EB;
    }

    .seat-controls {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .seat-btn {
        width: 50px;
        height: 50px;
        border: none;
        border-radius: 12px;
        background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        color: white;
        font-size: 24px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .seat-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 5px 20px rgba(79, 70, 229, 0.4);
    }

    .seat-input {
        width: 100px;
        text-align: center;
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
        border: none;
        background: transparent;
    }

    .seat-info {
        margin-left: auto;
        background: white;
        padding: 12px 20px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .available-seats {
        font-size: 0.9rem;
        color: #6B7280;
        margin: 0;
    }

    .available-count {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--success);
        display: block;
    }

    /* Flight Info Box */
    .flight-info-box {
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        border-left: 5px solid var(--primary);
    }

    .flight-info-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .flight-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
    }

    .flight-detail-item {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .detail-label {
        font-size: 0.85rem;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-value {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--dark);
    }

    /* Action Buttons */
    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 40px;
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

    .btn-primary-custom {
        background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        color: white;
        box-shadow: 0 10px 30px rgba(79, 70, 229, 0.4);
    }

    .btn-primary-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(79, 70, 229, 0.6);
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
    }

    /* Price Display */
    .price-display {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        margin-top: 30px;
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
    }

    .price-label {
        color: rgba(255,255,255,0.9);
        font-size: 1rem;
        margin-bottom: 8px;
    }

    .price-amount {
        color: white;
        font-size: 2.5rem;
        font-weight: 800;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
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

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .booking-title {
            font-size: 1.8rem;
        }

        .booking-form {
            padding: 30px 25px;
        }

        .form-actions {
            flex-direction: column;
        }

        .seat-selector {
            flex-direction: column;
            text-align: center;
        }

        .seat-info {
            margin-left: 0;
        }
    }
</style>

<div class="booking-container">
    <!-- Header -->
    <div class="booking-header">
        <h1 class="booking-title">✈️ Đặt Vé Máy Bay</h1>
        <div class="flight-badge">{{ $flight->flight_number }}</div>
    </div>

    <!-- Main Booking Card -->
    <div class="booking-card">
        <!-- Card Header -->
        <div class="card-header-custom">
            <h2 class="card-header-title">Thông Tin Đặt Chỗ</h2>
            <p class="card-header-subtitle">Vui lòng chọn số ghế bạn muốn đặt</p>
        </div>

        <!-- Form -->
        <form action="{{ route('bookings.store') }}" method="post" class="booking-form">
            @csrf
            <input type="hidden" name="flight_id" value="{{ $flight->id }}">

            <!-- Flight Info Box -->
            <div class="flight-info-box">
                <div class="flight-info-title">
                    <span>📋</span>
                    Chi tiết chuyến bay
                </div>
                <div class="flight-details">
                    <div class="flight-detail-item">
                        <span class="detail-label">🛫 Khởi hành</span>
                        <span class="detail-value">{{ $flight->departure ?? 'N/A' }}</span>
                    </div>
                    <div class="flight-detail-item">
                        <span class="detail-label">🛬 Đến</span>
                        <span class="detail-value">{{ $flight->arrival ?? 'N/A' }}</span>
                    </div>
                    <div class="flight-detail-item">
                        <span class="detail-label">⏰ Thời gian</span>
                        <span class="detail-value">{{ $flight->departure_time ?? 'TBA' }}</span>
                    </div>
                    <div class="flight-detail-item">
                        <span class="detail-label">💵 Giá vé</span>
                        <span class="detail-value">${{ $flight->price ?? '0' }}</span>
                    </div>
                </div>
            </div>

            <!-- Seat Selection -->
            <div class="form-group-custom">
                <label class="form-label-custom">
                    <span class="label-icon">💺</span>
                    Chọn số ghế
                </label>
                
                <div class="seat-selector">
                    <div class="seat-controls">
                        <button type="button" class="seat-btn" onclick="decreaseSeats()">−</button>
                        <input 
                            type="number" 
                            name="seats" 
                            id="seats" 
                            class="seat-input" 
                            min="1" 
                            max="{{ $flight->available_seats }}" 
                            value="1"
                            oninput="updatePrice()"
                            readonly
                        >
                        <button type="button" class="seat-btn" onclick="increaseSeats()">+</button>
                    </div>
                    
                    <div class="seat-info">
                        <p class="available-seats">
                            Còn lại
                            <span class="available-count">{{ $flight->available_seats }}</span>
                            ghế
                        </p>
                    </div>
                </div>
            </div>

            <!-- Price Display -->
            <div class="price-display">
                <p class="price-label">💰 Tổng tiền thanh toán</p>
                <p class="price-amount" id="totalPrice">${{ $flight->price ?? '0' }}</p>
            </div>

            <!-- Action Buttons -->
            <div class="form-actions">
                <button type="submit" class="btn-custom btn-primary-custom">
                    <span>✓</span>
                    Xác nhận đặt vé
                </button>
                <a href="{{ route('flights.show', $flight->id) }}" class="btn-custom btn-secondary-custom">
                    <span>✕</span>
                    Hủy bỏ
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    const pricePerSeat = {{ $flight->price ?? 0 }};
    const maxSeats = {{ $flight->available_seats }};

    function increaseSeats() {
        const input = document.getElementById('seats');
        const currentValue = parseInt(input.value);
        if (currentValue < maxSeats) {
            input.value = currentValue + 1;
            updatePrice();
        }
    }

    function decreaseSeats() {
        const input = document.getElementById('seats');
        const currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
            updatePrice();
        }
    }

    function updatePrice() {
        const seats = parseInt(document.getElementById('seats').value);
        const total = seats * pricePerSeat;
        document.getElementById('totalPrice').textContent = '$' + total.toFixed(2);
    }

    // Initialize price on load
    updatePrice();
</script>

@endsection