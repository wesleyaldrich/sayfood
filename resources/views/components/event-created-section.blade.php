@props(['event'])

<div class="rounded-xl overflow-hidden shadow-lg w-96 bg-white flex-shrink-0 flex flex-col h-full">
    <!-- Gambar -->
    <div class="relative w-full aspect-[18/9]">
        <img src="{{ asset('storage/'.$event->image_url) }}"
             alt="Event Image"
             class="absolute inset-0 w-full h-full object-cover" />
    </div>

    <!-- Isi Event -->
    <div class="created p-3 flex-grow flex flex-col justify-between">
        <div>
            <div class="created-detail flex items-center space-x-1 text-sm text-gray-600">
                <p>{{ \Carbon\Carbon::parse($event->date)->translatedFormat('l, d F') }}</p>
                <p>|</p>
                <p>{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}</p>
            </div>
            <h4 class="created-title font-bold">
                {{ $event->name }}
            </h4>
        </div>
        <div class="created-location text-sm flex items-center space-x-1 mt-2 text-gray-600">
            <img src="{{ asset('assets/icon_location.svg') }}" alt="Location icon" class="w-4 h-4">
            <p>{{ $event->location }}</p>
        </div>
    </div>
</div>
