<header>
    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/sayfood.png') }}" alt="Logo">
        </a>
    </div>
    <div class="right">
        <nav>
            <ul>
                <li><a href="{{ url('/') }}" class="oswald nav-button nav-active">HOME</a></li>
                <li><a href="{{ url('/foods') }}" class="oswald nav-button">FOODS</a></li>
                <li><a href="{{ url('/events') }}" class="oswald nav-button">EVENTS</a></li>
                <li><a href="{{ url('/activity') }}" class="oswald nav-button">ACTIVITY</a></li>
            </ul>
        </nav>
        <div class="icons">
            <a href="{{ url('/notifs') }}">
                <img src="{{ asset('assets/icon_notif.png') }}" alt="Notification Icon" class="notif-icon-img">
            </a>
            <a href="{{ url('/profile') }}">
                <img src="{{ asset('assets/icon_profile.png') }}" alt="Profile Icon" class="profile-icon-img">
            </a>
        </div>
    </div>
</header>