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
        $admin          = Role::create(['name' => 'Admin']);
        $productManager = Role::create(['name' => 'Product Manager']);
        $customer       = Role::create(['name' => 'Customer']);

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
            'delete-sub-category'
        ]);

        $productManager->givePermissionTo([
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
