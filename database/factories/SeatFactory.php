<?php

namespace Database\Factories;

use App\Http\Controllers\SeatController;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seat>
 */
class SeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        do {
            $booking = fake()->randomElement(Booking::get());
            $row = fake()->numberBetween(0, 4);
            $column = fake()->numberBetween(0, 14);
        } while (
            config('constants.avoid_conflicts') &&
            SeatController::has_conflict(
                $booking->time_slot,
                $row,
                $column
            )
        );
        return [
            'booking_id' => $booking->id,
            'row' => $row,
            'column' => $column,
        ];
    }
}
