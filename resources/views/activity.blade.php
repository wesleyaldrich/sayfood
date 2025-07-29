@extends('layout.app')

@section('title', __('activity.activity_page'))

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

@section('content')

    <div class="container-fluid my-2 px-4">
        <div
            class="header-tabs-donation-wrapper d-flex flex-column flex-lg-row justify-content-between align-items-start mb-4">
            <div class="left-section d-flex flex-column me-lg-4 mb-3 mb-lg-0">
                <h1>{{ __('activity.activities_title') }}</h1>

                <ul class="nav nav-pills" id="activityTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active food-tab" id="food-tab" data-bs-toggle="pill"
                            data-bs-target="#food-content" type="button" role="tab" aria-controls="food-content"
                            aria-selected="true" href="#">{{ __('activity.food_activities_tab') }}</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link charity-tab" id="charity-tab" data-bs-toggle="pill"
                            data-bs-target="#charity-content" type="button" role="tab" aria-controls="charity-content"
                            aria-selected="false" href="#">{{ __('activity.event_activities_tab') }}</a>
                    </li>
                </ul>
            </div>

            <div class="card donation-info-card flex-shrink-0">
                <div class="card-body d-flex align-items-center justify-content-between p-4" style="position: relative;">
                    <div class="d-flex align-items-center text-center">
                        <img src="{{ asset('assets/mascot_donationaccumulation.svg') }}" alt="Donating Potato"
                            class="me-3 donation-potato-img">
                        <div>
                            <h5 class="card-title mb-0 me-2">{{ __('activity.youve_been_donating') }}</h5>

                            <div class="d-flex-fluid card-text mb-0 fs-4 fw-bold">
                                <span id="donationAmountValue">IDR {{ number_format($totalDonated, 2, ',', '.') }}</span>
                                <button type="button" class="btn btn-sm btn-link p-0 text-decoration-none"
                                    id="toggleDonationVisibility">
                                    <i class="bi bi-eye-slash-fill" id="visibilityIcon"></i> {{-- Icon default: mata dicoret
                                    (sembunyi) --}}
                                </button>
                            </div>
                            <small class="text-muted d-block">{{ __('activity.past_six_months_accumulated') }}</small>
                            <a id="quote">{{ __('activity.charity_quote') }}</a>
                        </div>
                    </div>
                    <img src="{{ asset('assets/bg_donationaccumulation.svg') }}" alt="Money Bag"
                        class="donation-piggy-bank-img ms-3">
                </div>
            </div>
        </div>

        <div class="tab-content" id="activityTabContent">

            <div class="tab-pane fade show active mb-5" id="food-content" role="tabpanel" aria-labelledby="food-tab">

                <div class="activity-list">
                    <x-food-activities-item :orderStatuses="$orderStatuses" />
                </div>


            </div>

            <div class="tab-pane fade" id="charity-content" role="tabpanel" aria-labelledby="charity-tab">

                <div class="d-flex row">
                    <section class="created-event-section col-md-8">
                        <h2 style="font-family: 'Oswald'; margin-bottom: 20px;">
                            {{ __('activity.lets_take_a_look_at_created_events') }}</h2>
                        <div class="created-event-wrapper d-flex flex-row flex-nowrap overflow-auto gap-4"
                            style="scrollbar-width: thin;">
                            @if ($createdEvents->isEmpty())
                                <p class="text-muted" style="font-size: 1.25rem">{{ __('activity.no_created_events_yet') }}</p>
                            @else
                                @foreach ($createdEvents as $event)
                                    <a href="{{ route('show.created-event', $event->id) }}" class="block">
                                        <x-event-created-section :event="$event" />
                                    </a>
                                @endforeach
                            @endif

                        </div>
                    </section>

                    <section class="create-event-container col-12 col-md-4">
                        <div class="create-event-mascot d-flex justify-content-end">
                            <img src="{{asset('assets/mascot_create_event.png')}}">
                        </div>

                        <div class="create-event d-flex">
                            <h2 class="create-event-title">{{ __('activity.create_your_own_event_title') }}</h2>
                            <p class="create-event-quote">{!! __('activity.create_event_quote') !!}</p>
                            <button class="btn btn-propose-event" data-bs-toggle="modal" data-bs-target="#proposeEventModal"
                                id="wantToPurposeEvent">
                                {{ __('activity.propose_event_button') }}
                            </button>

                        </div>
                    </section>
                </div>

                <section class="upcoming-events d-flex flex-column gap-2">
                    <h2>{{ __('activity.your_upcoming_events') }}</h2>
                    <div class="event-cards-wrapper">

                        <x-event-upcoming-item :upcomingEvents="$upcomingEvents" />

                    </div>
                </section>

                <section class="journey-section">
                    <h2 style="font-family: 'Oswald'">{{ __('activity.lets_take_a_look_at_your_journey') }}</h2>
                    <div class="event-grid">
                        @if($completedEvents->isEmpty())
                            <p class="text-muted" style="font-size: 1.25rem">{{ __('activity.no_completed_events_yet') }}</p>
                        @else
                            <x-event-journey-section :events="$completedEvents" />
                        @endif
                    </div>
                </section>

            </div>
        </div>
    </div>

    @php
        $showModal = session()->pull('show_modal'); // hanya sekali baca dan langsung hilang
    @endphp

    @if ($showModal)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // 1. Trigger tab EVENT ACTIVITIES
                document.querySelector('#charity-tab')?.click();

                // 2. Tampilkan modal Propose Event
                document.querySelector('#wantToPurposeEvent')?.click();
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');

            if (tab === 'eventactivity') {
                // Trigger klik ke tab CREATED EVENTS
                document.querySelector('#charity-tab')?.click();
            }
        });
    </script>

    @php
        $tab = session()->pull('tab');
    @endphp

    @if ($tab === 'eventactivity')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelector('#charity-tab')?.click();
            });
        </script>
    @endif

@endsection

<div class="modal fade" id="proposeEventModal" tabindex="-1" aria-labelledby="proposeEventModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content rounded" style="background-color: #FDC87A; padding: 30px 40px;">
            <div class="modal-header border-0 d-flex justify-content-end">
                <button type="button" class="btn p-0 ms-auto" data-bs-dismiss="modal" aria-label="Close"
                    style="background: red; border-radius: 50px; height: 32px;">
                    <i class="bi bi-x-lg text-white fs-4 p-2"></i>
                </button>
            </div>
            <div class=" modal-body">

                <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="bg-white p-4 rounded-3">
                                <h5 class="fw-bold mb-4 fs-4">{{ __('activity.event_details_title') }}</h5>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('activity.event_name_label') }}</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" />
                                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('activity.event_category_label') }}</label>
                                    <select class="form-select @error('event_category_id') is-invalid @enderror"
                                        name="event_category_id">
                                        <option value="" disabled {{ old('event_category_id') ? '' : 'selected' }}>
                                            {{ __('activity.select_type_option') }}
                                        </option>
                                        <option value="1" {{ old('event_category_id') == 1 ? 'selected' : '' }}>
                                            {{ __('activity.cooking_workshop_option') }}
                                        </option>
                                        <option value="2" {{ old('event_category_id') == 2 ? 'selected' : '' }}>
                                            {{ __('activity.food_donation_option') }}
                                        </option>
                                        <option value="3" {{ old('event_category_id') == 3 ? 'selected' : '' }}>
                                            {{ __('activity.education_option') }}
                                        </option>
                                    </select>
                                    @error('event_category_id') <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('activity.event_description_label') }}</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        name="description" rows="3">{{ old('description') }}</textarea>
                                    @error('description') <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('activity.estimated_participants_label') }}</label>
                                    <input type="number"
                                        class="form-control @error('estimated_participants') is-invalid @enderror"
                                        name="estimated_participants" value="{{ old('estimated_participants') }}"
                                        min="1" />
                                    @error('estimated_participants') <div class="text-danger">{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('activity.group_link_label') }}</label>
                                    <input type="url" class="form-control @error('group_link') is-invalid @enderror"
                                        name="group_link" value="{{ old('group_link') }}" />
                                    @error('group_link') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="bg-white p-4 rounded-3 mt-4">
                                <h5 class="fw-bold mb-4 fs-4">{{ __('activity.uploads_title') }}</h5>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('activity.cover_image_label') }}</label>
                                    <input type="file" class="form-control @error('image_url') is-invalid @enderror"
                                        name="image_url" />
                                    @error('image_url') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('activity.supporting_files_label') }}
                                        <small><em>{{ __('activity.supporting_files_hint') }}</em></small></label>
                                    <input type="file" class="form-control @error('files') is-invalid @enderror"
                                        name="files[]" multiple />
                                    @error('files') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="bg-white p-4 rounded-3 mb-4">
                                <h5 class="fw-bold mb-4 fs-4">{{ __('activity.location_time_title') }}</h5>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('activity.event_location_label') }}</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                        name="location" value="{{ old('location') }}" />
                                    @error('location') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('activity.event_date_label') }}</label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror"
                                        name="date" value="{{ old('date') }}" />
                                    @error('date') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('activity.start_time_label') }}</label>
                                    <div class="d-flex gap-2">
                                        <input type="number"
                                            class="form-control time-box @error('start_hour') is-invalid @enderror"
                                            name="start_hour" placeholder="HH" min="1" max="12"
                                            value="{{ old('start_hour') }}">
                                        <span class="fw-bold fs-5">:</span>
                                        <input type="number"
                                            class="form-control time-box @error('start_minute') is-invalid @enderror"
                                            name="start_minute" placeholder="MM" min="0" max="59"
                                            value="{{ old('start_minute') }}">
                                        <select class="form-select time-box @error('start_ampm') is-invalid @enderror"
                                            name="start_ampm">
                                            <option {{ old('start_ampm') == 'AM' ? 'selected' : '' }}>AM</option>
                                            <option {{ old('start_ampm') == 'PM' ? 'selected' : '' }}>PM</option>
                                        </select>
                                    </div>
                                    @error('start_hour') <div class="text-danger">{{ $message }}</div> @enderror
                                    @error('start_minute') <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    @error('start_ampm') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('activity.end_time_label') }}</label>
                                    <div class="d-flex gap-2">
                                        <input type="number"
                                            class="form-control time-box @error('end_hour') is-invalid @enderror"
                                            name="end_hour" placeholder="HH" min="1" max="12"
                                            value="{{ old('end_hour') }}">
                                        <span class="fw-bold fs-5">:</span>
                                        <input type="number"
                                            class="form-control time-box @error('end_minute') is-invalid @enderror"
                                            name="end_minute" placeholder="MM" min="0" max="59"
                                            value="{{ old('end_minute') }}">
                                        <select class="form-select time-box @error('end_ampm') is-invalid @enderror"
                                            name="end_ampm">
                                            <option {{ old('end_ampm') == 'AM' ? 'selected' : '' }}>AM</option>
                                            <option {{ old('end_ampm') == 'PM' ? 'selected' : '' }}>PM</option>
                                        </select>
                                    </div>
                                    @error('end_hour') <div class="text-danger">{{ $message }}</div> @enderror
                                    @error('end_minute') <div class="text-danger">{{ $message }}</div> @enderror
                                    @error('end_ampm') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="bg-white p-4 rounded-3">
                                <h5 class="fw-bold mb-4 fs-4">{{ __('activity.contact_organizer_info_title') }}</h5>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('activity.organizer_name_label') }}</label>
                                    <input type="text"
                                        class="form-control @error('organizer_name') is-invalid @enderror"
                                        name="organizer_name" value="{{ old('organizer_name') }}" />
                                    @error('organizer_name') <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('activity.phone_whatsapp_label') }}</label>
                                    <input type="text"
                                        class="form-control @error('organizer_phone') is-invalid @enderror"
                                        name="organizer_phone" value="{{ old('organizer_phone') }}" />
                                    @error('organizer_phone') <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('activity.email_label') }}</label>
                                    <input type="email"
                                        class="form-control @error('organizer_email') is-invalid @enderror"
                                        name="organizer_email" value="{{ old('organizer_email') }}" />
                                    @error('organizer_email') <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section mt-4 d-flex flex-column align-items-center w-100">
                        <button type="button"
                            class="btn btn-terms d-flex justify-content-center align-items-center gap-2 mb-2 w-100 text-center"
                            data-bs-target="#termsAndConditionsModal" data-bs-toggle="modal">
                            <i id="checkTC" class="bi bi-check-circle-fill d-none"></i>
                            <span class="text-center">{{ __('activity.read_terms_conditions_button') }}</span>
                        </button>

                        <input type="checkbox" name="agree_terms" id="hiddenAgreeCheckbox" hidden>

                        @error('agree_terms')
                            <div class="text-danger text-center">{{ $message }}</div>
                        @enderror

                        <button type="submit"
                            class="btn btn-submit w-100 mt-4">{{ __('activity.propose_event_button') }}</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="termsAndConditionsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-3" style="background-color: #234C4C; padding: 30px 40px;">
            <div class="modal-header border-0 d-flex justify-content-end">
                <button type="button" id="backProposeEventModal" class="btn p-0 ms-auto"
                    data-bs-target="#proposeEventModal" data-bs-toggle="modal" style="background: none; border: none;">
                    <i class="bi bi-x-lg text-white fs-4 p-2" style="background: red; border-radius: 50px;"></i>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="fw-bold mb-4 text-white text-center" style="font-family: 'Oswald';">
                    {{ __('activity.terms_conditions_modal_title') }}</h3>
                <div class="terms-content bg-white p-4 rounded-3 text-start"
                    style="max-height: 300px; overflow-y: auto;">
                    <p>{{ __('activity.terms_intro') }}</p>
                    <ol>
                        <li>{!! __('activity.term_community_respect') !!}</li>
                        <li>{!! __('activity.term_food_safety') !!}</li>
                        <li>{!! __('activity.term_honest_info') !!}</li>
                        <li>{!! __('activity.term_no_profit_only') !!}</li>
                        <li>{!! __('activity.term_liability') !!}</li>
                        <li>{!! __('activity.term_moderation_right') !!}</li>
                    </ol>
                </div>

                <div class="d-flex align-items-center justify-content-center mt-4">
                    <input type="checkbox" id="agreeTermsCheckbox">
                    <label for="agreeTermsCheckbox" style="cursor: pointer; color: white;">
                        {{ __('activity.agree_terms_checkbox') }}
                    </label>
                </div>

            </div>

        </div>
    </div>
</div>
</div>



@push('styles')
    <link rel="stylesheet" href="{{ asset('css/activity.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/activity.js') }}" defer></script>
@endpush