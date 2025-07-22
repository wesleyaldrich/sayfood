<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventCustController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides = Event::with(['creator.user', 'customers']) // eager load relasi
            ->latest()
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
        $coming_soon = Event::with(['creator.user', 'customers'])
            ->where('status', 'Coming Soon')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($event) {
                $date = Carbon::parse($event->date)->locale('id');

                $author = $event->creator?->user?->username ?? 'Unknown';

                // Ambil substring lokasi sebelum koma
                $location = $event->location ?? '';
                if (strpos($location, ',') !== false) {
                    $shortLocation = trim(explode(',', $location)[0]);
                } else {
                    $shortLocation = trim($location);
                }

                return [
                    'id' => $event->id,
                    'title' => $event->name,
                    'author' => $author,
                    'location' => $shortLocation, // hanya bagian sebelum koma
                    'image' => $event->image_url,
                    'people' => $event->customers->count(),
                    'formatted_date' => $date->translatedFormat('l, j F Y'),
                    'month' => $date->translatedFormat('F'),
                    'day' => $date->translatedFormat('j'),
                    'description' => $event->description,
                    'duration' => Carbon::parse($event->hour)->format('H:i'), // contoh: 15:00
                ];
            });

        return view('events', compact('slides', 'coming_soon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
