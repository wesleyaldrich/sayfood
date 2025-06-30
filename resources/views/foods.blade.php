@extends('layout.app')
@section('title', 'Foods Page')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@section('content')	

{{-- container
container-fluid
m (mb, mt, ml, mr, mx, my)
p (pb, pt, pl, pr, px, py)
d-flex (justify-content, align-items, flex-{row|column}) --}}

<div class="container-fluid my-2 px-4">
    <div class="badge-location badge rounded-pill">
        <img class="location-icon" src="assets/icon_location.png" alt="Search">
        Home
    </div>
</div>

<div class="container-fluid my-2 px-4">
    <div class="search-flex d-flex align-items-center">
        <div class="search-bar input-group rounded-pill border flex-grow-1" style="overflow: hidden;">
            <span class="input-group-text rounded-0 bg-white border-0 px-4">
                <img class="search-icon" src="assets/icon_search.png" alt="Search">
            </span>
            <input type="text" class="search-input form-control rounded-0 border-0 pl-0" placeholder="Search">
        </div>

        <div class="position-relative">
            <img class="filter-icon" id="filterBtn" src="assets/icon_filter.png" alt="Filter">

            <div class="dropdown-filter position-absolute" id="filterDropdown">
                <h4 class="filter-by">Filter by:</h4>

                <div class="container-pricefilter w-100 d-flex flex-column mb-2">
                    <label for="priceRange" class="form-label mb-1">Price</label>
                    <div class="range-container d-flex align-items-center flex-row w-100 justify-content-between">
                        <p class="mb-0">IDR 5K</p>
                        <div class="range-wrapper position-relative">
                            <input type="range" class="custom-range form-range" id="priceRange" min="5000" max="100000" step="5000" value="25000">
                            <div id="priceLabel" class="range-label">IDR 25K</div>
                        </div>
                        <p class="mb-0">IDR 100K</p>
                    </div>
                </div>

                <div class="container-pricefilter w-100 d-flex flex-column mb-3">
                    <label for="ratingRange" class="form-label mb-1">Ratings</label>
                    <div class="range-container d-flex align-items-center flex-row w-100 justify-content-between">
                        <img src="assets/icon_star.png" alt="star" class="star-icon-filter">
                        <p class="mb-0">1.0</p>
                        <div class="range-wrapper position-relative">
                            <input type="range" class="custom-range form-range" id="ratingRange" min="1" max="5" step="1" value="4">
                            <div id="ratingLabel" class="range-label">5</div>
                        </div>
                        <img src="assets/icon_star.png" alt="star" class="star-icon-filter">
                        <p class="mb-0">5.0</p>
                    </div>
                </div>

                <button id="applyFilter" class="btn btn-apply btn-primary w-100">APPLY</button>
            </div>
        </div>
        
        <div>
            <img class="history-icon" src="assets/icon_history.png" alt="History">
        </div>
    </div>
</div>

<div class="filter-flex container-fluid d-flex my-2 px-4 gap-5">
    <button class="btn-filter btn btn-primary rounded-pill d-flex align-items-center" id="btnNearby">Nearby</button>
    <button class="btn-filter btn btn-primary rounded-pill d-flex align-items-center" id="btnMostPopular">Most Popular</button>
</div>

<img class="mycart" src="assets/icon_mycart.png" alt="mycart">

<div class="container-today container-fluid my-4 px-4 py-4 d-flex">
    <h2>TODAY'S BEST FOOD</h2>
    <div class="foreach-today d-flex overflow-auto flex-nowrap">
        @for ($i = 0; $i < 10; $i++)
            <x-food-item
                image="assets/food_chickenricebowl.png"
                title="Chicken Ricebowl"
                description="A chicken rice bowl is a tasty mix of juicy chicken, steamed rice, and savory sauce, all in one bowl."
                expiry="10.00 PM"
                stock="5"
                restoName="Restoran Nyonya Suan"
                rating="4,9"
                distance="2,3"
                price="20.000"
            />
        @endfor
    </div>

</div>

<div class="container-foodcategories container-maincourses container-fluid my-4 px-4 py-4 d-flex">
    <h2>MAIN COURSES</h2>
    <div class="foreach-foodcategories d-flex overflow-auto flex-nowrap">
        @for ($i = 0; $i < 4; $i++)
            <x-food-item
                image="assets/food_chickenricebowl.png"
                title="Chicken Ricebowl"
                description="A chicken rice bowl is a tasty mix of juicy chicken, steamed rice, and savory sauce, all in one bowl."
                expiry="10.00 PM"
                stock="5"
                restoName="Restoran Nyonya Suan"
                rating="4,9"
                distance="2,3"
                price="20.000"
            />
        @endfor
        <div class="viewmore" data-bs-toggle="modal" data-bs-target="#moreDrinksModal">
            <h3>VIEW<br>MORE</h3>
        </div>
    </div>
    <h4 class="viewmore2 mt-4 text-end" data-bs-toggle="modal" data-bs-target="#moreDrinksModal">VIEW MORE</h4>
</div>

<div class="container-foodcategories container-desserts container-fluid my-4 px-4 py-4 d-flex">
    <h2>DESSERTS</h2>
    <div class="foreach-foodcategories d-flex overflow-auto flex-nowrap">
        @for ($i = 0; $i < 4; $i++)
            <x-food-item
                image="assets/food_chickenricebowl.png"
                title="Chicken Ricebowl"
                description="A chicken rice bowl is a tasty mix of juicy chicken, steamed rice, and savory sauce, all in one bowl."
                expiry="10.00 PM"
                stock="5"
                restoName="Restoran Nyonya Suan"
                rating="4,9"
                distance="2,3"
                price="20.000"
            />
        @endfor
        <div class="viewmore" data-bs-toggle="modal" data-bs-target="#moreDrinksModal">
            <h3>VIEW<br>MORE</h3>
        </div>
    </div>
    <h4 class="viewmore2 mt-4 text-end" data-bs-toggle="modal" data-bs-target="#moreDrinksModal">VIEW MORE</h4>
</div>

<div class="container-foodcategories container-snacks container-fluid my-4 px-4 py-4 d-flex">
    <h2>SNACKS</h2>
    <div class="foreach-foodcategories d-flex overflow-auto flex-nowrap">
        @for ($i = 0; $i < 4; $i++)
            <x-food-item
                image="assets/food_chickenricebowl.png"
                title="Chicken Ricebowl"
                description="A chicken rice bowl is a tasty mix of juicy chicken, steamed rice, and savory sauce, all in one bowl."
                expiry="10.00 PM"
                stock="5"
                restoName="Restoran Nyonya Suan"
                rating="4,9"
                distance="2,3"
                price="20.000"
            />
        @endfor
        <div class="viewmore" data-bs-toggle="modal" data-bs-target="#moreDrinksModal">
            <h3>VIEW<br>MORE</h3>
        </div>
    </div>
    <h4 class="viewmore2 mt-4 text-end" data-bs-toggle="modal" data-bs-target="#moreDrinksModal">VIEW MORE</h4>
</div>

<div class="container-foodcategories container-drinks container-fluid my-4 px-4 py-4 d-flex">
    <h2>DRINKS</h2>
    <div class="foreach-foodcategories d-flex overflow-auto flex-nowrap">
        @for ($i = 0; $i < 4; $i++)
            <x-food-item
                image="assets/food_chickenricebowl.png"
                title="Chicken Ricebowl"
                description="A chicken rice bowl is a tasty mix of juicy chicken, steamed rice, and savory sauce, all in one bowl."
                expiry="10.00 PM"
                stock="5"
                restoName="Restoran Nyonya Suan"
                rating="4,9"
                distance="2,3"
                price="20.000"
            />
        @endfor
        <div class="viewmore" data-bs-toggle="modal" data-bs-target="#moreDrinksModal">
            <h3>VIEW<br>MORE</h3>
        </div>
    </div>
    <h4 class="viewmore2 mt-4 text-end" data-bs-toggle="modal" data-bs-target="#moreDrinksModal">VIEW MORE</h4>
</div>

<div class="modal fade" id="moreDrinksModal" tabindex="-1" aria-labelledby="moreDrinksLabel" aria-hidden="true">
    <div class="popup modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="moreDrinksLabel">
                    <h2 class="popup-title badge rounded-pill">MAIN COURSES</h2>
                </div>
                <img src="assets/btn_exit.png" alt="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            </div>
            <div class="modal-body pt-0">
                <div class="container-fluid px-4">
                    <div class="row g-4">
                        @for ($i = 0; $i < 12; $i++)
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-2 justify-content-center align-items-center d-flex">
                                <x-food-item
                                    image="assets/food_chickenricebowl.png"
                                    title="Chicken Ricebowl"
                                    description="A chicken rice bowl is a tasty mix of juicy chicken, steamed rice, and savory sauce, all in one bowl."
                                    expiry="10.00 PM"
                                    stock="5"
                                    restoName="Restoran Nyonya Suan"
                                    rating="4,9"
                                    distance="2,3"
                                    price="20.000"
                                />
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/foods.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/foods.js') }}" defer></script>
@endpush
