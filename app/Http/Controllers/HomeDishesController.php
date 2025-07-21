<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeDishesController extends Controller
{
    public function show(): View
    {
        // Sample product data (you would typically fetch this from a database)
        $restaurant = Restaurant::all();
        $badges = [
            ['label' => 'Newest Event', 'color' => 'New'],
            ['label' => 'Most Popular', 'color' => 'Popular'],
            ['label' => 'Seasonal Specials', 'color' => 'Trending'],
        ];

        $events = Event::with(['creator.user', 'customers'])
            ->latest()
            ->take(3)
            ->get()
            ->values() // biar index rapi dari 0
            ->map(function ($event, $index) use ($badges) {
                // Ambil badge sesuai urutan (jika index > 2, ulang dari awal)
                $badge = $badges[$index % count($badges)];
                $author = $event->creator?->user?->username ?? 'Unknown';
                return [
                    'id' => $event->id,
                    'name' => $event->name,
                    'host' => $author,
                    'location' => $event->location,
                    'badge' => $badge['label'],
                    'badge_color' => $badge['color'],
                    'image_url' => $event->image_url,
                    'participants' => $event->customers->count(),
                    'date' => $event->date,
                ];
            });
        $slides = Event::with(['creator.user', 'customers']) // eager load relasi
            ->where('status', 'Closed')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($event) {
                $formattedDate = Carbon::parse($event->date)
                    ->locale('id')
                    ->translatedFormat('l, j F Y');

                // Ambil nama user dari creator_id (melalui relasi customer -> user)
                $author = $event->creator?->user?->username ?? 'Unknown';

                return [
                    'id' => $event->id,
                    'title' => $event->name,
                    'author' => $author,
                    'location' => $event->location,
                    'image' => $event->image_url,
                    'people' => $event->customers->count(),
                    'date' => $formattedDate,
                    'description' => $event->description,
                    'duration' => $event->hour,
                ];
            });

        return view('home', compact('restaurant', 'events', 'slides'));
    }
}
