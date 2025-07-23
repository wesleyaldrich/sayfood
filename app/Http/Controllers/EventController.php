<?php
namespace App\Http\Controllers;

use App\Http\Requests\AdminEventStoreRequest;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('manage-events', compact('events', 'statuses','categories'));
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
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('event_images', 'public');
        }

        Event::create([
            'name'              => $validated['name'],
            'description'       => $validated['description'],
            'creator_id'        => 1,
            'event_category_id' => $validated['event_category_id'],
            'date'              => $validated['date'],
            'location'          => $validated['location'],
            'status'            => $validated['status'],
            'group_link'        => $validated['group_link'],
            'image_url'         => $imagePath,
        ]);

        return redirect()->route('show.manage.events')->with('status', 'Event successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // Load relasi untuk ditampilkan di view detail
        $event->load('creator', 'category','participants');
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
