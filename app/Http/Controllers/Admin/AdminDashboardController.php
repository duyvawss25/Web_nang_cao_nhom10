<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Thống kê
        $stats = [
            'total_flights' => Flight::count(),
            'total_bookings' => Booking::count(),
            'total_payments' => Payment::sum('amount'),
            'total_users' => User::where('role', 'user')->count(),
        ];

        // Booking gần đây
        $recentBookings = Booking::with(['user', 'flight'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }
}