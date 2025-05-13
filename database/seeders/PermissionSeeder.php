<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $permissions = [
            'view-product',
            'create-product',
            'edit-product',
            'delete-product',

            'view-product-customer',

            'view-category',
            'create-category',
            'edit-category',
            'delete-category',

            'view-sub-category',
            'create-sub-category',
            'edit-sub-category',
            'delete-sub-category'


        ];

        // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
