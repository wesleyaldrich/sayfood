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
        // Create the Admin User
        User::create([
            'role' => 'admin',
            'username' => 'admin',
            'email' => 'email_admin@gmail.com',
<<<<<<< HEAD
            'password' => Hash::make('adminnnn'), // Always hash passwords
=======
            'password' => Hash::make('admin'),
>>>>>>> 6e15715c2302d2c74c3e8d8b1ec7eb2d904010d1
            'two_factor_verified' => 1,
        ]);

        // Create Customer Users
        for ($i = 1; $i <= 9; $i++) {
            User::create([
                'id' => $i + 1,
                'role' => 'customer',
                'username' => 'customer' . $i,
                'email' => 'customer' . $i . '@gmail.com',
                'password' => Hash::make('customer' . $i),
                'two_factor_verified' => 1,
            ]);
        }

        // Create Restaurant Users
        for ($i = 1; $i <= 20; $i++) {
            User::create([
                'id' => $i + 10,
                'role' => 'restaurant',
                'username' => 'restaurant' . $i,
                'email' => 'restaurant' . $i . '@gmail.com',
                'password' => Hash::make('restaurant' . $i),
                'two_factor_verified' => 1,
            ]);
        }
    }
}
