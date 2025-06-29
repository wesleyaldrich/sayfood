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
            <ul>
                <li>
                    <a href="{{ url('/') }}" class="oswald nav-button {{ Request::is('/') ? 'nav-active' : '' }}">HOME</a>
                </li>
                <li>
                    <a href="{{ url('/foods') }}" class="oswald nav-button {{ Request::is('foods') ? 'nav-active' : '' }}">FOODS</a>
                </li>
                <li>
                    <a href="{{ url('/charity') }}" class="oswald nav-button {{ Request::is('charity') ? 'nav-active' : '' }}">EVENTS</a>
                </li>
                <li>
                    <a href="{{ url('/activity') }}" class="oswald nav-button {{ Request::is('activity') ? 'nav-active' : '' }}">ACTIVITY</a>
                </li>
                <li class="nav-hide">
                    <a href="{{ url('/profile') }}" class="oswald nav-button {{ Request::is('profile') ? 'nav-active' : '' }}">PROFILE</a>
                </li>
            </ul>
        </nav>
        <div class="icons">
            <a id="openOffcanvasNotif" href="#" role="button">
                <img src="{{ asset('assets/icon_notif.png') }}" alt="Notification Icon" class="notif-icon-img">
            </a>
            <div class="icon-language">
                <img src="{{ asset('assets/icon_globe.png') }}" alt="Language Icon" class="language-icon-img">
            </div>
            <a href="{{ url('/profile') }}">
                <img src="{{ asset('assets/icon_profile.png') }}" alt="Profile Icon" class="profile-icon-img">
            </a>
        </div>
    </div>

    <nav class="dropdown-nav">
        <ul>
            <li class="{{ Request::is('/') ? 'nav-active' : '' }}">
                <a href="{{ url('/') }}" class="oswald nav-button">HOME</a>
            </li>
            <li class="{{ Request::is('foods') ? 'nav-active' : '' }}">
                <a href="{{ url('/foods') }}" class="oswald nav-button">FOODS</a>
            </li>
            <li class="{{ Request::is('charity') ? 'nav-active' : '' }}">
                <a href="{{ url('/charity') }}" class="oswald nav-button">EVENTS</a>
            </li>
            <li class="{{ Request::is('activity') ? 'nav-active' : '' }}">
                <a href="{{ url('/activity') }}" class="oswald nav-button">ACTIVITY</a>
            </li>
            <li class="{{ Request::is('profile') ? 'nav-active' : '' }}">
                <a href="{{ url('/profile') }}" class="oswald nav-button">PROFILE</a>
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