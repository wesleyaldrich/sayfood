<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventCustStoreRequest;
use App\Http\Requests\HomeStoreRequest;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventCustController extends Controller
{
    public function index()
    {
        $slides = Event::with(['creator.user', 'customers'])
            ->where('status', 'Coming Soon')
            ->latest()
            ->paginate(4)
            ->through(function ($event) {
                $formattedDate = Carbon::parse($event->date)
                    ->locale('id')
                    ->translatedFormat('l, j F Y');

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
        
        $events = Event::with(['creator.user', 'customers'])
            ->where('status', 'Coming Soon')
            ->inRandomOrder()
            ->take(3) // ambil 
            ->get()
            ->map(function ($event) {
                $location = $event->location ?? '';
                $shortLocation = $location;
                if (strpos($location, ',') !== false) {
                    $pos = strrpos($location, ','); // cari koma terakhir
                    $shortLocation = trim(substr($location, $pos + 1)); // ambil setelah koma terakhir
                }

                return [
                    'id' => $event->id,
                    'title' => $event->name,
                    'host' => $event->creator?->user?->username ?? 'Unknown',
                    'location' => $shortLocation,
                    'image' => $event->image_url,
                    'participants' => $event->customers->count(),
                    'date' => Carbon::parse($event->date)
                        ->locale('id')
                        ->translatedFormat('l, j F Y'),
                    'badge' => $event->status ?? 'Active', // default badge
                    'badge_color' => $event->status === 'Coming Soon' ? 'warning' : 'success', // warna badge
                ];
            });

        return view('events', compact('slides', 'events'));
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
