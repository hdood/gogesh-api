<?php

namespace Database\Seeders;

use App\Models\Country;
use ParseCsv\Csv;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{

    private $arabicNames;
    private $englishNames;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $this->loadArabicNames();
        $this->loadEnglishNames();
        $i = 0;
        $j = 0;
        foreach ($this->arabicNames as $rows) {
            foreach ($rows as $arabicCountry => $arabicName) {
                if(!$arabicName) continue;

                foreach ($this->englishNames as $rows) {
                    foreach ($rows as $englishCountry => $englishName) {


                        if(!$englishName) continue;
                        if($i != $j){
                            $j++;
                            continue;
                        }
                        // echo "i = " . $i . "j = " . $j .  "arabic name : " . $arabicName . "  english name : " . $englishName .  "\n";
                        $country = Country::where('name_ar', $arabicCountry)->first();
                        $city = new \App\Models\City();
                        $city->name_ar = $arabicName;
                        $city->name_en = $englishName;
                        $city->country_id = $country->id;
                        $city->save();
                        $j++;
                    }
                }
                $i++;
                $j = 0;
            }
        }
    }

    function loadArabicNames()
    {
        $csv = new Csv();
        $csv->delimiter = ",";
        $csv->parseFile(__DIR__ . '/data/cities.csv');
        $this->arabicNames = $csv->data;
    }

    function loadEnglishNames()
    {
        $csv = new Csv();
        $csv->delimiter = ",";
        $csv->parseFile(__DIR__ . '/data/cities_english.csv');
        $this->englishNames = $csv->data;
    }
}
