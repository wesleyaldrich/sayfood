@props([
    'id',
    'image',
    'title',
    'description',
    'expiry',
    'stock',
    'restoName',
    'rating',
    'distance',
    'price',
    'resto_id'
])

<div class="container-food">
    <div class="ekor"></div>
    <img src="{{ asset('storage/' . $image) }}" alt="{{ $title }}" class="food-image">
    <div class="container-fooddetail px-3">
        <h5 class="food-title">{{ $title }}</h5>
        <p class="food-description mb-2">{{ $description }}</p>

        <div class="exp-stock d-flex justify-content-between mb-2">
            <p class="exp mb-1">Exp: {{ $expiry }}</p>
            <p class="stock mb-1">{{ __('foods.stock') }}: {{ $stock }} {{ __('foods.left') }}</p>
        </div>

        <div class="resto-detail d-flex justify-content-between align-items-center py-2">
            <div class="resto-left d-flex">
                <h7 class="resto-name">{{ $restoName }}</h7>
                <div class="rating d-flex">
                    <img class="star" src="{{ asset('assets/icon_star.png') }}" alt="star">
                    <p class="rating-num ml-1 mb-0"><span class="rating-numm">{{ $rating }}</span>/5</p>
                </div>
                <div class="location d-flex">
                    <img class="location-red" src="{{ asset('assets/icon_location_red.png') }}" alt="star">
                    <p class="location-num ml-1 mb-0">{{ $distance }} km</p>
                </div>
            </div>
            <div class="visit-resto">
                <a href="{{ route('resto.show', $resto_id) }}">    
                    <button class="btn-visit-resto btn btn-primary d-flex align-items-center">{{ __('foods.visit') }}<br>RESTO</button>
                </a>
            </div>
        </div>
    </div>
    <h3 class="price py-2 mb-0">{{ $price }}</h3>

    {{-- test functionality add to cart --}}
    <form action="{{ route('add.cart', $id) }}" method="POST" class="cart-form" data-resto-name="{{ $restoName }}">
        @csrf
        {{-- asumsi default kuantitas adalah 1 saat pertama kali klik --}}
        <input type="hidden" name="quantity" value="1">

        <button type="submit" class="cart-icon-button">
            <img src="{{ asset('assets/icon_cart.png') }}" alt="cart" class="cart-icon">
        </button>
    </form>

    <div class="successfully-added align-items-center justify-content-center">
        <h6 class="mb-0">Successfully added!</h6>
        <img class="checkcircle" src="assets/icon_checkcircle.png" alt="checkcircle">
    </div>

</div>