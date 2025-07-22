<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('customer_event')->insert([
            [
                'event_id'=>1,
                'customer_id'=>1
            ],
            [
                'event_id'=>1,
                'customer_id'=>2
            ],
            [
                'event_id'=>1,
                'customer_id'=>3
            ],
            [
                'event_id'=>3,
                'customer_id'=>3
            ],
            [
                'event_id'=>5,
                'customer_id'=>3
            ],
            [
                'event_id'=>6,
                'customer_id'=>3
            ],
            [
                'event_id'=>7,
                'customer_id'=>3
            ],
            [
                'event_id'=>3,
                'customer_id'=>4
            ],
            [
                'event_id'=>3,
                'customer_id'=>5
            ],
            [
                'event_id'=>5,
                'customer_id'=>4
            ],
            [
                'event_id'=>5,
                'customer_id'=>5
            ],
            [
                'event_id'=>5,
                'customer_id'=>6
            ],
            [
                'event_id'=>6,
                'customer_id'=>2
            ],
            [
                'event_id'=>6,
                'customer_id'=>5
            ],
            [
                'event_id'=>7,
                'customer_id'=>6
            ],
            [
                'event_id'=>7,
                'customer_id'=>7
            ],
            [
                'event_id'=>10,
                'customer_id'=>8
            ],
            [
                'event_id'=>10,
                'customer_id'=>9
            ],
            [
                'event_id'=>10,
                'customer_id'=>3
            ],
        ]);
        
    }
}
