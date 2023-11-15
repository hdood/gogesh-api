<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Day;
use App\Models\City;
use App\Models\User;
use App\Models\Offer;
use App\Models\Region;
use App\Models\Season;
use App\Models\Sector;
use App\Models\Country;
use App\Models\Activity;
use App\Models\Ads;
use App\Models\Speciality;
use App\Models\DurationOffer;
use App\Models\PlacesAds;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(1)->create();
        // DurationOffer::truncate();
        // Season::truncate();
        // Speciality::truncate();
        // Day::truncate();
        // Country::truncate();
        // City::truncate();
        // Region::truncate();
        // Offer::factory(10)->create();
        // Ads::factory(10)->create();

        // DurationOffer::factory(1)->create();
        // Season::factory(10)->create();
        // Speciality::factory(10)->create();
        // Sector::factory(10)->create();

        $places = ['Home_Baner', 'Home_Flash', 'Sectors_Baner', 'Ads_Screen', 'Search_Baner', 'Sector_Flash', 'Sector_Baner', 'Notification'];
        foreach ($places as $key => $place) {
            PlacesAds::create([
                "place" => $place,
                "price" => 3,
            ]);
        }

        $admin = User::factory()->create([
            "name"=> "test",
            "email" => "mahdi@test.com", 
            "password" => Hash::make("password")
        ]);

        // Permissions
        $permissions = [
            'offer-list',
            'offer-create',
            'offer-edit',
            'offer-delete',

            'reason-list',
            'reason-create',
            'reason-edit',
            'reason-delete',

            'duration-list',
            'duration-create',
            'duration-edit',
            'duration-delete',

            'ads-list',
            'ads-create',
            'ads-edit',
            'ads-delete',

            'location-list',
            'location-create',
            'location-edit',
            'location-delete',

            'category-list',
            'category-create',
            'category-edit',
            'category-delete',

            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',

            'seller-list',
            'seller-create',
            'seller-edit',
            'seller-delete',

            'company-list',
            'company-create',
            'company-edit',
            'company-delete',

            'package-list',
            'package-create',
            'package-edit',
            'package-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create([
            "name" => "Super Admin"
        ]);

        $role->syncPermissions($permissions); 

        $admin->assignRole($role);

        $this->call(CountrySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(RegionSeeder::class, false, ["country" => "saudi"]);
        $this->call(RegionSeeder::class, false, ["country" => "kuwait"]);
        $this->call(RegionSeeder::class, false, ["country" => "oman"]);
        $this->call(DaysSeeder::class); 
        
    }
}
