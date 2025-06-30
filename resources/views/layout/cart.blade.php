@extends('layout.app')
@section('title', 'Cart')

@section('content')
<div class="breadcrumb-nav d-flex align-items-center mb-3">
    <a href="/foods" class="breadcrumb-link">Foods</a>
    <span class="mx-2">></span>
    <span class="text-muted">Cart</span>
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</div>

<div class="pickup-location-tab d-flex align-items-center">
    <img class="pickup-location-icon" src="assets/icon_location.png" alt="Pickup Location">
    <span class=mx-2>Pickup Location</span>
</div>

<div class="pickup-address-tab">
    <p class="restaurant-name">Restoran Ny. Dira</p>
    <p class="restaurant-address">Jl. Pakuan No.3, Sumur Batu, Babakan Madang, Bogor, Jawa Barat</p>
</div>

<div class="transaction-section">
    <div class="added-to-cart-container">
        <div class="title">
            <p style="color:white" class="my-0">ADDED TO CART</p>
        </div>
        <div class="cart-item">
            <img src="assets/bubur_sukabumi.png" alt="Food Image" class="item-image"/>
            <div class="cart-item-details">
                <div class="item-description">
                    <div>
                        <p class="item-title" style="color: #234C4C">Bubur Sukabumi</p>
                        <p class="item-price my-2" style="color: #234C4C">Price : </p>
                        <p class="item-expiry my-2" style="color: #234C4C">Best Before : </p>
                    </div>
                </div>
                <div class="notes-and-qty-section">
                    <button class="add-notes-btn d-flex">
                        <img src="assets/add_notes.png" alt="Add" class="add-notes-icon">
                        <p style="color:white" class="my-0">Notes</p>
                    </button>
                    <div class="manage-quantity d-flex align-items-center">
                        <button class="qty-button">
                            <img src="assets/add_button.png" alt="add" class="qty-button-img">
                        </button>
                        <p class="qty-text">1</p>
                        <button class="qty-button">
                            <img src="assets/subtract_button.png" alt="subtract" class="qty-button-img">
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="button-section">
            <button class="add-more-btn">
                <p style="color:white" class="my-0">ADD MORE</p>
            </button>
        </div>
    </div>
    <div class="payment-contents-right-side">
        <div class="payment-container">
            <div class="title">
                <p style="color:white" class="my-0">PAYMENT SUMMARY</p>
            </div>
            <div class="product-details">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Food</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                        <th scope="row">1</th>
                        <td>Bubur Sukabumi</td>
                        <td>x1</td>
                        <td>IDR6.000,00</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Nasi Goreng Bebek</td>
                        <td>x2</td>
                        <td>IDR10.000,00</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td>Es Pisang Ijo</td>
                        <td>x1</td>
                        <td>IDR5.000,00</td>
                        </tr>
                    </tbody>
                    <tfoot class="total-price-section">
                        <tr>
                        <th scope="row"></th>
                        <td>Total Price</td>
                        <td></td>
                        <td>IDR6.000,00</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="payment-buttons">
            <button class="cancel-order-btn">
                <p style="color: white" class="my-0">CANCEL</p>
            </button>
            <button class="checkout-btn">
                <p style="color: white" class="my-0">CHECKOUT</p>
            </button>
        </div>
    </div>
</div>

@endsection