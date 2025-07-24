<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
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
                'description' => 'They sell expired foods'
            ],
            [
                'customer_id' => 3,
                'restaurant_id' => 3,
                'description' => 'They food is not like the image!'
            ],
            [
                'customer_id' => 3,
                'restaurant_id' => 1,
                'description' => 'Lorem ipsum dolor sit amet. There are actually no issue. This report is a troll.'
            ],
        ];

        Report::insert($data);
    }
}
