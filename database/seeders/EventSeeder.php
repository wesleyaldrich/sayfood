<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    private function randomGroupLink()
    {
        $groupLinks = [
            'https://chat.whatsapp.com/KomunitasBerbagi',
            'https://t.me/PenyelamatKelaparan',
            'https://chat.whatsapp.com/SukaBagiBagiMakanan',
            'https://t.me/KelompokPeduliSesama',
        ];

        return $groupLinks[array_rand($groupLinks)];
    }

    public function run(): void
    {
        DB::table('events')->insert([
            [
                'id' => 1, 'creator_id' => 1, 'event_category_id' => 2, // Cooking Workshop
                'name' => 'Cooking for Charity',
                'description' => 'Lets Share Indonesia kembali menggelar kegiatan memasak amal untuk membantu sesama yang membutuhkan, terutama anak-anak panti asuhan.',
                'image_url' => 'event_images/ev1.jpg', 'date' => '2025-06-20', 'location' => 'Ramurasa Cooking Studio, Kemang Jakarta Selatan', 'status' => 'On Going',
                'created_at' => now(), 'updated_at' => now(),
                'group_link'=>$this->randomGroupLink()
            ],
            [
                'id' => 2, 'creator_id' => 2, 'event_category_id' => 3, // Education
                'name' => 'Wonderfood Festival 2025',
                'description' => 'WonderFood Festival adalah sebuah kegiatan sosial yang bertujuan untuk meningkatkan kesadaran masyarakat akan pentingnya pangan bergizi.',
                'image_url' => 'event_images/ev2.jpg', 'date' => '2025-07-09', 'location' => 'Pergudangan Elang Laut, Sentra Industri 1, Blok A5 No.6, Jakarta Utara', 'status' => 'Pending',
                'created_at' => now(), 'updated_at' => now(),
                'group_link'=>$this->randomGroupLink()
            ],
            [
                'id' => 3, 'creator_id' => 3, 'event_category_id' => 2, // Cooking Workshop
                'name' => 'Plaza Indonesia Culinary Festival',
                'description' => 'Plaza Indonesia Culinary Festival dimulai dengan workshop memasak interaktif yang dipandu oleh chef ternama dari berbagai restoran.',
                'image_url' => 'event_images/ev3.jpg', 'date' => '2025-07-03', 'location' => 'Jalan M.H. Thamrin No.28-30 RT.9/RW.5, Gondangdia, Menteng, Jakarta Pusat', 'status' => 'Coming Soon',
                'created_at' => now(), 'updated_at' => now(),
                'group_link'=>$this->randomGroupLink()
            ],
            [
                'id' => 4, 'creator_id' => 4, 'event_category_id' => 1, // Food Donation
                'name' => 'Tunggadewi Charity',
                'description' => 'Yayasan Tunggadewi adalah organisasi nirlaba yang berfokus pada pemberdayaan perempuan dan anak-anak melalui berbagai program sosial.',
                'image_url' => 'event_images/ev4.jpeg', 'date' => '2025-08-09', 'location' => 'Jl. Ciniru 7 No.23, Kebayoran Baru, Jakarta Selatan', 'status' => 'Canceled',
                'created_at' => now(), 'updated_at' => now(),
                'group_link'=>$this->randomGroupLink()
            ],
            [
                'id' => 5, 'creator_id' => 5, 'event_category_id' => 1, // Food Donation
                'name' => 'Berbagi makanan bersama Yayasan Kanker Payudara',
                'description' => 'Dalam kegiatan ini, Yayasan Tunggadewi bersama komunitas peduli kanker akan menyalurkan paket makanan sehat kepada para penderita.',
                'image_url' => 'event_images/ev5.jpeg', 'date' => '2025-08-19', 'location' => 'Jl. Wijaya 2, Kebayoran, Jakarta Selatan', 'status' => 'Completed',
                'created_at' => now(), 'updated_at' => now(),
                'group_link'=>$this->randomGroupLink()
            ],
            [
                'id' => 6, 'creator_id' => 6, 'event_category_id' => 1, // Food Donation
                'name' => 'Greeneration Charity',
                'description' => 'Greeneration Charity adalah kegiatan sosial yang diinisiasi oleh Greeneration Foundation untuk mengurangi sampah makanan dan membantu sesama.',
                'image_url' => 'event_images/ev6.jpg', 'date' => '2025-09-02', 'location' => 'Jl. Tikukur No. 6, Gasibu, Sadang Serang, Coblong, Kota Bandung', 'status' => 'On Going',
                'created_at' => now(), 'updated_at' => now(),
                'group_link'=>$this->randomGroupLink()
            ],
            [
                'id' => 7, 'creator_id' => 7, 'event_category_id' => 1, // Food Donation
                'name' => 'Happy Hearts Indonesia Charity',
                'description' => 'Happy Hearts Indonesia Charity adalah kegiatan sosial yang bertujuan untuk membangun kembali sekolah-sekolah di daerah terdampak bencana.',
                'image_url' => 'event_images/ev7.jpg', 'date' => '2025-05-15', 'location' => 'Jl. Anggrek Garuda Blok J No.71 RT.6/RW.3, Kemanggisan, Palmerah, Jakarta Barat', 'status' => 'Coming Soon',
                'created_at' => now(), 'updated_at' => now(),
                'group_link'=>$this->randomGroupLink()
            ],
            [
                'id' => 8, 'creator_id' => 8, 'event_category_id' => 3, // Education
                'name' => 'Bumi Sehat Festival 2025',
                'description' => 'Bumi Sehat Festival adalah perayaan kepedulian terhadap kesehatan ibu dan anak, serta lingkungan yang diselenggarakan oleh Yayasan Bumi Sehat.',
                'image_url' => 'event_images/ev8.jpg', 'date' => '2025-06-27', 'location' => 'Jl. Nyuh Bulan, Banjar Nyuh Kuning, Mas, Ubud, Bali', 'status' => 'Pending',
                'created_at' => now(), 'updated_at' => now(),
                'group_link'=>$this->randomGroupLink()
            ],
            [
                'id' => 9, 'creator_id' => 9, 'event_category_id' => 1, // Food Donation
                'name' => 'Jalinan Rasa',
                'description' => 'Jalinan Rasa IPB merupakan kegiatan sosial yang diadakan oleh mahasiswa IPB untuk berbagi makanan kepada masyarakat kurang mampu di sekitar kampus.',
                'image_url' => 'event_images/ev9.jpeg', 'date' => '2025-10-25', 'location' => 'Kampus IPB Dramaga, Kecamatan Dramaga, Kabupaten Bogor', 'status' => 'Pending',
                'created_at' => now(), 'updated_at' => now(),
                'group_link'=>$this->randomGroupLink()
            ],
            [
                'id' => 10,
                'creator_id' => 1,
                'event_category_id' => 1,
                'name' => 'Ascott Takes Part Ramadan 2025',
                'description' => 'Ascott Takes Part Ramadan 2025 merupakan wujud kepedulian The Ascott Limited terhadap masyarakat sekitar dengan berbagi takjil gratis.',
                'image_url' => 'event_images/ev10.jpg',
                'date' => '2025-03-13',
                'location' => 'Oakwood Hotel & Apartments Grand Batam',
                'status' => 'Completed',
                'group_link' => $this->randomGroupLink(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
