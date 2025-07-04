<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'food_id' => 8,
                'order_id' => 1,
                'qty' => 10,
                'created_at' => now()
            ],
            [
                'food_id' => 4,
                'order_id' => 1,
                'qty' => 5,
                'created_at' => now()
            ],
            [
                'food_id' => 12,
                'order_id' => 2,
                'qty' => 4,
                'created_at' => now()
            ],
            [
                'food_id' => 16,
                'order_id' => 2,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'food_id' => 20,
                'order_id' => 3,
                'qty' => 10,
                'created_at' => now()
            ],
            [
                'food_id' => 21,
                'order_id' => 3,
                'qty' => 5,
                'created_at' => now()
            ],
            [
                'food_id' => 23,
                'order_id' => 4,
                'qty' => 4,
                'created_at' => now()
            ],
            [
                'food_id' => 24,
                'order_id' => 4,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'food_id' => 6,
                'order_id' => 5,
                'qty' => 5,
                'created_at' => now()
            ],
            [
                'food_id' => 7,
                'order_id' => 5,
                'qty' => 4,
                'created_at' => now()
            ],
            [
                'food_id' => 8,
                'order_id' => 5,
                'qty' => 20,
                'created_at' => now()
            ],
        ];

        Transaction::insert($data);
    }
}
