<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $customers = [];
        for ($i = 1; $i <= 15; $i++) {
            $customers[] = ['id' => $i, 'created_at' => now(), 'updated_at' => now()];
        }

        DB::table('customers')->insert($customers);
    }
}
