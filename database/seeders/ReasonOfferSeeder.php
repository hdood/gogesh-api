<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\ReasonOffer;
use Egulias\EmailValidator\Result\Reason\Reason;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ReasonOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker_ar = Faker::create('ar');
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            ReasonOffer::create([
                'title_ar' => $faker_ar->word,
                'title_en' => $faker->word,
                'description_ar' => $faker_ar->paragraph,
                'description_en' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
