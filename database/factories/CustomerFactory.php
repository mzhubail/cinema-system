<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $pass = fake()->password(minLength: 8, maxLength: 10);
        // $pass = fake()->realText(maxNbChars: 10);
        // self::$passwords[] = $pass;
        $fName = fake()->firstName();
        return [
            //
            "fName" => $fName,
            "lName" => fake()->lastName(),
            // "email" => fake()->unique()->email(),
            "email" => "$fName@gmail.com",
            "birthday" => fake()->date(),
            "hash" => password_hash($fName.'123', PASSWORD_DEFAULT),
        ];
    }
    public static $passwords = [];
}
