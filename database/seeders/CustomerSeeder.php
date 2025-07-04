<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [];

        // User dengan role customer biasanya dimulai dari ID 2
        for ($i = 1; $i <= 15; $i++) {
            $customers[] = [
                'id' => $i, // ID customer diset manual
                'user_id' => $i + 1, // Diasumsikan user_id 2-16 adalah customer1-15
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('customers')->insert($customers);
    }
}
