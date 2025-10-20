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
        $vca = DB::table('airports')->where('code', 'VCA')->first();

        // --- 3 chuyến bay cũ ---
        if ($han && $sgn) {
            DB::table('flights')->insert([
                'flight_number' => 'VJ101',
                'departure_airport_id' => $han->id,
                'arrival_airport_id' => $sgn->id,
                'departure_time' => $tomorrow->copy()->setHour(8)->setMinute(0),
                'arrival_time' => $tomorrow->copy()->setHour(10)->setMinute(0),
                'price' => 120.00,
                'available_seats' => 100,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('flights')->insert([
                'flight_number' => 'VJ102',
                'departure_airport_id' => $sgn->id,
                'arrival_airport_id' => $han->id,
                'departure_time' => $tomorrow->copy()->setHour(14)->setMinute(30),
                'arrival_time' => $tomorrow->copy()->setHour(16)->setMinute(30),
                'price' => 115.00,
                'available_seats' => 80,
                'created_at' => $now,
                'updated_at' => $now,
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
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // --- 10 chuyến bay mới ---
        if ($han && $vca) {
            DB::table('flights')->insert([
                'flight_number' => 'VJ301',
                'departure_airport_id' => $han->id,
                'arrival_airport_id' => $vca->id,
                'departure_time' => $tomorrow->copy()->setHour(7)->setMinute(30),
                'arrival_time' => $tomorrow->copy()->setHour(9)->setMinute(0),
                'price' => 100.00,
                'available_seats' => 70,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        if ($vca && $han) {
            DB::table('flights')->insert([
                'flight_number' => 'VJ302',
                'departure_airport_id' => $vca->id,
                'arrival_airport_id' => $han->id,
                'departure_time' => $tomorrow->copy()->setHour(15)->setMinute(0),
                'arrival_time' => $tomorrow->copy()->setHour(16)->setMinute(30),
                'price' => 95.00,
                'available_seats' => 60,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        if ($sgn && $dad) {
            DB::table('flights')->insert([
                'flight_number' => 'VJ401',
                'departure_airport_id' => $sgn->id,
                'arrival_airport_id' => $dad->id,
                'departure_time' => $tomorrow->copy()->setHour(10)->setMinute(15),
                'arrival_time' => $tomorrow->copy()->setHour(11)->setMinute(45),
                'price' => 80.00,
                'available_seats' => 90,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        if ($dad && $sgn) {
            DB::table('flights')->insert([
                'flight_number' => 'VJ402',
                'departure_airport_id' => $dad->id,
                'arrival_airport_id' => $sgn->id,
                'departure_time' => $tomorrow->copy()->setHour(17)->setMinute(0),
                'arrival_time' => $tomorrow->copy()->setHour(18)->setMinute(30),
                'price' => 85.00,
                'available_seats' => 85,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        if ($sgn && $vca) {
            DB::table('flights')->insert([
                'flight_number' => 'VJ501',
                'departure_airport_id' => $sgn->id,
                'arrival_airport_id' => $vca->id,
                'departure_time' => $tomorrow->copy()->setHour(9)->setMinute(30),
                'arrival_time' => $tomorrow->copy()->setHour(10)->setMinute(45),
                'price' => 70.00,
                'available_seats' => 75,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        if ($vca && $sgn) {
            DB::table('flights')->insert([
                'flight_number' => 'VJ502',
                'departure_airport_id' => $vca->id,
                'arrival_airport_id' => $sgn->id,
                'departure_time' => $tomorrow->copy()->setHour(19)->setMinute(0),
                'arrival_time' => $tomorrow->copy()->setHour(20)->setMinute(15),
                'price' => 75.00,
                'available_seats' => 65,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        if ($dad && $vca) {
            DB::table('flights')->insert([
                'flight_number' => 'VJ601',
                'departure_airport_id' => $dad->id,
                'arrival_airport_id' => $vca->id,
                'departure_time' => $tomorrow->copy()->setHour(6)->setMinute(45),
                'arrival_time' => $tomorrow->copy()->setHour(8)->setMinute(0),
                'price' => 65.00,
                'available_seats' => 60,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        if ($vca && $dad) {
            DB::table('flights')->insert([
                'flight_number' => 'VJ602',
                'departure_airport_id' => $vca->id,
                'arrival_airport_id' => $dad->id,
                'departure_time' => $tomorrow->copy()->setHour(13)->setMinute(0),
                'arrival_time' => $tomorrow->copy()->setHour(14)->setMinute(15),
                'price' => 68.00,
                'available_seats' => 55,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        if ($sgn && $han) {
            DB::table('flights')->insert([
                'flight_number' => 'VJ701',
                'departure_airport_id' => $sgn->id,
                'arrival_airport_id' => $han->id,
                'departure_time' => $tomorrow->copy()->setHour(21)->setMinute(0),
                'arrival_time' => $tomorrow->copy()->setHour(23)->setMinute(0),
                'price' => 110.00,
                'available_seats' => 100,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
