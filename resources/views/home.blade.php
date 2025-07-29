@extends('layout.app')
@section('title', 'Home Page')
@section('content')
    <div class="container-fluid">
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

        {{-- BAGIAN HERO SECTION --}}
        <div class="row gx-5">
            {{-- disini coding sebelah kiri --}}
            <div class="col-8">
                <div class="home-header">
                    <h1 class="oswald">{{ __('home.welcome_to') }}</h1>
                    <h1 class="oswald">
                        <span style="color: #FEA322;">SAY</span>FOOD
                    </h1>
                    <p class="lato-bold-italic">{{ __('home.welcome1') }}</p>
                    <p class="lato-regular">{{ __('home.welcome2') }}</p>
                    <p class="lato-regular">{{ __('home.welcome3') }}</p>
                    <div class="link-button-home">
                        <a href="{{ route('foods') }}"
                            class="oswald btn btn-custom-menu rounded-pill btn-lg">{{ __('home.see_menus') }}</a>
                        <a href="{{ route('events') }}"
                            class="oswald btn btn-custom-join rounded-pill btn-lg">{{ __('home.join_event') }}</a>
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
                    <p class="oswald tulisan_tengah text-4xl font-bold">{{ __('home.discover') }}</p>
                </div>
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#234B4B" fill-opacity="1"
            d="M0,96L40,112C80,128,160,160,240,176C320,192,400,192,480,181.3C560,171,640,149,720,144C800,139,880,149,960,160C1040,171,1120,181,1200,186.7C1280,192,1360,192,1400,192L1440,192L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
        </path>
    </svg>
    <div class="carousel-container">
        <p class="text-5xl font-medium text-white mb-[75px] text-center oswald antialiased">
            {{ __('home.best_restaurant') }}</p>

        <div class="carousel-track-container">
            <div class="carousel-track" id="carouselTrack">
                @foreach ($restaurants->take(7) as $resto)
                    <a href="{{ route('resto.show', $resto['id']) }}">
                        <div class="carousel-item-wrapper">
                            <div class="card-frame">
                                <div class="card-content">
                                    <img src="{{ $resto['image_url_resto'] }}" alt="{{ $resto['name'] }}"
                                        class="card-img-top">
                                    <div class="card-body-content">
                                        <div class="title-rating-group">
                                            <h5 class="card-title-text oswald">{{ $resto['name'] }}</h5>
                                            <div class="rating-stars">
                                                <i class="fas fa-star"></i>
                                                <p class="font-bold oswald">
                                                    @if ($resto->avg_rating !== null)
                                                        {{ number_format((float) $resto->avg_rating, 1, '.', '') }}
                                                    @else
                                                        No Rating
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <p class="cuisine-tags-text lato-regular truncate-text">{{ $resto['description'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <button class="carousel-nav-btn left" id="prevBtn">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="carousel-nav-btn right" id="nextBtn">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Slider bar & thumb -->
            <div id="sliderTrack" class="slider-bar">
                <div id="sliderThumb" class="slider-thumb"></div>
            </div>
        </div>
    </div>
    <div class="food-categories-container">
        <p class="text-5xl font-medium text-white mb-[75px] text-center oswald antialiased">
            {{ __('home.food_categories') }}</p>
        <div class="container mx-auto px-2">
            <div class="flex flex-wrap justify-center -mx-1">

                <!-- Circle 1 -->
                <a href="{{ route('foods') }}#main-course" class="w-1/2 sm:w-auto px-4 mb-8 sm:mb-0">
                    <div class="relative group">
                        <div
                            class="custom-circle rounded-full shadow-sm overflow-hidden flex flex-col items-center justify-between transition-all duration-150 group-hover:shadow group-hover:-translate-y-0.5 h-full">
                            <div class="flex-grow flex items-center justify-center p-2">
                                <img src="{{ asset('assets/Main_Courses.png') }}"
                                    class="max-h-full max-w-full object-contain">
                            </div>
                            <div class="w-full flex-shrink-0 p-1 text-center mb-3">
                                <h3 class="text-base font-medium text-[#234C4C] oswald">{{ __('home.main_courses') }}</h3>
                            </div>
                        </div>
                        <div
                            class="absolute -bottom-0.5 left-1/2 transform -translate-x-1/2 w-16 h-0.5 bg-black opacity-10 blur rounded-full group-hover:opacity-15 transition-all duration-150">
                        </div>
                    </div>
                </a>

                <!-- Circle 2 -->
                <a href="{{ route('foods') }}#desserts" class="w-1/2 sm:w-auto px-4 mb-8 sm:mb-0">
                    <div class="relative group">
                        <div
                            class="custom-circle rounded-full shadow-sm overflow-hidden flex flex-col items-center justify-between transition-all duration-150 group-hover:shadow group-hover:-translate-y-0.5 h-full">
                            <div class="flex-grow flex items-center justify-center p-2">
                                <img src="{{ asset('assets/Desserts.png') }}" class="max-h-full max-w-full object-contain">
                            </div>
                            <div class="w-full flex-shrink-0 p-1 text-center mb-3">
                                <h3 class="text-base font-medium text-[#234C4C] oswald">{{ __('home.desserts') }}</h3>
                            </div>
                        </div>
                        <div
                            class="absolute -bottom-0.5 left-1/2 transform -translate-x-1/2 w-16 h-0.5 bg-black opacity-10 blur rounded-full group-hover:opacity-15 transition-all duration-150">
                        </div>
                    </div>
                </a>

                <!-- Circle 3 -->
                <a href="{{ route('foods') }}#snacks" class="w-1/2 sm:w-auto px-4">
                    <div class="relative group">
                        <div
                            class="custom-circle rounded-full shadow-sm overflow-hidden flex flex-col items-center justify-between transition-all duration-150 group-hover:shadow group-hover:-translate-y-0.5 h-full">
                            <div class="flex-grow flex items-center justify-center p-2">
                                <img src="{{ asset('assets/Snacks.png') }}" class="max-h-full max-w-full object-contain">
                            </div>
                            <div class="w-full flex-shrink-0 p-1 text-center mb-3">
                                <h3 class="text-base font-medium text-[#234C4C] oswald">{{ __('home.snacks') }}</h3>
                            </div>
                        </div>
                        <div
                            class="absolute -bottom-0.5 left-1/2 transform -translate-x-1/2 w-16 h-0.5 bg-black opacity-10 blur rounded-full group-hover:opacity-15 transition-all duration-150">
                        </div>
                    </div>
                </a>

                <!-- Circle 4 -->
                <a href="{{ route('foods') }}#drinks" class="w-1/2 sm:w-auto px-4">
                    <div class="relative group">
                        <div
                            class="custom-circle rounded-full shadow-sm overflow-hidden flex flex-col items-center justify-between transition-all duration-150 group-hover:shadow group-hover:-translate-y-0.5 h-full">
                            <div class="flex-grow flex items-center justify-center p-2">
                                <img src="{{ asset('assets/Drinks.png') }}" class="max-h-full max-w-full object-contain">
                            </div>
                            <div class="w-full flex-shrink-0 p-1 text-center mb-3">
                                <h3 class="text-base font-medium text-[#234C4C] oswald">{{ __('home.drinks') }}</h3>
                            </div>
                        </div>
                        <div
                            class="absolute -bottom-0.5 left-1/2 transform -translate-x-1/2 w-16 h-0.5 bg-black opacity-10 blur rounded-full group-hover:opacity-15 transition-all duration-150">
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#234B4B" fill-opacity="1"
            d="M0,128L48,144C96,160,192,192,288,181.3C384,171,480,117,576,122.7C672,128,768,192,864,234.7C960,277,1056,299,1152,282.7C1248,267,1344,213,1392,186.7L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
        </path>
    </svg>
    <div class="container flex items-center">
        <p class="oswald text-4xl font-bold mr-4">{{ __('home.top_events') }}</p>
        <img src="{{ asset('assets/on_going.png') }}" class="w-32 h-auto">
    </div>
    <div class="on_going_event text-center container-fluid">
        <div class="cards-container">
            @foreach ($finalEvents as $event)
                <div class="event-card m-5" data-bs-toggle="modal" data-bs-target="#joinFormModal"
                    data-event-id="{{ $event['id'] }}" data-event-title="{{ $event['name'] }}"
                    data-event-host="{{ $event['host'] }}" data-event-location="{{ $event['location'] }}"
                    data-event-date="{{ $event['date'] }}">
                    @if (isset($event['badge']))
                        <div class="event-badge badge-{{ strtolower($event['badge_color']) }}">
                            {{ $event['badge'] }}
                        </div>
                    @endif
                    <div class="image-container">
                        <img src="{{ asset('storage/' . $event['image_url']) }}" alt="{{ $event['name'] }}"
                            class="event-image">
                        <div class="image-content">
                            <div class="shape-container">
                                <div class="circle">
                                    <div class="circle-content">
                                        <img src="{{ asset('assets/participant_logo.png') }}" alt="Logo">
                                        <div class="circle-text-participants circle-text number oswald">
                                            {{ $event['participants'] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="rectangle">
                                    <div class="row">
                                        <div class="col">
                                            <div class="title_font">
                                                <p class="oswald title_font_os">{{ $event['name'] }}</p>
                                            </div>
                                            <div class="host_font">
                                                <p class="lato-light-italic host_font_os">{{ $event['host'] }}</p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="loc_date-group">
                                                <div class="row-group">
                                                    <i class="fas fa-map-marker-alt icon"></i>
                                                    <p class="location_font lato-regular font-weight-bold">
                                                        {{ $event['location'] }}
                                                    </p>
                                                </div>
                                                <div class="row-group">
                                                    <i class="far fa-calendar-alt icon"></i>
                                                    <p class="date_font lato-regular font-weight-bold">
                                                        {{ $event['date'] }}
                                                    </p>
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
            <a href="{{ route('events') }}"
                class="underline text-2xl underline-class hover:text-white-600 hover:underline lato-regular">
                {{ __('home.see_more') }}
            </a>
        </div>
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="joinFormModal" tabindex="-1" aria-labelledby="joinEventLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <p class="modal-title text-xl text-[#234C4C] font-bold" id="joinEventLabel">
                        {{ __('home.join_event2') }} <span id="modalEventTitle" class="text-xl"></span>
                    </p>
                </div>

                <div class="modal-body">
                    <label class="form-label text-[#234C4C] text-xl">{{ __('home.host') }}</label>
                    <p class="lato-light-italic" id="modalEventHost"></p>
                    <label class="form-label text-[#234C4C] text-xl">{{ __('home.location') }}</label>
                    <p class="lato-regular" id="modalEventLocation"></p>
                    <label class="form-label text-[#234C4C] text-xl">{{ __('home.date') }}</label>
                    <p class="lato-regular" id="modalEventDate"></p>
                    <!-- Form Join -->
                    <form method="POST" action="{{ route('event.join') }}">
                        @csrf
                        <input type="hidden" name="event_id" id="eventId">

                        <div class="mb-3">
                            <label for="phoneNumber"
                                class="form-label text-[#234C4C] text-xl">{{ __('home.phone_number') }}</label>
                            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber"
                                value="{{ old('phoneNumber') }}">
                            @error('phoneNumber')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            {{ __('home.submit_form') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col photo_kiri_carousel_event">
                <img src="{{ asset('assets/photo_carousel_event.png') }}"
                    class="w-75 h-auto img-fluid mt-3 mx-auto d-block">
            </div>
            <div class="col carousel_kanan">
                {{-- ini diawal --}}
                <div class="share_moments-wrapper my-5">
                    <!-- Navigation buttons -->
                    <button class="carousel-nav left" onclick="prevSlide()"><i
                            class="fa-solid fa-chevron-left"></i></button>
                    <button class="carousel-nav right" onclick="nextSlide()"><i
                            class="fa-solid fa-chevron-right"></i></button>

                    <!-- Slides -->
                    @foreach ($slides as $index => $slide)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="carousel-header">{{ $slide['title'] }}</div>
                            <div class="carousel-sub">{{ __('home.by') }} {{ $slide['author'] }}</div>
                            <div class="carousel-body">
                                <img src="{{ asset('storage/' . $slide['image']) }}" alt="{{ $slide['title'] }}">
                                <div class="carousel-text" id="text-{{ $index }}">
                                    <div class="desc">{{ $slide['description'] }}</div>
                                    <div class="carousel-info">
                                        <div class='loc'><i class="fa-solid fa-location-dot"></i>
                                            {{ Str::limit($slide['location'], 23, '...') }}</div>
                                        <div><i class="fa-solid fa-user"></i> {{ $slide['people'] }}</div>
                                        <div><i class="fa-solid fa-calendar"></i> {{ $slide['date'] }}</div>
                                        <div><i class="fa-solid fa-clock"></i> {{ $slide['duration'] }}
                                            {{ __('home.hours') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Carousel dots -->
                    <div class="carousel-dots">
                        @foreach ($slides as $index => $slide)
                            <span class="{{ $index === 0 ? 'active' : '' }}"
                                onclick="setSlide({{ $index }})"></span>
                        @endforeach
                    </div>
                </div>
                {{-- ini diakhir --}}
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Clamp.js/0.5.1/clamp.min.js"></script>
@endpush
