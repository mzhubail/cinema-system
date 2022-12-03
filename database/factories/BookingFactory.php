<?php

namespace Database\Factories;

use App\Http\Controllers\BookingController;
use App\Models\Customer;
use App\Models\TimeSlot;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    do {
      $seats_start = fake()->numberBetween(0, 29);
      $seats_end = fake()->numberBetween($seats_start, 29);
      $time_slot_id = fake()->randomElement(TimeSlot::select('id')->get());
      $customer_id = fake()->randomElement(Customer::select('id')->get());
      $row = fake()->numberBetween(0, 7);

      $ts = TimeSlot::find($time_slot_id);
    } while (BookingController::has_conflict(
      TimeSlot::find($time_slot_id)->first(),
      $customer_id,
      $row,
      $seats_start,
      $seats_end,
    ));

    return [
      'payment_method' => fake()->randomElement(config('constants.payment_methods')),
      'time_slot_id' => $time_slot_id,
      'customer_id' => $customer_id,
      'row' => $row,
      'seats_start' => $seats_start,
      'seats_end' => $seats_end,
    ];
  }
}
