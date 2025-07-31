@extends('layout.app')
@section('title', 'Events Page')
@section('content')

    <div class="event-page container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('info'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="event-categories row mx-0 gap-5 w-auto">
            <div class="col-3 p-3 mx-5 gap-3">
                <h1 class="event-categories" style="font-size: 35px; font-weight: bold;">{{ __('events.event_categories') }}
                </h1>
            </div>
            <div class="category-list p-0 d-flex flex-wrap gap-3">
                <div class="category-card" style="width: 250px;">
                    <img src="assets/cookingworkshop.jpg" alt="Cooking Workshop">
                    <span>{{ __('events.cooking_workshop') }}</span>
                </div>
                <div class="category-card" style="width: 250px;">
                    <img src="assets/fooddonation.jpg" alt="Food Donation">
                    <span>{{ __('events.food_donation') }}</span>
                </div>
                <div class="category-card" style="width: 250px;">
                    <img src="assets/education.jpg" alt="Education">
                    <span>{{ __('events.education') }}</span>
                </div>
            </div>
        </div>

        <div class="container my-4">
            <div class="row g-4 align-items-start">

                <div class="recommended-cb col-lg-8 col-12 h-100 d-flex flex-column">
                    <div class="recommended p-3 d-flex flex-column h-100">
                        <h3>{{ __('events.recommended_for_you') }}</h3>
                        <div class="recommended-wrapper position-relative flex-grow-1">
                            <div class="recommended-list d-flex gap-3 h-100" id="recommendedList">
                                @foreach ($events as $event)
                                    <div class="recommended-card position-relative d-flex flex-column"
                                        data-bs-toggle="modal" data-bs-target="#joinFormModal"
                                        data-event-id="{{ $event['id'] }}" data-event-title="{{ $event['title'] }}"
                                        data-event-host="{{ $event['host'] }}"
                                        data-event-location="{{ $event['location'] }}"
                                        data-event-date="{{ $event['date'] }}" style="cursor: pointer;">

                                        @if (!empty($event['badge']))
                                            <div class="badge {{ strtolower($event['badge_color']) }}">
                                                {{ $event['badge'] }}
                                            </div>
                                        @endif

                                        <img src="{{ asset('storage/' . $event['image']) }}" alt="event"
                                            class="img-fluid rounded-top object-fit-cover">

                                        <div
                                            class="card-details d-flex p-2 align-items-center bg-dark text-white rounded-bottom">
                                            <div
                                                class="participants-circle d-flex align-items-center justify-content-center">
                                                <div class="circle text-dark d-flex flex-column align-items-center justify-content-center rounded-circle"
                                                    style="width:70px; height:70px; border: 3px solid #cd8200;">
                                                    <img src="{{ asset('assets/participant_logo.png') }}"
                                                        alt="participants icon" style="width: 24px; height: 24px;">
                                                    <div class="text-center small">
                                                        <div class="fw-bold">{{ $event['participants'] }}</div>
                                                        <div>{{ __('events.joined') }}</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center w-100 flex-wrap">
                                                <div>
                                                    <p class="title fw-bold mb-0 truncate-text" style="font-size: 20px;">
                                                        {{ $event['title'] }}</p>
                                                    <p class="host fst-italic mb-0 text-warning">{{ __('events.by') }}
                                                        {{ $event['host'] }}
                                                    </p>
                                                </div>
                                                <div class="text-end me-5">
                                                    <p class="info mb-0 truncate-text">
                                                        <i class="bi bi-geo-alt-fill text-warning"></i>
                                                        {{ $event['location'] }}
                                                    </p>
                                                    <p class="info mb-0 truncate-text">
                                                        <i class="bi bi-calendar-event-fill text-warning"></i>
                                                        {{ $event['date'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="coming-soon fw-bold">
                        <h3>{{ __('events.coming_soon') }}</h3>
                        <div class="coming-scroll overflow-auto p-2">
                            @foreach ($coming_soon as $event)
                                <div class="coming-item mb-3 d-flex align-items-center">
                                    <div class="Container-csd rounded p-3 d-flex align-items-center">
                                        <div class="Container-date-box text-white fw-bold text-center mx-0">
                                            <div class="date p-3">
                                                {{ $event['month'] }}<br />
                                                <div class="date-cs" style="font-size: 25px;">
                                                    {{ $event['day'] }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cs-description">
                                            <div class="cs-title fw-bold mx-2 truncate-text1">{{ $event['title'] }}</div>
                                            <div class="cs-by mx-2 fst-italic text-warning-emphasis">
                                                {{ __('events.by') }} {{ $event['author'] }}
                                            </div>
                                            <div class="d-flex gap-2 mx-2 mt-2">
                                                <div class="border-loc px-1 py-1 d-flex align-items-center mx-1">
                                                    <i class="bi bi-geo-alt-fill p-1"></i>
                                                    <span
                                                        class="cs-loc fw-bold text-dark-green">{{ $event['location'] }}</span>
                                                </div>
                                                <div class="border-date px-1 py-1 d-flex align-items-center">
                                                    <i class="bi bi-clock-fill p-1"></i>
                                                    <span class="cs-date fw-bold text-dark-green">{{ $event['duration'] }}
                                                        {{ __('events.hours') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="event-list">
            @foreach ($slides as $slide)
                <div class="event-card d-flex flex-column rounded-4 shadow-sm overflow-hidden mb-4"
                    style="background-color: #f6d6a4; max-width: 850px;">
                    <div class="d-flex p-2 pb-0">
                        <img src="{{ asset('storage/' . $slide['image']) }}" alt="event" class="rounded"
                            style="width: 200px; height: auto; object-fit: cover;">
                        <div class="ps-4 flex-grow-1">
                            <h5 class="fw-bold text-dark mb-1">{{ $slide['title'] }}</h5>
                            <div class="fst-italic fw-semibold mb-2" style="color: #d38a2e;">
                                {{ __('events.by') }} {{ $slide['author'] }}
                            </div>
                            <p class="text-dark small mb-2">
                                {{ $slide['description'] }}
                            </p>
                            <hr class="my-2 text-dark">
                        </div>
                    </div>
                    <div class="px-4 pb-2 pt-2">
                        <div class="d-flex flex-wrap gap-1 mb-3" style="font-size: 11px;">
                            <div class="border-loc px-2 py-1 d-flex align-items-center rounded"
                                style="border: 2px solid #cd8200;">
                                <i class="bi bi-geo-alt-fill me-2 text-dark-green"></i>
                                <span class="fw-bold text-dark-green">{{ $slide['location'] }}</span>
                            </div>
                            <div class="border-loc px-2 py-1 d-flex align-items-center rounded"
                                style="border: 2px solid #cd8200;">
                                <i class="bi bi-calendar-event-fill me-2 text-dark-green"></i>
                                <span class="fw-bold text-dark-green">{{ $slide['date'] }}</span>
                            </div>
                            <div class="border-loc px-2 py-1 d-flex align-items-center rounded"
                                style="border: 2px solid #cd8200;">
                                <i class="bi bi-people-fill me-2 text-dark-green"></i>
                                <span class="fw-bold text-dark-green">{{ $slide['people'] }}
                                    {{ __('events.participants') }}</span>
                            </div>
                            <div class="border-loc px-2 py-1 d-flex align-items-center rounded"
                                style="border: 2px solid #cd8200;">
                                <i class="bi bi-clock-fill me-2 text-dark-green"></i>
                                <span class="fw-bold text-dark-green">{{ $slide['duration'] }}
                                    {{ __('events.hours') }}</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-success rounded-pill px-5 py-1" style="background-color: #1d4d4f;"
                                data-bs-toggle="modal" data-bs-target="#joinFormModal"
                                data-event-title="{{ $slide['title'] }}" data-event-host="{{ $slide['author'] }}"
                                data-event-location="{{ $slide['location'] }}" data-event-id="{{ $slide['id'] }}"
                                data-event-date="{{ $slide['date'] }}" dusk="join-event-btn">
                                {{ __('events.join_event') }}
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4 flex justify-center">
            {{ $slides->links() }}
        </div>
    </div>

    <div class="modal fade" id="joinFormModal" tabindex="-1" aria-labelledby="joinEventLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <p class="modal-title text-xl text-[#234C4C] font-bold" id="joinEventLabel">
                        {{ __('home.join_event2') }} <span id="modalEventTitle" class="text-xl"></span>
                    </p>
                </div>
                <div class="modal-body">
                    <label class="form-label text-[#234C4C] text-xl">{{ __('events.host') }}</label>
                    <p class="lato-light-italic" id="modalEventHost"></p>
                    <label class="form-label text-[#234C4C] text-xl">{{ __('events.location') }}</label>
                    <p class="lato-regular" id="modalEventLocation"></p>
                    <label class="form-label text-[#234C4C] text-xl">{{ __('events.date') }}</label>
                    <p class="lato-regular" id="modalEventDate"></p>
                    <form method="POST" action="{{ route('event.join') }}">
                        @csrf
                        <input type="hidden" name="event_id" id="eventId">
                        <div class="mb-3">
                            <label for="phoneNumber"
                                class="form-label text-[#234C4C] text-xl">{{ __('events.phone_number') }}</label>
                            <input type="tel" class="form-control @error('phoneNumber') is-invalid @enderror"
                                id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber') }}">
                            @error('phoneNumber')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success w-100" dusk="submit-join-event-btn">
                            {{ __('events.submit_form') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>


    <div class="volunteering-list row row-cols-1 row-cols-md-3 g-4 container-fluid py-5">
        <div class="col">
            <div class="card border-0 shadow-sm h-100 text-center">
                <div class="card-body py-5">
                    <i class="bi bi-cash-coin mb-3" style="font-size: 60px; color:#1d4d4f;"></i>
                    <h5 class="fw-bold text-dark">{{ __('events.fund_raising_title') }}</h5>
                </div>
                <div class="px-0 py-3 text-white" style="background-color: #1d4d4f;">
                    <p class="my-5 large">{{ __('events.fund_raising_description') }}</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-0 shadow-sm h-100 text-center">
                <div class="card-body py-5">
                    <i class="bi bi-recycle mb-3" style="font-size: 60px; color:#1d4d4f;"></i>
                    <h5 class="fw-bold text-dark">{{ __('events.reduce_food_waste_title') }}</h5>
                </div>
                <div class="px-0 py-3 text-white" style="background-color: #f48b3b;">
                    <p class="my-5 large">{{ __('events.reduce_food_waste_description') }}</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-0 shadow-sm h-100 text-center">
                <div class="card-body py-5">
                    <i class="bi bi-megaphone-fill mb-3" style="font-size: 60px; color:#1d4d4f;"></i>
                    <h5 class="fw-bold text-dark">{{ __('events.charity_event_title') }}</h5>
                </div>
                <div class="px-0 py-3 text-white" style="background-color: #1d4d4f;">
                    <p class="my-5 large">{{ __('events.charity_event_description') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('styles')
    <link rel="stylesheet" href="{{ asset('css/events.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endpush
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('joinFormModal');
            modal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                document.getElementById('modalEventTitle').textContent = button.getAttribute(
                    'data-event-title');
                document.getElementById('modalEventHost').textContent = button.getAttribute(
                    'data-event-host');
                document.getElementById('modalEventLocation').textContent = button.getAttribute(
                    'data-event-location');
                document.getElementById('eventId').value = button.getAttribute('data-event-id');
                document.getElementById('modalEventDate').textContent = button.getAttribute(
                    'data-event-date');
            });
        });
    </script>
@endpush
