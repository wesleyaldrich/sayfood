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

        //  customer dengan id 1 = admin
        $customers[] = [
            'id'         => 1, 
            'user_id'    => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ];

        for ($i = 2; $i <= 10; $i++) {
            $customers[] = [
                'id'         => $i,
                'user_id'    => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('customers')->insert($customers);
    }
}
