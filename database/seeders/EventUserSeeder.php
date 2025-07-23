<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('event_user')->insert([
            [
                'event_id'=>1,
                'user_id'=>1
            ],
            [
                'event_id'=>1,
                'user_id'=>2
            ],
            [
                'event_id'=>1,
                'user_id'=>3
            ],
            [
                'event_id'=>3,
                'user_id'=>3
            ],
            [
                'event_id'=>3,
                'user_id'=>4
            ],
            [
                'event_id'=>3,
                'user_id'=>5
            ],
            [
                'event_id'=>5,
                'user_id'=>4
            ],
            [
                'event_id'=>5,
                'user_id'=>5
            ],
            [
                'event_id'=>5,
                'user_id'=>6
            ],
            [
                'event_id'=>6,
                'user_id'=>2
            ],
            [
                'event_id'=>6,
                'user_id'=>5
            ],
            [
                'event_id'=>7,
                'user_id'=>6
            ],
            [
                'event_id'=>7,
                'user_id'=>7
            ],
            [
                'event_id'=>10,
                'user_id'=>8
            ],
            [
                'event_id'=>10,
                'user_id'=>9
            ],
            [
                'event_id'=>10,
                'user_id'=>3
            ],
        ]);
        
    }
}
