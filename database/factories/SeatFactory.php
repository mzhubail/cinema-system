<?php

namespace Database\Factories;

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
        $booking_id = fake()->randomElement(Booking::get())->id;
        $row = fake()->numberBetween(0, 12);
        $column = fake()->numberBetween(0, 12);
        return [
            'booking_id' => $booking_id,
            'row' => $row,
            'column' => $column,
        ];
    }
}
