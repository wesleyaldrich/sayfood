<?php
namespace App\Http\Controllers;
use App\Models\Event;

use Illuminate\Http\Request;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // Load relasi untuk ditampilkan di view detail
        $event->load('creator.user', 'category');

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
