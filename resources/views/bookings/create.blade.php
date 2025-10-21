@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #2563EB;
        --secondary: #3B82F6;
        --success: #10B981;
        --dark: #1F2937;
    }

    body {
        background: url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1920&q=80') center center fixed;
        background-size: 100% 100%;
        background-repeat: no-repeat;
        min-height: 100vh;
        font-family: 'Inter', 'Segoe UI', sans-serif;
        padding: 60px 20px;
        position: relative;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.35);
        z-index: 0;
    }

    .booking-container {
        max-width: 950px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    /* Header Section */
    .booking-header {
        text-align: center;
        margin-bottom: 50px;
        animation: fadeInDown 0.8s ease;
    }

    .booking-title {
        font-size: 3rem;
        font-weight: 900;
        color: white;
        text-shadow: 0 4px 30px rgba(0,0,0,0.5), 0 2px 10px rgba(0,0,0,0.3);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
    }

    .title-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #2563EB, #3B82F6);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        box-shadow: 0 10px 40px rgba(37, 99, 235, 0.4);
    }

    .flight-badge {
        display: inline-block;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(20px);
        padding: 15px 40px;
        border-radius: 50px;
        color: white;
        font-size: 1.5rem;
        font-weight: 800;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        border: 1px solid rgba(255, 255, 255, 0.3);
        animation: pulse 2s infinite;
    }

    /* Main Card - Glass Effect */
    .booking-card {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(30px);
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 25px 80px rgba(0,0,0,0.35);
        animation: fadeInUp 0.8s ease;
        margin-bottom: 30px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .card-header-custom {
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.85), rgba(59, 130, 246, 0.85));
        backdrop-filter: blur(20px);
        padding: 45px;
        position: relative;
        overflow: hidden;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .card-header-custom::before {
        content: '✈️';
        position: absolute;
        font-size: 250px;
        opacity: 0.08;
        right: -40px;
        top: -60px;
        transform: rotate(-15deg);
    }

    .card-header-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: white;
        margin: 0;
        position: relative;
        z-index: 1;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .card-header-subtitle {
        color: rgba(255,255,255,0.95);
        font-size: 1.15rem;
        margin-top: 12px;
        position: relative;
        z-index: 1;
    }

    /* Form Section */
    .booking-form {
        padding: 50px;
    }

    .form-group-custom {
        margin-bottom: 40px;
    }

    .form-label-custom {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 1.15rem;
        font-weight: 700;
        color: white;
        margin-bottom: 18px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    .label-icon {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #2563EB, #3B82F6);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 22px;
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
    }

    /* Flight Info Box - Glass */
    .flight-info-box {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 35px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 32px rgba(0,0,0,0.15);
    }

    .flight-info-title {
        font-size: 1.2rem;
        font-weight: 800;
        color: white;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    .flight-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
    }

    .flight-detail-item {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        padding: 20px;
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .flight-detail-item:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .detail-label {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.8);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
        display: block;
        font-weight: 600;
    }

    .detail-value {
        font-size: 1.3rem;
        font-weight: 800;
        color: white;
        text-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    /* Seat Map Container */
    .seat-map-container {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        padding: 40px;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 32px rgba(0,0,0,0.15);
    }

    .seat-legend {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: white;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .legend-box {
        width: 35px;
        height: 35px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .legend-available {
        background: rgba(255, 255, 255, 0.25);
        border: 2px solid rgba(255, 255, 255, 0.4);
    }

    .legend-selected {
        background: linear-gradient(135deg, #2563EB, #3B82F6);
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
    }

    .legend-occupied {
        background: rgba(239, 68, 68, 0.6);
        border: 2px solid rgba(239, 68, 68, 0.8);
    }

    /* Airplane Seat Map */
    .airplane-body {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(15px);
        border-radius: 30px;
        padding: 40px 30px;
        max-width: 600px;
        margin: 0 auto;
        border: 2px solid rgba(255, 255, 255, 0.2);
        position: relative;
    }

    .airplane-nose {
        width: 0;
        height: 0;
        border-left: 40px solid transparent;
        border-right: 40px solid transparent;
        border-bottom: 60px solid rgba(255, 255, 255, 0.15);
        margin: 0 auto 30px;
    }

    .cockpit-label {
        text-align: center;
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .seat-rows {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .seat-row {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 12px;
        position: relative;
    }

    .seat-row::after {
        content: '';
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 30px;
        height: 2px;
        background: rgba(255, 255, 255, 0.2);
    }

    .row-label {
        position: absolute;
        left: -35px;
        top: 50%;
        transform: translateY(-50%);
        color: white;
        font-weight: 700;
        font-size: 1rem;
    }

    .seat {
        aspect-ratio: 1;
        border: 2px solid rgba(255, 255, 255, 0.4);
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.85rem;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        user-select: none;
    }

    .seat:hover:not(.occupied):not(.selected) {
        background: rgba(255, 255, 255, 0.35);
        transform: scale(1.1);
        box-shadow: 0 5px 20px rgba(255, 255, 255, 0.2);
    }

    .seat.selected {
        background: linear-gradient(135deg, #2563EB, #3B82F6);
        border-color: #2563EB;
        box-shadow: 0 5px 20px rgba(37, 99, 235, 0.6);
        transform: scale(1.05);
    }

    .seat.occupied {
        background: rgba(239, 68, 68, 0.6);
        border-color: rgba(239, 68, 68, 0.8);
        cursor: not-allowed;
        opacity: 0.7;
    }

    .seat.occupied::after {
        content: '✕';
        position: absolute;
        font-size: 1.2rem;
        color: white;
    }

    /* Selected Seats Summary */
    .selected-seats-summary {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(15px);
        padding: 20px 30px;
        border-radius: 15px;
        margin-top: 30px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .summary-title {
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .selected-seats-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .seat-tag {
        background: linear-gradient(135deg, #2563EB, #3B82F6);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.9rem;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .seat-tag button {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        transition: all 0.2s;
    }

    .seat-tag button:hover {
        background: rgba(255, 255, 255, 0.4);
        transform: scale(1.1);
    }

    .no-seats-selected {
        color: rgba(255, 255, 255, 0.7);
        font-style: italic;
    }

    /* Price Display - Glass */
    .price-display {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.85), rgba(5, 150, 105, 0.85));
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        margin-top: 35px;
        box-shadow: 0 12px 40px rgba(16, 185, 129, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .price-label {
        color: rgba(255,255,255,0.95);
        font-size: 1.1rem;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .price-amount {
        color: white;
        font-size: 3rem;
        font-weight: 900;
        text-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }

    /* Action Buttons */
    .form-actions {
        display: flex;
        gap: 20px;
        margin-top: 45px;
    }

    .btn-custom {
        flex: 1;
        padding: 20px 40px;
        border: none;
        border-radius: 16px;
        font-size: 1.15rem;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        letter-spacing: 0.5px;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #2563EB, #3B82F6);
        color: white;
        box-shadow: 0 10px 35px rgba(37, 99, 235, 0.5);
    }

    .btn-primary-custom:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 50px rgba(37, 99, 235, 0.7);
    }

    .btn-secondary-custom {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(15px);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.4);
        font-weight: 700;
    }

    .btn-secondary-custom:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-4px);
        box-shadow: 0 10px 35px rgba(0,0,0,0.2);
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

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        body {
            padding: 40px 15px;
        }

        .booking-title {
            font-size: 2rem;
            flex-direction: column;
        }

        .title-icon {
            width: 50px;
            height: 50px;
            font-size: 25px;
        }

        .flight-badge {
            font-size: 1.2rem;
            padding: 12px 30px;
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

        .airplane-body {
            padding: 25px 15px;
        }

        .seat-row {
            gap: 8px;
        }

        .row-label {
            left: -25px;
            font-size: 0.9rem;
        }

        .seat {
            font-size: 0.75rem;
        }

        .seat-info {
            margin-left: 0;
            margin-top: 15px;
        }

        .flight-details {
            grid-template-columns: 1fr;
        }

        .price-amount {
            font-size: 2.5rem;
        }
    }
</style>

<div class="booking-container">
    <!-- Header -->
    <div class="booking-header">
        <h1 class="booking-title">
            <div class="title-icon">✈️</div>
            Đặt Vé Máy Bay
        </h1>
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
                    Chọn ghế của bạn
                </label>
                
                <div class="seat-map-container">
                    <!-- Legend -->
                    <div class="seat-legend">
                        <div class="legend-item">
                            <div class="legend-box legend-available">✓</div>
                            <span>Trống</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-box legend-selected">✓</div>
                            <span>Đã chọn</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-box legend-occupied">✕</div>
                            <span>Đã đặt</span>
                        </div>
                    </div>

                    <!-- Airplane Seat Map -->
                    <div class="airplane-body">
                        <div class="airplane-nose"></div>
                        <div class="cockpit-label">🛫 Buồng lái</div>
                        
                        <div class="seat-rows">
                            @php
                                $rows = 8; // Số hàng ghế
                                $columns = ['A', 'B', 'C', 'D', 'E', 'F']; // Cột ghế
                                $occupiedSeats = ['2B', '2E', '3C', '3D', '5A', '5F', '7B']; // Ghế đã đặt (giả lập)
                            @endphp

                            @for ($row = 1; $row <= $rows; $row++)
                                <div class="seat-row">
                                    <span class="row-label">{{ $row }}</span>
                                    @foreach ($columns as $col)
                                        @php
                                            $seatNumber = $row . $col;
                                            $isOccupied = in_array($seatNumber, $occupiedSeats);
                                        @endphp
                                        <div 
                                            class="seat {{ $isOccupied ? 'occupied' : '' }}" 
                                            data-seat="{{ $seatNumber }}"
                                            onclick="toggleSeat('{{ $seatNumber }}', {{ $isOccupied ? 'true' : 'false' }})"
                                        >
                                            {{ $col }}
                                        </div>
                                    @endforeach
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Selected Seats Summary -->
                    <div class="selected-seats-summary">
                        <div class="summary-title">
                            <span>🎫</span>
                            Ghế đã chọn:
                        </div>
                        <div class="selected-seats-list" id="selectedSeatsList">
                            <span class="no-seats-selected">Chưa chọn ghế nào</span>
                        </div>
                    </div>

                    <!-- Hidden input to store selected seats -->
                    <input type="hidden" name="seats" id="selectedSeatsInput" value="">
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
    let selectedSeats = [];

    function toggleSeat(seatNumber, isOccupied) {
        if (isOccupied) {
            return; // Không cho phép chọn ghế đã đặt
        }

        const seatElement = document.querySelector(`[data-seat="${seatNumber}"]`);
        const index = selectedSeats.indexOf(seatNumber);

        if (index > -1) {
            // Bỏ chọn ghế
            selectedSeats.splice(index, 1);
            seatElement.classList.remove('selected');
        } else {
            // Chọn ghế
            if (selectedSeats.length >= maxSeats) {
                alert(`Chỉ có thể chọn tối đa ${maxSeats} ghế!`);
                return;
            }
            selectedSeats.push(seatNumber);
            seatElement.classList.add('selected');
        }

        updateSelectedSeatsDisplay();
        updatePrice();
    }

    function removeSeat(seatNumber) {
        const index = selectedSeats.indexOf(seatNumber);
        if (index > -1) {
            selectedSeats.splice(index, 1);
            const seatElement = document.querySelector(`[data-seat="${seatNumber}"]`);
            if (seatElement) {
                seatElement.classList.remove('selected');
            }
            updateSelectedSeatsDisplay();
            updatePrice();
        }
    }

    function updateSelectedSeatsDisplay() {
        const listContainer = document.getElementById('selectedSeatsList');
        const input = document.getElementById('selectedSeatsInput');

        if (selectedSeats.length === 0) {
            listContainer.innerHTML = '<span class="no-seats-selected">Chưa chọn ghế nào</span>';
            input.value = '';
        } else {
            listContainer.innerHTML = selectedSeats.map(seat => 
                `<div class="seat-tag">
                    ${seat}
                    <button type="button" onclick="removeSeat('${seat}')">×</button>
                </div>`
            ).join('');
            input.value = selectedSeats.join(',');
        }
    }

      function updatePrice() {
        const total = selectedSeats.length * pricePerSeat;
        document.getElementById('totalPrice').textContent = '$' + total.toFixed(2);
    }

    // Initialize price on load
    updatePrice();
</script>

@endsection
