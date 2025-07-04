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
                'customer_id' => 2,
                'food_id' => 8,
                'payment_id' => 1,
                'qty' => 10
            ],
            [
                'customer_id' => 2,
                'food_id' => 4,
                'payment_id' => 1,
                'qty' => 5
            ],
            [
                'customer_id' => 1,
                'food_id' => 12,
                'payment_id' => 2,
                'qty' => 4
            ],
            [
                'customer_id' => 1,
                'food_id' => 16,
                'payment_id' => 2,
                'qty' => 20
            ],
        ];

        Transaction::insert($data);
    }
}
