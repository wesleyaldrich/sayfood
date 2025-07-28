@props(['events'])

    @foreach ($events as $event)
        <div class="event-card d-flex align-items-center" dusk="past-events-card">
            <div class="event-card-header">
                <h3>{{ $event->title }}</h3>
                <p>{{ __('activity.by') }} {{ $event->organizer }}</p>
            </div>
            <div class="event-card-body d-flex">
                <img src="{{ asset('storage/'.$event->image) }}" class="event-card-body-img" alt="{{ $event->title }}">
                <div class="event-details">
                    <p>{{ $event->description }}</p>
                    <div class="event-meta">
                        <div>
                            <img src="{{ asset('assets/icon_location.svg') }}" alt="Location icon">
                            <span>{{ $event->location }}</span>
                        </div>
                        <div>
                            <img src="{{ asset('assets/icon_person.svg') }}" alt="Time icon">
                            <span>{{ $event->participants_count }} {{__('activity.participants')}}</span>
                        </div>
                        <div>
                            <img src="{{ asset('assets/icon_calendar.svg') }}" alt="Date icon">
                            <span>{{ $event->date }}</span>
                        </div>
                        <div>
                            <img src="{{ asset('assets/icon_clock.svg') }}" alt="Hours icon">
                            <span>{{ $event->duration }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
