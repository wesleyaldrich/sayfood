@props(['date', 'profile', 'name', 'order'])

<div class="restaurant-order-item d-flex flex-column">
    <p class="date">{{ $date }}</p>
    <div class="customer-profile my-3 d-flex flex-row align-items-center">
        <img class="profpic" src="{{ $profile }}" alt="">
        <div class="name-role">
            <p class="customer-name">{{ $name }}</p>
            <p>Customer</p>
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

    <div class="buttons d-flex mt-2">
        <button class="btn-accept">Accept</button>
    </div>
</div>
