<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Main Course'],
            ['id' => 2, 'name' => 'Dessert'],
            ['id' => 3, 'name' => 'Drinks'],
            ['id' => 4, 'name' => 'Snacks'],
        ]);
    }
}
