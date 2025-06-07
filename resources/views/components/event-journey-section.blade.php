@props(['events'])

<div class="event-grid">
    @for ($i = 0; $i < count($events); $i++)
        <div class="event-card d-flex align-items-center">
            <div class="event-card-header">
                <h3>{{ $events[$i]['title'] }}</h3>
                <p>by {{ $events[$i]['organizer'] }}</p>
            </div>
            <div class="event-card-body d-flex">
                <img src="{{ asset('assets/activity_journey.png') }}" class="event-card-body-img" alt="{{ $events[$i]['title'] }}">
                <div class="event-details">
                    <p>{{ $events[$i]['description'] }}</p>
                    <div class="event-meta">
                        <div>
                            <img src="{{ asset('assets/icon_location.svg') }}" alt="Location icon">
                            <span>{{ $events[$i]['location'] }}</span>
                        </div>
                        <div>
                            <img src="{{ asset('assets/icon_person.svg') }}" alt="Time icon">
                            <span>{{ $events[$i]['time'] }}</span>
                        </div>
                        <div>
                            <img src="{{ asset('assets/icon_calendar.svg') }}" alt="Date icon">
                            <span>{{ $events[$i]['date'] }}</span>
                        </div>
                        <div>
                            <img src="{{ asset('assets/icon_clock.svg') }}" alt="Hours icon">
                            <span>{{ $events[$i]['duration'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" class="d-flex download-button align-items-end">
                <span>Download Certificate</span>
            </a>
        </div>
    @endfor
</div>
