<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $strings = ["Masculin", "Feminin"];
        shuffle($strings);

        $random_index = array_rand($strings);

        $random_string = $strings[$random_index];
        return [
            'nom' => fake()->name(),
            'prenoms' => fake()->lastName(),
            'genre' => $random_string,
            'email' => fake()->unique()->safeEmail(),
            'telephone' => fake()->phoneNumber(),
            'email_verified_at' => now(),
            'password' => Random::generate(), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
