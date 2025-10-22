<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    /**
     * Danh sách tất cả bookings
     */
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'flight', 'payment']);

        // Lọc theo status
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        // Tìm kiếm theo booking code
        if ($search = $request->get('search')) {
            $query->where('booking_code', 'like', '%'.$search.'%');
        }

        $bookings = $query->latest()->paginate(20);

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Chi tiết booking
     */
    public function show(string $id)
    {
        $booking = Booking::with(['user', 'flight', 'payment'])
            ->findOrFail($id);

        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Cập nhật status booking
     */
    public function updateStatus(Request $request, string $id)
    {
        $booking = Booking::findOrFail($id);

        $data = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $booking->update($data);

        return redirect()->route('admin.bookings.show', $booking->id)
            ->with('success', 'Trạng thái đã được cập nhật.');
    }
}