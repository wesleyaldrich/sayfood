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
                'notes' => 'Pesan tanpa sambal',
                'created_at' => now()
            ],
            [
                'food_id' => 4,
                'order_id' => 1,
                'qty' => 5,
                'notes' => 'Pakai plastik terpisah',
                'created_at' => now()
            ],
            [
                'food_id' => 12,
                'order_id' => 2,
                'qty' => 4,
                'notes' => 'Tambahkan sendok',
                'created_at' => now()
            ],
            [
                'food_id' => 16,
                'order_id' => 2,
                'qty' => 20,
                'notes' => 'Tanpa kuah',
                'created_at' => now()
            ],
            [
                'food_id' => 20,
                'order_id' => 3,
                'qty' => 10,
                'notes' => 'Level pedas 3',
                'created_at' => now()
            ],
            [
                'food_id' => 21,
                'order_id' => 3,
                'qty' => 5,
                'notes' => 'Porsi anak-anak',
                'created_at' => now()
            ],
            [
                'food_id' => 23,
                'order_id' => 4,
                'qty' => 4,
                'notes' => 'Tanpa kacang',
                'created_at' => now()
            ],
            [
                'food_id' => 24,
                'order_id' => 4,
                'qty' => 20,
                'notes' => 'Dibungkus terpisah',
                'created_at' => now()
            ],
            [
                'food_id' => 6,
                'order_id' => 5,
                'qty' => 5,
                'notes' => 'Tidak terlalu manis',
                'created_at' => now()
            ],
            [
                'food_id' => 7,
                'order_id' => 5,
                'qty' => 4,
                'notes' => 'Jangan pakai bawang goreng',
                'created_at' => now()
            ],
            [
                'food_id' => 8,
                'order_id' => 5,
                'qty' => 20,
                'notes' => 'Tambah saus ekstra',
                'created_at' => now()
            ],
            [
                'food_id' => 4,
                'order_id' => 6,
                'qty' => 2,
                'notes' => 'Porsi kecil saja',
                'created_at' => now()
            ],
            [
                'food_id' => 6,
                'order_id' => 7,
                'qty' => 3,
                'notes' => 'Tanpa nasi',
                'created_at' => now()
            ],
            [
                'food_id' => 8,
                'order_id' => 8,
                'qty' => 10,
                'notes' => 'Kirim cepat ya',
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
                'noted' => null,
                'created_at' => now()
            ],
        ];

        Transaction::insert($data);
    }
}
