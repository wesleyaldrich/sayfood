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

<<<<<<< HEAD
        for ($i = 1; $i <= 10; $i++) {
            $customers[] = [
                'id' => $i,
                'user_id' => $i+1, 
=======
        // User dengan role customer biasanya dimulai dari ID 2
        for ($i = 1; $i <= 9; $i++) {
            $customers[] = [
                'id' => $i,
                'user_id' => $i + 1,
>>>>>>> ac428bdae8a6ef4035a29b5bb78563fbaf9f2e5c
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('customers')->insert($customers);
    }
}
