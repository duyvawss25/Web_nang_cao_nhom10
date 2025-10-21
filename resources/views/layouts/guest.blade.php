<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Poppins', sans-serif !important;
                min-height: 100vh;
                overflow-x: hidden;
                background: url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?q=80&w=2000') no-repeat center center fixed !important;
                background-size: cover !important;
                position: relative;
            }

            /* Thay bằng ảnh local: url('/images/airplane-login-bg.jpg') */

            body::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1;
            }

            .page-title {
                position: fixed;
                top: 40px;
                left: 50%;
                transform: translateX(-50%);
                color: white;
                font-size: 36px;
                font-weight: 600;
                letter-spacing: 10px;
                text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
                z-index: 100;
            }

            .main-wrapper {
                position: relative;
                z-index: 10;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                padding: 140px 20px 80px;
            }

            .logo-container {
                margin-bottom: 30px;
                position: relative;
                z-index: 10;
            }

            .logo-container a {
                display: inline-block;
            }

            .logo-container svg,
            .logo-container img {
                width: 80px;
                height: 80px;
                filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.3));
            }

            .auth-container {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border-radius: 12px;
                padding: 50px 45px;
                width: 100%;
                max-width: 420px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
                position: relative;
                z-index: 10;
            }

            .auth-title {
                text-align: center;
                color: #333;
                font-size: 18px;
                font-weight: 600;
                letter-spacing: 4px;
                margin-bottom: 40px;
                text-transform: uppercase;
            }

            .input-group {
                position: relative;
                margin-bottom: 22px;
            }

            .input-group input,
            .input-group select {
                width: 100%;
                padding: 15px 45px 15px 20px !important;
                border: 2px solid transparent !important;
                border-radius: 30px !important;
                background: #f8f9fa !important;
                font-size: 14px;
                outline: none;
                transition: all 0.3s;
                font-family: 'Poppins', sans-serif;
            }

            .input-group input:focus,
            .input-group select:focus {
                background: white !important;
                border-color: #ff4081 !important;
                box-shadow: 0 0 0 3px rgba(255, 64, 129, 0.1) !important;
            }

            .input-group input::placeholder {
                color: #999;
            }

            .input-icon {
                position: absolute;
                right: 18px;
                top: 50%;
                transform: translateY(-50%);
                width: 20px;
                height: 20px;
                background-size: contain;
                background-repeat: no-repeat;
                opacity: 0.6;
                pointer-events: none;
            }

            .icon-user {
                background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23ff4081"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>');
            }

            .icon-lock {
                background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23ff4081"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>');
            }

            .icon-email {
                background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23ff4081"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>');
            }

            .error-message {
                color: #e53935;
                font-size: 12px;
                margin-top: 5px;
                margin-left: 20px;
            }

            .forgot-password {
                text-align: center;
                margin: 20px 0 30px;
            }

            .forgot-password a {
                color: #666 !important;
                font-size: 13px;
                text-decoration: none !important;
                transition: color 0.3s;
            }

            .forgot-password a:hover {
                color: #ff4081 !important;
            }

            .auth-button,
            button[type="submit"] {
                width: 100%;
                padding: 15px !important;
                border: none !important;
                border-radius: 30px !important;
                background: linear-gradient(135deg, #ff4081 0%, #ff6b9d 100%) !important;
                color: white !important;
                font-size: 16px;
                font-weight: 600;
                letter-spacing: 2px;
                cursor: pointer;
                transition: all 0.3s;
                box-shadow: 0 4px 20px rgba(255, 64, 129, 0.4) !important;
                font-family: 'Poppins', sans-serif;
                text-transform: uppercase;
            }

            .auth-button:hover,
            button[type="submit"]:hover {
                background: linear-gradient(135deg, #f50057 0%, #ff4081 100%) !important;
                box-shadow: 0 6px 25px rgba(255, 64, 129, 0.5) !important;
                transform: translateY(-2px);
            }

            .auth-button:active,
            button[type="submit"]:active {
                transform: translateY(0);
            }

            .auth-link {
                text-align: center;
                margin-top: 25px;
                font-size: 14px;
                color: #666;
            }

            .auth-link a {
                color: #ff4081 !important;
                text-decoration: none !important;
                font-weight: 600;
                transition: color 0.3s;
            }

            .auth-link a:hover {
                color: #f50057 !important;
                text-decoration: underline !important;
            }

            .footer-text {
                position: fixed;
                bottom: 25px;
                left: 50%;
                transform: translateX(-50%);
                color: white;
                font-size: 12px;
                text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
                z-index: 100;
                text-align: center;
                white-space: nowrap;
            }

            .status-message,
            .mb-4 {
                background: #4caf50;
                color: white;
                padding: 12px;
                border-radius: 10px;
                margin-bottom: 25px !important;
                font-size: 13px;
                text-align: center;
            }

            .checkbox-group {
                display: flex;
                align-items: center;
                margin: 20px 0;
                padding-left: 10px;
            }

            .checkbox-group input[type="checkbox"] {
                width: 18px;
                height: 18px;
                margin-right: 10px;
                cursor: pointer;
                accent-color: #ff4081;
            }

            .checkbox-group label {
                font-size: 13px;
                color: #666;
                cursor: pointer;
            }

            /* Override Tailwind styles */
            .bg-gray-100,
            .bg-white {
                background: transparent !important;
            }

            .shadow-md {
                box-shadow: none !important;
            }

            .sm\:rounded-lg {
                border-radius: 0 !important;
            }

            /* Responsive */
            @media (max-width: 480px) {
                .page-title {
                    font-size: 24px;
                    letter-spacing: 6px;
                    top: 30px;
                }

                .auth-container {
                    padding: 40px 30px;
                }

                .main-wrapper {
                    padding: 120px 15px 60px;
                }

                .footer-text {
                    font-size: 10px;
                    padding: 0 10px;
                }
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <h1 class="page-title">ONLINE LOGIN FORM</h1>
        
        <div class="main-wrapper">
            <div class="logo-container">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="auth-container">
                {{ $slot }}
            </div>
        </div>

        <div class="footer-text">
            © 2025 Online Login Form. All rights reserved | Design by W3layouts
        </div>
    </body>
</html>