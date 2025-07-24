@props(['upcomingEvents'])

<div class="event-cards-wrapper">
    @foreach($upcomingEvents as $index => $event)
        <div class="event-card-upcoming " data-bs-toggle="modal" data-bs-target="#eventModal{{ $index }}">
            <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}" class="event-background-image">
            <div class="overlay-area d-flex flex-row">
                <div class="circle d-flex flex-column">
                    <img src="{{ asset('assets/icon_participants.png') }}" alt="Participants icon">
                    <p class="total-participants">{{ $event->participants_count }}</p>
                    <p>Participants</p>
                </div>
                <div class="box event-main-details">
                    <h5>{{ $event->title }}</h5>
                    <p>by {{ $event->organizer }}</p>

                </div>
            </div>
        </div>

        {{-- Modal per Event --}}
        <div class="modal fade" id="eventModal{{ $index }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content event-modal-card">
                    <div class="modal-body p-0">
                        <div class="p-5">
                            <div class="d-flex flex-column flex-md-row gap-4">

                                {{-- Gambar Kiri --}}
                                <div class="event-modal-image">
                                    <img src="{{ $event->image }}" alt="{{ $event->title }}" class="img-fluid rounded"
                                        style=" width: 100%; aspect-ratio: 16 / 9">
                                </div>

                                {{-- Judul & Deskripsi --}}
                                <div class="event-modal-info d-flex flex-column align-items-start"
                                    style="text-align: left;">
                                    <h4 class="event-title">{{ $event->title }}</h4>
                                    <p class="event-organizer mt-1">by {{ $event->organizer }}</p>
                                    <p class="event-description" style="text-align: left">{{ $event->description }}</p>
                                </div>
                            </div>

                            {{-- Info Grid: Lokasi, Tanggal, Peserta, Durasi --}}
                            <div class="event-info-grid mt-3">
                                <div class="info-box">
                                    <img src="{{ asset('assets/icon_location.svg') }}" class="event-info-icon"
                                        alt="Location">
                                    <span class="d-flex text-start">{{ $event->location }}</span>
                                </div>
                                <div class="info-box">
                                    <img src="{{ asset('assets/icon_calendar.svg') }}" class="event-info-icon" alt="Date">
                                    <span>{{ $event->date }}</span>
                                </div>
                                <div class="info-box">
                                    <img src="{{ asset('assets/icon_person.svg') }}" class="event-info-icon"
                                        alt="Participants">
                                    <span>{{ $event->participants_count }} participants</span>
                                </div>
                                <div class="info-box">
                                    <img src="{{ asset('assets/icon_clock.svg') }}" class="event-info-icon" alt="Duration">
                                    <span>{{ $event->duration }} hours</span>
                                </div>
                            </div>

                            <div class="participant-section mb-3 d-flex align-items-center">
                                <strong class="me-3">Participants:</strong>

                                <div class="participant-avatars overflow-auto">
                                    <div class="d-flex flex-nowrap gap-3">
                                        @foreach($event->participant_details as $participant)
                                            <div class="text-center participant-avatar">
                                                <img src="{{ $participant['profile_image'] }}"
                                                    alt="{{ $participant['username'] }}" class="avatar-img mb-1">
                                                <div class="avatar-name">{{ $participant['username'] }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>


                            <div class="community-link d-flex align-items-center">
                                <strong>Community:</strong>
                                <a href="{{ $event->group_link }}" target="_blank" class="link-whatsapp"
                                    style="margin-left: 10px">
                                    {{ $event->group_link }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>