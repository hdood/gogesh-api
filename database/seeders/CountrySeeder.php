<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            "البحرين" => "Bahrain",
            "الكويت" => "Kuwait",
            "عمان" => "Oman",
            "قطر" => "Qatar",
            "الإمارات العربية المتحدة" => "United Arab Emirates",
            "المملكة العربية السعودية" => "Saudi Arabia"
        ];

        foreach ($countries as $arabicName => $englishName) {
            Country::create([
                "name_ar" => $arabicName,
                "name_en" => $englishName,
                "status" => "Active"
            ]);
        }
    }
}
