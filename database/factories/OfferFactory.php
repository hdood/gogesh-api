<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\CommercialActivity;
use App\Models\DurationOffer;
use App\Models\Season;
use App\Models\Sector;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageUrls = [];

        // Generate three fake image URLs
        for ($i = 0; $i < 3; $i++) {
            $imageUrl = fake()->imageUrl();
            $imageUrls[] = $imageUrl;
        }

        return [
            "title" => fake()->title(),
            "description" => fake()->paragraph(),
            "condition" => fake()->paragraph(),
            "price" => fake()->randomDigit(),
            "total" => fake()->randomDigit(),
            "discount" => fake()->randomDigit(),
            "images" => json_encode($imageUrls),
            "bold" => fake()->boolean(),
            "speciality_id" => 1,
            "commercial_activity_id" => 1,
            "activity_id" => 1,
            "sector_id" =>  1,
            "season_id" => 1,
            "duration_id" => DurationOffer::factory()->create(),
        ];
    }
}
