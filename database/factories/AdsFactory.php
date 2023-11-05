<?php

namespace Database\Factories;

use App\Enum\EnumGeneral;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ads>
 */
class AdsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => fake()->title(),
            "description" => fake()->paragraph(),
            "duration" => fake()->numberBetween(1, 30),
            'date_start' => now(),
            "price" => fake()->randomDigit(),
            "total" => fake()->randomDigit(),
            "place" => Arr::random(['Home_Baner', 'Home_Flash', 'Sectors_Baner', 'Ads_Screen', 'Search_Baner', 'Sector_Flash', 'Sector_Baner', 'Notification']),
            "images" => fake()->imageUrl(),
            "seller_id" => 1,
            "status" => Arr::random([EnumGeneral::APPROVED, EnumGeneral::PENDING, EnumGeneral::REJECTED]),
        ];
    }
}
