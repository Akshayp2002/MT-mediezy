<?php

namespace Database\Seeders;

use App\Models\shop;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Admin
        $admin = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => Hash::make('password')
        ]);
        $admin->assignRole('Admin');

        // Creating Shop
        $shop = User::create([
            'name'     => 'Shop',
            'email'    => 'shop@example.com',
            'password' => Hash::make('password')
        ]);
        $shop->assignRole('Shops');

        shop::create([
            'user_id' => $shop->id,
            'name'    => "Shop Test",
            'address' => "Kozhikode",
        ]);

        // Creating Customer
        $customer = User::create(
            [
                'name'     => 'Customer 1',
                'email'    => 'customer1@example.com',
                'password' => Hash::make('password')
            ],
            [
                'name'     => 'Customer 2',
                'email'    => 'customer2@example.com',
                'password' => Hash::make('password')
            ],
            [
                'name'     => 'Customer 3',
                'email'    => 'customer3@example.com',
                'password' => Hash::make('password')
            ],
            [
                'name'     => 'Customer 4',
                'email'    => 'customer4@example.com',
                'password' => Hash::make('password')
            ],
            [
                'name'     => 'Customer 5',
                'email'    => 'customer5@example.com',
                'password' => Hash::make('password')
            ],
        );
        $customer->assignRole('Customer');
    }
}
