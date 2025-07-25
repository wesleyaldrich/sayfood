<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminEventStoreRequest;

use App\Models\Event;
use App\Models\EventCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) // Tambahkan Request $request
    {
        $statuses = Event::pluck('status')->unique();
        $query = Event::with('creator.user', 'category');

        if ($request->has('status') && $request->get('status') != 'All') {
            $query->where('status', $request->get('status'));
        }

        if ($request->has('search') && $request->get('search') != '') {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhereHas('creator.user', function ($userQuery) use ($search) {
                        $userQuery->where('username', 'like', "%{$search}%");
                    })
                    ->orWhereHas('category', function ($catQuery) use ($search) {
                        $catQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $events = $query->latest()->paginate(10);


        $categories = EventCategory::all();

        return view('manage-events', compact('events', 'statuses', 'categories'));
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
    public function store(AdminEventStoreRequest $request)
    {
        try {
            $start = Carbon::createFromFormat('g:i A', sprintf('%02d:%02d %s', $request->start_hour, $request->start_minute, $request->start_ampm));
            $end = Carbon::createFromFormat('g:i A', sprintf('%02d:%02d %s', $request->end_hour, $request->end_minute, $request->end_ampm));
            $duration = $start->diffInMinutes($end);
            $durationInHours = ceil($duration / 60);

            // Simpan gambar jika ada
            if ($request->hasFile('image_url')) {
                $originalName = $request->file('image_url')->getClientOriginalName();
                $imagePath = $request->file('image_url')->storeAs('events', $originalName, 'public');
            }

            // Simpan file pendukung jika ada
            $supportingFiles = [];
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $path = $file->storeAs('supporting_files', $originalName, 'public');
                    $supportingFiles[] = $path;
                }
            }

            Event::create([
                'creator_id' => Auth::user()->customer->id,
                'event_category_id' => $request->event_category_id,
                'name' => $request->name,
                'description' => $request->description,
                'date' => $request->date,
                'location' => $request->location,
                'status' => 'Pending',
                'image_url' => $imagePath ?? 'assets/default_event.png',

                'estimated_participants' => $request->estimated_participants,
                'organizer_name' => $request->organizer_name,
                'organizer_email' => $request->organizer_email,
                'organizer_phone' => $request->organizer_phone,
                'group_link' => $request->group_link,
                'supporting_files' => json_encode($supportingFiles),
                'duration' => $durationInHours,

                'start_time' => $start->format('H:i:s'),
                'end_time' => $end->format('H:i:s'),
            ]);

            return redirect()->route('activity')->with('success', 'Event proposal submitted!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while saving the event.'])
                ->withInput()
                ->with('show_modal', true);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // Load relasi untuk ditampilkan di view detail
        $event->load('creator', 'category', 'participants');
        // dd($event);

        // Arahkan ke view baru dan kirim data event
        return view('manage-events-detail', compact('event'));
    }

    public function approve(Event $event)
    {
        $event->status = 'Coming Soon';
        $event->save();

        return redirect()->back()->with('success', 'Event "' . $event->name . '" has been approved successfully.');
    }

    public function reject(Event $event)
    {
        $event->status = 'Canceled';
        $event->save();

        return redirect()->back()->with('danger', 'Event "' . $event->name . '" has been rejected.');
    }

    public function showCreatedEvent(Request $request, $id) // Tambahkan Request $request
    {
        $event = Event::with(['creator.user', 'participants.user', 'category'])->findOrFail($id);

        return view('event-created-detail', compact('event'));
    }

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
