@extends('layout.app')
@section('title', 'Restaurant Menu Page')
@section('content')

<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('report.store') }}" method="POST" class="modal-content p-4 shadow rounded position-relative">
            @csrf

            <!-- Hidden Inputs -->
            <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

            <!-- Tombol Close Kustom -->
            <button type="button" onclick="closePopup()" style="background: none; border: none; position: absolute; top: 10px; right: 10px;">
                <img src="{{ asset('assets/btn_exit.png') }}" alt="exit-button" style="width: 35px; height: 35px;">
            </button>

            <div class="modal-body text-center mt-4">
                <h1 class="fw-bold mb-3" style="font-size: 28px;">Report Restaurant</h1>

                <p class="mb-3">Why do you want to report this restaurant?</p>

                <!-- Pilihan alasan -->
                <div id="report-options" class="d-grid gap-2 mb-3">
                    <button type="button" class="btn btn-light border option-btn"
                        onclick="selectOption(this, 'They sell expired foods')">They sell expired foods</button>
                    <button type="button" class="btn btn-light border option-btn"
                        onclick="selectOption(this, 'This resto is a scam')">This resto is a scam</button>
                    <button type="button" class="btn btn-light border option-btn"
                        onclick="selectOption(this, 'Bad hygiene')">Bad hygiene</button>
                </div>

                <!-- Textarea untuk others -->
                <div class="form-group mb-3">
                    <label class="fw-semibold">Others:</label>
                    <textarea name="description" class="form-control" placeholder="Write something..." rows="3"></textarea>
                </div>

                <input type="hidden" name="selected_reason" id="selectedReasonInput">

                <button type="submit" class="btn btn-success rounded-pill px-5 py-1" style="background-color: #1d4d4f;">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

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

    <!-- Tombol Report -->
    <button class="report-resto" data-bs-toggle="modal" data-bs-target="#reportModal">
        <img src="{{ asset('assets/reportResto-btn.png') }}" alt="reportResto_btn">
    </button>
    

    </div>
    <div class="menu-tab-bar">  
        <div class="tab" data-category="maincourse"><p class="oswald">{{ __('foods.main_courses') }}</p></div>
        <div class="tab" data-category="drinks"><p class="oswald">{{ __('foods.drinks') }}</p></div>
        <div class="tab" data-category="desserts"><p class="oswald">{{ __('foods.desserts') }}</p></div>
        <div class="tab" data-category="snacks"><p class="oswald">{{ __('foods.snacks') }}</p></div>
    </div>

    
    <div class="container my-4">
    {{-- Main Course --}}
    <div class="row g-4 menu-content" data-category="maincourse">
        @foreach($mainCourses as $i)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 d-flex justify-content-center">
            <x-restaurant-menu-food-item
                :image="$i->image_url"
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
                :image="$i->image_url"
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
                :image="$i->image_url"
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
                :image="$i->image_url"
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