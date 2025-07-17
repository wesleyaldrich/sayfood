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
    [
        'title' => 'Flavor & Favor3',
        'host' => 'by Chef Renatta Moeloek',
        'location' => 'Yogyakarta',
        'date' => 'April 2025',
        'participants' => '980',
        'image' => 'https://images.unsplash.com/photo-1482049016688-2d3e1b311543?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
        'badge_color' => 'New',
        'badge' => 'Seasonal Specials'
    ]
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
                            <button class="arrow left" onclick="slideLeft()">&#10094;</button>
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
                                                    <p class="title fw-bold mb-0" style="font-size: 20px;">{{ $event['title'] }}</p>
                                                    <p class="host fst-italic mb-0 text-warning">by {{ $event['host'] }}</p>
                                                </div>

                                                <!-- Kanan: Location & Date -->
                                                <div class="text-end me-5">
                                                    <p class="info mb-0">
                                                        <i class="bi bi-geo-alt-fill text-warning"></i> {{ $event['location'] }}
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
                            <button class="arrow right" onclick="slideRight()">&#10095;</button>
                        </div>
                    </div>
                </div>

                <!-- COMING SOON KANAN -->
                <div class="col-lg-4 col-12">
                    <div class="coming-soon fw-bold">
                        <h3>COMING SOON</h3>
                        <div class="coming-scroll overflow-auto p-2">
                            @for ($i = 0; $i < 5; $i++)
                                <div class="coming-item mb-3 d-flex align-items-center">
                                    <div class="Container-csd rounded p-3 d-flex align-items-center">
                                        <div class="Container-date-box text-white fw-bold text-center mx-0">
                                            <div class="date p-3">
                                                November<br />
                                                <div class="date-cs" style="font-size: 25px;">19</div>
                                            </div>
                                        </div>
                                        <div class="cs-description">
                                            <div class="cs-title fw-bold mx-2">Cooking Workshop</div>
                                            <div class="cs-by mx-2 fst-italic text-warning-emphasis">
                                                by Chef Renatta Moeloek
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
            </div>
        </div>


        <!-- CTA -->
        <h4 class="cta-text">Let’s Start Your Journey With <span class="text-orange">SAYFOOD</span>!</h4>

        <!-- Event List -->
        <div class="event-list">
            @for ($i = 0; $i < 4; $i++)
                <div class="event-card d-flex flex-column rounded-4 shadow-sm overflow-hidden mb-4"
                    style="background-color: #f6d6a4; max-width: 850px;">

                    <div class="d-flex p-2 pb-0">
                        {{-- Gambar kiri --}}
                        <img src="{{ asset('assets/bg_upcoming_events.png') }}" alt="event" class="rounded"
                            style="width: 200px; height: auto; object-fit: cover;">

                        {{-- Konten kanan --}}
                        <div class="ps-4 flex-grow-1">
                            <h5 class="fw-bold text-dark mb-1">Flavor & Favor: Cooking for Good</h5>
                            <div class="fst-italic fw-semibold mb-2" style="color: #d38a2e;">by Chef Renatta Moeloek
                            </div>
                            <p class="text-dark small mb-2">
                                Bring flavor and kindness to the table in Yogyakarta! Together with local chefs and
                                volunteers,
                                we’ll turn donated ingredients into tasty meals for the elderly and children living on
                                the
                                streets.
                            </p>
                            <hr class="my-2 text-dark">
                        </div>
                    </div>

                    {{-- Info + Join Button --}}
                    <div class="px-4 pb-2 pt-2">
                        {{-- Info bar --}}
                        <div class="d-flex flex-wrap gap-1 mb-3" style="font-size: 11px;">
                            <div class="border-loc px-2 py-1 d-flex align-items-center rounded"
                                style="border: 2px solid #cd8200;">
                                <i class="bi bi-geo-alt-fill me-2 text-dark-green"></i>
                                <span class="fw-bold text-dark-green">Malioboro, Yogyakarta</span>
                            </div>
                            <div class="border-loc px-2 py-1 d-flex align-items-center rounded"
                                style="border: 2px solid #cd8200;">
                                <i class="bi bi-calendar-event-fill me-2 text-dark-green"></i>
                                <span class="fw-bold text-dark-green">Thursday, 21 April 2025</span>
                            </div>
                            <div class="border-loc px-2 py-1 d-flex align-items-center rounded"
                                style="border: 2px solid #cd8200;">
                                <i class="bi bi-people-fill me-2 text-dark-green"></i>
                                <span class="fw-bold text-dark-green">138 participants</span>
                            </div>
                            <div class="border-loc px-2 py-1 d-flex align-items-center rounded"
                                style="border: 2px solid #cd8200;">
                                <i class="bi bi-clock-fill me-2 text-dark-green"></i>
                                <span class="fw-bold text-dark-green">12 hours</span>
                            </div>
                        </div>

                        {{-- Join Button --}}
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-success rounded-pill px-5 py-1" style="background-color: #1d4d4f;">Join
                                Event</button>
                        </div>
                    </div>
                </div>
            @endfor

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