<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            RestaurantSeeder::class,
            FoodSeeder::class,
            EventCategorySeeder::class,
            CustomerSeeder::class,
            EventSeeder::class,
            OrderSeeder::class,
            RestaurantRegistrationSeeder::class,
            TransactionSeeder::class,
            CustomerEventSeeder::class,
            ReportSeeder::class
        ]);
    }
}
