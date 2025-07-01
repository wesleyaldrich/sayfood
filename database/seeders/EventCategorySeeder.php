<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('event_categories')->insert([
            ['id' => 1, 'name' => 'Food Donation', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Cooking Workshop', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Education', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
