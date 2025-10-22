<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Airport;
use Illuminate\Http\Request;

class AdminFlightController extends Controller
{
    /**
     * Danh sách chuyến bay
     */
    public function index()
    {
        $flights = Flight::with(['departureAirport', 'arrivalAirport'])
            ->latest()
            ->paginate(20);

        return view('admin.flights.index', compact('flights'));
    }

    /**
     * Form tạo chuyến bay mới
     */
    public function create()
    {
        $airports = Airport::all();
        return view('admin.flights.create', compact('airports'));
    }

    /**
     * Lưu chuyến bay mới
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'flight_number' => 'required|unique:flights,flight_number',
            'departure_airport_id' => 'required|exists:airports,id',
            'arrival_airport_id' => 'required|exists:airports,id|different:departure_airport_id',
            'departure_time' => 'required|date|after:now',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric|min:0',
            'available_seats' => 'required|integer|min:0',
        ]);

        Flight::create($data);

        return redirect()->route('admin.flights.index')
            ->with('success', 'Chuyến bay đã được tạo thành công.');
    }

    /**
     * Chi tiết chuyến bay
     */
    public function show(string $id)
    {
        $flight = Flight::with(['departureAirport', 'arrivalAirport', 'bookings'])
            ->findOrFail($id);

        return view('admin.flights.show', compact('flight'));
    }

    /**
     * Form sửa chuyến bay
     */
    public function edit(string $id)
    {
        $flight = Flight::findOrFail($id);
        $airports = Airport::all();

        return view('admin.flights.edit', compact('flight', 'airports'));
    }

    /**
     * Cập nhật chuyến bay
     */
    public function update(Request $request, string $id)
    {
        $flight = Flight::findOrFail($id);

        $data = $request->validate([
            'flight_number' => 'required|unique:flights,flight_number,'.$flight->id,
            'departure_airport_id' => 'required|exists:airports,id',
            'arrival_airport_id' => 'required|exists:airports,id|different:departure_airport_id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric|min:0',
            'available_seats' => 'required|integer|min:0',
        ]);

        $flight->update($data);

        return redirect()->route('admin.flights.show', $flight->id)
            ->with('success', 'Chuyến bay đã được cập nhật.');
    }

    /**
     * Xóa chuyến bay
     */
    public function destroy(string $id)
    {
        $flight = Flight::findOrFail($id);
        $flight->delete();

        return redirect()->route('admin.flights.index')
            ->with('success', 'Chuyến bay đã được xóa.');
    }
}