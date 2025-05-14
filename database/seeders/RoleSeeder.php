<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin    = Role::create(['name' => 'Admin']);
        $shop     = Role::create(['name' => 'Shops']);
        $customer = Role::create(['name' => 'Customer']);

        $admin->givePermissionTo([
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
            'delete-sub-category',
            'manage-shops',

            'view-shops',
            'create-shops',
            'store-shops',
            'edit-shops',
            'update-shops',
            
            'view-customers',

        ]);

        $shop->givePermissionTo([
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
        ]);

        $customer->givePermissionTo([
            'view-product-customer',
        ]);
    }
}
