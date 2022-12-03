<?php

namespace Database\Factories;

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
    $seats_start = fake()->numberBetween(0, 29);
    $seats_end = fake()->numberBetween($seats_start, 29);
    return [
      'payment_method' => fake()->randomElement(config('constants.payment_methods')),
      'time_slot_id' => fake()->randomElement(TimeSlot::select('id')->get()),
      'customer_id' => fake()->randomElement(Customer::select('id')->get()),
      'row' => fake()->numberBetween(0, 7),
      'seats_start' => $seats_start,
      'seats_end' => $seats_end,
    ];
  }
}
