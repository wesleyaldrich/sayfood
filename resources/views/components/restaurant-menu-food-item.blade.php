@props([
    'image',
    'title',
    'description',
    'expiry',
    'stock',
    'restoName',
    'rating',
    'distance',
    'price'
])

<div class="container-food">
    <div class="ekor"></div>
    <img src="{{ asset('storage/' . $image) }}" alt="{{ $title }}" class="food-image">
    <div class="container-fooddetail px-3">
        <h5 class="oswald food-title">{{ $title }}</h5>
        <p class="food-description mb-2">{{ $description }}</p>

        <div class="exp-stock d-flex justify-content-between mb-2">
            <p class="exp mb-1">Exp: {{ $expiry }}</p>
            <p class="stock mb-1">{{ __('foods.stock') }}: {{ $stock }} {{ __('foods.left') }}</p>
        </div>
    </div>
    <h3 class="oswald price py-2 mb-0">{{ $price }}</h3>
    <img src="{{ asset('assets/icon_cart.png') }}" alt="cart" class="cart-icon" onclick="showCartPopup(this)">
    <div class="successfully-added align-items-center justify-content-center">
        <h6 class="mb-0">Successfully added!</h6>
        <img class="checkcircle" src="{{ asset('assets/icon_checkcircle.png')   }}" alt="checkcircle">
    </div>
</div>

