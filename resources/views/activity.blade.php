@extends('layout.app')

@section('title', 'Activity Page')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

@section('content')

<div class="container-fluid my-2 px-4">
    <div class="header-tabs-donation-wrapper d-flex flex-column flex-lg-row justify-content-between align-items-start mb-4">
        <div class="left-section d-flex flex-column me-lg-4 mb-3 mb-lg-0">
            <h1>ACTIVITIES</h1>

            <ul class="nav nav-pills" id="activityTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active food-tab" id="food-tab" data-bs-toggle="pill" data-bs-target="#food-content" type="button" role="tab" aria-controls="food-content" aria-selected="true" href="#">FOOD ACTIVITIES</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link charity-tab" id="charity-tab" data-bs-toggle="pill" data-bs-target="#charity-content" type="button" role="tab" aria-controls="charity-content" aria-selected="false" href="#">EVENT ACTIVITIES</a>
                </li>
            </ul>
        </div>

        <div class="card donation-info-card flex-shrink-0">
            <div class="card-body d-flex align-items-center justify-content-between p-4" style="position: relative;">
                <div class="d-flex align-items-center text-center">
                    <img src="{{ asset('assets/mascot_donationaccumulation.svg') }}" alt="Donating Potato" class="me-3 donation-potato-img">
                    <div>
                        <h5 class="card-title mb-0 me-2">YOU'VE BEEN DONATING</h5>

                        <div class="d-flex-fluid card-text mb-0 fs-4 fw-bold">
                            <span id="donationAmountValue">IDR {{ number_format($totalDonated, 2, ',', '.') }}</span>
                            <button type="button" class="btn btn-sm btn-link p-0 text-decoration-none" id="toggleDonationVisibility">
                                <i class="bi bi-eye-slash-fill" id="visibilityIcon"></i> {{-- Icon default: mata dicoret (sembunyi) --}}
                            </button>
                        </div>
                        <small class="text-muted d-block">this past 6 months, accumulated from your orders!</small>
                        <a id="quote">"Charity is love in action."</a>
                    </div>
                </div>
                <img src="{{ asset('assets/bg_donationaccumulation.svg') }}" alt="Money Bag" class="donation-piggy-bank-img ms-3">
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
            <div class="d-flex flex-row upcoming-event-wrap">
                <section class="upcoming-events col-12 col-md-8 d-flex flex-column gap-2">
                    <h2>YOUR UPCOMING EVENTS</h2>
                    <div class="upcoming-content d-flex flex-row align-items-center">
                        <div class="container-arrow d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-angle-left arrow"></i>
                        </div>

                        <div class="scroll-container d-flex mx-3">
                            <div class="event-cards-wrapper">
                               @php
                                    $upcomingEvents = [
                                        (object)[
                                            'title' => 'Flavor & Favor',
                                            'organizer' => 'Chef Renatto Moeloek',
                                            'location' => 'Yogyakarta',
                                            'date' => 'April 2025',
                                            'participants' => '1350',
                                            'image' =>asset('assets/memasak.jpeg'),
                                            'description' => 'Bring flavor and kindness to the table in Yogyakarta! Together with local chefs and volunteers, we’ll turn donated ingredients into tasty meals for the elderly and children living on the streets.',
                                            'duration' => '12',
                                            'wa_link' => 'testing'
                                        ],
                                        (object)[
                                            'title' => 'Flavor & Favor',
                                            'organizer' => 'Chef Renatto Moeloek',
                                            'location' => 'Yogyakarta',
                                            'date' => 'April 2025',
                                            'participants' => '1500',
                                            'image' =>asset('assets/memasak.jpeg'),
                                            'description' => 'Bring flavor and kindness to the table in Yogyakarta! Together with local chefs and volunteers, we’ll turn donated ingredients into tasty meals for the elderly and children living on the streets.',
                                            'duration' => '12',
                                            'wa_link' => 'testing'
                                        ],
                                        (object)[
                                            'title' => 'Flavor & Favor',
                                            'organizer' => 'Chef Renatto Moeloek',
                                            'location' => 'Yogyakarta',
                                            'date' => 'April 2025',
                                            'participants' => '1500',
                                            'image' =>asset('assets/memasak.jpeg'),
                                            'description' => 'Bring flavor and kindness to the table in Yogyakarta! Together with local chefs and volunteers, we’ll turn donated ingredients into tasty meals for the elderly and children living on the streets.',
                                            'duration' => '12',
                                            'wa_link' => 'testing'
                                        ],
                                        (object)[
                                            'title' => 'Flavor & Favor',
                                            'organizer' => 'Chef Renatto Moeloek',
                                            'location' => 'Yogyakarta',
                                            'date' => 'April 2025',
                                            'participants' => '1500',
                                            'image' =>asset('assets/memasak.jpeg'),
                                            'description' => 'Bring flavor and kindness to the table in Yogyakarta! Together with local chefs and volunteers, we’ll turn donated ingredients into tasty meals for the elderly and children living on the streets.',
                                            'duration' => '12',
                                            'wa_link' => 'testing'
                                        ],
                                        (object)[
                                            'title' => 'Flavor & Favor',
                                            'organizer' => 'Chef Renatto Moeloek',
                                            'location' => 'Yogyakarta',
                                            'date' => 'April 2025',
                                            'participants' => '1500',
                                            'image' =>asset('assets/memasak.jpeg'),
                                            'description' => 'Bring flavor and kindness to the table in Yogyakarta! Together with local chefs and volunteers, we’ll turn donated ingredients into tasty meals for the elderly and children living on the streets.',
                                            'duration' => '12',
                                            'wa_link' => 'testing'
                                        ],
                                    ];
                                @endphp
 
                                <x-event-upcoming-item :upcomingEvents="$upcomingEvents" />

                            </div>
                        </div>
                        <div class="container-arrow d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-angle-right arrow"></i>
                        </div>
                    </div>
                </section>

                <section class="create-event-container col-12 col-md-4">
                    <div class="create-event-mascot d-flex justify-content-end">
                        <img src="{{asset('assets/mascot_create_event.png')}}">
                    </div>
                    
                    <div class="create-event d-flex">
                        <h2 class="create-event-title">CREATE YOUR OWN EVENT!</h2>
                        <p class="create-event-quote">Don't Just Join-Lead!<br>Propose Your Own Sayfood Gathering</p>
                        <button class="btn btn-propose-event" data-bs-toggle="modal" data-bs-target="#proposeEventModal">
                            PROPOSE EVENT
                        </button>

                    </div>
                </section>
        
            </div>
            
            <section class="journey-section">
                <h2>Let's Take a Look of Your Journey With SAYFOOD!</h2>
                <div class="event-grid">
                    @php
                        $events = [
                            [
                                'title' => 'RENDANG FOR PALEMBANG',
                                'organizer' => 'Willie Salim',
                                'image_color' => 'FFDDC1',
                                'description' => 'Rendang for Palembang was a heartwarming donation event...',
                                'location' => 'Keluar Barops, Palembang',
                                'date' => 'Senin, 12 Mei 2025',
                                'time' => '10.45',
                                'duration' => '12 hours',
                            ],
                            [
                                'title' => 'RENDANG FOR PALEMBANG',
                                'organizer' => 'Willie Salim',
                                'image_color' => 'FFDDC1',
                                'description' => 'Rendang for Palembang was a heartwarming donation event...',
                                'location' => 'Keluar Barops, Palembang',
                                'date' => 'Senin, 12 Mei 2025',
                                'time' => '10.45',
                                'duration' => '12 hours',
                            ],
                            [
                                'title' => 'RENDANG FOR PALEMBANG',
                                'organizer' => 'Willie Salim',
                                'image_color' => 'FFDDC1',
                                'description' => 'Rendang for Palembang was a heartwarming donation event...',
                                'location' => 'Keluar Barops, Palembang',
                                'date' => 'Senin, 12 Mei 2025',
                                'time' => '10.45',
                                'duration' => '12 hours',
                            ],
                            [
                                'title' => 'RENDANG FOR PALEMBANG',
                                'organizer' => 'Willie Salim',
                                'image_color' => 'FFDDC1',
                                'description' => 'Rendang for Palembang was a heartwarming donation event...',
                                'location' => 'Keluar Barops, Palembang',
                                'date' => 'Senin, 12 Mei 2025',
                                'time' => '10.45',
                                'duration' => '12 hours',
                            ],
                            [
                                'title' => 'RENDANG FOR PALEMBANG',
                                'organizer' => 'Willie Salim',
                                'image_color' => 'FFDDC1',
                                'description' => 'Rendang for Palembang was a heartwarming donation event...',
                                'location' => 'Keluar Barops, Palembang',
                                'date' => 'Senin, 12 Mei 2025',
                                'time' => '10.45',
                                'duration' => '12 hours',
                            ],
                            [
                                'title' => 'RENDANG FOR PALEMBANG',
                                'organizer' => 'Willie Salim',
                                'image_color' => 'FFDDC1',
                                'description' => 'Rendang for Palembang was a heartwarming donation event...',
                                'location' => 'Keluar Barops, Palembang',
                                'date' => 'Senin, 12 Mei 2025',
                                'time' => '10.45',
                                'duration' => '12 hours',
                            ],
                            [
                                'title' => 'RENDANG FOR PALEMBANG',
                                'organizer' => 'Willie Salim',
                                'image_color' => 'FFDDC1',
                                'description' => 'Rendang for Palembang was a heartwarming donation event...',
                                'location' => 'Keluar Barops, Palembang',
                                'date' => 'Senin, 12 Mei 2025',
                                'time' => '10.45',
                                'duration' => '12 hours',
                            ],
                            [
                                'title' => 'RENDANG FOR PALEMBANG',
                                'organizer' => 'Willie Salim',
                                'image_color' => 'FFDDC1',
                                'description' => 'Rendang for Palembang was a heartwarming donation event...',
                                'location' => 'Keluar Barops, Palembang',
                                'date' => 'Senin, 12 Mei 2025',
                                'time' => '10.45',
                                'duration' => '12 hours',
                            ],
                            [
                                'title' => 'RENDANG FOR PALEMBANG',
                                'organizer' => 'Willie Salim',
                                'image_color' => 'FFDDC1',
                                'description' => 'Rendang for Palembang was a heartwarming donation event...',
                                'location' => 'Keluar Barops, Palembang',
                                'date' => 'Senin, 12 Mei 2025',
                                'time' => '10.45',
                                'duration' => '12 hours',
                            ],
                            [
                                'title' => 'RENDANG FOR PALEMBANG',
                                'organizer' => 'Willie Salim',
                                'image_color' => 'FFDDC1',
                                'description' => 'Rendang for Palembang was a heartwarming donation event...',
                                'location' => 'Keluar Barops, Palembang',
                                'date' => 'Senin, 12 Mei 2025',
                                'time' => '10.45',
                                'duration' => '12 hours',
                            ]
                        ];
                    @endphp

                    <x-event-journey-section :events="$events" />

                </div>
            </section>
        </div>
    </div>
</div>
@endsection

<!-- Modal Propose Event -->
<div class="modal fade" id="proposeEventModal" tabindex="-1" aria-labelledby="proposeEventModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content rounded-" style="background-color: #FDC87A; padding: 30px 40px;">
      <div class="modal-header border-0 d-flex justify-content-end">
        <button type="button" class="btn p-0 ms-auto" data-bs-dismiss="modal" aria-label="Close" style="background: none; border: none;">
          <i class="bi bi-x-lg text-white fs-4 p-2" style="background: red; border-radius: 50px;"></i>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="row g-4">
            <!-- Kiri -->
            <div class="col-md-6">
              <div class="bg-white p-4 rounded-3">
                <h5 class="fw-bold mb-4 fs-4">Event Details</h5>
                <div class="mb-3">
                  <label class="form-label">Event Name</label>
                  <input type="text" class="form-control" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Event Type</label>
                  <select class="form-select">
                    <option selected disabled>Select type</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label">Event Description</label>
                  <textarea class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Resources Needed</label>
                  <input type="text" class="form-control" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Estimated Participants</label>
                  <input type="text" class="form-control" />
                </div>
              </div>

              <div class="bg-white p-4 rounded-3 mt-4">
                <h5 class="fw-bold mb-4 fs-4">Uploads</h5>
                <div class="mb-3">
                  <label class="form-label">Cover Image</label>
                  <input type="file" class="form-control" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Supporting Files <small><em>(Proposal, Poster, etc.)</em></small></label>
                  <input type="file" class="form-control" multiple />
                </div>
              </div>
            </div>

            <!-- Kanan -->
            <div class="col-md-6">
                <div class="bg-white p-4 rounded-3 mb-4">
                    <h5 class="fw-bold mb-4 fs-4">Location & Time</h5>
                    <div class="mb-3">
                    <label class="form-label">Event Location</label>
                    <input type="text" class="form-control" />
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Event Date</label>
                    <input type="date" class="form-control" />
                    </div>

                    <div class="mb-3">
                    <label class="form-label">Start Time</label>
                    <div class="d-flex gap-2">
                        <input type="number" class="form-control time-box" placeholder="HH">
                        <span class="fw-bold fs-5">:</span>
                        <input type="number" class="form-control time-box" placeholder="MM">
                        <select class="form-select time-box">
                        <option>AM</option>
                        <option>PM</option>
                        </select>
                    </div>
                    </div>

                    <div class="mb-3">
                    <label class="form-label">End Time</label>
                    <div class="d-flex gap-2">
                        <input type="number" class="form-control time-box" placeholder="HH">
                        <span class="fw-bold fs-5">:</span>
                        <input type="number" class="form-control time-box" placeholder="MM">
                        <select class="form-select time-box">
                        <option>AM</option>
                        <option>PM</option>
                        </select>
                    </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-3">
                    <h5 class="fw-bold mb-4 fs-4">Contact & Organizer Info</h5>
                    <div class="mb-3">
                    <label class="form-label">Organizer Name</label>
                    <input type="text" class="form-control" />
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Phone / Whatsapp</label>
                    <input type="text" class="form-control" />
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" />
                    </div>
                </div>
                </div>
            </div>

            <div class="submit-section mt-4 d-flex flex-column align-items-start w-100">
                <button type="button"
                        class="btn btn-terms d-flex justify-content-center align-items-center gap-2 mb-2 w-100 text-center"
                        data-bs-target="#termsAndConditionsModal"
                        data-bs-toggle="modal">
                    <i class="bi bi-check-circle-fill"></i>
                    <span class="text-center">Read Terms & Conditions</span>
                </button>

                <button type="submit" class="btn btn-submit w-100">PROPOSE EVENT</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Terms & Conditions (chained) -->
<div class="modal fade" id="termsAndConditionsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-3" style="background-color: #234C4C; padding: 30px 40px;">
      <div class="modal-header border-0 d-flex justify-content-end">
        <button type="button" class="btn p-0 ms-auto" data-bs-dismiss="modal" aria-label="Close" style="background: none; border: none;">
          <i class="bi bi-x-lg text-white fs-4 p-2" style="background: red; border-radius: 50px;"></i>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="fw-bold mb-4 text-white text-center" style="font-family: 'Oswald';">Terms & Conditions</h3>
        <div class="terms-content bg-white p-4 rounded-3 text-start" style="max-height: 300px; overflow-y: auto;">
          <p>By submitting an event on SayFood, you agree to the following:</p>
          <ol>
            <li><strong>Community Respect:</strong> Promote kindness, inclusivity, and sustainability.</li>
            <li><strong>Food Safety:</strong> You are responsible for food hygiene.</li>
            <li><strong>Honest Info:</strong> Update your event details if needed.</li>
            <li><strong>No Profit-Only:</strong> Focus must be on community.</li>
            <li><strong>Liability:</strong> SayFood is not responsible for issues.</li>
            <li><strong>Moderation Right:</strong> We may reject your event if needed.</li>
          </ol>
        </div>

        <div class="d-flex align-items-center justify-content-center mt-4">
            <input type="checkbox" id="agreeTermsCheckbox">
            <label onclick="agreeAndReturnToForm()" style="cursor: pointer; color: white;">
                I agree to the Terms & Conditions above.
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
