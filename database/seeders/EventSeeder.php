<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'id' => 1, 'creator_id' => 1, 'event_category_id' => 2, // Cooking Workshop
                'name' => 'Cooking for Charity',
                'description' => 'Lets Share Indonesia kembali menggelar kegiatan memasak amal untuk membantu sesama yang membutuhkan, terutama anak-anak panti asuhan.',
                'image_url' => 'assets/event_images/ev1.jpg', 'date' => '2025-06-20', 'location' => 'Ramurasa Cooking Studio, Kemang Jakarta Selatan', 'status' => 'Ongoing',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 2, 'creator_id' => 2, 'event_category_id' => 3, // Education
                'name' => 'Wonderfood Festival 2025',
                'description' => 'WonderFood Festival adalah sebuah kegiatan sosial yang bertujuan untuk meningkatkan kesadaran masyarakat akan pentingnya pangan bergizi.',
                'image_url' => 'assets/event_images/ev2.jpg', 'date' => '2025-07-09', 'location' => 'Pergudangan Elang Laut, Sentra Industri 1, Blok A5 No.6, Jakarta Utara', 'status' => 'Ongoing',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 3, 'creator_id' => 3, 'event_category_id' => 2, // Cooking Workshop
                'name' => 'Plaza Indonesia Culinary Festival',
                'description' => 'Plaza Indonesia Culinary Festival dimulai dengan workshop memasak interaktif yang dipandu oleh chef ternama dari berbagai restoran.',
                'image_url' => 'assets/event_images/ev3.jpg', 'date' => '2025-07-03', 'location' => 'Jalan M.H. Thamrin No.28-30 RT.9/RW.5, Gondangdia, Menteng, Jakarta Pusat', 'status' => 'Ongoing',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 4, 'creator_id' => 4, 'event_category_id' => 1, // Food Donation
                'name' => 'Tunggadewi Charity',
                'description' => 'Yayasan Tunggadewi adalah organisasi nirlaba yang berfokus pada pemberdayaan perempuan dan anak-anak melalui berbagai program sosial.',
                'image_url' => 'assets/event_images/ev4.jpeg', 'date' => '2025-08-09', 'location' => 'Jl. Ciniru 7 No.23, Kebayoran Baru, Jakarta Selatan', 'status' => 'Ongoing',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 5, 'creator_id' => 5, 'event_category_id' => 1, // Food Donation
                'name' => 'Berbagi makanan bersama Yayasan Kanker Payudara',
                'description' => 'Dalam kegiatan ini, Yayasan Tunggadewi bersama komunitas peduli kanker akan menyalurkan paket makanan sehat kepada para penderita.',
                'image_url' => 'assets/event_images/ev5.jpeg', 'date' => '2025-08-19', 'location' => 'Jl. Wijaya 2, Kebayoran, Jakarta Selatan', 'status' => 'Ongoing',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 6, 'creator_id' => 6, 'event_category_id' => 1, // Food Donation
                'name' => 'Greeneration Charity',
                'description' => 'Greeneration Charity adalah kegiatan sosial yang diinisiasi oleh Greeneration Foundation untuk mengurangi sampah makanan dan membantu sesama.',
                'image_url' => 'assets/event_images/ev6.jpg', 'date' => '2025-09-02', 'location' => 'Jl. Tikukur No. 6, Gasibu, Sadang Serang, Coblong, Kota Bandung', 'status' => 'Ongoing',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 7, 'creator_id' => 7, 'event_category_id' => 1, // Food Donation
                'name' => 'Happy Hearts Indonesia Charity',
                'description' => 'Happy Hearts Indonesia Charity adalah kegiatan sosial yang bertujuan untuk membangun kembali sekolah-sekolah di daerah terdampak bencana.',
                'image_url' => 'assets/event_images/ev7.jpg', 'date' => '2025-05-15', 'location' => 'Jl. Anggrek Garuda Blok J No.71 RT.6/RW.3, Kemanggisan, Palmerah, Jakarta Barat', 'status' => 'Closed',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 8, 'creator_id' => 8, 'event_category_id' => 3, // Education
                'name' => 'Bumi Sehat Festival 2025',
                'description' => 'Bumi Sehat Festival adalah perayaan kepedulian terhadap kesehatan ibu dan anak, serta lingkungan yang diselenggarakan oleh Yayasan Bumi Sehat.',
                'image_url' => 'assets/event_images/ev8.jpg', 'date' => '2025-06-27', 'location' => 'Jl. Nyuh Bulan, Banjar Nyuh Kuning, Mas, Ubud, Bali', 'status' => 'Ongoing',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 9, 'creator_id' => 9, 'event_category_id' => 1, // Food Donation
                'name' => 'Jalinan Rasa',
                'description' => 'Jalinan Rasa IPB merupakan kegiatan sosial yang diadakan oleh mahasiswa IPB untuk berbagi makanan kepada masyarakat kurang mampu di sekitar kampus.',
                'image_url' => 'assets/event_images/ev9.jpeg', 'date' => '2025-10-25', 'location' => 'Kampus IPB Dramaga, Kecamatan Dramaga, Kabupaten Bogor', 'status' => 'Ongoing',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 10, 'creator_id' => 10, 'event_category_id' => 1, // Food Donation
                'name' => 'Ascott Takes Part Ramadan 2025',
                'description' => 'Ascott Takes Part Ramadan 2025 merupakan wujud kepedulian The Ascott Limited terhadap masyarakat sekitar dengan berbagi takjil gratis.',
                'image_url' => 'assets/event_images/ev10.jpg', 'date' => '2025-03-13', 'location' => 'Oakwood Hotel & Apartments Grand Batam', 'status' => 'Closed',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 11, 'creator_id' => 11, 'event_category_id' => 2, // Cooking Workshop
                'name' => 'DapurRos Cooking Charity',
                'description' => 'DapurRos Cooking Charity adalah kegiatan amal yang menggabungkan workshop memasak dengan donasi makanan untuk kaum dhuafa.',
                'image_url' => 'assets/event_images/ev11.jpg', 'date' => '2025-06-21', 'location' => 'Lapangan Terbuka Taman Menteng, Jakarta Pusat', 'status' => 'Ongoing',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 12, 'creator_id' => 12, 'event_category_id' => 1, // Food Donation
                'name' => 'BeraMal',
                'description' => 'Program BeraMaL, yang sempat terhenti akibat pandemi, kembali hadir untuk menyediakan makanan gratis bagi siapa saja yang membutuhkan.',
                'image_url' => 'assets/event_images/ev12.jpg', 'date' => '2025-05-12', 'location' => 'Pelataran Masjid Raya Al-Azhar, Kebayoran Baru, Jakarta Selatan', 'status' => 'Closed',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 13, 'creator_id' => 13, 'event_category_id' => 1, // Food Donation
                'name' => 'Dapur Makan by Chef Sarah',
                'description' => 'Nikmati sajian istimewa dari Chef Sarah, sambil berdonasi untuk mendukung program pangan bagi anak-anak jalanan di ibukota.',
                'image_url' => 'assets/event_images/ev13.png', 'date' => '2025-07-02', 'location' => 'Halaman Balaikota Jakarta, Gambir', 'status' => 'Ongoing',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 14, 'creator_id' => 14, 'event_category_id' => 2, // Cooking Workshop
                'name' => 'Cooking Workshop by Chef Nindy',
                'description' => 'Bergabunglah dalam sesi eksklusif memasak bersama Chef Nindy, di mana seluruh keuntungan akan didonasikan untuk panti werdha.',
                'image_url' => 'assets/event_images/ev14.jpg', 'date' => '2025-09-10', 'location' => 'Taman Lapangan Banteng, Jakarta Pusat', 'status' => 'Ongoing',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'id' => 15, 'creator_id' => 15, 'event_category_id' => 1, // Food Donation
                'name' => 'IkatanHati Charity',
                'description' => 'IkatanHati Charity adalah acara amal penuh keharmonisan yang bertujuan untuk menyalurkan bantuan makanan pokok kepada keluarga prasejahtera.',
                'image_url' => 'assets/event_images/ev15.jpg', 'date' => '2025-08-27', 'location' => 'Taman Kota 2 BSD, Tangerang Selatan', 'status' => 'Ongoing',
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);
    }
}
