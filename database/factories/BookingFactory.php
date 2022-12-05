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
    $time_slot_id = fake()->randomElement(TimeSlot::select('id')->get());
    $customer_id = fake()->randomElement(Customer::select('id')->get());

    return [
      'payment_method' => fake()->randomElement(config('constants.payment_methods')),
      'time_slot_id' => $time_slot_id,
      'customer_id' => $customer_id,
    ];
  }
}
