<?php

namespace App\Http\Controllers;

use App\Models\Event;
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

        // Filter query jika ada request status dari URL
        // Pastikan status yang diminta ada dan bukan 'All'
        if ($request->has('status') && $request->get('status') != 'All') {
            $query->where('status', $request->get('status'));
        }

        // 4. Ambil data event yang sudah difilter dan urutkan dari yang terbaru
        $events = $query->latest()->get();

        // 5. Kirim data events dan statuses ke view
        return view('manage-events', compact('events', 'statuses'));
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


        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'date' => 'required',
            'location' => 'required',
            'event_category_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'estimated_participants' => 'required',
            'organizer_name' => 'required',
            'organizer_email' => 'required|email',
            'organizer_phone' => 'required',
            'wa_link' => 'required|url',

            'start_hour' => 'required',
            'start_minute' => 'required',
            'start_ampm' => 'required',
            'end_hour' => 'required',
            'end_minute' => 'required',
            'end_ampm' => 'required',

            'files.*' => 'nullable|file|max:5120', // max 5MB each

            'agree_terms' => 'accepted'
        ]);

        // Parse jam dari input
        try {
            $start = Carbon::createFromFormat('g:i A', sprintf('%02d:%02d %s', $request->start_hour, $request->start_minute, $request->start_ampm));
            $end = Carbon::createFromFormat('g:i A', sprintf('%02d:%02d %s', $request->end_hour, $request->end_minute, $request->end_ampm));
        } catch (\Exception $e) {
            return back()->withErrors(['start_hour' => 'Invalid time format.'])->withInput();
        }

        // Custom rule: end > start
        if ($end <= $start) {
            return back()->withErrors(['end_hour' => 'End time must be after start time.'])->withInput();
        }

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $originalName = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('events', $originalName, 'public');
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

        $start = Carbon::createFromFormat('g:i A', sprintf('%02d:%02d %s', $request->start_hour, $request->start_minute, $request->start_ampm));
        $end = Carbon::createFromFormat('g:i A', sprintf('%02d:%02d %s', $request->end_hour, $request->end_minute, $request->end_ampm));

        if ($end <= $start) {
            return back()->withErrors(['end_hour' => 'End time must be after start time.'])->withInput();
        }

        $duration = $start->diffInMinutes($end); // yang benar: $start->diffInMinutes($end), bukan sebaliknya
        $durationInHours = ceil($duration / 60);

        // Simpan data ke DB
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
            'wa_link' => $request->wa_link,
            'supporting_files' => json_encode($supportingFiles),
            'duration' => $durationInHours,

            'start_time' => $start->format('H:i:s'),
            'end_time' => $end->format('H:i:s'),
        ]);

        return redirect()->route('activity')->with('success', 'Event proposal submitted!');
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
