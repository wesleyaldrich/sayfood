@props(['upcomingEvents'])

<div class="event-cards-wrapper">
    @foreach($upcomingEvents as $index => $event)
        <div class="event-card-upcoming" data-bs-toggle="modal" data-bs-target="#eventModal{{ $index }}">
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

        {{-- Modal per Event --}}
        <div class="modal fade" id="eventModal{{ $index }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content event-modal-card">
                    <div class="modal-body p-0">
                        <div class="p-5">
                            <div class="d-flex flex-column flex-md-row gap-4">

                                {{-- Gambar Kiri --}}
                                <div class="event-modal-image p-3">
                                    <img src="{{ $event->image }}" alt="{{ $event->title }}" class="img-fluid rounded" style="width:800px">
                                </div>

                                {{-- Judul & Deskripsi --}}
                                <div class="event-modal-info d-flex flex-column align-items-start">
                                    <h4 class="event-title">{{ $event->title }}</h4>
                                    <p class="event-organizer">by {{ $event->organizer }}</p>
                                    <p class="event-description" style="text-align: left">{{ $event->description }}</p>
                                </div>
                            </div>

                            {{-- Info Grid: Lokasi, Tanggal, Peserta, Durasi --}}
                            <div class="event-info-grid mt-3">
                                <div class="info-box">
                                    <img src="{{ asset('assets/icon_location.svg') }}" class="event-info-icon" alt="Location">
                                    <span>{{ $event->location }}</span>
                                </div>
                                <div class="info-box">
                                    <img src="{{ asset('assets/icon_calendar.svg') }}" class="event-info-icon"  alt="Date">
                                    <span>{{ $event->date }}</span>
                                </div>
                                <div class="info-box">
                                    <img src="{{ asset('assets/icon_person.svg') }}" class="event-info-icon"  alt="Participants">
                                    <span>{{ $event->participants }} participants</span>
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

                                        <div class="text-center participant-avatar">
                                            <img src="{{ asset('assets/icon_profile.png') }}" alt="" class="avatar-img mb-1">
                                            <div class="avatar-name">Adit</div>
                                        </div>

                                        <div class="text-center participant-avatar">
                                            <img src="{{ asset('assets/icon_profile.png') }}" alt="" class="avatar-img mb-1">
                                            <div class="avatar-name">Budi</div>
                                        </div>

                                        <div class="text-center participant-avatar">
                                            <img src="{{ asset('assets/icon_profile.png') }}" alt="" class="avatar-img mb-1">
                                            <div class="avatar-name">Sari</div>
                                        </div>

                                        <div class="text-center participant-avatar">
                                            <img src="{{ asset('assets/icon_profile.png') }}" alt="" class="avatar-img mb-1">
                                            <div class="avatar-name">Tono</div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="community-link d-flex align-items-center">
                                <strong>Community:</strong>
                                <a href="{{ $event->wa_link }}" target="_blank" class="link-whatsapp" style="margin-left: 10px">
                                    {{ $event->wa_link }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>