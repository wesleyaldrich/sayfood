@props(['upcomingEvents'])

<div class="event-cards-wrapper">
    @foreach($upcomingEvents as $event)
        <div class="event-card-upcoming">
            {{-- Gambar Latar Belakang --}}
            <img src="{{ $event->image }}" alt="{{ $event->title }}" class="event-background-image">
            
            <div class="overlay-area d-flex flex-row">
                <div class="circle d-flex flex-column">
                    <img src="{{ asset('assets/icon_participants.png') }}" alt="Participants icon">
                    <p class="total-participants">{{ $event->participants }}</p>
                    <p>Participants</p>
                </div>

                <div class="box">
                    <div class="event-info-overlay-content">
                        <div class="event-main-details">
                            <h5>{{ $event->title }}</h5>
                            <p>by {{ $event->organizer }}</p>
                        </div>

                        <div class="event-main-subdetails">
                            <div class="meta-item">
                                <img src="{{ asset('assets/icon_location.svg') }}" alt="Location icon">
                                <span>{{ $event->location }}</span>
                            </div>
                            <div class="meta-item">
                                <img src="{{ asset('assets/icon_calendar.svg') }}" alt="Date icon">
                                <span>{{ $event->date }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endforeach
</div>
