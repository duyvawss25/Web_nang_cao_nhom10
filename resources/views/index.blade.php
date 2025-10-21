@extends('layouts.app')

@section('content')
<!-- Link CSS file -->
<link rel="stylesheet" href="{{ asset('css/flight-booking.css') }}">

<!-- Scroll Progress Bar -->
<div class="scroll-progress" id="scrollProgress"></div>

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-overlay"></div>
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>
    
    <div class="hero-content">
        <div class="hero-badge">✈️ Tìm & Đặt Vé Máy Bay Giá Rẻ</div>
        <h1 class="hero-title">
            Khám Phá <span class="hero-title-highlight">Thế Giới</span><br>
            Với Chúng Tôi
        </h1>
        <p class="hero-subtitle">
            Đặt vé nhanh chóng, an toàn và tiện lợi. Hàng nghìn ưu đãi đang chờ bạn!
        </p>
        
        <!-- Search Box -->
        <div class="search-box">
            <div class="search-tabs">
                <button class="search-tab active">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    Máy bay
                </button>
                <button class="search-tab">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Khách sạn
                </button>
            </div>
            
            <form action="{{ route('flights.index') }}" method="GET" class="search-form">
                <div class="form-group">
                    <label class="form-label">Từ</label>
                    <input type="text" name="from" class="form-input" placeholder="Hà Nội (HAN)" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Đến</label>
                    <input type="text" name="to" class="form-input" placeholder="TP. Hồ Chí Minh (SGN)" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Ngày đi</label>
                    <input type="date" name="departure_date" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Ngày về</label>
                    <input type="date" name="return_date" class="form-input">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Hành khách</label>
                    <select name="passengers" class="form-input" required>
                        <option value="1">1 người lớn</option>
                        <option value="2">2 người lớn</option>
                        <option value="3">3 người lớn</option>
                        <option value="4">4 người lớn</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Hạng ghế</label>
                    <select name="class" class="form-input" required>
                        <option value="economy">Phổ thông</option>
                        <option value="business">Thương gia</option>
                        <option value="first">Hạng nhất</option>
                    </select>
                </div>
                
                <button type="submit" class="search-button">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Tìm chuyến bay
                </button>
            </form>
        </div>
        
        <!-- Promo Codes -->
        <div class="promo-section">
            <div class="promo-card" data-code="SALE20">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
                <div>
                    <div class="promo-code">SALE20</div>
                    <div class="promo-desc">Giảm 20% cho đơn đầu</div>
                </div>
            </div>
            
            <div class="promo-card" data-code="SUMMER">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                </svg>
                <div>
                    <div class="promo-code">SUMMER</div>
                    <div class="promo-desc">Giảm 500K chuyến bay quốc tế</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="features-section">
    <div class="features-container">
        <div class="section-header">
            <div class="section-badge">🌟 Tại sao chọn chúng tôi</div>
            <h2 class="section-title">Trải Nghiệm Đặt Vé Tuyệt Vời</h2>
            <p class="section-subtitle">Những tính năng vượt trội giúp bạn bay dễ dàng hơn</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3 class="feature-title">Đặt Vé Siêu Tốc</h3>
                <p class="feature-description">
                    Chỉ 3 bước đơn giản để hoàn tất đặt vé. Nhanh chóng, dễ dàng và tiện lợi.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">💰</div>
                <h3 class="feature-title">Giá Tốt Nhất</h3>
                <p class="feature-description">
                    So sánh giá từ hàng trăm hãng bay. Đảm bảo mức giá tốt nhất cho bạn.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3 class="feature-title">An Toàn Tuyệt Đối</h3>
                <p class="feature-description">
                    Thanh toán được mã hóa SSL. Thông tin cá nhân được bảo vệ 100%.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3 class="feature-title">Hỗ Trợ 24/7</h3>
                <p class="feature-description">
                    Đội ngũ chăm sóc khách hàng luôn sẵn sàng hỗ trợ bạn mọi lúc, mọi nơi.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">🎁</div>
                <h3 class="feature-title">Ưu Đãi Độc Quyền</h3>
                <p class="feature-description">
                    Nhận deal hot, mã giảm giá khủng dành riêng cho thành viên.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">📱</div>
                <h3 class="feature-title">Đa Nền Tảng</h3>
                <p class="feature-description">
                    Đặt vé mọi lúc, mọi nơi trên web, iOS và Android.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Deals Section -->
<div class="deals-section">
    <div class="deals-container">
        <div class="section-header">
            <div class="section-badge">🔥 Ưu đãi hot</div>
            <h2 class="section-title">Điểm Đến Hấp Dẫn</h2>
            <p class="section-subtitle">Khám phá các chuyến bay giá tốt nhất</p>
        </div>
        
        <div class="deals-grid">
            <div class="deal-card">
                <div class="deal-image">
                    <img src="https://images.unsplash.com/photo-1528127269322-539801943592?w=600" alt="Seoul">
                    <div class="deal-badge">Giảm 30%</div>
                </div>
                <div class="deal-content">
                    <div class="deal-location">Hà Nội → Seoul</div>
                    <div class="deal-title">Seoul - Hàn Quốc</div>
                    <div class="deal-footer">
                        <div class="deal-price">1,699,000đ</div>
                        <div class="deal-arrow">→</div>
                    </div>
                </div>
            </div>
            
            <div class="deal-card">
                <div class="deal-image">
                    <img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=600" alt="Tokyo">
                    <div class="deal-badge">Hot Deal</div>
                </div>
                <div class="deal-content">
                    <div class="deal-location">Hà Nội → Tokyo</div>
                    <div class="deal-title">Tokyo - Nhật Bản</div>
                    <div class="deal-footer">
                        <div class="deal-price">9,000,000đ</div>
                        <div class="deal-arrow">→</div>
                    </div>
                </div>
            </div>
            
            <div class="deal-card">
                <div class="deal-image">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600" alt="Bali">
                    <div class="deal-badge">Mới</div>
                </div>
                <div class="deal-content">
                    <div class="deal-location">Hà Nội → Bali</div>
                    <div class="deal-title">Bali - Indonesia</div>
                    <div class="deal-footer">
                        <div class="deal-price">3,500,000đ</div>
                        <div class="deal-arrow">→</div>
                    </div>
                </div>
            </div>
            
            <div class="deal-card">
                <div class="deal-image">
                    <img src="https://a.travel-assets.com/findyours-php/viewfinder/images/res70/542000/542607-singapore.jpg" alt="Singapore">
                    <div class="deal-badge">Sale</div>
                </div>
                <div class="deal-content">
                    <div class="deal-location">Hà Nội → Singapore</div>
                    <div class="deal-title">Singapore</div>
                    <div class="deal-footer">
                        <div class="deal-price">2,800,000đ</div>
                        <div class="deal-arrow">→</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Flight List Section -->
<div class="flight-list-section">
    <div class="flight-list-container">
        <div class="section-header">
            <h2 class="section-title">Tìm Kiếm Các Ưu Đãi Vé Máy Bay Rẻ Từ Việt Nam</h2>
        </div>
        
        <div class="flight-tabs">
            <button class="flight-tab active">Một Chiều</button>
            <button class="flight-tab">Khứ Hồi</button>
            <button class="flight-tab">Quốc Tế</button>
        </div>
        
        <div class="flights-list">
            <!-- Flight Item 1 -->
            <div class="flight-item">
                <div class="flight-route">
                    <div class="flight-airline">
                        <img src="https://www.tripsavvy.com/thmb/-GZ-Zcf9aL7sTOMBNJy0osnlMis=/5472x3648/filters:no_upscale():max_bytes(150000):strip_icc()/thai-vietjet-air-flight-5a827c2e1f4e130037c8dc8d.jpg" alt="Vietjet Air" class="airline-logo">
                        <div class="airline-info">
                            <div class="airline-name">Vietjet Air</div>
                            <div class="flight-route-text">TP HCM (SGN) ↔️ Bangkok (BKK)</div>
                            <div class="flight-date">Thứ Hai, 17 tháng 11, 2025</div>
                        </div>
                    </div>
                    <div class="flight-price-box">
                        <div class="flight-price">1.431.541 VNĐ</div>
                        <div class="price-label">Một Chiều</div>
                    </div>
                    <a href="{{ route('flights.index') }}" class="flight-arrow">→</a>
                </div>
            </div>
            
            <!-- Flight Item 2 -->
            <div class="flight-item">
                <div class="flight-route">
                    <div class="flight-airline">
                        <img src="https://www.aerotime.aero/images/Scoot-Airline-Boeing-787-8-Dreamliner-1600x1000.jpg" alt="Scoot" class="airline-logo">
                        <div class="airline-info">
                            <div class="airline-name">Scoot</div>
                            <div class="flight-route-text">TP HCM (SGN) ↔️ Singapore (SIN)</div>
                            <div class="flight-date">Thứ Tư, 19 tháng 10, 2025</div>
                        </div>
                    </div>
                    <div class="flight-price-box">
                        <div class="flight-price">1.240.765 VNĐ</div>
                        <div class="price-label">Một Chiều</div>
                    </div>
                    <a href="{{ route('flights.index') }}" class="flight-arrow">→</a>
                </div>
            </div>
            
            <!-- Flight Item 3 -->
            <div class="flight-item">
                <div class="flight-route">
                    <div class="flight-airline">
                        <img src="https://www.tripsavvy.com/thmb/-GZ-Zcf9aL7sTOMBNJy0osnlMis=/5472x3648/filters:no_upscale():max_bytes(150000):strip_icc()/thai-vietjet-air-flight-5a827c2e1f4e130037c8dc8d.jpg" alt="Vietjet Air" class="airline-logo">
                        <div class="airline-info">
                            <div class="airline-name">Vietjet Air</div>
                            <div class="flight-route-text">TP HCM (SGN) ↔️ Kuala Lumpur (KUL)</div>
                            <div class="flight-date">Thứ Sáu, 14 tháng 11, 2025</div>
                        </div>
                    </div>
                    <div class="flight-price-box">
                        <div class="flight-price">1.202.850 VNĐ</div>
                        <div class="price-label">Một Chiều</div>
                    </div>
                    <a href="{{ route('flights.index') }}" class="flight-arrow">→</a>
                </div>
            </div>
            
            <!-- Flight Item 4 -->
            <div class="flight-item">
                <div class="flight-route">
                    <div class="flight-airline">
                        <img src="https://www.aerotime.aero/images/Scoot-Airline-Boeing-787-8-Dreamliner-1600x1000.jpg" alt="Scoot" class="airline-logo">
                        <div class="airline-info">
                            <div class="airline-name">Scoot</div>
                            <div class="flight-route-text">Singapore (SIN) ↔️ TP HCM (SGN)</div>
                            <div class="flight-date">Thứ Ba, 18 tháng 11, 2025</div>
                        </div>
                    </div>
                    <div class="flight-price-box">
                        <div class="flight-price">2.255.152 VNĐ</div>
                        <div class="price-label">Một Chiều</div>
                    </div>
                    <a href="{{ route('flights.index') }}" class="flight-arrow">→</a>
                </div>
            </div>
            
            <!-- Flight Item 5 -->
            <div class="flight-item">
                <div class="flight-route">
                    <div class="flight-airline">
                        <img src="https://www.tripsavvy.com/thmb/-GZ-Zcf9aL7sTOMBNJy0osnlMis=/5472x3648/filters:no_upscale():max_bytes(150000):strip_icc()/thai-vietjet-air-flight-5a827c2e1f4e130037c8dc8d.jpg" alt="Vietjet Air" class="airline-logo">
                        <div class="airline-info">
                            <div class="airline-name">Vietjet Air</div>
                            <div class="flight-route-text">Bangkok (BKK) ↔️ TP HCM (SGN)</div>
                            <div class="flight-date">Thứ Năm, 13 tháng 11, 2025</div>
                        </div>
                    </div>
                    <div class="flight-price-box">
                        <div class="flight-price">1.374.937 VNĐ</div>
                        <div class="price-label">Một Chiều</div>
                    </div>
                    <a href="{{ route('flights.index') }}" class="flight-arrow">→</a>
                </div>
            </div>
            
            <!-- Flight Item 6 -->
            <div class="flight-item">
                <div class="flight-route">
                    <div class="flight-airline">
                        <img src="https://wallpapers.com/images/hd/thai-airways-purple-airplane-9v5zqxguqi8kx3hu.jpg" alt="AirAsia" class="airline-logo">
                        <div class="airline-info">
                            <div class="airline-name">Thai AirAsia</div>
                            <div class="flight-route-text">TP HCM (SGN) ↔️ Bangkok (DMK)</div>
                            <div class="flight-date">Thứ Bảy, 10 tháng 11, 2025</div>
                        </div>
                    </div>
                    <div class="flight-price-box">
                        <div class="flight-price">1.385.925 VNĐ</div>
                        <div class="price-label">Một Chiều</div>
                    </div>
                    <a href="{{ route('flights.index') }}" class="flight-arrow">→</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Benefits Section -->
<div class="benefits-section">
    <div class="benefits-container">
        <h2 class="section-title" style="text-align: center; margin-bottom: 3rem;">
            Hơn 50 triệu lượt tải, hơn 1 triệu lượt đánh giá
        </h2>
        
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-icon">🛡️</div>
                <h3 class="benefit-title">Dễ dàng thay đổi chuyến bay</h3>
                <p class="benefit-desc">Thay mới hay hoặc thay đổi các loại chuyến bay</p>
            </div>
            
            <div class="benefit-card">
                <div class="benefit-icon">💳</div>
                <h3 class="benefit-title">Thanh toán đơn giản</h3>
                <p class="benefit-desc">Giao dịch dễ dàng với đa dạng hình thức thanh toán</p>
            </div>
            
            <div class="benefit-card">
                <div class="benefit-icon">🎧</div>
                <h3 class="benefit-title">Hỗ trợ 24/7</h3>
                <p class="benefit-desc">Hãy liên hệ với chúng tôi bất cứ khi nào, bất cứ ở đâu</p>
            </div>
        </div>
    </div>
</div>

<!-- Destinations Section -->
<div class="destinations-section">
    <div class="destinations-container">
        <div class="section-header">
            <h2 class="section-title">Ưu Đãi Vé Máy Bay Từ Việt Nam Đến Những Điểm Đến Phổ Biến</h2>
            <p class="section-subtitle">Khám Phá Các Ưu Đãi Vé Máy Bay Đặc Biệt Đến Những Điểm Đến Toàn Cầu Hàng Đầu</p>
        </div>
        
        <div class="destinations-grid">
            <!-- Singapore -->
            <div class="destination-card">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1525625293386-3f8f99389edd?w=600" alt="Singapore">
                    <div class="destination-overlay">
                        <h3 class="destination-name">Singapore</h3>
                    </div>
                </div>
                <div class="destination-content">
                    <div class="destination-route">
                        <div class="route-info">
                            <div class="route-text">TP HCM (SGN) ⇄ Singapore (SIN)</div>
                            <div class="route-date">22 tháng 9 - 1 tháng 2</div>
                        </div>
                        <div class="route-price">
                            <span class="price-from">từ</span>
                            <span class="price-amount">2.823.798 VNĐ</span>
                        </div>
                    </div>
                    <button class="btn-book">Khám Phá Chuyến Bay</button>
                </div>
            </div>
            
            <!-- Thái Lan -->
            <div class="destination-card">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?w=600" alt="Thailand">
                    <div class="destination-overlay">
                        <h3 class="destination-name">Thái Lan</h3>
                    </div>
                </div>
                <div class="destination-content">
                    <div class="destination-route">
                        <div class="route-info">
                            <div class="route-text">TP HCM (SGN) ⇄ Chiang Mai (CNX)</div>
                            <div class="route-date">12 - 14 tháng 3</div>
                        </div>
                        <div class="route-price">
                            <span class="price-from">từ</span>
                            <span class="price-amount">3.780.343 VNĐ</span>
                        </div>
                    </div>
                    <button class="btn-book">Khám Phá Chuyến Bay</button>
                </div>
            </div>
            
            <!-- Trung Quốc -->
            <div class="destination-card">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1508804185872-d7badad00f7d?w=600" alt="China">
                    <div class="destination-overlay">
                        <h3 class="destination-name">Trung Quốc</h3>
                    </div>
                </div>
                <div class="destination-content">
                    <div class="destination-route">
                        <div class="route-info">
                            <div class="route-text">TP HCM (SGN) ⇄ Nam Kinh (NKG)</div>
                            <div class="route-date">29 tháng 10 - 11 tháng 11</div>
                        </div>
                        <div class="route-price">
                            <span class="price-from">từ</span>
                            <span class="price-amount">7.304.494 VNĐ</span>
                        </div>
                    </div>
                    <button class="btn-book">Khám Phá Chuyến Bay</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Promo Banner -->
<div class="promo-banner">
    <div class="promo-banner-content">
        <div class="promo-text">
            <h3>Giảm ngay 50K</h3>
            <p>Áp dụng cho lần đầu đặt trên hệ thống</p>
        </div>
        <div class="promo-code-box">
            <input type="text" value="Code:TVLK8ANMOI" readonly class="promo-input" id="promoCodeInput">
            <button class="btn-copy-code" onclick="copyPromoCode()">Copy</button>
        </div>
    </div>
</div>

<script src="{{ asset('js/flight-booking.js') }}"></script>
@endsection