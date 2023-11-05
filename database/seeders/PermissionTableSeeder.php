<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Permissions
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
    }
}
