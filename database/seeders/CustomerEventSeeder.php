<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CustomerEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
         DB::table('customer_event')->insert([
            [
                'event_id'=>1,
                'customer_id'=>1,
                'phone_number'=> $faker->phoneNumber()
            ],
            [
                'event_id'=>1,
                'customer_id'=>2,
                'phone_number'=> $faker->phoneNumber()
            ],
            [
                'event_id'=>1,
                'customer_id'=>3,
                'phone_number'=> $faker->phoneNumber()
            ],
            [
                'event_id'=>3,
                'customer_id'=>3,
                'phone_number'=> $faker->phoneNumber()
            ],
            [
                'event_id'=>3,
                'customer_id'=>4,
                'phone_number'=> $faker->phoneNumber()
            ],
            [
                'event_id'=>3,
                'customer_id'=>5,
                'phone_number'=> $faker->phoneNumber()
            ],
            [
                'event_id'=>5,
                'customer_id'=>4,
                'phone_number'=> $faker->phoneNumber()
            ],
            [
                'event_id'=>5,
                'customer_id'=>5,
                'phone_number'=> $faker->phoneNumber()
            ],
            [
                'event_id'=>5,
                'customer_id'=>6,
                'phone_number'=> $faker->phoneNumber()
            ],
            [
                'event_id'=>6,
                'customer_id'=>2,
                'phone_number'=> $faker->phoneNumber()
            ],
            [
                'event_id'=>6,
                'customer_id'=>5,
                'phone_number'=> $faker->phoneNumber()
            ],
            [
                'event_id'=>7,
                'customer_id'=>6,
                'phone_number'=> $faker->phoneNumber()
            ],
            [
                'event_id'=>7,
                'customer_id'=>7,
                'phone_number'=> $faker->phoneNumber()
            ],
            [
                'event_id'=>10,
                'customer_id'=>8,
                'phone_number'=> $faker->phoneNumber()
            ],
            [
                'event_id'=>10,
                'customer_id'=>9,
                'phone_number'=> $faker->phoneNumber()
            ],
            [
                'event_id'=>10,
                'customer_id'=>3,
                'phone_number'=> $faker->phoneNumber()
            ],
        ]);   
    }
}
