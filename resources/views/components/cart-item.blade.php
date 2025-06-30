@props([
    'image',
    'title',
    'expiry',
    'quantity',
    'price'
])

<div class="cart-item">
    <div class="item-image">
        <img src="{{$image}}" alt="{{$title}}">
    </div>
    <div class="item-description">
        <button class="add-notes-btn">
            <p style="color:white" class="my-0">Notes</p>
            <img src="" alt="">
        </button>
    </div>
    <div class="item-quantity">
        <button class="add-button">
            <img src="" alt="">
        </button>
        <p class="qty-text">1</p>
        <button class="subtract-button">
            <img src="" alt="">
        </button>
    </div>
</div>