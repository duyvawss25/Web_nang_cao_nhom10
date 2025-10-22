<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Hiển thị trang đăng nhập.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Xử lý đăng nhập.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Xác thực thông tin đăng nhập
        $request->authenticate();

        // Tạo session mới an toàn
        $request->session()->regenerate();

        // ✅ Nếu là admin → chuyển đến dashboard admin
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        // ✅ Nếu là user → chuyển về trang dashboard user
        return redirect()->route('dashboard');
    }

    /**
     * Xử lý đăng xuất.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // ✅ Lưu role trước khi logout (tránh auth()->user() bị null)
        $role = auth()->check() ? auth()->user()->role : null;

        // Logout người dùng
        Auth::guard('web')->logout();

        // Xóa session cũ
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ✅ Redirect theo role
        if ($role === 'admin') {
            return redirect()->route('login')->with('status', 'Admin đã đăng xuất.');
        }

        return redirect()->route('login')->with('status', 'Bạn đã đăng xuất.');
    }
}
