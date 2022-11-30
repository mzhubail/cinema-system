<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'id' => fake()->unique()->randomNumber(nbDigits: 100, strict: false),
            // 'id' => self::$currentId++,
            'title' => fake()->realText('32'),
            'release_year' => fake()->year(),
            'lang' => fake()->randomElement(["ar", "en", "hu"]),
            'duration' => fake()->numberBetween(0, 180),
            'rating' => fake()->randomFloat(1, 0, 10),
            'genre' => fake()->randomElement(config('constants.genres')),
            'desc' => fake()->realText(maxNbChars: 400),
            'img_path' => fake()->randomElement(Storage::files('posters')),
        ];
    }
    private static $currentId = 1;
}
