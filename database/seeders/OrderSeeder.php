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
                'created_at' => now(),
                'updated_at' => now(),
                'rating' => null
            ],
            [
                'customer_id' => 2,
                'restaurant_id' => 2,
                'status' => 'Order Reviewed',
                'created_at' => now(),
                'updated_at' => now(),
                'rating' => '5'
            ],
            [
                'customer_id' => 3,
                'restaurant_id' => 3,
                'status' => 'Order Completed',
                'created_at' => now(),
                'updated_at' => now(),
                'rating' => null
            ],
            [
                'customer_id' => 3,
                'restaurant_id' => 4,
                'status' => 'Order Reviewed',
                'created_at' => now(),
                'updated_at' => now(),
                'rating' => '4'
            ],
            [
                'customer_id' => 3,
                'restaurant_id' => 1,
                'status' => 'Order Reviewed',
                'created_at' => now(),
                'updated_at' => now(),
                'rating' => '3'
            ],
            [
                'customer_id' => 2,
                'restaurant_id' => 1, // Order ID 6
                'status' => 'Order Created',
                'created_at' => now(),
                'updated_at' => now(),
                'rating' => null
            ],
            [
                'customer_id' => 3,
                'restaurant_id' => 1, // Order ID 7
                'status' => 'Order Created',
                'created_at' => now(),
                'updated_at' => now(),
                'rating' => null
            ],
            [
                'customer_id' => 3,
                'restaurant_id' => 1,
                'status' => 'Order Completed',
                'created_at' => now(),
                'updated_at' => now(),
                'rating' => null
            ],
            [
                'customer_id' => 9,
                'restaurant_id' => 1,
                'status' => 'Order Reviewed',
                'created_at' => now(),
                'updated_at' => now(),
                'rating' => '4'
            ],
            [
                'customer_id' => 2,
                'restaurant_id' => 1,
                'status' => 'Order Reviewed',
                'created_at' => now(),
                'updated_at' => now(),
                'rating' => '4'
            ],
        ];

        Order::insert($data);
    }
}
