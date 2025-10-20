<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Flight;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_book_when_seats_available()
    {
        $this->seed();

        $user = User::factory()->create();
        $flight = Flight::first();

        $response = $this->actingAs($user)->post(route('bookings.store'), [
            'flight_id' => $flight->id,
            'seats' => 2,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'flight_id' => $flight->id,
            'seats' => 2,
        ]);
    }
}
