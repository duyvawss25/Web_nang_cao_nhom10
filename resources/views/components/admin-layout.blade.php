<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

    <nav class="bg-gray-800 text-white p-4">
        <div class="flex justify-between">
            <a href="{{ route('admin.dashboard') }}" class="font-bold">Admin Panel</a>
            <div>
                <a href="{{ route('home') }}" class="px-3 hover:underline">Trang chủ</a>
                <a href="{{ route('logout') }}" class="px-3 hover:underline"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   Đăng xuất
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <main class="p-6">
        {{ $slot }}
    </main>

</body>
</html>
