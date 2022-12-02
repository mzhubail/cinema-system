<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Movie, Hall};

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
        return [
            'start_time' => fake()->dateTimeBetween('-3 day', '+4 day'),
            'movie_id' => fake()->randomElement(Movie::select('id')->get()),
            'hall_id' => fake()->randomElement(Hall::select('id')->get()),
        ];
    }
}
