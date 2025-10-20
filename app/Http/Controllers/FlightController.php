<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Airport;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Flight::with(['departureAirport','arrivalAirport']);

        if ($from = request('from')) {
            $query->whereHas('departureAirport', function($q) use ($from) {
                $q->where('code', 'like', strtoupper($from));
            });
        }

        if ($to = request('to')) {
            $query->whereHas('arrivalAirport', function($q) use ($to) {
                $q->where('code', 'like', strtoupper($to));
            });
        }

        if ($date = request('date')) {
            $query->whereDate('departure_time', $date);
        }

        $flights = $query->orderBy('departure_time')->paginate(10)->withQueryString();
        return view('flights.index', compact('flights'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $airports = Airport::all();
        return view('flights.create', compact('airports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'flight_number' => 'required|unique:flights,flight_number',
            'departure_airport_id' => 'required|exists:airports,id',
            'arrival_airport_id' => 'required|exists:airports,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date',
            'price' => 'required|numeric',
            'available_seats' => 'required|integer',
        ]);

        Flight::create($data);
        return redirect()->route('flights.index')->with('success','Chuyến bay đã được tạo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $flight = Flight::with(['departureAirport','arrivalAirport'])->findOrFail($id);
        return view('flights.show', compact('flight'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $flight = Flight::findOrFail($id);
        $airports = Airport::all();
        return view('flights.edit', compact('flight','airports'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $flight = Flight::findOrFail($id);
        $data = $request->validate([
            'flight_number' => 'required|unique:flights,flight_number,'.$flight->id,
            'departure_airport_id' => 'required|exists:airports,id',
            'arrival_airport_id' => 'required|exists:airports,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date',
            'price' => 'required|numeric',
            'available_seats' => 'required|integer',
        ]);
        $flight->update($data);
        return redirect()->route('flights.show', $flight->id)->with('success','Chuyến bay đã cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flight = Flight::findOrFail($id);
        $flight->delete();
        return redirect()->route('flights.index')->with('success','Chuyến bay đã xóa.');
    }
}
