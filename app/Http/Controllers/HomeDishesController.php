<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeStoreRequest;
use App\Models\Customer;
use App\Models\Event;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            ->whereDoesntHave('customers', function ($query) {
                // Hapus event di mana creator juga ada di pivot sebagai customer
                $query->whereColumn('customers.id', 'events.creator_id');
            })
            ->latest()
            ->take(3)
            ->get()
            ->values()
            ->map(function ($event, $index) use ($badges) {
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


        $slides = Event::with(['creator.user', 'customers'])
            ->where('status', 'Completed')
            ->whereDoesntHave('customers', function ($query) {
                $query->whereColumn('customers.id', 'events.creator_id');
            })
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($event) {
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



        return view('home', compact('restaurant', 'events', 'slides'));
    }

    public function store(HomeStoreRequest $request)
    {
        // Ambil ID customer berdasarkan user login
        $customerId = Auth::user()->customer->id ?? null;

        if (!$customerId) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => ['general' => ['Customer tidak ditemukan untuk user ini.']]
                ], 422);
            }
            return back()->withErrors('Customer tidak ditemukan untuk user ini.');
        }

        // Ambil event
        $event = Event::findOrFail($request->event_id);

        // Cek apakah sudah join
        $alreadyJoined = DB::table('customer_event')
            ->where('event_id', $event->id)
            ->where('customer_id', $customerId)
            ->exists();

        if ($alreadyJoined) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => ['general' => ['Anda sudah bergabung di event ini.']]
                ], 422);
            }
            return back()->with('info', 'Anda sudah bergabung di event ini.');
        }

        // Simpan ke pivot table
        $event->customers()->attach($customerId);

        // Balikan respon sesuai request
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil bergabung ke event!'
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil bergabung ke event!');
    }
}
