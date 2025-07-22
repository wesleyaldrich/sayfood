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
        'badge' => 'Newest Event',
    ],
    [
        'title' => 'Flavor & Favor2',
        'host' => 'by Chef Renatta Moeloek',
        'location' => 'Yogyakarta',
        'date' => 'April 2025',
        'participants' => '2,480',
        'image' => 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
        'badge_color' => 'Trending',
        'badge' => 'Most Popular',
    ],
    [
        'title' => 'Flavor & Favor3',
        'host' => 'by Chef Renatta Moeloek',
        'location' => 'Yogyakarta',
        'date' => 'April 2025',
        'participants' => '980',
        'image' => 'https://images.unsplash.com/photo-1482049016688-2d3e1b311543?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
        'badge_color' => 'New',
        'badge' => 'Seasonal Specials',
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
        <div class="container my-4">
            <div class="row g-4 align-items-start">

                <!-- RECOMMENDED KIRI -->
                <div class="recommended-cb col-lg-8 col-12 h-100 d-flex flex-column">
                    <div class="recommended p-3 d-flex flex-column h-100">
                        <h3>RECOMMENDED FOR YOU</h3>
                        <div class="recommended-wrapper position-relative flex-grow-1">
                            <div class="recommended-list d-flex gap-3 h-100" id="recommendedList">
                                @foreach ($events as $event)
                                    <div class="recommended-card position-relative d-flex flex-column">
                                        <div class="badge {{ strtolower($event['badge_color']) }}">
                                            {{ $event['badge'] }}
                                        </div>
                                        <img src="{{ $event['image'] }}" alt="event"
                                            class="img-fluid rounded-top object-fit-cover">
                                        <div
                                            class="card-details d-flex p-2 align-items-center bg-dark text-white rounded-bottom">
                                            <!-- Participant Circle -->
                                            <div
                                                class="participants-circle d-flex align-items-center justify-content-center">
                                                <div class="circle text-dark d-flex flex-column align-items-center justify-content-center rounded-circle"
                                                    style="width:70px; height:70px; border: 3px solid #cd8200;">
                                                    <img src="{{ asset('assets/participant_logo.png') }}"
                                                        alt="participants icon" style="width: 24px; height: 24px;">
                                                    <div class="text-center small">
                                                        <div class="fw-bold">{{ $event['participants'] }}</div>
                                                        <div>joined</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Two Column Details -->
                                            <div class="d-flex justify-content-between align-items-center w-100 flex-wrap">
                                                <!-- Kiri: Title & Host -->
                                                <div>
                                                    <p class="title fw-bold mb-0" style="font-size: 20px;">
                                                        {{ $event['title'] }}</p>
                                                    <p class="host fst-italic mb-0 text-warning">by {{ $event['host'] }}</p>
                                                </div>

                                                <!-- Kanan: Location & Date -->
                                                <div class="text-end me-5">
                                                    <p class="info mb-0">
                                                        <i class="bi bi-geo-alt-fill text-warning"></i>
                                                        {{ $event['location'] }}
                                                    </p>
                                                    <p class="info mb-0">
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

                <!-- COMING SOON KANAN -->
                
            </div>
        </div>


        <!-- CTA -->
        <h4 class="cta-text">Let’s Start Your Journey With <span class="text-orange">SAYFOOD</span>!</h4>

        <!-- Event List -->
        


        {{-- Pagination --}}
        <div class="d-flex justify-content-center mb-4">
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item active">
                        <a class="page-link text-white" href="#"
                            style="background-color: #f6d6a4; border-color: #f6d6a4;">1</a>
                    </li>
                    <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                    <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
                    <li class="page-item"><a class="page-link text-dark" href="#">4</a></li>
                    <li class="page-item"><a class="page-link text-dark" href="#">5</a></li>
                    <li class="page-item">
                        <a class="page-link text-dark" href="#"><i class="bi bi-chevron-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>


    <!-- Volunteering -->
    <div class="volunteering-list row row-cols-1 row-cols-md-3 g-4">
        <!-- Card 1 -->
        <div class="col">
            <div class="card border-0 shadow-sm h-100 text-center">
                <div class="card-body py-5">
                    <i class="bi bi-cash-coin mb-3" style="font-size: 60px; color:#1d4d4f;"></i>
                    <h5 class="fw-bold text-dark">FUND RAISING</h5>
                </div>
                <div class="px-4 py-3 text-white" style="background-color: #1d4d4f;">
                    <p class="my-5 large">Help us raise funds to empower community-driven solutions against food
                        waste
                        and hunger. Every donation goes directly to impactful programs, from food redistribution
                        to
                        sustainable education. By contributing, you're not only giving — you're creating
                        long-term
                        change.</p>
                </div>
            </div>
        </div>

        <!-- Card 2 (Orange) -->
        <div class="col">
            <div class="card border-0 shadow-sm h-100 text-center">
                <div class="card-body py-5">
                    <i class="bi bi-recycle mb-3" style="font-size: 60px; color:#1d4d4f;"></i>
                    <h5 class="fw-bold text-dark">REDUCE FOOD WASTE</h5>
                </div>
                <div class="px-4 py-3 text-white" style="background-color: #f48b3b;">
                    <p class="my-5 large">Our platform connects food providers with charities to ensure excess
                        food is
                        redirected to those in need. By joining, you help reduce landfill waste and fight hunger
                        — all
                        while supporting a more sustainable ecosystem.</p>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col">
            <div class="card border-0 shadow-sm h-100 text-center">
                <div class="card-body py-5">
                    <i class="bi bi-megaphone-fill mb-3" style="font-size: 60px; color:#1d4d4f;"></i>
                    <h5 class="fw-bold text-dark">CHARITY EVENT</h5>
                </div>
                <div class="px-4 py-3 text-white" style="background-color: #1d4d4f;">
                    <p class="my-5 large">Be part of our regular charity events — from food drives to awareness
                        campaigns. Participate or volunteer to make a real impact while building a more
                        compassionate
                        community. Every event is a chance to give back and connect.</p>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
