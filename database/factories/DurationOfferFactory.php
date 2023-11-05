<?php

namespace Database\Factories;

use App\Models\DurationOffer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DurationOfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "type" => fake()->randomElement(['Days', 'Week', 'Month', 'Year']),
            "duration" => fake()->randomDigit(),
            "price" => fake()->randomDigit(),

        ];
    }
}
