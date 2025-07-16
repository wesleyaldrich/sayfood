@extends('layout.app')
@section('title', 'Events Page')

<?php
$events = [
    [
        'title' => 'Flavor & Favor1',
        'host' => 'by Chef Renatta Moeloek',
        'location' => 'Yogyakarta',
        'date' => 'April 2025',
        'participants' => '1,350',
        'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
        'badge_color' => 'Popular',
        'badge' => 'Newest Event'
    ],
    [
        'title' => 'Flavor & Favor2',
        'host' => 'by Chef Renatta Moeloek',
        'location' => 'Yogyakarta',
        'date' => 'April 2025',
        'participants' => '2,480',
        'image' => 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
        'badge_color' => 'Trending',
        'badge' => 'Most Popular'
    ],
];
?>

@section('content')
    <link rel="stylesheet" href="{{ asset('css/events.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <div class="event-page">
        <!-- Kategori -->
        <div class="event-categories row mx-0 gap-5 w-100">
            <div class="col-3 p-3 mx-5 gap-3">
                <h1 class="event-categories" style="font-size: 35px; font-weight: bold;">EVENT<br>CATEGORIES</h1>
            </div>
            <div class="category-list p-0">
                <button class="category-card" style="width: 250px;">
                    <img src="assets/cookingworkshop.jpg" alt="Cooking Workshop">
                    <span>Cooking Workshop</span>
                </button>
                <button class="category-card" style="width: 250px;">
                    <img src="assets/fooddonation.jpg" alt="Food Donation">
                    <span>Food Donation</span>
                </button>
                <button class="category-card" style="width: 250px;">
                    <img src="assets/education.jpg" alt="Education">
                    <span>Education</span>
                </button>
            </div>
        </div>

        <!-- Recommended & Coming Soon -->
<div class="section-flex">
    <div class="recommended">
        <h3>RECOMMENDED FOR YOU</h3>
        <div class="recommended-wrapper">
            <button class="arrow left" onclick="slideLeft()">&#10094;</button>
            
            <div class="recommended-list" id="recommendedList">
                @foreach ($events as $event)
                    <div class="recommended-card">
                        <div class="badge {{ strtolower($event['badge_color']) }}">
                            {{ $event['badge'] }}
                        </div>
                        <img src="{{ $event['image'] }}" alt="event">
                        <div class="card-details">
                            <div class="participants">{{ $event['participants'] }} joined</div>
                            <div>
                                <p class="title">{{ $event['title'] }}</p>
                                <p class="host">{{ $event['host'] }}</p>
                                <p class="info"><i class="bi bi-geo-alt-fill"></i> {{ $event['location'] }}</p>
                                <p class="info"><i class="bi bi-calendar-event-fill"></i> {{ $event['date'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="arrow right" onclick="slideRight()">&#10095;</button>
        </div>
    </div>
</div>


            <div class="coming-soon">
                <h3>COMING SOON</h3>
                <div class="coming-scroll flex-grow-1 overflow-auto p-2 Container-wide">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="coming-item mb-3 d-flex align-items-center">
                            <div class="Container-csd rounded p-3 d-flex align-items-center">
                                <div class="Container-date-box text-white fw-bold text-center mx-0">
                                    <div class="date p-3">
                                        November<br />
                                        <div class="date-cs" style="font-size: 25px;">
                                            19
                                        </div>
                                    </div>
                                </div>
                                <div class="cs-description">
                                    <div class="cs-title fw-bold mx-2">Cooking Workshop</div>
                                    <div class="cs-by mx-2 fst-italic text-warning-emphasis">by Chef Renatta Moeloek
                                    </div>
                                    <div class="d-flex gap-2 mx-2 mt-2">
                                        <div class="border-loc px-1 py-1 d-flex align-items-center mx-1">
                                            <i class="bi bi-geo-alt-fill p-1"></i>
                                            <span class="cs-loc fw-bold text-dark-green">Taman Menteng, Jakarta</span>
                                        </div>
                                        <div class="border-date px-1 py-1 d-flex align-items-center">
                                            <i class="bi bi-clock-fill p-1"></i>
                                            <span class="cs-date fw-bold text-dark-green">15:00 WIB</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- CTA -->
        <h4 class="cta-text">Let’s Start Your Journey With <span class="text-orange">SAYFOOD</span>!</h4>

        <!-- Event List -->
        <div class="event-list">
            @for ($i = 0; $i < 4; $i++)
                <div class="event-card">
                    <img src="event.jpg" alt="event">
                    <div class="event-info">
                        <h6>Flavor & Favor: Cooking for Good</h6>
                        <p>Short description here...</p>
                        <button class="btn-teal">Join Event</button>
                    </div>
                </div>
            @endfor
        </div>

        <!-- Volunteering -->
        <div class="volunteering-list row row-cols-1 row-cols-md-3 g-4">
            <!-- Card 1 -->
            <div class="col">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body py-5">
                        <i class="bi bi-megaphone-fill fs-1 mb-3 text-dark"></i>
                        <h5 class="fw-bold text-dark">VOLUNTEERING</h5>
                    </div>
                    <div class="px-4 py-3 text-white" style="background-color: #1d4d4f;">
                        <p class="mb-1 small">lorem ipsum dolor sit ameLorem ipsum dolor sit amet</p>
                        <p class="mb-1 small">lorem ipsum dolor sit ameLorem ipsum dolor sit amet</p>
                        <p class="mb-1 small">lorem ipsum dolor sit ameLorem ipsum dolor sit amet</p>
                        <p class="mb-1 small">lorem ipsum dolor sit ameLorem ipsum dolor sit amet</p>
                        <p class="mb-0 small">lorem ipsum dolor sit ameLorem ipsum dolor sit amet</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 (Orange) -->
            <div class="col">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body py-5">
                        <i class="bi bi-megaphone-fill fs-1 mb-3 text-dark"></i>
                        <h5 class="fw-bold text-dark">VOLUNTEERING</h5>
                    </div>
                    <div class="px-4 py-3 text-white" style="background-color: #f48b3b;">
                        <p class="mb-1 small">lorem ipsum dolor sit ameLorem ipsum dolor sit amet</p>
                        <p class="mb-1 small">lorem ipsum dolor sit ameLorem ipsum dolor sit amet</p>
                        <p class="mb-1 small">lorem ipsum dolor sit ameLorem ipsum dolor sit amet</p>
                        <p class="mb-1 small">lorem ipsum dolor sit ameLorem ipsum dolor sit amet</p>
                        <p class="mb-0 small">lorem ipsum dolor sit ameLorem ipsum dolor sit amet</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body py-5">
                        <i class="bi bi-megaphone-fill fs-1 mb-3 text-dark"></i>
                        <h5 class="fw-bold text-dark">VOLUNTEERING</h5>
                    </div>
                    <div class="px-4 py-3 text-white" style="background-color: #1d4d4f;">
                        <p class="mb-1 small">lorem ipsum dolor sit ameLorem ipsum dolor sit amet</p>
                        <p class="mb-1 small">lorem ipsum dolor sit ameLorem ipsum dolor sit amet</p>
                        <p class="mb-1 small">lorem ipsum dolor sit ameLorem ipsum dolor sit amet</p>
                        <p class="mb-1 small">lorem ipsum dolor sit ameLorem ipsum dolor sit amet</p>
                        <p class="mb-0 small">lorem ipsum dolor sit ameLorem ipsum dolor sit amet</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection