@extends('layout.app')
@section('title', 'Foods Page')

@section('content')	

{{-- container
container-fluid
m (mb, mt, ml, mr, mx, my)
p (pb, pt, pl, pr, px, py)
d-flex (justify-content, align-items, flex-{row|column}) --}}

<div class="container-fluid my-2 px-4 d-flex flex-row justify-content-between">
    @if(Auth::check())
        <div class="badge-location badge rounded-pill">
            <img class="location-icon" src="assets/icon_location.png" alt="Location">
            {{ Auth::user()->address ?? '[Not Set]' }}
        </div>
    @else
        <div class="badge-location badge rounded-pill">
            <img class="location-icon" src="assets/icon_location.png" alt="Location">
            [Not Logged In]
        </div>
    @endif
    <a href="{{ route('foods') }}" class="btn-clear-all">CLEAR ALL FILTERS</a>
</div>

<div class="container-fluid my-2 px-4">
    <div class="search-flex d-flex align-items-center">
        <form action="{{ route('foods') }}" method="GET" class="search-bar input-group rounded-pill border flex-grow-1" style="overflow: hidden;">
            <span class="input-group-text rounded-0 bg-white border-0 px-4">
                <img class="search-icon" src="assets/icon_search.png" alt="Search">
            </span>
            <input name="q" type="text" class="search-input form-control rounded-0 border-0 pl-0" placeholder="Search" value="{{ request('q') }}">
            
            <input type="hidden" name="price" value="{{ request('price') }}">
            <input type="hidden" name="rating" value="{{ request('rating') }}">
            <input type="hidden" name="sort" value="{{ request('sort') }}">
        </form>

        <div class="position-relative">
            <img class="filter-icon" id="filterBtn" src="assets/icon_filter.png" alt="Filter">

            <form action="{{ route('foods') }}" method="GET" class="dropdown-filter position-absolute" id="filterDropdown">
                <h4 class="filter-by pb-2" style="font-weight: bold;">Filter by:</h4>

                <div class="container-pricefilter w-100 d-flex flex-column mb-2">
                    <label for="priceRange" class="form-label mb-1">Max Price</label>
                    <div class="range-container d-flex align-items-center flex-row w-100 justify-content-between">
                        <p class="mb-0">IDR 5K</p>
                        <div class="range-wrapper position-relative">
                            <input type="range" name="price" class="custom-range form-range" id="priceRange" min="5000" max="100000" step="5000" value="{{ request('price', 100000) }}">
                            <div id="priceLabel" class="range-label">IDR 25K</div>
                        </div>
                        <p class="mb-0">IDR 100K</p>
                    </div>
                </div>

                <div class="container-pricefilter w-100 d-flex flex-column mb-3">
                    <label for="ratingRange" class="form-label mb-1">Min Rating</label>
                    <div class="range-container d-flex align-items-center flex-row w-100 justify-content-between">
                        <img src="assets/icon_star.png" alt="star" class="star-icon-filter">
                        <p class="mb-0">0.0</p>
                        <div class="range-wrapper position-relative">
                            <input type="range" name="rating" class="custom-range form-range" id="ratingRange" min="0" max="5" step="0.5" value="{{ request('rating', 0) }}">
                            <div id="ratingLabel" class="range-label">5</div>
                        </div>
                        <img src="assets/icon_star.png" alt="star" class="star-icon-filter">
                        <p class="mb-0">5.0</p>
                    </div>
                </div>

                <input type="hidden" name="q" value="{{ request('q') }}">
                <input type="hidden" name="sort" value="{{ request('sort') }}">

                <div class="button-filter-wrapper d-flex flex-row">
                    <a href="{{ route('foods', array_filter(request()->except(['price', 'rating']))) }}" id="resetFilter" class="btn btn-reset btn-primary w-100">RESET</a>
                    <button id="applyFilter" class="btn btn-apply btn-primary w-100">APPLY</button>
                </div>
            </form>
        </div>

        <a href="{{ route('activity') }}"><img class="history-icon" src="assets/icon_history.png" alt="History"></a>
    </div>
</div>

<form id="sortForm" action="{{ route('foods') }}" method="GET" class="filter-flex container-fluid d-flex my-2 px-4 gap-5">
    <input type="hidden" name="sort" id="sortInput" value="{{ request('sort') }}">

    <input type="hidden" name="q" value="{{ request('q') }}">
    <input type="hidden" name="price" value="{{ request('price') }}">
    <input type="hidden" name="rating" value="{{ request('rating') }}">

    <button type="button"
        class="btn-filter btn btn-primary rounded-pill d-flex align-items-center {{ request('sort') === 'nearby' ? 'active' : '' }}"
        id="btnNearby">Nearby</button>

    <button type="button"
        class="btn-filter btn btn-primary rounded-pill d-flex align-items-center {{ request('sort') === 'popular' ? 'active' : '' }}"
        id="btnMostPopular">Most Popular</button>
</form>

<a href="/cart">
    <img class="mycart" src="assets/icon_mycart.png" alt="mycart">
</a>

@if (!request()->has('q') && !request()->has('price') && !request()->has('rating') && !request()->has('sort'))
    <div class="container-today container-fluid my-4 px-4 py-4 d-flex">
        <h2 class="category-title">RECOMMENDED FOR YOU</h2>
        <div class="foreach-today d-flex overflow-auto flex-nowrap">
            @foreach ($popular as $food)
                <x-food-item
                    :id="$food->id"
                    :image="$food->image_url"
                    :title="$food->name"
                    :description="$food->description"
                    :expiry="$food->exp_datetime->format('d/m h:i A')"
                    :stock="$food->stock"
                    :restoName="$food->restaurant->name"
                    :rating="$food->restaurant->avg_rating"
                    :distance="number_format($food->restaurant->distance, 1)"
                    :price="'IDR ' . number_format($food->price, 0, ',', '.')"
                />
            @endforeach
        </div>
    </div>
@endif

@if ($mainCourses->count() > 0)
    <div class="container-foodcategories container-maincourses container-fluid my-4 px-4 py-4 d-flex">
        <h2 class="category-title">MAIN COURSES</h2>
        <div class="foreach-foodcategories d-flex overflow-auto flex-nowrap">
            @foreach ($mainCourses->take(4) as $food)
                <x-food-item
                    :id="$food->id"
                    :image="$food->image_url"
                    :title="$food->name"
                    :description="$food->description"
                    :expiry="$food->exp_datetime->format('d/m h:i A')"
                    :stock="$food->stock"
                    :restoName="$food->restaurant->name"
                    :rating="$food->restaurant->avg_rating"
                    :distance="number_format($food->restaurant->distance, 1)"
                    :price="'IDR ' . number_format($food->price, 0, ',', '.')"
                />
            @endforeach

            @if ($mainCourses->count() > 4)
                <div class="viewmore" data-bs-toggle="modal" data-bs-target="#moreModal" data-category="mainCourses">
                    <h3 class="viewmore-text">VIEW<br>MORE</h3>
                </div>
            @endif
        </div>
        @if ($mainCourses->count() > 4)
            <h4 class="viewmore2 mt-4 text-end viewmore-text" data-bs-toggle="modal" data-bs-target="#moreModal" data-category="mainCourses">VIEW MORE</h4>
        @endif
    </div>
@endif

@if ($desserts->count() > 0)
    <div class="container-foodcategories container-desserts container-fluid my-4 px-4 py-4 d-flex">
        <h2 class="category-title">DESSERTS</h2>
        <div class="foreach-foodcategories d-flex overflow-auto flex-nowrap">
            @foreach ($desserts->take(4) as $food)
                <x-food-item
                    :id="$food->id"
                    :image="$food->image_url"
                    :title="$food->name"
                    :description="$food->description"
                    :expiry="$food->exp_datetime->format('d/m h:i A')"
                    :stock="$food->stock"
                    :restoName="$food->restaurant->name"
                    :rating="$food->restaurant->avg_rating"
                    :distance="number_format($food->restaurant->distance, 1)"
                    :price="'IDR ' . number_format($food->price, 0, ',', '.')"
                />
            @endforeach

            @if ($desserts->count() > 4)
                <div class="viewmore" data-bs-toggle="modal" data-bs-target="#moreModal" data-category="desserts">
                    <h3 class="viewmore-text">VIEW<br>MORE</h3>
                </div>
            @endif
        </div>
        @if ($desserts->count() > 4)
            <h4 class="viewmore2 mt-4 text-end viewmore-text" data-bs-toggle="modal" data-bs-target="#moreModal" data-category="desserts">VIEW MORE</h4>
        @endif
    </div>
@endif

@if ($snacks->count() > 0)
    <div class="container-foodcategories container-snacks container-fluid my-4 px-4 py-4 d-flex">
        <h2 class="category-title">SNACKS</h2>
        <div class="foreach-foodcategories d-flex overflow-auto flex-nowrap">
            @foreach ($snacks->take(4) as $food)
                <x-food-item
                    :id="$food->id"
                    :image="$food->image_url"
                    :title="$food->name"
                    :description="$food->description"
                    :expiry="$food->exp_datetime->format('d/m h:i A')"
                    :stock="$food->stock"
                    :restoName="$food->restaurant->name"
                    :rating="$food->restaurant->avg_rating"
                    :distance="number_format($food->restaurant->distance, 1)"
                    :price="'IDR ' . number_format($food->price, 0, ',', '.')"
                />
            @endforeach
            
            @if ($snacks->count() > 4)
                <div class="viewmore" data-bs-toggle="modal" data-bs-target="#moreModal" data-category="snacks">
                    <h3 class="viewmore-text">VIEW<br>MORE</h3>
                </div>
            @endif
        </div>
        @if ($snacks->count() > 4)
            <h4 class="viewmore2 mt-4 text-end viewmore-text" data-bs-toggle="modal" data-bs-target="#moreModal" data-category="snacks">VIEW MORE</h4>
        @endif
    </div>
@endif

@if ($drinks->count() > 0)
    <div class="container-foodcategories container-drinks container-fluid my-4 px-4 py-4 d-flex">
        <h2 class="category-title">DRINKS</h2>
        <div class="foreach-foodcategories d-flex overflow-auto flex-nowrap">
            @foreach ($drinks->take(4) as $food)
                <x-food-item
                    :id="$food->id"
                    :image="$food->image_url"
                    :title="$food->name"
                    :description="$food->description"
                    :expiry="$food->exp_datetime->format('d/m h:i A')"
                    :stock="$food->stock"
                    :restoName="$food->restaurant->name"
                    :rating="$food->restaurant->avg_rating"
                    :distance="number_format($food->restaurant->distance, 1)"
                    :price="'IDR ' . number_format($food->price, 0, ',', '.')"
                />
            @endforeach

            @if ($drinks->count() > 4)
                <div class="viewmore" data-bs-toggle="modal" data-bs-target="#moreModal" data-category="drinks">
                    <h3 class="viewmore-text">VIEW<br>MORE</h3>
                </div>
            @endif
        </div>
        @if ($drinks->count() > 4)
            <h4 class="viewmore2 mt-4 text-end viewmore-text" data-bs-toggle="modal" data-bs-target="#moreModal" data-category="drinks">VIEW MORE</h4>
        @endif
    </div>
@endif

<div class="modal fade" id="moreModal" tabindex="-1" aria-labelledby="moreDrinksLabel" aria-hidden="true">
    <div class="popup modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="moreDrinksLabel">
                    <h2 class="popup-title badge rounded-pill" id="moreModalLabel">MAIN COURSES</h2>
                </div>
                <img src="assets/btn_exit.png" alt="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            </div>
            <div class="modal-body pt-0">
                <div class="container-fluid px-4">

                    {{-- MAIN COURSES --}}
                    <div class="row g-4 category-section" id="mainCoursesSection">
                        @foreach ($mainCourses as $food)
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-2 d-flex justify-content-center align-items-center">
                                <x-food-item
                                    :id="$food->id"
                                    :image="$food->image_url"
                                    :title="$food->name"
                                    :description="$food->description"
                                    :expiry="$food->exp_datetime->format('d/m h:i A')"
                                    :stock="$food->stock"
                                    :restoName="optional($food->restaurant)->name"
                                    :rating="number_format(optional($food->restaurant)->avg_rating ?? 0, 1)"
                                    :distance="number_format(optional($food->restaurant)->distance ?? 0, 1)"
                                    :price="'IDR ' . number_format($food->price, 0, ',', '.')"
                                />
                            </div>
                        @endforeach
                    </div>

                    {{-- DESSERTS --}}
                    <div class="row g-4 category-section d-none" id="dessertsSection">
                        @foreach ($desserts as $food)
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-2 d-flex justify-content-center align-items-center">
                                <x-food-item
                                    :id="$food->id"
                                    :image="$food->image_url"
                                    :title="$food->name"
                                    :description="$food->description"
                                    :expiry="$food->exp_datetime->format('d/m h:i A')"
                                    :stock="$food->stock"
                                    :restoName="optional($food->restaurant)->name"
                                    :rating="number_format(optional($food->restaurant)->avg_rating ?? 0, 1)"
                                    :distance="number_format(optional($food->restaurant)->distance ?? 0, 1)"
                                    :price="'IDR ' . number_format($food->price, 0, ',', '.')"
                                />
                            </div>
                        @endforeach
                    </div>

                    {{-- SNACKS --}}
                    <div class="row g-4 category-section d-none" id="snacksSection">
                        @foreach ($snacks as $food)
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-2 d-flex justify-content-center align-items-center">
                                <x-food-item
                                    :id="$food->id"
                                    :image="$food->image_url"
                                    :title="$food->name"
                                    :description="$food->description"
                                    :expiry="$food->exp_datetime->format('d/m h:i A')"
                                    :stock="$food->stock"
                                    :restoName="optional($food->restaurant)->name"
                                    :rating="number_format(optional($food->restaurant)->avg_rating ?? 0, 1)"
                                    :distance="number_format(optional($food->restaurant)->distance ?? 0, 1)"
                                    :price="'IDR ' . number_format($food->price, 0, ',', '.')"
                                />
                            </div>
                        @endforeach
                    </div>

                    {{-- DRINKS --}}
                    <div class="row g-4 category-section d-none" id="drinksSection">
                        @foreach ($drinks as $food)
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-2 d-flex justify-content-center align-items-center">
                                <x-food-item
                                    :id="$food->id"
                                    :image="$food->image_url"
                                    :title="$food->name"
                                    :description="$food->description"
                                    :expiry="$food->exp_datetime->format('d/m h:i A')"
                                    :stock="$food->stock"
                                    :restoName="optional($food->restaurant)->name"
                                    :rating="number_format(optional($food->restaurant)->avg_rating ?? 0, 1)"
                                    :distance="number_format(optional($food->restaurant)->distance ?? 0, 1)"
                                    :price="'IDR ' . number_format($food->price, 0, ',', '.')"
                                />
                            </div>
                        @endforeach
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
