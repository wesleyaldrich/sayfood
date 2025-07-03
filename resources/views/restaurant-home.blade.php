@extends('layout.app')
@section('title', 'Restaurant Home Page')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@php
    $orders = collect(range(1, 10))->map(function ($i) {
        return [
            'date' => 'Monday, 20/05/2025 12:30 PM',
            'profile' => 'assets/icon_profile.png',
            'name' => "Customer $i",
            'order' => [
                'Main Courses' => [['name' => 'Bubur Ayam', 'qty' => 2], ['name' => 'Nasi Goreng Sapi', 'qty' => 1]],
                'Snacks' => [['name' => 'Kentang Goreng', 'qty' => 2]],
            ],
        ];
    });

    $reviews = collect(range(1, 5))->map(function () {
        return [
            'name' => 'Naufal Dimas Azizan',
            'menu' => 'Bubur Ayam',
            'rating' => '4.9',
            'review' => 'Enak pokoknya. Saya sih tim makan bubur diaduk. Tapi either way tetep enak lah ya.',
            'date' => 'Monday, 20/05/2025 12:30 PM',
            'profile' => 'assets/icon_profile.png',
        ];
    });
@endphp

@section('content')

    <div class="container-fluid-today-summary container-fluid my-4 px-5 d-flex flex-row justify-content-center">
        <div class="today-summary-container d-flex flex-row">
            <div class="total-orders-today text-center">
                <h5 class="today-summary-title">Total Orders Today</h5>
                <h2 class="today-summary-content">120 Orders</h2>
            </div>
            <div class="today-summary-divider"></div>
            <div class="total-orders-today text-center">
                <h5 class="today-summary-title">Today's Income</h5>
                <h2 class="today-summary-content">1.030.000 IDR</h2>
            </div>
            <div class="today-summary-divider"></div>
            <div class="total-orders-today text-center">
                <h5 class="today-summary-title">Today's Most Purchased</h5>
                <h2 class="today-summary-content">Bubur Ayam</h2>
            </div>
        </div>
        <img class="mascot_peganghati" src="assets/mascot_peganghati.png" alt="">
    </div>

    <div class="container-fluid-order-list container-fluid my-4 px-5 d-flex justify-content-center">
        <div class="order-list-container d-flex justify-content-center align-items-center flex-column">
            <h1
                style="display:flex; width: fit-content; color: white; background: #EE8D4A; padding: 16px 40px; font-size: 2rem; font-weight: bold; border-radius: 32px; margin-bottom: 16px;">
                ORDER LIST</h1>
            <div class="restaurant-order-scroll-wrapper position-relative w-100 d-flex flex-row">
                <button class="scroll-btn left" onclick="scrollLeftt()">
                     < 
                </button>

                <!-- Scrollable Order List -->
                <div id="scrollContainer" class="restaurant-order-list-container d-flex flex-row overflow-auto">
                    @foreach ($orders as $order)
                        <x-restaurant-order-item 
                            :date="$order['date']" 
                            :profile="$order['profile']" 
                            :name="$order['name']" 
                            :order="$order['order']" 
                        />
                    @endforeach
                </div>

                <button class="scroll-btn right" onclick="scrollRightt()">
                     > 
                </button>
            </div>

        </div>

    </div>
    
    <div class="customer-review-container container-fluid my-5 py-5 px-5 d-flex flex-column justify-content-center">
        <h1 style="color: white; font-size: 2rem; font-weight: bold; text-align: center; margin-bottom: 20px;">NEW CUSTOMER REVIEW</h1>
        <div class="customer-review-wrapper d-flex flex-row">
            @foreach ($reviews as $r)
                <x-customer-review-item 
                    :name="$r['name']"
                    :menu="$r['menu']"
                    :rating="$r['rating']"
                    :date="$r['date']"
                    :profile="$r['profile']"
                />
            @endforeach
        </div>
    </div>

    <div class="total-orders-container container-fluid my-5 py-5 px-5 d-flex flex-column justify-content-center align-items-center">
        <h1 style="font-size: 2rem; font-weight: bold; text-align: center; margin-bottom: 20px;">TOTAL ORDERS THIS WEEK</h1>
        <div class="total-orders-category-container d-flex flex-row justify-content-center">
            <div class="total-orders-category-wrapper">
                <p class="total-orders-category">Main Courses</p>
                <h1 class="total-orders-num total-orders-maincourse">200</h1>
                <img src="assets/Main_Courses.png" alt="">
            </div>
            <div class="total-orders-category-wrapper">
                <p class="total-orders-category">Desserts</p>
                <h1 class="total-orders-num total-orders-dessert">50</h1>
                <img src="assets/Desserts.png" alt="">
            </div>
            <div class="total-orders-category-wrapper">
                <p class="total-orders-category">Snacks</p>
                <h1 class="total-orders-num total-orders-snack">75</h1>
                <img src="assets/Snacks.png" alt="">
            </div>
            <div class="total-orders-category-wrapper">
                <p class="total-orders-category">Drinks</p>
                <h1 class="total-orders-num total-orders-drink">89</h1>
                <img src="assets/Drinks.png" alt="">
            </div>
        </div>
        <button class="btn-transaction-report">Transaction Report</button>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/restaurant-home.css') }}">
@endpush

@push('scripts')
<script>
    function scrollLeftt() {
        const container = document.getElementById('scrollContainer');
        console.log("Before scrollLeft: ", container.scrollLeft);
        container.scrollBy({ left: -275, behavior: 'smooth' });
        console.log("After scrollLeft: ", container.scrollLeft);
    }

    function scrollRightt() {
        const container = document.getElementById('scrollContainer');
        container.scrollBy({ left: 275, behavior: 'smooth' });
    }
</script>
@endpush

