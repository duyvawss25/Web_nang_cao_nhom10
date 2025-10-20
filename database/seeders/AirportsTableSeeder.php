<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AirportsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('airports')->insert([
            ['code' => 'HAN', 'name' => 'Noi Bai International Airport', 'city' => 'Hanoi', 'country' => 'Vietnam', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['code' => 'SGN', 'name' => 'Tan Son Nhat International Airport', 'city' => 'Ho Chi Minh City', 'country' => 'Vietnam', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['code' => 'DAD', 'name' => 'Da Nang International Airport', 'city' => 'Da Nang', 'country' => 'Vietnam', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
