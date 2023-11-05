<?php

namespace Database\Seeders;

use App\Models\City;
use ParseCsv\Csv;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionSeeder extends Seeder
{

    private $arabicNames;
    private $englishNames;

    /**
     * Run the database seeds.
     */
    public function run(string $country): void
    {
        $this->loadArabicNames($country);
        $this->loadEnglishNames($country);
        $i = 0;
        $j = 0;
        foreach ($this->arabicNames as $rows) {
            foreach ($rows as $arabicRegion => $arabicName) {
                if(!$arabicName) continue;

                foreach ($this->englishNames as $rows) {
                    foreach ($rows as $englishRegion => $englishName) {


                        if(!$englishName) continue;
                        if($i != $j){
                            $j++;
                            continue;
                        }

                        echo "arabic name : " . $arabicName . "  english name : " . $englishName .  "\n";

                        $city = City::where('name_ar', trim($arabicRegion))->first();

                        $region = new Region();
                        $region->name_ar = $arabicName;
                        $region->name_en = $englishName;
                        $region->city_id = $city->id;
                        $region->save();
                        $j++;
                    }
                }
                $i++;
                $j = 0;
            }
        }
    }

    function loadArabicNames(string $country)
    {
        $csv = new Csv();
        $csv->delimiter = ",";
        $csv->parseFile(__DIR__ . '/data/' . $country .  '.csv');
        $this->arabicNames = $csv->data;
    }

    function loadEnglishNames(string $country)
    {
        $csv = new Csv();
        $csv->delimiter = ",";
        $csv->parseFile(__DIR__ . '/data/' . $country . '_english.csv');
        $this->englishNames = $csv->data;
    }
}
