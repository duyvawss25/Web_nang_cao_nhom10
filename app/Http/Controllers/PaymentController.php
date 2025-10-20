<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Hiển thị danh sách thanh toán của người dùng hiện tại.
     */
    public function index()
    {
        $userId = Auth::id();

        // Lấy tất cả thanh toán liên quan tới user hiện tại
        $payments = Payment::whereHas('booking', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->with('booking')
        ->latest()
        ->get();

        return view('payments.index', compact('payments'));
    }

    /**
     * Hiển thị form thanh toán cho 1 booking cụ thể.
     */
    public function create($bookingId = null)
    {
        if (!$bookingId) {
            return redirect()->route('bookings.index')->with('error', 'Không tìm thấy mã đặt vé.');
        }

        $booking = Booking::findOrFail($bookingId);

        // Chỉ cho phép thanh toán nếu booking thuộc về user hiện tại
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền thanh toán cho vé này.');
        }

        return view('payments.create', compact('booking'));
    }

    /**
     * Lưu thông tin thanh toán mới (giả lập).
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $booking = Booking::findOrFail($data['booking_id']);

        // Kiểm tra quyền sở hữu
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Bạn không thể thanh toán cho vé này.');
        }

        // Tạo bản ghi thanh toán
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'amount' => $data['amount'],
            'status' => 'completed', // Giả lập thanh toán thành công
        ]);

        return redirect()
            ->route('payments.index')
            ->with('success', 'Thanh toán thành công cho chuyến bay ' . $booking->flight_id);
    }
}
