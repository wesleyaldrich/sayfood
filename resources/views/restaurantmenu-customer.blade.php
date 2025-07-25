@extends('layout.app')
@section('title', 'Restaurant Menu Page')
@section('content')

<div class="hero-container">
        <img src="{{ asset($restaurant->image_url_resto) }}" class="hero-img" alt="">
        
        <!-- Back Icon -->
        <a href="{{ route('foods') }}" class="back-icon">
            <i class="fas fa-chevron-left"></i>
        </a>
        <!-- Dark overlay over image -->
        <div class="overlay"></div>
        
        <!-- Text sits above the overlay -->
        <div class="overlay-content">
            <h2 class="restaurant-title">{{ $restaurant->name }}</h2>
            <div class="location-badge">
                <i class="fas fa-map-marker-alt"></i>
                <span>{{ $restaurant->address }}</span>
            </div>
        </div>

        <!-- Report Resto Button -->
<!-- Report Resto Button -->
        <button class="report-resto" onclick="reportRestoPopup()">
            <img src="{{ asset('assets/reportResto-btn.png') }}" alt="reportResto_btn">
        </button>

    </div>
    <div class="menu-tab-bar">  
        <div class="tab active-tab" data-category="maincourse"><p class="oswald">{{ __('foods.main_courses') }}</p></div>
        <div class="tab" data-category="drinks"><p class="oswald">{{ __('foods.drinks') }}</p></div>
        <div class="tab" data-category="desserts"><p class="oswald">{{ __('foods.desserts') }}</p></div>
        <div class="tab" data-category="snacks"><p class="oswald">{{ __('foods.snacks') }}</p></div>
    </div>

    
    <div class="container my-4">
    {{-- Main Course --}}
    <div class="row g-4 menu-content" data-category="maincourse">
        @foreach($mainCourses as $i)
        <div class="col-12 col-xl-3 d-flex justify-content-center">
            <x-restaurant-menu-food-item
                :id="$i->id"
                :image="$i->image_url"
                :restoName="$restaurant->name"
                :title="$i->name"
                :description="$i->description"
                :expiry="$i->exp_datetime->format('d/m h:i A')"
                :stock="$i->stock"
                :price="'IDR ' . number_format($i->price, 0, ',', '.')"
            />
        </div>
        @endforeach
    </div>

    {{-- Beverages --}}
    <div class="row g-4 menu-content" data-category="drinks">
        @foreach($drinks as $i)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 d-flex justify-content-center">
            <x-restaurant-menu-food-item
                :id="$i->id"
                :image="$i->image_url"
                :restoName="$restaurant->name"
                :title="$i->name"
                :description="$i->description"
                :expiry="$i->exp_datetime->format('d/m h:i A')"
                :stock="$i->stock"
                :price="'IDR ' . number_format($i->price, 0, ',', '.')"
            />
        </div>
        @endforeach
    </div>

    {{-- Desserts --}}
    <div class="row g-4 menu-content" data-category="desserts">
        @foreach($desserts as $i)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 d-flex justify-content-center">
            <x-restaurant-menu-food-item
                :id="$i->id"
                :image="$i->image_url"
                :restoName="$restaurant->name"
                :title="$i->name"
                :description="$i->description"
                :expiry="$i->exp_datetime->format('d/m h:i A')"
                :stock="$i->stock"
                :price="'IDR ' . number_format($i->price, 0, ',', '.')"
            />
        </div>
        @endforeach
    </div>

    {{-- Snacks --}}
    <div class="row g-4 menu-content" data-category="snacks">
        @foreach($snacks as $i)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 d-flex justify-content-center">
            <x-restaurant-menu-food-item
                :id="$i->id"
                :image="$i->image_url"
                :restoName="$restaurant->name"
                :title="$i->name"
                :description="$i->description"
                :expiry="$i->exp_datetime->format('d/m h:i A')"
                :stock="$i->stock"
                :price="'IDR ' . number_format($i->price, 0, ',', '.')"
            />
        </div>
        @endforeach
        </div>
    </div>

    <br>
    <br>
</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/restaurantmenu-customer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@push('scripts')
    <script src="{{ asset('js/restaurantmenu-customer.js') }}"></script>
@endpush