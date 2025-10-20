<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FlightsTableSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $tomorrow = $now->copy()->addDay();

        $han = DB::table('airports')->where('code', 'HAN')->first();
        $sgn = DB::table('airports')->where('code', 'SGN')->first();
        $dad = DB::table('airports')->where('code', 'DAD')->first();

        if ($han && $sgn) {
            DB::table('flights')->insert([
                'flight_number' => 'VJ101',
                'departure_airport_id' => $han->id,
                'arrival_airport_id' => $sgn->id,
                'departure_time' => $tomorrow->copy()->setHour(8)->setMinute(0),
                'arrival_time' => $tomorrow->copy()->setHour(10)->setMinute(0),
                'price' => 120.00,
                'available_seats' => 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            DB::table('flights')->insert([
                'flight_number' => 'VJ102',
                'departure_airport_id' => $sgn->id,
                'arrival_airport_id' => $han->id,
                'departure_time' => $tomorrow->copy()->setHour(14)->setMinute(30),
                'arrival_time' => $tomorrow->copy()->setHour(16)->setMinute(30),
                'price' => 115.00,
                'available_seats' => 80,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        if ($han && $dad) {
            DB::table('flights')->insert([
                'flight_number' => 'VJ201',
                'departure_airport_id' => $han->id,
                'arrival_airport_id' => $dad->id,
                'departure_time' => $tomorrow->copy()->setHour(9)->setMinute(0),
                'arrival_time' => $tomorrow->copy()->setHour(11)->setMinute(0),
                'price' => 90.00,
                'available_seats' => 50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
