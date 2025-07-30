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
                'notes' => 'Tolong dikemas rapi',
                'created_at' => now()
            ],
            [
                'food_id' => 4,
                'order_id' => 1,
                'qty' => 5,
                'notes' => 'Harap pisahkan dari pesanan lain',
                'created_at' => now()
            ],
            [
                'food_id' => 12,
                'order_id' => 2,
                'qty' => 4,
                'notes' => 'Minta tambahan sendok',
                'created_at' => now()
            ],
            [
                'food_id' => 16,
                'order_id' => 2,
                'qty' => 20,
                'notes' => 'Harap pisahkan dalam dua kantong',
                'created_at' => now()
            ],
            [
                'food_id' => 20,
                'order_id' => 3,
                'qty' => 10,
                'notes' => 'Tolong beri label pada kemasan',
                'created_at' => now()
            ],
            [
                'food_id' => 21,
                'order_id' => 3,
                'qty' => 5,
                'notes' => 'Minta porsi kecil',
                'created_at' => now()
            ],
            [
                'food_id' => 23,
                'order_id' => 4,
                'qty' => 4,
                'notes' => 'Tanpa bahan tambahan',
                'created_at' => now()
            ],
            [
                'food_id' => 24,
                'order_id' => 4,
                'qty' => 20,
                'notes' => 'Pisahkan ke dalam beberapa bungkus',
                'created_at' => now()
            ],
            [
                'food_id' => 6,
                'order_id' => 5,
                'qty' => 5,
                'notes' => 'Tidak perlu tambahan apapun',
                'created_at' => now()
            ],
            [
                'food_id' => 7,
                'order_id' => 5,
                'qty' => 4,
                'notes' => 'Tolong jangan dicampur',
                'created_at' => now()
            ],
            [
                'food_id' => 8,
                'order_id' => 5,
                'qty' => 20,
                'notes' => 'Tambahkan tisu jika ada',
                'created_at' => now()
            ],
            [
                'food_id' => 4,
                'order_id' => 6,
                'qty' => 2,
                'notes' => 'Cukup porsi kecil',
                'created_at' => now()
            ],
            [
                'food_id' => 6,
                'order_id' => 7,
                'qty' => 3,
                'notes' => 'Tanpa tambahan lain',
                'created_at' => now()
            ],
            [
                'food_id' => 8,
                'order_id' => 8,
                'qty' => 10,
                'notes' => 'Disiapkan secepatnya bila bisa',
                'created_at' => now()
            ],
            [
                'food_id' => 4,
                'order_id' => 9,
                'qty' => 5,
                'notes' => null,
                'created_at' => now()
            ],
            [
                'food_id' => 12,
                'order_id' => 10,
                'qty' => 4,
                'notes' => null,
                'created_at' => now()
            ],
        ];


        Transaction::insert($data);
    }
}
