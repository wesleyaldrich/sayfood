<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class EventGroupLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();

        $groupLinks = [
            'https://chat.whatsapp.com/KomunitasBerbagi',
            'https://t.me/PenyelamatKelaparan',
            'https://chat.whatsapp.com/SukaBagiBagiMakanan',
            'https://t.me/KelompokPeduliSesama',
        ];

        foreach($events as $event){
            $event->update([
                'group_link'=> $groupLinks[array_rand($groupLinks)]
            ]);
        }
    }
}
