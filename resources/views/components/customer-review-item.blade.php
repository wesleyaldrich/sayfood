@props(['name', 'menu', 'rating', 'date', 'profile' => 'assets/icon_profile.png'])

<div class="customer-review-item">
    <div class="customer-profile my-3 d-flex flex-row align-items-center">
        <img class="profpic" src="{{ $profile }}" alt="">
        <div class="name-role">
            <p class="customer-name">{{ $name }}</p>
            <div class="rating-wrapper d-flex flex-row align-items-center">
                <img src="assets/icon_star.png" alt="" style="width: 20px; height: 20px; margin-right: 5px;">
                <p><span class="rating">{{ $rating }}</span>/5</p>
            </div>
        </div>
    </div>
    <p class="date">{{ $date }}</p>
</div>
