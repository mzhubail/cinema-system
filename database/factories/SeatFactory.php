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
    // Pick a booking that has no more than 7 seats already
    do {
      $booking = fake()->randomElement(Booking::get());
      $booking->loadCount('seats');
    } while ($booking->seats_count > 7);

    // Pick row and column without conflict
    do {
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
