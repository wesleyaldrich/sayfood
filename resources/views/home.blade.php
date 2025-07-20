@extends('layout.app')
@section('title', 'Home Page')
@section('content')

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
    $slides = [
        [
            'image' => 'https://images.unsplash.com/photo-1551504734-5ee1c4a1479b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
            'title' => 'RENDANG FOR PALEMBANG',
            'author' => 'by Willie Salim',
            'description' => 'Rendang for Palembang was a heartwarming donation event where we shared hundreds of portions of delicious rendang with communities in need across Palembang. With the help of amazing volunteers and local restaurants.',
            'items' => [
                ['icon' => 'map-marker-alt', 'text' => 'Kebun Bunga, Palembang'],
                ['icon' => 'calendar-alt', 'text' => 'Senin, 32 Desember 1990'], // Note: December only has 31 days
                ['icon' => 'user-friends', 'text' => '1,045 participants'],
                ['icon' => 'clock', 'text' => '12 Hours']
            ]
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
            'title' => 'COMMUNITY OUTREACH',
            'author' => 'by Volunteer Team',
            'description' => 'Our team visited 15 neighborhoods in Palembang, distributing food and essential supplies to families affected by the recent floods. The community response was overwhelmingly positive.',
            'items' => [
                ['icon' => 'map-marker-alt', 'text' => '15 neighborhoods reached'],
                ['icon' => 'calendar-alt', 'text' => 'Senin, 32 Desember 1990'], // Note: December only has 31 days
                ['icon' => 'user-friends', 'text' => '1,045 participants'],
                ['icon' => 'clock', 'text' => '12 Hours']
            ]
        ]
    ];
?>
<div class="container-fluid">
    {{-- BAGIAN HERO SECTION --}}
    <div class="row gx-5">
        {{-- disini coding sebelah kiri --}}
        <div class="col-8">
            <div class="home-header">
                <h1 class="oswald">WELCOME TO</h1>
                <h1 class="oswald">
                    <span style="color: #FEA322;">SAY</span>FOOD
                </h1>
                <p class="lato-bold-italic">Good food, better cause.</p>
                <p class="lato-regular">Get affordable rescued meals and fight food waste!</p>
                <p class="lato-regular">Join us as a volunteer to share meals and share kindness.</p>
                <div class="link-button-home">
                    <a href="{{ route('foods') }}" class="oswald btn btn-custom-menu rounded-pill btn-lg">SEE MENUS</a>
                    <a href="{{ route('events') }}" class="oswald btn btn-custom-join rounded-pill btn-lg">JOIN EVENT</a>
                </div>
            </div>
        </div>
        {{-- disini coding sebelah kanan --}}
        <div class="col-4">
            <img src="{{ asset('assets/Hero_Section_Photo.png') }}" class="img-fluid home-hero">
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-3">
        <div class="d-flex align-items-center dibawah_hero">
            <img src="{{ asset('assets/Dibawah_Hero.png') }}" style="width: 50px; height: auto; margin-right: 20px;">
            <div>
                {{-- <h3>Judul Tulisan</h3> --}}
                <p class="oswald tulisan_tengah text-4xl font-bold">DISCOVER TOP PICKS AND TASTY BITES!</p>
            </div>
        </div>
    </div>
</div>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#234B4B" fill-opacity="1" d="M0,96L40,112C80,128,160,160,240,176C320,192,400,192,480,181.3C560,171,640,149,720,144C800,139,880,149,960,160C1040,171,1120,181,1200,186.7C1280,192,1360,192,1400,192L1440,192L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
<div class="carousel-container">
        <p class="text-5xl font-medium text-white mb-[75px] text-center oswald antialiased">BEST RESTAURANT</p>

        <div class="carousel-track-container">
            <div class="carousel-track" id="carouselTrack">
                @if (count($allProducts) > 0)
                    @foreach ($allProducts as $index => $product)
                        <div class="carousel-item-wrapper">
                            <div class="card-frame">
                                <div class="card-content">
                                    <img src="{{ $product['image'] }}"
                                         alt="{{ $product['title'] }}"
                                         class="card-img-top">
                                        <div class="card-body-content">
                                            <div class="title-rating-group">
                                                <h5 class="card-title-text oswald">{{ $product['title'] }}</h5>
                                                <div class="rating-stars">
                                                    <i class="fas fa-star"></i>
                                                    <p class="font-bold oswald">{{ $product['rating'] }}</p>
                                                </div>
                                            </div>
                                            <p class="cuisine-tags-text lato-regular">{{ $product['description'] }}</p>
                                        </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center w-full">No products to display.</p>
                @endif
            </div>

            @if (count($products) > 0)
                <button class="carousel-nav-btn left" id="prevBtn">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="carousel-nav-btn right" id="nextBtn">
                    <i class="fas fa-chevron-right"></i>
                </button>
            @endif
        </div>

        @if (count($products) > 0)
            <div class="slider-range-track" id="sliderTrack">
                <div class="slider-range-thumb-wrapper">
                    <div class="slider-range-thumb" id="sliderThumb"></div>
                </div>
            </div>
        @endif
    </div>
<div class="food-categories-container">
    <p class="text-5xl font-medium text-white mb-[75px] text-center oswald antialiased">FOOD CATEGORIES</p>
    <div class="container mx-auto px-2">
        <div class="flex flex-wrap justify-center -mx-1"> 
            
            <!-- Circle 1 -->
            <a href="#" class="w-1/2 sm:w-auto px-4 mb-8 sm:mb-0">
                <div class="relative group">
                    <div class="custom-circle rounded-full shadow-sm overflow-hidden flex flex-col items-center justify-between transition-all duration-150 group-hover:shadow group-hover:-translate-y-0.5 h-full">
                        <div class="flex-grow flex items-center justify-center p-2">
                            <img src="{{ asset('assets/Main_Courses.png') }}" 
                            class="max-h-full max-w-full object-contain">
                        </div>
                        <div class="w-full flex-shrink-0 p-1 text-center mb-3">
                            <h3 class="text-base font-medium text-[#234C4C] oswald">Main Courses</h3>
                        </div>
                    </div>
                    <div class="absolute -bottom-0.5 left-1/2 transform -translate-x-1/2 w-16 h-0.5 bg-black opacity-10 blur rounded-full group-hover:opacity-15 transition-all duration-150"></div>
                </div>
            </a>
                
            <!-- Circle 2 -->
            <a href="#" class="w-1/2 sm:w-auto px-4 mb-8 sm:mb-0">
                <div class="relative group">
                    <div class="custom-circle rounded-full shadow-sm overflow-hidden flex flex-col items-center justify-between transition-all duration-150 group-hover:shadow group-hover:-translate-y-0.5 h-full">
                        <div class="flex-grow flex items-center justify-center p-2">
                            <img src="{{ asset('assets/Desserts.png') }}" 
                            class="max-h-full max-w-full object-contain">
                        </div>
                        <div class="w-full flex-shrink-0 p-1 text-center mb-3">
                            <h3 class="text-base font-medium text-[#234C4C] oswald">Desserts</h3>
                        </div>
                    </div>
                    <div class="absolute -bottom-0.5 left-1/2 transform -translate-x-1/2 w-16 h-0.5 bg-black opacity-10 blur rounded-full group-hover:opacity-15 transition-all duration-150"></div>
                </div>
            </a>
            
            <!-- Circle 3 -->
            <a href="#" class="w-1/2 sm:w-auto px-4">
                <div class="relative group">
                    <div class="custom-circle rounded-full shadow-sm overflow-hidden flex flex-col items-center justify-between transition-all duration-150 group-hover:shadow group-hover:-translate-y-0.5 h-full">
                        <div class="flex-grow flex items-center justify-center p-2">
                            <img src="{{ asset('assets/Snacks.png') }}" 
                            class="max-h-full max-w-full object-contain">
                        </div>
                        <div class="w-full flex-shrink-0 p-1 text-center mb-3">
                            <h3 class="text-base font-medium text-[#234C4C] oswald">Snacks</h3>
                        </div>
                    </div>
                    <div class="absolute -bottom-0.5 left-1/2 transform -translate-x-1/2 w-16 h-0.5 bg-black opacity-10 blur rounded-full group-hover:opacity-15 transition-all duration-150"></div>
                </div>
            </a>
            
            <!-- Circle 4 -->
            <a href="#" class="w-1/2 sm:w-auto px-4">
                <div class="relative group">
                    <div class="custom-circle rounded-full shadow-sm overflow-hidden flex flex-col items-center justify-between transition-all duration-150 group-hover:shadow group-hover:-translate-y-0.5 h-full">
                        <div class="flex-grow flex items-center justify-center p-2">
                            <img src="{{ asset('assets/Drinks.png') }}" 
                            class="max-h-full max-w-full object-contain">
                        </div>
                        <div class="w-full flex-shrink-0 p-1 text-center mb-3">
                            <h3 class="text-base font-medium text-[#234C4C] oswald">Drinks</h3>
                        </div>
                    </div>
                    <div class="absolute -bottom-0.5 left-1/2 transform -translate-x-1/2 w-16 h-0.5 bg-black opacity-10 blur rounded-full group-hover:opacity-15 transition-all duration-150"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#234B4B" fill-opacity="1" d="M0,128L48,144C96,160,192,192,288,181.3C384,171,480,117,576,122.7C672,128,768,192,864,234.7C960,277,1056,299,1152,282.7C1248,267,1344,213,1392,186.7L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
<div class="container flex items-center">
    <p class="oswald text-4xl font-bold mr-4">TOP ON GOING EVENTS!</p>   
    <img src="{{ asset('assets/on_going.png') }}" class="w-32 h-auto">
</div>
<div class="on_going_event text-center container-fluid">
        <div class="cards-container">
        @foreach ($events as $event)
        <div class="event-card m-5" 
             data-event-title="{{ $event['title'] }}"
             data-event-host="{{ $event['host'] }}"
             data-event-location="{{ $event['location'] }}">
            <?php if (isset($event['badge'])): ?>
                <div class="event-badge badge-<?php echo strtolower($event['badge_color']); ?>">
                    <?= $event['badge'] ?>
                </div>
            <?php endif; ?>
            <div class="image-container">
                <img src="<?= $event['image'] ?>" alt="<?= $event['title'] ?>" class="event-image">
                <div class="image-content">
                     <div class="shape-container">
                        <div class="circle">
                            <div class="circle-content">
                                <img src="{{ asset('assets/participant_logo.png') }}" alt="Logo">
                                    <div class="circle-text-participants circle-text number oswald"><?= $event['participants'] ?></div>
                            </div>
                        </div>
                        <div class="rectangle">
                            <div class="row">
                                <div class="col">
                                    <div class="title_font">
                                        <p class="oswald title_font_os"><?= $event['title'] ?></p>
                                    </div>
                                    <div class="host_font">
                                        <p class="lato-light-italic host_font_os"><?= $event['host'] ?></p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="loc_date-group">
                                        <div class="row-group">
                                            <i class="fas fa-map-marker-alt icon"></i>
                                            <p class="location_font lato-regular font-weight-bold"><?= $event['location'] ?></p>
                                        </div>
                                        <div class="row-group">
                                            <i class="far fa-calendar-alt icon"></i>
                                            <p class="date_font lato-regular font-weight-bold"><?= $event['date'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endforeach
            </div>
            <div class="py-5">
                <a href="#" class="underline text-2xl underline-class hover:text-white-600 hover:underline lato-regular">SEE MORE</a>
            </div>
        </div>
        <div class="modal container-fluid" id="joinFormModal">
            <div class="modal-content">
                <button class="close-btn" id="closeModal" aria-label="Close"></button>
                <div class="modal-header">
                    <h2>Join Event - <span id="modalEventTitle"></span></h2>
                    <p class="lato-light-italic" id="modalEventHost"></p>
                    <p class="lato-regular" id="modalEventLocation"></p>
                </div>
                <form id="joinForm">
                    <div class="form-row text-start">
                        <div class="form-group">
                            <label class="text-[#234C4C]" for="firstName">First Name</label>
                            <input class="input-fn" type="text" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label class="text-[#234C4C]" for="lastName">Last Name</label>
                            <input class="input-fn" type="text" id="lastName" name="lastName" required>
                        </div>
                    </div>
                    <div class="form-row text-start">
                            <div class="form-group">
                                <label class="text-[#234C4C]" for="phoneNumber">Phone Number</label>
                                <input class="input-fn" type="tel" id="phoneNumber" name="phoneNumber" required
                                    pattern="[0-9]{10,15}" 
                                    title="Please enter only numbers (10-15 digits)">
                                <div id="phoneError" class="error-message">Please enter a valid phone number (only numbers, 10-15 digits)</div>
                            </div>
                            <div class="form-group">
                                <label class="text-[#234C4C]" for="age">Age</label>
                                <input class="input-fn" type="number" id="age" name="age" required min="12" max="120">
                            </div>
                    </div>
                    <div class="form-group text-start">
                        <label class="text-[#234C4C]" wfor="address">Address</label>
                        <input class="input-fn" type="text" id="address" name="address" required>
                    </div>
                    <button type="submit" class="submit-btn">Submit Form</button>
                </form>
            </div>
        </div>
        <div class="container-fluid text-center">
        <div class="row">
            <div class="col photo_kiri_carousel_event">
                <img src="{{ asset('assets/photo_carousel_event.png') }}" class="w-75 h-auto img-fluid mt-3 mx-auto d-block">
            </div>
            <div class="col carousel_kanan">
                {{-- ini diawal --}}
                <div class="share_moment-carousel-container my-5 pl-3 shadow">
                    <div class="share_moment-nav-buttons-container">
                        <button class="share_moment-nav-btn nav-btn" id="prevBtn_shamo"><i class="fas fa-chevron-left"></i></button>
                        <button class="share_moment-nav-btn nav-btn" id="nextBtn_shamo"><i class="fas fa-chevron-right"></i></button>
                    </div>

                    <div class="share_moment-carousel-slides" id="slides">
                        <?php foreach ($slides as $index => $slideData): ?>
                        <div class="share_moment-slide">
                            <div class="share_moment-slide-heading-content">
                                <h2 class="share_moment-slide-title"><?php echo htmlspecialchars($slideData['title']); ?></h2>
                                <div class="share_moment-slide-subtitle"><?php echo htmlspecialchars($slideData['author']); ?></div>
                            </div>
                            
                            <div class="share_moment-slide-body-area">
                                <div class="share_moment-slide-image" style="background-image: url('<?php echo htmlspecialchars($slideData['image']); ?>');"></div>
                                <div class="share_moment-slide-details-content">
                                    <p class="share_moment-slide-description">
                                        <?php echo htmlspecialchars($slideData['description']); ?>
                                    </p>
                                    <div class="share_moment-checklist-container">
                                        <div class="share_moment-checklist-column">
                                            <ul class="share_moment-checklist">
                                                <?php foreach (array_slice($slideData['items'], 0, 2) as $item): ?>
                                                <li class="share_moment-checklist-item">
                                                    <span class="share_moment-item-icon">
                                                        <i class="fas fa-<?php echo htmlspecialchars($item['icon']); ?>"></i>
                                                    </span>
                                                    <span class="share_moment-item-text"><?php echo htmlspecialchars($item['text']); ?></span>
                                                </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <div class="share_moment-checklist-column">
                                            <ul class="share_moment-checklist">
                                                <?php foreach (array_slice($slideData['items'], 2, 2) as $item): ?>
                                                <li class="share_moment-checklist-item">
                                                    <span class="share_moment-item-icon">
                                                        <i class="fas fa-<?php echo htmlspecialchars($item['icon']); ?>"></i>
                                                    </span>
                                                    <span class="share_moment-item-text"><?php echo htmlspecialchars($item['text']); ?></span>
                                                </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="share_moment-carousel-indicators" id="indicators">
                        <?php foreach ($slides as $index => $slideData): ?>
                        <div class="share_moment-indicator<?php echo $index === 0 ? ' share_moment-active' : ''; ?>" data-index="<?php echo $index; ?>"></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                {{-- ini diakhir --}}
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Clamp.js/0.5.1/clamp.min.js"></script>
@endpush
