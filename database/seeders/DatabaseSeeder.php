<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Controllers\TimeSlotController;
use App\Models\Booking;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Seat;
use App\Models\TimeSlot;
use DateTimeImmutable;
use Illuminate\Database\Seeder;
use Str;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $customers =
      Customer::factory(10)->create();
    $movies =
      Movie::factory(5)->create();

    // $movies = Movie::get();
    // $customers = Customer::get();

    // Branches
    foreach (range(1, 3) as $i) {
      $branch = Branch::factory()->create();
      $letters = collect([]);

      // Halls
      // foreach (range(1, fake()->numberBetween(2,4)) as $j) {
      foreach (range(1, 3) as $j) {
        // Check for letter uniqueness
        do {
          $letter = Str::upper(
            fake()->randomLetter()
          );
        } while ($letters->contains($letter));

        $hall = Hall::create([
          'letter' => $letter,
          'branch_id' => $branch->id,
        ]);

        // Time Slots
        foreach (range(1, 10) as $k) {
          $movie = fake()->randomElement($movies);

          // Pick date interval
          if ($movie->id <= 4)
            $getStartTime = fn () => fake()->dateTimeBetween('+1 day', '+8 day'); // Coming soon
          elseif ($movie->id <= 8)
            $getStartTime = fn () => fake()->dateTimeBetween('-14 day', '-8 day'); // In the past
          elseif ($movie->id <= 10)
            $getStartTime = fn () => fake()->dateTimeBetween('-7 day', '+21 day');
          else
            $getStartTime = fn () => fake()->dateTimeBetween('-16 day', '+35 day');

          // Check for time conflict
          do {
            $start_time = $getStartTime();
          } while (
            config('constants.avoid_conflicts') &&
            TimeSlotController::has_conflict(
              $hall,
              DateTimeImmutable::createFromInterface(
                $start_time
              ),
              $movie->duration,
            )
          );

          $time_slot = TimeSlot::create([
            'start_time' => $start_time,
            'movie_id' => $movie->id,
            'hall_id' => $hall->id,
          ]);
          $all_seats = collect([]);

          // Bookings
          foreach (range(1, 4) as $l) {
            $customer = fake()->randomElement($customers);

            $current_seats = collect([]);
            // Seats
            foreach (range(1, 4) as $m) {
              // Check for seat conflict
              do {
                $row = fake()->numberBetween(0, 4);
                $column = fake()->numberBetween(0, 14);
              } while ($all_seats->contains([$row, $column]));
              $current_seats->push([$row, $column]);
              $all_seats->push([$row, $column]);
            }

            // TODO: change price calculation
            $price = $current_seats->count() * 3;

            $booking = Booking::create([
              'payment_method' => fake()->randomElement(config('constants.payment_methods')),
              'time_slot_id' => $time_slot->id,
              'customer_id' => $customer->id,
              'price' => $price,
            ]);
            foreach ($current_seats as [$row, $column])
              Seat::create([
                'booking_id' => $booking->id,
                'row' => $row,
                'column' => $column,
              ]);
          }
        }
      }
    }
  }
}
