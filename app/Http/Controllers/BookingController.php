<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\Flight;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Hiển thị danh sách vé đã đặt.
     */
    public function index()
    {
        $user = Auth::user();
        $bookings = Booking::with('flight')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Trang form đặt vé cho 1 chuyến bay.
     */
    public function create(Flight $flight)
    {
        return view('bookings.create', compact('flight'));
    }

    /**
     * Lưu thông tin đặt vé vào DB.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'seats' => 'required|string', // cho phép danh sách ghế
        ]);

        $user = Auth::user();

        $booking = DB::transaction(function () use ($data, $user) {
            $flight = Flight::lockForUpdate()->findOrFail($data['flight_id']);

            // Tính số lượng ghế
            $seatList = explode(',', $data['seats']);
            $seatCount = count($seatList);

            if ($flight->available_seats < $seatCount) {
                throw new \Exception('Không đủ chỗ');
            }

            // Cập nhật lại số ghế trống
            $flight->available_seats -= $seatCount;
            $flight->save();

            $total = $flight->price * $seatCount;

            return Booking::create([
                'user_id' => $user->id,
                'flight_id' => $flight->id,
                'seats' => implode(',', $seatList),
                'total_price' => $total,
                'status' => 'confirmed',
            ]);
        });

        return redirect()
            ->route('bookings.show', $booking->id)
            ->with('success', 'Đặt vé thành công!');
    }

    /**
     * Hiển thị chi tiết 1 vé đặt.
     */
    public function show(string $id)
    {
        $booking = Booking::with('flight', 'payment')->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    /**
     * Chỉnh sửa trạng thái đặt vé.
     */
    public function edit(string $id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, string $id)
    {
        $booking = Booking::findOrFail($id);
        $data = $request->validate([
            'status' => 'required|string',
        ]);
        $booking->update($data);
        return redirect()->route('bookings.show', $booking->id)->with('success', 'Cập nhật thành công!');
    }

    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Xóa thành công!');
    }
}
