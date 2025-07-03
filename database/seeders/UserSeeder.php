<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create the Admin User
        User::create([
            'role' => 'admin',
            'username' => 'admin',
            'email' => 'email_admin@gmail.com',
            'password' => Hash::make('admin'), // Always hash passwords
            'two_factor_verified' => 1,
        ]);

        // 2. Create the Customer User
        User::create([
            'role' => 'customer',
            'username' => 'customer',
            'email' => 'email_customer@gmail.com',
            'password' => Hash::make('customer'),
            'two_factor_verified' => 1,
        ]);

        // 3. Create the Restaurant User
        User::create([
            'role' => 'restaurant',
            'username' => 'restaurant',
            'email' => 'email_restaurant@gmail.com',
            'password' => Hash::make('restaurant'),
            'two_factor_verified' => 1,
        ]);

        for ($i = 1; $i <= 19; $i++) {
            User::create([
                'role' => 'restaurant',
                'username' => 'restaurant' . $i,
                'email' => 'restaurant' . $i . '@gmail.com',
                'password' => Hash::make('restaurant' . $i),
                'two_factor_verified' => 1,
            ]);
        }
    }
}
