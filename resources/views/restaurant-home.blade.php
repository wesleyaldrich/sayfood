@extends('layout.app')
@section('title', __('restaurant.home_page_title'))

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@section('content')

    <div class="container-fluid-today-summary container-fluid my-4 px-5 d-flex flex-row justify-content-center">
        <div class="today-summary-container d-flex flex-row">
            <div class="total-orders-today text-center">
                <h5 class="today-summary-title">{{ __('restaurant.total_orders_today_title') }}</h5>
                <h2 class="today-summary-content">{{ $totalOrdersToday }} {{ __('restaurant.orders_suffix') }}</h2>
            </div>
            <div class="today-summary-divider"></div>
            <div class="total-orders-today text-center">
                <h5 class="today-summary-title">{{ __('restaurant.todays_income_title') }}</h5>
                <h2 class="today-summary-content">IDR {{ number_format($todaysIncome, 0, ',', '.') }}</h2>
            </div>
            <div class="today-summary-divider"></div>
            <div class="total-orders-today text-center">
                <h5 class="today-summary-title">{{ __('restaurant.todays_most_purchased_title') }}</h5>
                <h2 class="today-summary-content">{{ $mostPurchased }}</h2>
            </div>
        </div>
        <img class="mascot_peganghati" src="assets/mascot_peganghati.png" alt="">
    </div>

    <div class="container-fluid-order-list container-fluid my-4 px-5 d-flex justify-content-center">
        <div class="order-list-container d-flex justify-content-center align-items-center flex-column">
            <h1
                style="display:flex; width: fit-content; color: white; background: #EE8D4A; padding: 16px 40px; font-size: 2rem; font-weight: bold; border-radius: 32px; margin-bottom: 16px;">
                {{ __('restaurant.order_list_heading') }}</h1>
            @if ($orders->count() > 0)
                <div class="restaurant-order-scroll-wrapper position-relative w-100 d-flex flex-row">
                    @if ($orders->count() > 4)
                        <button class="scroll-btn left" onclick="scrollLeftt()">
                            <
                        </button>
                    @endif

                    <div id="scrollContainer" class="restaurant-order-list-container d-flex flex-row overflow-auto">
                        @foreach ($orders as $order)
                            @php
                                $date = $order->created_at->format('d M Y');
                                $profile = $order->customer->user->profile_image ?? asset('assets/example/sayfood_profile.png');
                                $name = $order->customer->user->username ?? __('restaurant.unknown_customer');

                                $groupedItems = [];

                                foreach ($order->transactions as $transaction) {
                                    $category = $transaction->food->category->name ?? __('restaurant.other_category');
                                    $groupedItems[$category][] = [
                                        'name' => $transaction->food->name,
                                        'qty'  => $transaction->qty,
                                    ];
                                }
                            @endphp

                            <x-restaurant-order-item
                                :id="$order->id"
                                :date="$date"
                                :profile="$profile"
                                :name="$name"
                                :order="$groupedItems"
                                :status="$order->status"
                            />
                        @endforeach
                    </div>
                    @if ($orders->count() > 4)
                        <button class="scroll-btn right" onclick="scrollRightt()">
                            >
                        </button>
                    @endif
                </div>
            @else
                <h2 style="font-size: 1.5rem; font-weight: bold;">{{ __('restaurant.no_pending_orders') }}</h2>
            @endif
        </div>

    </div>

    <div class="customer-review-container container-fluid my-5 py-5 px-5 d-flex flex-column justify-content-center">
        <h1 style="color: white; font-size: 2rem; font-weight: bold; text-align: center; margin-bottom: 20px;">{{ __('restaurant.new_customer_ratings_heading') }}</h1>
        @if ($reviewedOrders->count() === 0)
            <div class="text-center text-white" style="font-size: 1.5rem; font-weight: bold;">
                <h3>{{ __('restaurant.no_customer_ratings_yet') }}</h3>
            </div>
        @else
            <div class="customer-review-wrapper d-flex flex-row">
                @foreach ($reviewedOrders as $order)
                    <x-customer-review-item
                        :id="$order->id"
                        :name="$order->customer->username"
                        :rating="$order->rating"
                        :date="$order->updated_at"
                        :profile="$order->customer->profile_image"
                    />
                @endforeach
            </div>
        @endif
    </div>

    <div class="total-orders-container container-fluid my-5 py-5 px-5 d-flex flex-column justify-content-center align-items-center">
        <h1 style="font-size: 2rem; font-weight: bold; text-align: center; margin-bottom: 20px;">{{ __('restaurant.total_orders_this_week_heading') }}</h1>
        <div class="total-orders-category-container d-flex flex-row justify-content-center">
            <div class="total-orders-category-wrapper">
                <p class="total-orders-category">{{ __('restaurant.main_courses_category') }}</p>
                <h1 class="total-orders-num total-orders-maincourse">{{ $categoryCounts['Main Course'] }}</h1>
                <img src="assets/Main_Courses.png" alt="">
            </div>
            <div class="total-orders-category-wrapper">
                <p class="total-orders-category">{{ __('restaurant.desserts_category') }}</p>
                <h1 class="total-orders-num total-orders-dessert">{{ $categoryCounts['Dessert'] }}</h1>
                <img src="assets/Desserts.png" alt="">
            </div>
            <div class="total-orders-category-wrapper">
                <p class="total-orders-category">{{ __('restaurant.snacks_category') }}</p>
                <h1 class="total-orders-num total-orders-snack">{{ $categoryCounts['Snacks'] }}</h1>
                <img src="assets/Snacks.png" alt="">
            </div>
            <div class="total-orders-category-wrapper">
                <p class="total-orders-category">{{ __('restaurant.drinks_category') }}</p>
                <h1 class="total-orders-num total-orders-drink">{{ $categoryCounts['Drinks'] }}</h1>
                <img src="assets/Drinks.png" alt="">
            </div>
        </div>
        <a href="{{ route('restaurant-transactions') }}"><button class="btn-transaction-report">{{ __('restaurant.transaction_report_button') }}</button></a>
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