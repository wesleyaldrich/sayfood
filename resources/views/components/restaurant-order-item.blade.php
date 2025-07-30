@props(['id', 'date', 'profile', 'name', 'order', 'status'])

<div class="restaurant-order-item d-flex flex-column">
    <p class="date">{{ $date }}</p>
    <div class="customer-profile my-3 d-flex flex-row align-items-center">
        <img class="profpic" src="{{ $profile }}" alt="" style="object-fit: cover">
        <div class="name-role">
            <p class="customer-name">{{ $name }}</p>
            <p>{{ __('restaurant.customer_role') }}</p>
        </div>
    </div>

    <div class="container px-0">
        @foreach ($order as $category => $items)
            <h5 class="food-category">{{ $category }}</h5>
            <ul class="list-unstyled pl-4 mb-2">
                @foreach ($items as $item)
                    <li class="d-flex justify-content-between">
                        <span>{{ $item['name'] }}</span>
                        <span>{{ $item['qty'] }}</span>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </div>

    <form class="buttons d-flex mt-2" action="{{ route('restaurant-orders.update-status', $id) }}" method="POST">
        @csrf
        @if ($status === 'Order Created')
            <button class="btn-accept" style="background-color: #007771;">{{ __('restaurant.order_created_status_button') }}</button>
        @elseif ($status === 'Ready to Pickup')
            <button class="btn-accept" style="background-color: #FEA322;">{{ __('restaurant.ready_to_pickup_status_button') }}</button>
        @elseif ($status === 'Order Completed' || $order->status === 'Order Reviewed')
            <button class="btn-accept" style="background-color: #4D4D4C;">{{ __('restaurant.completed_status_button') }}</button>
        @endif
    </form>
</div>