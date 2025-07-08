<header>
    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/sayfood.png') }}" alt="Logo">
        </a>
    </div>
    <div class="icon-hamburger">
        <img src="{{ asset('assets/icon_hamburgermenu.png') }}" alt="Hamburger Icon" class="hamburger-icon-img">
    </div>
    <div class="right">
        <nav>
            <ul class="oswald">
                <li><a href="{{ route('restaurant-home') }}" class="oswald nav-button {{ request()->routeIs('restaurant-home') ? 'nav-active' : '' }}">HOME</a></li>
                <li><a href="{{ route('manage.food.restaurant') }}" class="oswald nav-button {{ request()->routeIs('manage.food.restaurant') ? 'nav-active' : '' }}">FOODS</a></li>
                <li><a href="{{ route('foods') }}" class="oswald nav-button {{ request()->routeIs('foods') ? 'nav-active' : '' }}">ORDERS</a></li>
                <li><a href="{{ route('events') }}" class="oswald nav-button {{ request()->routeIs('events') ? 'nav-active' : '' }}">EVENTS</a></li>
                <li><a href="{{ route('activity') }}" class="oswald nav-button {{ request()->routeIs('activity') ? 'nav-active' : '' }}">ACTIVITY</a></li>
                <li class="nav-hide"><a href="{{ route('profile') }}" class="oswald nav-button {{ request()->routeIs('profile') ? 'nav-active' : '' }}">PROFILE</a></li>
            </ul>
        </nav>
        <div class="icons">
            <a id="openOffcanvasNotif" href="#" role="button">
                <img src="{{ asset('assets/icon_notif.png') }}" alt="Notification Icon" class="notif-icon-img">
            </a>
            <div class="icon-language">
                <img src="{{ asset('assets/icon_globe.png') }}" alt="Language Icon" class="language-icon-img">
            </div>
            <a href="{{ route('profile') }}">
                @if (Auth::check() && Auth::user()->two_factor_verified)
                    <img src="{{ Auth::user()->profile_image
                        ? asset('storage/' . Auth::user()->profile_image)
                        : asset('assets/example/profile.jpg') }}"
                        alt="Profile Icon" class="profile-icon-img" style="width: 40px; border-radius: 50%; border: 2px solid #234c4c; object-fit: cover;">
                @else
                    <img src="{{ asset('assets/icon_profile.png') }}" alt="Profile Icon" class="profile-icon-img">
                @endif
            </a>
        </div>
    </div>

    <nav class="dropdown-nav">
        <ul>
            <li class="{{ request()->routeIs('restaurant-home') ? 'nav-active' : '' }}">
                <a href="{{ route('restaurant-home') }}" class="oswald nav-button">HOME</a>
            </li>
            <li class="{{ request()->routeIs('manage.food.restaurant') ? 'nav-active' : '' }}">
                <a href="{{ route('manage.food.restaurant') }}" class="oswald nav-button">FOODS</a>
            </li>
            <li class="{{ request()->routeIs('foods') ? 'nav-active' : '' }}">
                <a href="{{ route('foods') }}" class="oswald nav-button">ORDERS</a>
            </li>
            <li class="{{ request()->routeIs('events') ? 'nav-active' : '' }}">
                <a href="{{ route('events') }}" class="oswald nav-button">EVENTS</a>
            </li>
            <li class="{{ request()->routeIs('activity') ? 'nav-active' : '' }}">
                <a href="{{ route('activity') }}" class="oswald nav-button">ACTIVITY</a>
            </li>
            <li class="{{ request()->routeIs('profile') ? 'nav-active' : '' }}">
                <a href="{{ route('profile') }}" class="oswald nav-button">PROFILE</a>
            </li>
        </ul>
    </nav>


    <div class="dropdown-language">
        <ul>
            <li class="language-active"><a href="#" class="oswald">English</a></li>
            <li><a href="#" class="oswald">Indonesian</a></li>
        </ul>
    </div>
</header>

<div id="notifOffcanvas" class="offcanvas-notif">
    <div class="offcanvas-header">
        <h4>Notifications</h4>
        <button id="closeOffcanvas" class="close-btn">&times;</button>
    </div>
    <div class="offcanvas-body">
        @for ($i = 0; $i < 10; $i++)
            <x-notification-card 
                title="Welcome to SayFood!" 
                desc="Hi Adit! Thanks for joining SayFood. Let’s start saving food together! 😋🍉" 
                time="25 days ago" 
            />
        @endfor
    </div>
</div>

<div id="offcanvasOverlay" class="offcanvas-overlay"></div>