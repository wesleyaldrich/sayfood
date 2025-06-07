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
                <li><a href="{{ route('home') }}" class="oswald nav-button nav-active">HOME</a></li>
                <li><a href="{{ route('foods') }}" class="oswald nav-button">FOODS</a></li>
                <li><a href="{{ route('charity') }}" class="oswald nav-button">EVENTS</a></li>
                <li><a href="{{ route('activity') }}" class="oswald nav-button">ACTIVITY</a></li>
                <li><a href="{{ route('profile') }}" class="oswald nav-button nav-hide">PROFILE</a></li>
            </ul>
        </nav>
        <div class="icons">
            <a href="{{ url('/notifs') }}">
                <img src="{{ asset('assets/icon_notif.png') }}" alt="Notification Icon" class="notif-icon-img">
            </a>
            <img src="{{ asset('assets/icon_globe.png') }}" alt="Language Icon" class="language-icon-img">
            <a href="{{ url('/profile') }}">
                <img src="{{ asset('assets/icon_profile.png') }}" alt="Profile Icon" class="profile-icon-img">
            </a>
        </div>
    </div>

    <nav class="dropdown-nav">
        <ul>
            <li class="nav-active"><a href="{{ url('/') }}" class="oswald nav-button">HOME</a></li>
            <li><a href="{{ url('/foods') }}" class="oswald nav-button">FOODS</a></li>
            <li><a href="{{ url('/charity') }}" class="oswald nav-button">EVENTS</a></li>
            <li><a href="{{ url('/activity') }}" class="oswald nav-button">ACTIVITY</a></li>
            <li><a href="{{ url('/profile') }}" class="oswald nav-button">PROFILE</a></li>
        </ul>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hamburgerIcon = document.querySelector('.icon-hamburger');
        const dropdownNav = document.querySelector('header .dropdown-nav');

        hamburgerIcon.addEventListener('click', function () {
            dropdownNav.classList.toggle('show');
        });

        // Optional: close if clicked outside
        document.addEventListener('click', function (e) {
            const isClickInside = dropdownNav.contains(e.target) || hamburgerIcon.contains(e.target);
            if (!isClickInside) {
                dropdownNav.classList.remove('show');
            }
        });
    });
</script>



