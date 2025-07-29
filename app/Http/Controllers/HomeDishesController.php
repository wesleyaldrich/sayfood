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
        $restaurants = Restaurant::withAvg(['orders as avg_rating' => function ($query) {
            $query->whereNotNull('rating');
        }], 'rating')
            ->orderByDesc('avg_rating')
            ->get()
            ->map(function ($restaurant) {
                // Jika null → "No Rating"
                if (is_null($restaurant->avg_rating)) {
                    $restaurant->avg_rating = 'No Rating';
                } else {
                    // Bulatkan ke 1 angka di belakang koma
                    $restaurant->avg_rating = number_format($restaurant->avg_rating, 1);
                }
                return $restaurant;
            });
        $events = Event::with(['creator.user', 'customers'])->get();

        // Ambil 3 kategori utama
        $newestEvent = $events->sortByDesc('date')->first();
        $mostPopularEvent = $events->sortByDesc(fn($e) => $e->customers->count())->first();
        $seasonalEvent = $events->filter(fn($e) => Carbon::parse($e->date)->isCurrentMonth())
            ->sortBy('date')->first();

        // Gabungkan & pastikan tidak duplikat
        $finalEvents = collect([$newestEvent, $mostPopularEvent, $seasonalEvent])
            ->filter()        // hapus null (kalau tidak ada event seasonal misalnya)
            ->unique('id');   // hapus duplikat (kalau 1 event memenuhi 2 kategori)

        // Jika hasilnya kurang dari 3, tambah event lain (tanpa badge) supaya tetap 3
        if ($finalEvents->count() < 3) {
            $remaining = $events->whereNotIn('id', $finalEvents->pluck('id'))
                ->sortByDesc('date')
                ->take(3 - $finalEvents->count());
            $finalEvents = $finalEvents->merge($remaining);
        }

        // Format final untuk Blade (selalu 3 item)
        $finalEvents = $finalEvents->take(3)->values()->map(function ($event) use ($newestEvent, $mostPopularEvent, $seasonalEvent) {
            $author = $event->creator?->user?->username ?? 'Unknown';

            // Tentukan badge
            if ($event->id === $newestEvent?->id) {
                $badgeLabel = 'Newest Event';
                $badgeColor = 'New';
            } elseif ($event->id === $mostPopularEvent?->id) {
                $badgeLabel = 'Most Popular';
                $badgeColor = 'Popular';
            } elseif ($event->id === $seasonalEvent?->id) {
                $badgeLabel = 'Seasonal Specials';
                $badgeColor = 'Trending';
            } else {
                $badgeLabel = null; // Event tambahan tidak dapat badge
                $badgeColor = null;
            }

            return [
                'id' => $event->id,
                'name' => $event->name,
                'host' => $author,
                'location' => $event->location,
                'badge' => $badgeLabel,
                'badge_color' => $badgeColor,
                'image_url' => $event->image_url,
                'participants' => $event->customers->count(),
                'date' => $event->date,
            ];
        });

        // dd($events);
        $slides = Event::with(['creator.user', 'customers']) // eager load relasi
            ->where('status', 'Completed')
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

        return view('home', compact('restaurants', 'finalEvents', 'slides'));
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
                    'errors' => ['general' => ['You have already joined this event.']]
                ], 422);
            }
            return back()->with('info', 'You have already joined this event.');
        }

        // Simpan ke pivot table
        $event->participants()->attach($customerId, [
            'phone_number' => $request->phoneNumber,
        ]);;

        // Balikan respon sesuai request
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Successfully joined the event!'
            ]);
        }

        return redirect()->back()->with('success', 'Successfully joined the event!');
    }
}
