<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Flight;

class BookingEdgeCaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_book_more_than_available_seats()
    {
        $this->seed();

        $user = User::factory()->create();
        $flight = Flight::first();

        // set available seats low
        $flight->available_seats = 1;
        $flight->save();

        $response = $this->actingAs($user)->post(route('bookings.store'), [
            'flight_id' => $flight->id,
            'seats' => 2,
        ]);

        $response->assertStatus(500); // our controller throws exception; improve later to return validation
        $this->assertDatabaseMissing('bookings', [
            'user_id' => $user->id,
            'flight_id' => $flight->id,
        ]);
    }
}
