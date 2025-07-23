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
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <li class="nav-item dropdown admin-nav-item">
                        <a class="admin-nav-link dropdown-toggle p-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('navigation.admin') }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#2">REVIEW REPORT</a></li>
                            <li><a class="dropdown-item" href="#3">MANAGE RESTAURANT</a></li>
                            <li><a class="dropdown-item" href="#4">MANAGE EVENT</a></li>
                        </ul>
                    </li>
                @endif
                <li><a href="{{ route('home') }}" class="oswald nav-button {{ request()->routeIs('home') ? 'nav-active' : '' }}">{{ __('navigation.home') }}</a></li>
                <li><a href="{{ route('foods') }}" class="oswald nav-button {{ request()->routeIs('foods') ? 'nav-active' : '' }}">{{ __('navigation.foods') }}</a></li>
                <li><a href="{{ route('events') }}" class="oswald nav-button {{ request()->routeIs('events') ? 'nav-active' : '' }}">{{ __('navigation.events') }}</a></li>
                <li><a href="{{ route('activity') }}" class="oswald nav-button {{ request()->routeIs('activity') ? 'nav-active' : '' }}">{{ __('navigation.activity') }}</a></li>
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

    <nav class="dropdown-nav">
        <ul>
            <li class="{{ request()->routeIs('home') ? 'nav-active' : '' }}">
                <a href="{{ route('home') }}" class="oswald nav-button">{{ __('navigation.home') }}</a>
            </li>
            <li class="{{ request()->routeIs('foods') ? 'nav-active' : '' }}">
                <a href="{{ route('foods') }}" class="oswald nav-button">{{ __('navigation.foods') }}</a>
            </li>
            <li class="{{ request()->routeIs('events') ? 'nav-active' : '' }}">
                <a href="{{ route('events') }}" class="oswald nav-button">{{ __('navigation.events') }}</a>
            </li>
            <li class="{{ request()->routeIs('activity') ? 'nav-active' : '' }}">
                <a href="{{ route('activity') }}" class="oswald nav-button">{{ __('navigation.activity') }}</a>
            </li>
            <li class="{{ request()->routeIs('profile') ? 'nav-active' : '' }}">
                <a href="{{ route('profile') }}" class="oswald nav-button">{{ __('navigation.profile') }}</a>
            </li>

            
            @if (Auth::check() && Auth::user()->role === 'admin')
                <li class="p-0"><hr class="dropdown-divider"></li>
                <li class="">
                    <a href="#" class="oswald nav-button">REVIEW REPORT</a>
                </li>
                <li class="">
                    <a href="#" class="oswald nav-button">{{ __('navigation.manage_restaurant') }}</a>
                </li>
                <li class="">
                    <a href="#" class="oswald nav-button">{{ __('navigation.manage_event') }}</a>
                </li>
            @endif
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
        <h4>{{ __('navigation.notification') }}</h4>
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