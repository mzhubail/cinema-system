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
    $movie = fake()->randomElement(Movie::select('id')->get());
    // Limit movies 1..3 with time slots in the future (i.e. coming soon)
    $getStartTime = ($movie->id <= 3)
      ? fn () => fake()->dateTimeBetween('+1 day', '+4 day')
      : fn () => fake()->dateTimeBetween('-7 day', '+7 day');

    do {
      $start_time = $getStartTime();
      $hall_id = fake()->randomElement(Hall::select('id')->get());
    } while (
      config('constants.avoid_conflicts') &&
      TimeSlotController::has_conflict(
        Hall::find($hall_id)->first(),
        DateTimeImmutable::createFromInterface(
          $start_time
        ),
        Movie::find($movie)->first()->duration,
      )
    );
    return [
      'start_time' => $start_time,
      'movie_id' => $movie,
      'hall_id' => $hall_id,
    ];
  }
}
