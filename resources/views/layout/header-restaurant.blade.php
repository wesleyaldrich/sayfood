<header>
    <div class="logo">
        <a href="{{ route('restaurant-home') }}">
            <img src="{{ asset('assets/sayfood.png') }}" alt="Logo">
        </a>
    </div>
    <div class="icon-hamburger">
        <img src="{{ asset('assets/icon_hamburgermenu.png') }}" alt="Hamburger Icon" class="hamburger-icon-img">
    </div>
    <div class="right">
        {{-- DESKTOP NAVBAR --}}
        <nav>
            <ul class="oswald">
                <li><a href="{{ route('restaurant-home') }}" class="oswald nav-button {{ request()->routeIs('restaurant-home') ? 'nav-active' : '' }}">{{ __('navigation.home') }}</a></li>
                <li><a href="{{ route('manage.food.restaurant') }}" class="oswald nav-button {{ request()->routeIs('manage.food.restaurant') ? 'nav-active' : '' }}">{{ __('navigation.foods') }}</a></li>
                <li><a href="{{ route('restaurant-orders') }}" class="oswald nav-button {{ request()->routeIs('restaurant-orders') ? 'nav-active' : '' }}">{{ __('navigation.orders') }}</a></li>
                <li><a href="{{ route('restaurant-activity') }}" class="oswald nav-button {{ request()->routeIs('restaurant-activity') ? 'nav-active' : '' }}">{{ __('navigation.activity') }}</a></li>
                <li class="nav-hide"><a href="{{ route('profile') }}" class="oswald nav-button {{ request()->routeIs('profile') ? 'nav-active' : '' }}">{{ __('navigation.profile') }}</a></li>
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
                        ? asset('' . Auth::user()->profile_image)
                        : asset('assets/example/profile.jpg') }}"
                        alt="Profile Icon" class="profile-icon-img" style="width: 40px; border-radius: 50%; border: 2px solid #234c4c; object-fit: cover;">
                @else
                    <img src="{{ asset('assets/icon_profile.png') }}" alt="Profile Icon" class="profile-icon-img">
                @endif
            </a>
        </div>
    </div>

    {{-- MOBILE NAVBAR --}}
    <nav class="dropdown-nav">
        <ul>
            <li class="{{ request()->routeIs('restaurant-home') ? 'nav-active' : '' }}">
                <a href="{{ route('restaurant-home') }}" class="oswald nav-button">{{ __('navigation.home') }}</a>
            </li>
            <li class="{{ request()->routeIs('manage.food.restaurant') ? 'nav-active' : '' }}">
                <a href="{{ route('manage.food.restaurant') }}" class="oswald nav-button">{{ __('navigation.foods') }}</a>
            </li>
            <li class="{{ request()->routeIs('restaurant-orders') ? 'nav-active' : '' }}">
                <a href="{{ route('restaurant-orders') }}" class="oswald nav-button">{{ __('navigation.orders') }}</a>
            </li>
            <li class="{{ request()->routeIs('restaurant-activity') ? 'nav-active' : '' }}">
                <a href="{{ route('restaurant-activity') }}" class="oswald nav-button">{{ __('navigation.activity') }}</a>
            </li>
            <li class="{{ request()->routeIs('profile') ? 'nav-active' : '' }}">
                <a href="{{ route('profile') }}" class="oswald nav-button">{{ __('navigation.profile') }}</a>
            </li>
        </ul>
    </nav>


    <div class="dropdown-language">
        <ul>
            <li class="{{ app()->getLocale() == 'en' ? 'language-active' : '' }}">
                <a href="{{ url('lang/en') }}" class="oswald">English</a>
            </li>
            <li class="{{ app()->getLocale() == 'id' ? 'language-active' : '' }}">
                <a href="{{ url('lang/id') }}" class="oswald">Bahasa Indonesia</a>
            </li>
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