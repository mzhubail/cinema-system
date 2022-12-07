<?php

namespace Database\Factories;

use App\Http\Controllers\TimeSlotController;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Movie, Hall};
use DateTimeImmutable;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\time_slot>
 */
class TimeSlotFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    do {
      $start_time = fake()->dateTimeBetween('-3 day', '+4 day');
      $movie_id = fake()->randomElement(Movie::select('id')->get());
      $hall_id = fake()->randomElement(Hall::select('id')->get());
    } while (
      config('constants.avoid_conflicts') &&
      TimeSlotController::has_conflict(
        Hall::find($hall_id)->first(),
        DateTimeImmutable::createFromInterface(
          $start_time
        ),
        Movie::find($movie_id)->first()->duration,
      )
    );
    return [
      'start_time' => $start_time,
      'movie_id' => $movie_id,
      'hall_id' => $hall_id,
    ];
  }
}
