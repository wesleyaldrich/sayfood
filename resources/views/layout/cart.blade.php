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
                    <button class="add-notes-btn d-flex" data-toggle="modal" data-target="#addNoteModal">
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
        <div class="payment-buttons" data-toggle="modal" data-target="#checkoutModal">
            <button class="cancel-order-btn">
                <p style="color: white" class="my-0">CANCEL</p>
            </button>
            <button class="checkout-btn">
                <p style="color: white" class="my-0">CHECKOUT</p>
            </button>
        </div>
    </div>
</div>

<x-popup-modal id="addNoteModal" title="Add Notes" content-classes="addnotesmodal">
    <p class="text-muted">Tulis permintaan khusus Anda di bawah ini.</p>
    <textarea class="form-control" rows="4" placeholder="Contoh: Saus dipisah, jangan pedas..."></textarea>
    
    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary">Simpan Perubahan</button>
    </x-slot>
</x-popup-modal>

<x-popup-modal id="checkoutModal" title="Pilih Metode Pembayaran" content-classes="modal-checkout">
    
    {{-- Opsi untuk Bank Transfer --}}
    <h6>Bank Transfer</h6>
    <p class="text-muted small">Pilih salah satu bank untuk melihat nomor virtual account.</p>
    <div class="list-group">
        {{-- Pilihan BCA --}}
        <label for="paymentBca" class="list-group-item list-group-item-action d-flex align-items-center">
            <input class="form-check-input" type="radio" name="paymentMethod" id="paymentBca" value="bca">
            <img src="{{ asset('assets/logo-bca.png') }}" alt="BCA" class="payment-logo ml-3 mr-3">
            <span>Bank Central Asia (BCA)</span>
        </label>
        {{-- Pilihan Mandiri --}}
        <label for="paymentMandiri" class="list-group-item list-group-item-action d-flex align-items-center">
            <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMandiri" value="mandiri">
            <img src="{{ asset('assets/logo-mandiri.png') }}" alt="Mandiri" class="payment-logo ml-3 mr-3">
            <span>Bank Mandiri</span>
        </label>
         {{-- Pilihan BNI --}}
         <label for="paymentBni" class="list-group-item list-group-item-action d-flex align-items-center">
            <input class="form-check-input" type="radio" name="paymentMethod" id="paymentBni" value="bni">
            <img src="{{ asset('assets/logo-bni.png') }}" alt="BNI" class="payment-logo ml-3 mr-3">
            <span>Bank Negara Indonesia (BNI)</span>
        </label>
    </div>

    {{-- Opsi untuk E-Wallet --}}
    <h6 class="mt-4">E-Wallet</h6>
    <div class="list-group">
        {{-- Pilihan GoPay --}}
        <label for="paymentGopay" class="list-group-item list-group-item-action d-flex align-items-center">
            <input class="form-check-input" type="radio" name="paymentMethod" id="paymentGopay" value="gopay">
            <img src="{{ asset('assets/logo-gopay.png') }}" alt="GoPay" class="payment-logo ml-3 mr-3">
            <span>GoPay</span>
        </label>
        {{-- Pilihan OVO --}}
        <label for="paymentOvo" class="list-group-item list-group-item-action d-flex align-items-center">
            <input class="form-check-input" type="radio" name="paymentMethod" id="paymentOvo" value="ovo">
            <img src="{{ asset('assets/logo-ovo.png') }}" alt="OVO" class="payment-logo ml-3 mr-3">
            <span>OVO</span>
        </label>
        {{-- Pilihan DANA --}}
        <label for="paymentDana" class="list-group-item list-group-item-action d-flex align-items-center">
            <input class="form-check-input" type="radio" name="paymentMethod" id="paymentDana" value="dana">
            <img src="{{ asset('assets/logo-dana.png') }}" alt="DANA" class="payment-logo ml-3 mr-3">
            <span>DANA</span>
        </label>
    </div>

    {{-- Mengisi bagian footer dengan tombol aksi --}}
    <x-slot name="footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-success font-weight-bold">Konfirmasi & Bayar</button>
    </x-slot>
</x-popup-modal>

@endsection