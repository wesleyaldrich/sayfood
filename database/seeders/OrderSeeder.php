<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'customer_id' => 2,
                'restaurant_id' => 1,
                'status' => 'Order Completed',
                'created_at' => now()
            ],
            [
                'customer_id' => 2,
                'restaurant_id' => 2,
                'status' => 'Order Reviewed',
                'created_at' => now()
            ],
            [
                'customer_id' => 3,
                'restaurant_id' => 3,
                'status' => 'Order Completed',
                'created_at' => now()
            ],
            [
                'customer_id' => 3,
                'restaurant_id' => 4,
                'status' => 'Order Reviewed',
                'created_at' => now()
            ],
            [
                'customer_id' => 3,
                'restaurant_id' => 1,
                'status' => 'Order Reviewed',
                'created_at' => now()
            ],
        ];

        Order::insert($data);
    }
}
