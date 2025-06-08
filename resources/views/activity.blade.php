@extends('layout.app')

@section('title', 'Activity Page')

{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@section('content')

<div class="container-fluid my-2 px-4">
    {{-- Wrapper for Header, Tabs, and Donation Card (THIS IS CORRECT FOR ITS POSITION) --}}
    <div class="header-tabs-donation-wrapper d-flex flex-column flex-lg-row justify-content-between align-items-start mb-4">
        <div class="left-section d-flex flex-column me-lg-4 mb-3 mb-lg-0">
            <h1>ACTIVITIES</h1>

            {{-- TAB CONTROL: ACTIVITIES & CHARITY ACTIVITIES --}}
            <ul class="nav nav-pills" id="activityTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active food-tab" id="food-tab" data-bs-toggle="pill" data-bs-target="#food-content" type="button" role="tab" aria-controls="food-content" aria-selected="true" href="#">FOOD ACTIVITIES</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link charity-tab" id="charity-tab" data-bs-toggle="pill" data-bs-target="#charity-content" type="button" role="tab" aria-controls="charity-content" aria-selected="false" href="#">CHARITY ACTIVITIES</a>
                </li>
            </ul>
        </div>

        {{-- Donation Info Card - This card should always be visible (based on your images) --}}
        <div class="card donation-info-card flex-shrink-0">
            <div class="card-body d-flex align-items-center justify-content-between p-4" style="position: relative;">
                <div class="d-flex align-items-center text-center">
                    <img src="{{ asset('assets/mascot_donationaccumulation.svg') }}" alt="Donating Potato" class="me-3 donation-potato-img">
                    <div>
                        {{-- Tombol toggle ejajar dengan h5 --}}
                        <h5 class="card-title mb-0 me-2">YOU'VE BEEN DONATING</h5>
                        {{-- Nominal donasi sekarang ada di bawahnya --}}
                        <div class="d-flex-fluid card-text mb-0 fs-4 fw-bold">
                            <span id="donationAmountValue">IDR 472.300,00</span>
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
    {{-- END HEADER-TABS-DONATION-WRAPPER --}}

    {{-- SINGLE TAB CONTENT CONTAINER --}}
    <div class="tab-content" id="activityTabContent">
        {{-- TAB PANE: FOOD ACTIVITIES CONTENT --}}
        <div class="tab-pane fade show active" id="food-content" role="tabpanel" aria-labelledby="food-tab">
            {{-- Konten LIST AKTIVITAS MAKANAN akan berada di sini --}}
            {{-- Ini adalah tempat untuk semua activity-main-item --}}
            <div class="activity-list">
                @php
                    $orderStatuses = [
                        [
                            'status' => 'order_created',
                            'orderPlacedLabel' => 'ORDER PLACED',
                            'orderPlacedDate' => '25 May 2025',
                            'total' => 'IDR 50.000,00',
                            'restoName' => 'Restoran Ny. Nita',
                            'restoLocation' => 'Jl. Pakuan No.3, Sumur Batu, Babakan Madang, Bogor',
                            'readyPickupText' => 'Ready to Pick Up',
                            'items' => [
                                ['name' => 'Bubur Sukabumi', 'qty' => 1, 'price' => 'IDR 6.000,00'],
                                ['name' => 'Lemongrass Tea', 'qty' => 1, 'price' => 'IDR 1.000,00'],
                            ],
                            'reviewButtonText' => 'Review Order',
                        ],
                    ];
                @endphp

                @for ($i = 0; $i < 10; $i++)
                    <x-food-activities-item :orderStatuses="$orderStatuses" />
                @endfor
            </div>
        </div>

        {{-- TAB PANE: CHARITY ACTIVITIES CONTENT --}}
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
                                            'participants' => '1,350',
                                            'image' =>asset('assets/memasak.jpeg')
                                        ],
                                        (object)[
                                            'title' => 'Flavor & Favor',
                                            'organizer' => 'Chef Renatto Moeloek',
                                            'location' => 'Yogyakarta',
                                            'date' => 'April 2025',
                                            'participants' => '1,500',
                                            'image' =>asset('assets/memasak.jpeg')
                                        ],
                                        (object)[
                                            'title' => 'Flavor & Favor',
                                            'organizer' => 'Chef Renatto Moeloek',
                                            'location' => 'Yogyakarta',
                                            'date' => 'April 2025',
                                            'participants' => '1,500',
                                            'image' =>asset('assets/memasak.jpeg')
                                        ],
                                        (object)[
                                            'title' => 'Flavor & Favor',
                                            'organizer' => 'Chef Renatto Moeloek',
                                            'location' => 'Yogyakarta',
                                            'date' => 'April 2025',
                                            'participants' => '1,500',
                                            'image' =>asset('assets/memasak.jpeg')
                                        ],
                                        (object)[
                                            'title' => 'Flavor & Favor',
                                            'organizer' => 'Chef Renatto Moeloek',
                                            'location' => 'Yogyakarta',
                                            'date' => 'April 2025',
                                            'participants' => '1,500',
                                            'image' =>asset('assets/memasak.jpeg')
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
                        <button class="btn btn-propose-event"n>PROPOSE EVENT</button>
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
    {{-- END SINGLE TAB CONTENT CONTAINER --}}
</div>


@endsection