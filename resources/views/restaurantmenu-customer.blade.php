@extends('layout.app')
@section('title', 'Restaurant Menu Page')
@section('content')

    <div class="hero-container">


        <img src=" {{ asset($restaurant->image_url_resto) }}" class="hero-img" alt="">

        <!-- Back Icon -->
        <a href="{{ route('foods')}}" class="back-icon">
            <i class="fas fa-chevron-left"></i>
        </a>
        <!-- Dark overlay over image -->
        <div class="overlay"></div>

        <!-- Text sits above the overlay -->
        <div class="overlay-content">
            <h2 class="restaurant-title">{{ $restaurant->name }}</h2>
            <div class="location-badge">
                <i class=" fas fa-map-marker-alt"></i>
                <span>{{ $restaurant->address }}</span>
            </div>
        </div>

        <!-- Tombol Report -->
        <button class="report-resto" data-bs-toggle="modal" data-bs-target="#reportModal">
            <img src="{{ asset('assets/reportResto-btn.png') }}" alt="reportResto_btn">
        </button>


    </div>
    <div class="menu-tab-bar">
        <div class="tab active-tab" data-category="maincourse">
            <p class="oswald">{{ __('foods.main_courses') }}</p>
        </div>
        <div class="tab" data-category="drinks">
            <p class="oswald">{{ __('foods.drinks') }}</p>
        </div>
        <div class="tab" data-category="desserts">
            <p class="oswald">{{ __('foods.desserts') }}</p>
        </div>
        <div class="tab" data-category="snacks">
            <p class="oswald">{{ __('foods.snacks') }}</p>
        </div>
    </div>


    <div class="container my-4">
        {{-- Main Course --}}
        <div class="row g-4 menu-content" data-category="maincourse">
            @foreach($mainCourses as $i)
                <div class=" col-12 col-xl-3 d-flex justify-content-center">
                    <x-restaurant-menu-food-item :id="$i->id" :image="$i->image_url" :restoName="$restaurant->name"
                        :title="$i->name" :description="$i->description" :expiry="$i->exp_datetime->format('d/m h:i A')"
                        :stock="$i->stock" :price="'IDR ' . number_format($i->price, 0, ',', '.')" />
                </div>
            @endforeach
        </div> {{-- Beverages --}} <div class="row g-4 menu-content" data-category="drinks">
            @foreach($drinks as $i)
                <div class=" col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 d-flex justify-content-center">
                    <x-restaurant-menu-food-item :id="$i->id" :image="$i->image_url" :restoName="$restaurant->name"
                        :title="$i->name" :description="$i->description" :expiry="$i->exp_datetime->format('d/m h:i A')"
                        :stock="$i->stock" :price="'IDR ' . number_format($i->price, 0, ',', '.')" />
                </div>
            @endforeach
        </div> {{-- Desserts --}} <div class="row g-4 menu-content" data-category="desserts">
            @foreach($desserts as $i)
                <div class=" col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 d-flex justify-content-center">
                    <x-restaurant-menu-food-item :id="$i->id" :image="$i->image_url" :restoName="$restaurant->name"
                        :title="$i->name" :description="$i->description" :expiry="$i->exp_datetime->format('d/m h:i A')"
                        :stock="$i->stock" :price="'IDR ' . number_format($i->price, 0, ',', '.')" />
                </div>
            @endforeach
        </div>

        {{-- Snacks --}}
        <div class="row g-4 menu-content" data-category="snacks">
            @foreach($snacks as $i)

                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 d-flex justify-content-center">
                    <x-restaurant-menu-food-item :id="$i->id" :image="$i->image_url" :restoName="$restaurant->name"
                        :title="$i->name" :description="$i->description" :expiry="$i->exp_datetime->format('d/m h:i A')"
                        :stock="$i->stock" :price="'IDR ' . number_format($i->price, 0, ',', '.')" />
                </div>
            @endforeach
        </div>
    </div>

    <br>
    <br>
    </div>

     <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('report.store') }}" method="POST" class="modal-content p-4 shadow position-relative"
                style="border-radius: 15px !important;">
                @csrf

                <div class="modal-header border-0 d-flex justify-content-end">
                    <button type="button" class="btn p-0 ms-auto" data-bs-dismiss="modal" aria-label="Close"
                        style="background: red; border-radius: 50px; width: 35px; height: 35px;">
                        <h1 style="font-weight: bold; color: white;">X</h1>
                    </button>
                </div>

                <div class="modal-body text-center">
                    <h1 class="fw-bold mb-3" style="font-size: 28px; font-family: 'Oswald'; font-weight: bold;">
                        {{ __('restaurant.report_restaurant_modal_title') }}</h1>

                    <p class="mb-3" style="font-family: font-family: 'Lato';">
                        {{ __('restaurant.report_restaurant_question') }}</p>

                    <div class="d-grid gap-2 mb-3">
                        <button type="button" id="expiredFoodBtn" class="btn btn-light border" onclick="chooseExpiredFood()"
                            style="font-family: font-family: 'Lato';">{{ __('restaurant.reason_expired_foods') }}</button>
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label fw-semibold"
                            style="font-family: font-family: 'Lato';">{{ __('restaurant.reason_others_label') }}</label>
                        <textarea id="otherTextarea" class="form-control @error('description') is-invalid @enderror"
                            name="other_reason" rows="3" placeholder="{{ __('restaurant.reason_others_placeholder') }}"
                            oninput="chooseOther()"
                            style="font-family: font-family: 'Lato';">{{ old('other_reason') }}</textarea>
                    </div>

                    {{-- @if (session('report_success'))
                    <div class="alert alert-success small">
                        {{ session('report_success') }}
                    </div>
                    @endif --}}

                    <input type="hidden" name="description" id="descriptionInput" value="{{ old('description') }}">
                    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                    @error('description')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-success rounded-pill px-5 py-1 mt-3"
                        style="background-color: #1d4d4f; font-family: 'Lato';" dusk="submit-report-button">
                        {{ __('restaurant.submit_report_button') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if ($errors->has('description') || $errors->has('other_reason'))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var myModal = new bootstrap.Modal(document.getElementById('reportModal'));
                myModal.show();
            });
        </script>
    @endif


    @if (session('report_success'))
        <div id="popupSuccess" class="popup-success">
            {{ session('report_success') }}
        </div>
    @endif

@endsection

<style>
    .popup-success {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #d4edda;
        color: #155724;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 9999;
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
    }


    .popup-success.hide {
        opacity: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const popup = document.getElementById('popupSuccess');
        if (popup) {
            setTimeout(() => {
                popup.classList.add('hide');
                setTimeout(() => popup.remove(), 500); // hapus dari DOM
            }, 3000); // muncul selama 3 detik
        }
    });
</script>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/restaurantmenu-customer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@push('scripts')
    <script src="{{ asset('js/restaurantmenu-customer.js') }}"></script>
@endpush