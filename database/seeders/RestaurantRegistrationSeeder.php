<?php

namespace Database\Seeders;

use App\Models\RestaurantRegistration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RestaurantRegistration::insert([
            [
                'id' => 1,
                'name' => 'BART',
                'address' => 'Artotel Jakarta, Lantai 7, Jl. Sunda No. 3, Thamrin, Jakarta',
                'email' => 'restaurant1@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 1
            ],
            [
                'id' => 2,
                'name' => 'Sana Sini Restaurant',
                'address' => 'Pullman Jakarta Indonesia, Jl. M.H. Thamrin 59, Thamrin, Jakarta',
                'email' => 'restaurant2@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 2
            ],
            [
                'id' => 3,
                'name' => 'KAUM Jakarta',
                'address' => 'Jl. Dr. Kusuma Atmaja No. 77-79, Thamrin, Jakarta',
                'email' => 'restaurant3@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 3
            ],
            [
                'id' => 4,
                'name' => 'Li Feng',
                'address' => 'Hotel Mandarin Oriental, Jakarta, Jl. M. H. Thamrin, Thamrin, Jakarta 10310',
                'email' => 'restaurant4@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 4
            ],
            [
                'id' => 5,
                'name' => 'Henshin',
                'address' => 'The Westin Jakarta, Lantai 67-69, Jl. H. R. Rasuna Said, Kuningan, Jakarta 12940',
                'email' => 'restaurant5@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 5
            ],
            [
                'id' => 6,
                'name' => 'Seasonal Tastes',
                'address' => 'The Westin Jakarta, Jl. H. R. Rasuna Said, Kuningan, Jakarta',
                'email' => 'restaurant6@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 6
            ],
            [
                'id' => 7,
                'name' => 'Lyon',
                'address' => 'Hotel Mandarin Oriental, Jakarta, Jl. M. H. Thamrin, Thamrin, Jakarta',
                'email' => 'restaurant7@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 7
            ],
            [
                'id' => 8,
                'name' => 'OPEN Restaurant',
                'address' => 'DoubleTree by Hilton Jakarta - Diponegoro, Jl. Pegangsaan Timur No. 17, Cikini - Menteng, Jakarta Pusat  10310',
                'email' => 'restaurant8@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 8
            ],
            [
                'id' => 9,
                'name' => 'Tugu Kunstkring Paleis',
                'address' => 'Jl. Teuku Umar No. 1, Menteng, Jakarta',
                'email' => 'restaurant9@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 9
            ],
            [
                'id' => 10,
                'name' => 'Sudestada Grill',
                'address' => 'Jl. Irian No.18, Thamrin, Jakarta 10350',
                'email' => 'restaurant10@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 10
            ],
            [
                'id' => 11,
                'name' => 'The Japanese',
                'address' => 'Sari Pacific Hotel, Jl. M. H. Thamrin No. 6, Thamrin, Jakarta 10340',
                'email' => 'restaurant11@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 11
            ],
            [
                'id' => 12,
                'name' => 'Giyanti Coffee Roastery',
                'address' => 'Jl. Surabaya No. 20, Cikini, Jakarta',
                'email' => 'restaurant12@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 12
            ],
            [
                'id' => 13,
                'name' => 'Arts Cafe',
                'address' => 'Raffles Jakarta, Jl. Prof. Dr. Satrio No. 3 - 5, Karet, Jakarta 12940',
                'email' => 'restaurant13@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 13
            ],
            [
                'id' => 14,
                'name' => 'Plataran Menteng',
                'address' => 'Jl. H.O.S. Cokroaminoto No. 42, Menteng, Jakarta',
                'email' => 'restaurant14@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 14
            ],
            [
                'id' => 15,
                'name' => 'La Vue Rooftop Bar',
                'address' => 'The Hermitage, Lantai 9. Jl. Cilacap No. 1, Menteng, Jakarta 10310',
                'email' => 'restaurant15@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 15
            ],
            [
                'id' => 16,
                'name' => 'Dope Burger & Co.',
                'address' => 'Jl. Teuku Cik Ditiro No. 25, Menteng, Jakarta',
                'email' => 'restaurant16@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 16
            ],
            [
                'id' => 17,
                'name' => 'Paradigma',
                'address' => 'Jl. Pegangsaan Barat No. 4, Cikini, Jakarta',
                'email' => 'restaurant17@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 17
            ],
            [
                'id' => 18,
                'name' => 'Bandar Djakarta',
                'address' => 'Taman Impian Jaya Ancol, Jl. Lodan Timur, Ancol, Jakarta 14430',
                'email' => 'restaurant18@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 18
            ],
            [
                'id' => 19,
                'name' => 'Cinnamon',
                'address' => 'Hotel Mandarin Oriental, Jakarta, Jl. M. H. Thamrin, Thamrin, Jakarta',
                'email' => 'restaurant19@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 19
            ],
            [
                'id' => 20,
                'name' => 'Bunga Rampai',
                'address' => 'Jl. Teuku Cik Ditiro No. 35, Menteng, Jakarta',
                'email' => 'restaurant20@gmail.com',
                'status' => 'operational',
                'restaurant_id' => 20
            ],
            [
                'id' => 21,
                'name' => 'Wesley\'s Restaurant',
                'address' => 'Jalan Imam Bonjol',
                'email' => 'izonefandom@gmail.com',
                'status' => 'pending',
                'restaurant_id' => null
            ],
            [
                'id' => 22,
                'name' => 'Warteg Sehat',
                'address' => 'Jalan Jendral Sudirman No. 30',
                'email' => 'wartegsehat@gmail.com',
                'status' => 'pending',
                'restaurant_id' => null
            ],
        ]);
    }
}
