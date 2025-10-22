<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer - Airline Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }

        /* Mission Section */
        .mission-section {
            position: relative;
            height: 400px;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1600') center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .mission-content {
            max-width: 700px;
            padding: 20px;
            animation: fadeInUp 1s ease;
        }

        .mission-title {
            font-size: 14px;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 25px;
            font-weight: 300;
            opacity: 0.9;
        }

        .mission-text {
            font-size: 22px;
            line-height: 1.6;
            margin-bottom: 30px;
            font-weight: 300;
        }

        .continue-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            font-size: 13px;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .continue-btn:hover {
            color: white;
            border-bottom-color: white;
            gap: 15px;
        }

        .continue-btn i {
            font-size: 18px;
        }

        /* Footer Info Section */
        .footer-info {
            background: rgba(10, 25, 47, 0.98);
            backdrop-filter: blur(10px);
            color: rgba(255, 255, 255, 0.8);
            padding: 60px 0 30px;
        }

        .footer-brand {
            margin-bottom: 20px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 24px;
            font-weight: 600;
            color: white;
            margin-bottom: 25px;
        }

        .footer-logo i {
            color: rgba(59, 130, 246, 0.9);
            font-size: 28px;
        }

        .footer-address {
            font-size: 14px;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.6);
        }

        .footer-section-title {
            font-size: 13px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .footer-links a:hover {
            color: rgba(96, 165, 250, 1);
            padding-left: 5px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 40px;
            padding-top: 25px;
            text-align: center;
        }

        .footer-bottom p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 13px;
            margin: 0;
        }

        .footer-bottom-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 12px;
            flex-wrap: wrap;
        }

        .footer-bottom-links a {
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            font-size: 12px;
            transition: color 0.3s ease;
        }

        .footer-bottom-links a:hover {
            color: rgba(96, 165, 250, 1);
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .social-links a:hover {
            background: rgba(59, 130, 246, 0.9);
            color: white;
            transform: translateY(-3px);
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

        @media (max-width: 768px) {
            .mission-section {
                height: 350px;
            }

            .mission-text {
                font-size: 18px;
            }

            .footer-info {
                padding: 40px 0 20px;
            }

            .footer-section {
                margin-bottom: 30px;
            }
        }
    </style>
</head>
<body>

    <!-- MISSION STATEMENT SECTION -->
    <section class="mission-section">
        <div class="mission-content">
            <h2 class="mission-title">SỨ MỆNH CỦA CHÚNG TÔI</h2>
            <p class="mission-text">
                Airline Booking cam kết mang đến trải nghiệm đặt vé bay tốt nhất, 
                xây dựng một nền tảng đẳng cấp thế giới tiên phong trong công nghệ du lịch hiện đại.
            </p>
            <a href="#" class="continue-btn">
                <i class="fas fa-chevron-right"></i>
                TÌM HIỂU THÊM
            </a>
        </div>
    </section>

    <!-- FOOTER INFO SECTION -->
    <footer class="footer-info">
        <div class="container">
            <div class="row">
                <!-- Brand & Address -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-brand">
                        <div class="footer-logo">
                            <i class="fas fa-plane-departure"></i>
                            Airline Booking
                        </div>
                        <div class="footer-address">
                            <p>
                                2400 - 1177 West Hastings Street<br>
                                Vancouver, British Columbia<br>
                                Canada V6E 2K3
                            </p>
                            <p style="margin-top: 15px;">
                                Toll Free: 1-888-331-0096
                            </p>
                        </div>
                        <div class="social-links">
                            <a href="#" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" aria-label="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Project -->
                <div class="col-lg-2 col-md-6 col-6 mb-4">
                    <h6 class="footer-section-title">Dịch vụ</h6>
                    <ul class="footer-links">
                        <li><a href="#">Vé máy bay</a></li>
                        <li><a href="#">Vé khứ hồi</a></li>
                        <li><a href="#">Combo tiết kiệm</a></li>
                        <li><a href="#">Vé doanh nghiệp</a></li>
                    </ul>
                </div>

                <!-- Corporate -->
                <div class="col-lg-2 col-md-6 col-6 mb-4">
                    <h6 class="footer-section-title">Công ty</h6>
                    <ul class="footer-links">
                        <li><a href="#">Quản lý</a></li>
                        <li><a href="#">Ban giám đốc</a></li>
                        <li><a href="#">Trách nhiệm</a></li>
                    </ul>
                </div>

                <!-- Investors -->
                <div class="col-lg-2 col-md-6 col-6 mb-4">
                    <h6 class="footer-section-title">Nhà đầu tư</h6>
                    <ul class="footer-links">
                        <li><a href="#">Thông tin cổ phiếu</a></li>
                        <li><a href="#">Báo cáo</a></li>
                        <li><a href="#">Bài thuyết trình</a></li>
                        <li><a href="#">Sự kiện</a></li>
                    </ul>
                </div>

                <!-- News & Media -->
                <div class="col-lg-2 col-md-6 col-6 mb-4">
                    <h6 class="footer-section-title">Tin tức</h6>
                    <ul class="footer-links">
                        <li><a href="#">Tin mới nhất</a></li>
                        <li><a href="#">Thư viện Media</a></li>
                        <li><a href="#">Liên hệ báo chí</a></li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p>&copy; 2025 Airline Booking. All rights reserved.</p>
                <div class="footer-bottom-links">
                    <a href="#">Chính sách bảo mật</a>
                    <span style="color: rgba(255,255,255,0.3);">•</span>
                    <a href="#">Điều khoản sử dụng</a>
                    <span style="color: rgba(255,255,255,0.3);">•</span>
                    <a href="#">Chính sách cookie</a>
                    <span style="color: rgba(255,255,255,0.3);">•</span>
                    <a href="#">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>