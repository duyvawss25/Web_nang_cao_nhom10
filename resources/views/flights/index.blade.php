@extends('layouts.app')

@section('content')
<style>
:root {
    --primary-blue: #0ea5e9;
    --primary-cyan: #06b6d4;
    --dark-blue: #0c4a6e;
    --light-blue: #e0f2fe;
    --glass-bg: rgba(255, 255, 255, 0.08);
    --glass-border: rgba(255, 255, 255, 0.18);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.flights-wrapper {
    min-height: 100vh;
    background: linear-gradient(rgba(0, 15, 35, 0.75), rgba(0, 30, 60, 0.85)), 
                url('https://images.unsplash.com/photo-1464037866556-6812c9d1c72e?w=1920&q=80') center/cover fixed;
    padding: 2rem 0;
    position: relative;
    overflow: hidden;
}

.flights-wrapper::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 20% 50%, rgba(14, 165, 233, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(6, 182, 212, 0.15) 0%, transparent 50%);
    pointer-events: none;
}

.flights-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1.5rem;
    position: relative;
    z-index: 1;
}

.page-header {
    text-align: center;
    color: white;
    margin-bottom: 3rem;
    animation: fadeInDown 0.8s ease;
}

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

.page-header h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    text-shadow: 0 4px 30px rgba(0,0,0,0.8);
    background: linear-gradient(135deg, #fff 0%, #0ea5e9 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.page-header .subtitle {
    font-size: 1.3rem;
    opacity: 0.95;
    text-shadow: 0 2px 15px rgba(0,0,0,0.8);
    font-weight: 300;
    letter-spacing: 0.5px;
}

.stats-bar {
    display: flex;
    justify-content: center;
    gap: 3rem;
    margin-top: 2rem;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
}

.stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-cyan);
    text-shadow: 0 0 20px rgba(6, 182, 212, 0.5);
}

.stat-label {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.8);
    margin-top: 0.25rem;
}

.search-card {
    background: var(--glass-bg);
    backdrop-filter: blur(30px);
    border: 1px solid var(--glass-border);
    border-radius: 24px;
    padding: 2.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 25px 60px rgba(0,0,0,0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
    animation: fadeInUp 0.8s ease 0.2s backwards;
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

.search-card h2 {
    font-size: 1.6rem;
    font-weight: 700;
    color: white;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.trip-type-selector {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
}

.trip-type-btn {
    flex: 1;
    padding: 0.875rem;
    background: rgba(255, 255, 255, 0.05);
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    color: rgba(255, 255, 255, 0.7);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.trip-type-btn.active {
    background: var(--primary-blue);
    border-color: var(--primary-blue);
    color: white;
    box-shadow: 0 4px 20px rgba(14, 165, 233, 0.4);
}

.search-form {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.25rem;
    align-items: end;
}

.form-field {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-field label {
    font-size: 0.9rem;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.9);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-field input,
.form-field select {
    padding: 1rem 1.25rem;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    font-size: 1rem;
    color: white;
    transition: all 0.3s ease;
}

.form-field input::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.form-field input:focus,
.form-field select:focus {
    outline: none;
    border-color: var(--primary-cyan);
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 0 0 4px rgba(6, 182, 212, 0.2);
}

.btn-search {
    padding: 1rem 2.5rem;
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-cyan) 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    box-shadow: 0 8px 25px rgba(14, 165, 233, 0.4);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-search:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(14, 165, 233, 0.6);
}

.filters-section {
    background: var(--glass-bg);
    backdrop-filter: blur(30px);
    border: 1px solid var(--glass-border);
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
}

.filters-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.filters-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.filters-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.filter-group label {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.8);
    font-weight: 600;
}

.filter-buttons {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.filter-btn {
    padding: 0.625rem 1.25rem;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    font-size: 0.9rem;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.8);
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-btn:hover,
.filter-btn.active {
    background: var(--primary-cyan);
    border-color: var(--primary-cyan);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(6, 182, 212, 0.4);
}

.results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    color: white;
}

.results-count {
    font-size: 1.1rem;
    font-weight: 600;
}

.results-count span {
    color: var(--primary-cyan);
    font-weight: 700;
}

.sort-dropdown {
    padding: 0.75rem 1.25rem;
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    border-radius: 10px;
    color: white;
    font-weight: 600;
    cursor: pointer;
    backdrop-filter: blur(20px);
}

.flights-grid {
    display: grid;
    gap: 1.5rem;
}

.flight-card {
    background: var(--glass-bg);
    backdrop-filter: blur(30px);
    border: 1px solid var(--glass-border);
    border-radius: 24px;
    padding: 2rem;
    box-shadow: 0 15px 50px rgba(0,0,0,0.3);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    animation: fadeInUp 0.6s ease backwards;
    position: relative;
    overflow: hidden;
}

.flight-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-blue) 0%, var(--primary-cyan) 100%);
}

.flight-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 60px rgba(0,0,0,0.4);
    border-color: rgba(255, 255, 255, 0.3);
}

.flight-card:nth-child(1) { animation-delay: 0.1s; }
.flight-card:nth-child(2) { animation-delay: 0.15s; }
.flight-card:nth-child(3) { animation-delay: 0.2s; }
.flight-card:nth-child(4) { animation-delay: 0.25s; }
.flight-card:nth-child(5) { animation-delay: 0.3s; }
.flight-card:nth-child(6) { animation-delay: 0.35s; }

.flight-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.airline-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.airline-logo {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary-blue), var(--primary-cyan));
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    box-shadow: 0 8px 25px rgba(14, 165, 233, 0.3);
}

.airline-details {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.flight-number {
    font-size: 1.4rem;
    font-weight: 800;
    color: white;
}

.airline-name {
    font-size: 0.95rem;
    color: rgba(255, 255, 255, 0.7);
    font-weight: 500;
}

.badges-group {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.badge {
    padding: 0.5rem 1rem;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.badge-available {
    background: rgba(34, 197, 94, 0.2);
    color: #86efac;
    border: 1px solid rgba(34, 197, 94, 0.3);
}

.badge-hot {
    background: rgba(239, 68, 68, 0.2);
    color: #fca5a5;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.badge-wifi {
    background: rgba(59, 130, 246, 0.2);
    color: #93c5fd;
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.flight-route {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 2rem;
    align-items: center;
    margin-bottom: 1.5rem;
}

.airport-info {
    text-align: center;
}

.airport-info.departure {
    text-align: left;
}

.airport-info.arrival {
    text-align: right;
}

.airport-code {
    font-size: 2.5rem;
    font-weight: 800;
    color: white;
    margin-bottom: 0.25rem;
    text-shadow: 0 0 20px rgba(14, 165, 233, 0.5);
}

.airport-time {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.airport-date {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.6);
}

.airport-name {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.5);
    margin-top: 0.25rem;
}

.route-line {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
    padding: 0 1rem;
}

.flight-icon {
    font-size: 2.5rem;
    animation: fly 3s ease-in-out infinite;
    filter: drop-shadow(0 0 10px rgba(14, 165, 233, 0.5));
}

@keyframes fly {
    0%, 100% { transform: translateX(-15px); }
    50% { transform: translateX(15px); }
}

.duration {
    font-size: 1rem;
    color: var(--primary-cyan);
    font-weight: 700;
    background: rgba(6, 182, 212, 0.1);
    padding: 0.5rem 1rem;
    border-radius: 8px;
}

.divider {
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--primary-cyan), transparent);
    position: relative;
}

.divider::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 8px;
    height: 8px;
    background: var(--primary-cyan);
    border-radius: 50%;
    box-shadow: 0 0 10px var(--primary-cyan);
}

.divider::after {
    content: '';
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 8px;
    height: 8px;
    background: var(--primary-cyan);
    border-radius: 50%;
    box-shadow: 0 0 10px var(--primary-cyan);
}

.flight-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 1.25rem;
    margin-bottom: 1.5rem;
    padding: 1.25rem;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.08);
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    text-align: center;
}

.detail-icon {
    font-size: 1.5rem;
}

.detail-label {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.6);
    font-weight: 500;
}

.detail-value {
    font-size: 1.1rem;
    font-weight: 700;
    color: white;
}

.flight-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.price-section {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.price-label {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.6);
}

.price-amount {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--primary-cyan);
    text-shadow: 0 0 20px rgba(6, 182, 212, 0.5);
    display: flex;
    align-items: baseline;
    gap: 0.5rem;
}

.price-currency {
    font-size: 1.5rem;
}

.action-buttons {
    display: flex;
    gap: 1rem;
}

.btn {
    padding: 1rem 2rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 700;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-blue), var(--primary-cyan));
    color: white;
    box-shadow: 0 8px 25px rgba(14, 165, 233, 0.4);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(14, 165, 233, 0.6);
}

.btn-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-secondary:hover {
    background: rgba(255, 255, 255, 0.15);
    border-color: rgba(255, 255, 255, 0.3);
}

.no-flights {
    background: var(--glass-bg);
    backdrop-filter: blur(30px);
    border: 1px solid var(--glass-border);
    border-radius: 24px;
    padding: 5rem 2rem;
    text-align: center;
    box-shadow: 0 15px 50px rgba(0,0,0,0.3);
}

.no-flights-icon {
    font-size: 6rem;
    margin-bottom: 1.5rem;
    opacity: 0.3;
}

.no-flights h3 {
    font-size: 2rem;
    color: white;
    margin-bottom: 1rem;
    font-weight: 700;
}

.no-flights p {
    color: rgba(255, 255, 255, 0.7);
    font-size: 1.1rem;
}

.pagination-wrapper {
    margin-top: 2.5rem;
    display: flex;
    justify-content: center;
}

.quick-filters {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 2rem;
}

.quick-filter-chip {
    padding: 0.75rem 1.5rem;
    background: var(--glass-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    border-radius: 50px;
    color: white;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.quick-filter-chip:hover {
    background: var(--primary-cyan);
    border-color: var(--primary-cyan);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(6, 182, 212, 0.4);
}

@media (max-width: 768px) {
    .page-header h1 {
        font-size: 2.5rem;
    }
    
    .stats-bar {
        gap: 1.5rem;
    }
    
    .stat-value {
        font-size: 1.5rem;
    }
    
    .search-form {
        grid-template-columns: 1fr;
    }
    
    .trip-type-selector {
        flex-direction: column;
    }
    
    .flight-route {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .route-line {
        transform: rotate(90deg);
    }
    
    .airport-info.departure,
    .airport-info.arrival {
        text-align: center;
    }
    
    .flight-details {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .flight-footer {
        flex-direction: column;
        align-items: stretch;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .filters-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="flights-wrapper">
    <div class="flights-container">
        <div class="page-header">
            <h1>✈️ Đặt Vé Máy Bay Trực Tuyến</h1>
            <p class="subtitle">Khám phá hàng ngàn chuyến bay với giá tốt nhất mỗi ngày</p>
            
            <div class="stats-bar">
                <div class="stat-item">
                    <div class="stat-value">250+</div>
                    <div class="stat-label">Chuyến bay mỗi ngày</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">50+</div>
                    <div class="stat-label">Điểm đến</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">1M+</div>
                    <div class="stat-label">Khách hàng hài lòng</div>
                </div>
            </div>
        </div>

        <div class="search-card">
            <h2>
                <span>🔍</span>
                Tìm chuyến bay phù hợp với bạn
            </h2>
            
            <div class="trip-type-selector">
                <button class="trip-type-btn active">🔄 Khứ hồi</button>
                <button class="trip-type-btn">➡️ Một chiều</button>
                <button class="trip-type-btn">🌐 Nhiều thành phố</button>
            </div>

            <form method="get" action="{{ route('flights.index') }}" class="search-form">
                <div class="form-field">
                    <label>
                        <span>🛫</span>
                        Điểm khởi hành
                    </label>
                    <input type="text" name="from" placeholder="HAN - Hà Nội" value="{{ request('from') }}">
                </div>

                <div class="form-field">
                    <label>
                        <span>🛬</span>
                        Điểm đến
                    </label>
                    <input type="text" name="to" placeholder="SGN - Hồ Chí Minh" value="{{ request('to') }}">
                </div>

                <div class="form-field">
                    <label>
                        <span>📅</span>
                        Ngày đi
                    </label>
                    <input type="date" name="date" value="{{ request('date') }}">
                </div>

                <div class="form-field">
                    <label>
                        <span>👥</span>
                        Hành khách
                    </label>
                    <select name="passengers">
                        <option>1 người</option>
                        <option>2 người</option>
                        <option>3 người</option>
                        <option>4+ người</option>
                    </select>
                </div>

                <button type="submit" class="btn-search">
                    <span>🔎</span>
                    Tìm kiếm
                </button>
            </form>
        </div>

        @if(request()->has('from') || request()->has('to') || request()->has('date'))
        <div class="quick-filters">
            <div class="quick-filter-chip">⚡ Bay sớm (6h-12h)</div>
            <div class="quick-filter-chip">☀️ Bay trưa (12h-18h)</div>
            <div class="quick-filter-chip">🌙 Bay tối (18h-24h)</div>
            <div class="quick-filter-chip">💰 Giá rẻ nhất</div>
            <div class="quick-filter-chip">⚡ Bay nhanh nhất</div>
        </div>

        <div class="filters-section">
            <div class="filters-header">
                <div class="filters-title">
                    <span>🎛️</span>
                    Bộ lọc nâng cao
                </div>
            </div>
            
            <div class="filters-grid">
                <div class="filter-group">
                    <label>Hãng hàng không</label>
                    <div class="filter-buttons">
                        <button class="filter-btn active">Tất cả</button>
                        <button class="filter-btn">Vietnam Airlines</button>
                        <button class="filter-btn">VietJet Air</button>
                        <button class="filter-btn">Bamboo Airways</button>
                    </div>
                </div>
                
                <div class="filter-group">
                    <label>Khoảng giá</label>
                    <div class="filter-buttons">
                        <button class="filter-btn">Dưới $100</button>
                        <button class="filter-btn">$100 - $200</button>
                        <button class="filter-btn">Trên $200</button>
                    </div>
                </div>
                
                <div class="filter-group">
                    <label>Thời gian bay</label>
                    <div class="filter-buttons">
                        <button class="filter-btn">Dưới 2h</button>
                        <button class="filter-btn">2h - 4h</button>
                        <button class="filter-btn">Trên 4h</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="results-header">
            <div class="results-count">
                Tìm thấy <span>{{ $flights->total() }}</span> chuyến bay
            </div>
            <select class="sort-dropdown">
                <option>💰 Giá tốt nhất</option>
                <option>⏰ Thời gian bay</option>
                <option>⚡ Khởi hành sớm nhất</option>
                <option>🌙 Khởi hành muộn nhất</option>
                <option>⭐ Đánh giá cao nhất</option>
            </select>
        </div>
        @endif

        @if($flights->count())
        <div class="flights-grid">
            @foreach($flights as $index => $flight)
            <div class="flight-card">
                <div class="flight-header">
                    <div class="airline-info">
                        <div class="airline-logo">✈️</div>
                        <div class="airline-details">
                            <div class="flight-number">{{ $flight->flight_number }}</div>
                            <div class="airline-name">
                                @if($index % 3 == 0)
                                    Vietnam Airlines
                                @elseif($index % 3 == 1)
                                    VietJet Air
                                @else
                                    Bamboo Airways
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="badges-group">
                        <div class="badge badge-available">
                            <span>✓</span>
                            Còn chỗ
                        </div>
                        @if($index % 4 == 0)
                        <div class="badge badge-hot">
                            <span>🔥</span>
                            Hot
                        </div>
                        @endif
                        @if($index % 3 == 0)
                        <div class="badge badge-wifi">
                            <span>📶</span>
                            WiFi
                        </div>
                        @endif
                    </div>
                </div>

                <div class="flight-route">
                    <div class="airport-info departure">
                        <div class="airport-code">{{ $flight->departureAirport->code }}</div>
                        <div class="airport-time">{{ date('H:i', strtotime($flight->departure_time)) }}</div>
                        <div class="airport-date">{{ date('d/m/Y', strtotime($flight->departure_time)) }}</div>
                        <div class="airport-name">{{ $flight->departureAirport->name ?? $flight->departureAirport->city }}</div>
                    </div>

                    <div class="route-line">
                        <div class="flight-icon">✈️</div>
                        <div class="duration">
                            @php
                                $hours = rand(1, 3);
                                $minutes = rand(0, 59);
                            @endphp
                            {{ $hours }}h {{ $minutes }}m
                        </div>
                        <div class="divider"></div>
                    </div>

                    <div class="airport-info arrival">
                        <div class="airport-code">{{ $flight->arrivalAirport->code }}</div>
                        <div class="airport-time">
                            @php
                                $arrivalTime = strtotime($flight->departure_time . ' + ' . $hours . ' hours ' . $minutes . ' minutes');
                            @endphp
                            {{ date('H:i', $arrivalTime) }}
                        </div>
                        <div class="airport-date">{{ date('d/m/Y', $arrivalTime) }}</div>
                        <div class="airport-name">{{ $flight->arrivalAirport->name ?? $flight->arrivalAirport->city }}</div>
                    </div>
                </div>

                <div class="flight-details">
                    <div class="detail-item">
                        <div class="detail-icon">💺</div>
                        <div class="detail-label">Ghế trống</div>
                        <div class="detail-value">{{ $flight->available_seats }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-icon">🎒</div>
                        <div class="detail-label">Hành lý ký gửi</div>
                        <div class="detail-value">23kg</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-icon">👜</div>
                        <div class="detail-label">Hành lý xách tay</div>
                        <div class="detail-value">7kg</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-icon">🍽️</div>
                        <div class="detail-label">Bữa ăn</div>
                        <div class="detail-value">Miễn phí</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-icon">⭐</div>
                        <div class="detail-label">Hạng vé</div>
                        <div class="detail-value">Economy</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-icon">🎬</div>
                        <div class="detail-label">Giải trí</div>
                        <div class="detail-value">Có</div>
                    </div>
                </div>

                <div class="flight-footer">
                    <div class="price-section">
                        <div class="price-label">Giá vé từ</div>
                        <div class="price-amount">
                            <span class="price-currency">$</span>{{ number_format($flight->price, 0) }}
                        </div>
                        <div class="price-label">/ 1 khách</div>
                    </div>

                    <div class="action-buttons">
                        <button class="btn btn-secondary" onclick="toggleDetails(this, {{ $index }})">
                            <span>📋</span>
                            Chi tiết
                        </button>
                        <a href="{{ route('flights.show', $flight->id) }}" class="btn btn-primary">
                            <span>🎫</span>
                            Đặt vé ngay
                        </a>
                    </div>
                </div>

                <div class="flight-extra-details" id="details-{{ $index }}" style="display: none; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; color: white;">
                        <div>
                            <div style="font-size: 0.85rem; color: rgba(255, 255, 255, 0.6); margin-bottom: 0.5rem;">📍 Terminal</div>
                            <div style="font-weight: 600;">T{{ rand(1, 3) }}</div>
                        </div>
                        <div>
                            <div style="font-size: 0.85rem; color: rgba(255, 255, 255, 0.6); margin-bottom: 0.5rem;">🚪 Cổng</div>
                            <div style="font-weight: 600;">A{{ rand(1, 20) }}</div>
                        </div>
                        <div>
                            <div style="font-size: 0.85rem; color: rgba(255, 255, 255, 0.6); margin-bottom: 0.5rem;">✈️ Loại máy bay</div>
                            <div style="font-weight: 600;">Boeing 787</div>
                        </div>
                        <div>
                            <div style="font-size: 0.85rem; color: rgba(255, 255, 255, 0.6); margin-bottom: 0.5rem;">⚡ Tốc độ trung bình</div>
                            <div style="font-weight: 600;">850 km/h</div>
                        </div>
                        <div>
                            <div style="font-size: 0.85rem; color: rgba(255, 255, 255, 0.6); margin-bottom: 0.5rem;">💳 Chính sách hoàn</div>
                            <div style="font-weight: 600;">Có thể hoàn</div>
                        </div>
                        <div>
                            <div style="font-size: 0.85rem; color: rgba(255, 255, 255, 0.6); margin-bottom: 0.5rem;">🔄 Đổi lịch</div>
                            <div style="font-weight: 600;">Phí $20</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="pagination-wrapper">
            {{ $flights->links() }}
        </div>

        @else
        <div class="no-flights">
            <div class="no-flights-icon">✈️</div>
            <h3>Không tìm thấy chuyến bay phù hợp</h3>
            <p>Vui lòng thử lại với các tiêu chí tìm kiếm khác hoặc thay đổi ngày bay</p>
        </div>
        @endif
    </div>
</div>

<script>
function toggleDetails(btn, index) {
    const detailsDiv = document.getElementById('details-' + index);
    if (detailsDiv.style.display === 'none') {
        detailsDiv.style.display = 'block';
        btn.innerHTML = '<span>📋</span> Ẩn chi tiết';
    } else {
        detailsDiv.style.display = 'none';
        btn.innerHTML = '<span>📋</span> Chi tiết';
    }
}

// Auto-fill current date if empty
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.querySelector('input[name="date"]');
    if (dateInput && !dateInput.value) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.value = today;
    }

    // Trip type selector
    const tripTypeBtns = document.querySelectorAll('.trip-type-btn');
    tripTypeBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            tripTypeBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Filter buttons functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const parent = this.closest('.filter-group');
            if (parent) {
                parent.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            }
            this.classList.add('active');
        });
    });

    // Quick filter chips
    const quickFilterChips = document.querySelectorAll('.quick-filter-chip');
    quickFilterChips.forEach(chip => {
        chip.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    });

    // Add smooth scroll animation
    const flightCards = document.querySelectorAll('.flight-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    flightCards.forEach(card => {
        observer.observe(card);
    });

    // Parallax effect for background
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const wrapper = document.querySelector('.flights-wrapper');
        if (wrapper) {
            wrapper.style.backgroundPositionY = -(scrolled * 0.5) + 'px';
        }
    });
});
</script>
@endsection