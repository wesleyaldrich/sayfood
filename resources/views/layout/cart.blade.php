@extends('layout.app')
@section('title', 'Cart')

@section('content')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">

<div class="breadcrumb-nav d-flex align-items-center mb-3">
    <a href="/foods" class="breadcrumb-link">Foods</a>
    <span class="mx-2">></span>
    <span class="text-muted">Cart</span>
</div>

<div class="pickup-location-tab d-flex align-items-center">
    <img class="pickup-location-icon" src="assets/icon_location.png" alt="Pickup Location">
    <span class=mx-2>Pickup Location</span>
</div>

<div class="pickup-address-tab">
    <p class="restaurant-name">{{$item->restaurant->name}}</p>
    <p class="restaurant-address">{{$item->restaurant->address}}</p>
</div>

<div class="transaction-section">
    <div class="added-to-cart-container">
        <div class="title">
            <p style="color:white" class="my-0">ADDED TO CART</p>
        </div>
        <x-cart-item :item="$item" />
        
        <div class="button-section">
            <a href="foods">
                <button class="add-more-btn">
                    <p style="color:white" class="my-0">ADD MORE</p>
                </button>
            </a>
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
                        <td>{{$item->name}}</td>
                        <td>x{{$item->stock}} </td>
                        <td>IDR {{ number_format($item->price, 0, ',', '.') }},00</td>
                        </tr>
                    </tbody>
                    <tfoot class="total-price-section">
                        <tr>
                        <th scope="row"></th>
                        <td>Total Price</td>
                        <td></td>
                        <td>IDR {{ number_format($item->price, 0, ',', '.') }},00</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="payment-buttons">
            <button class="cancel-order-btn">
                <p style="color: white" class="my-0">CANCEL</p>
            </button>
            <button class="checkout-btn" data-toggle="modal" data-target="#checkoutModal">
                <p style="color: white" class="my-0">CHECKOUT</p>
            </button>
        </div>
    </div>
</div>

<x-popup-modal id="addNoteModal" title="Add Notes">
        <p class="text-muted">Write your special requests below.</p>
        <textarea class="form-control" rows="4" placeholder="Example: Separate the sauce, not spicy..."></textarea>
        
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save Changes</button>
        </x-slot>
</x-popup-modal>

<x-popup-modal id="checkoutModal" title="Select Payment Method">
    
    <h6>Bank Transfer</h6>
    <p class="text-muted small">Select a bank to view the virtual account number.</p>
    <div class="list-group">
        {{-- BCA --}}
        <label for="paymentBca" class="list-group-item list-group-item-action d-flex align-items-center">
            <input class="form-check-input" type="radio" name="paymentMethod" id="paymentBca" value="bca">
            <img src="{{ asset('assets/payment_gateway_images/logobca.png') }}" alt="BCA" class="payment-logo ml-3 mr-3">
            <span>Bank Central Asia (BCA)</span>
        </label>
            {{-- BNI --}}
            <label for="paymentBni" class="list-group-item list-group-item-action d-flex align-items-center">
            <input class="form-check-input" type="radio" name="paymentMethod" id="paymentBni" value="bni">
            <img src="{{ asset('assets/payment_gateway_images/logobni.png') }}" alt="BNI" class="payment-logo ml-3 mr-3">
            <span>Bank Negara Indonesia (BNI)</span>
        </label>
    </div>

    <h6 class="mt-4">E-Wallet</h6>
    <div class="list-group">
        {{-- GoPay --}}
        <label for="paymentGopay" class="list-group-item list-group-item-action d-flex align-items-center">
            <input class="form-check-input" type="radio" name="paymentMethod" id="paymentGopay" value="gopay">
            <img src="{{ asset('assets/payment_gateway_images/logogopay.png') }}" alt="GoPay" class="payment-logo ml-3 mr-3">
            <span>GoPay</span>
        </label>
        {{-- OVO --}}
        <label for="paymentOvo" class="list-group-item list-group-item-action d-flex align-items-center">
            <input class="form-check-input" type="radio" name="paymentMethod" id="paymentOvo" value="ovo">
            <img src="{{ asset('assets/payment_gateway_images/logoovo.png') }}" alt="OVO" class="payment-logo ml-3 mr-3">
            <span>OVO</span>
        </label>
        {{-- Pilihan DANA --}}
        <label for="paymentDana" class="list-group-item list-group-item-action d-flex align-items-center">
            <input class="form-check-input" type="radio" name="paymentMethod" id="paymentDana" value="dana">
            <img src="{{ asset('assets/payment_gateway_images/logodana.png') }}" alt="DANA" class="payment-logo ml-3 mr-3">
            <span>DANA</span>
        </label>
    </div>

    <x-slot name="footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success font-weight-bold">Confirm & Pay</button>
    </x-slot>
</x-popup-modal>

@endsection