<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/header.js') }}" defer></script>
    @stack('styles')
</head>

<body>
    @if (Auth::check() && Auth::user()->role === 'restaurant')
    @include('layout.header-restaurant')
    @else
    @include('layout.header')
    @endif

    <div class="sayfood-content-container">
        @if ($errors->has('error'))
        <div class="alert alert-danger">
            <div class="alert alert-danger">
                {{ $errors->first('error') }}
            </div>
        </div>
        @endif

        @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        @yield('content')
    </div>

    {{-- Badge Keranjang & Resto (logic di CartComposer) --}}
    @if(isset($cartItemCount))
    <div style="position: relative; width: fit-content;">
        <a href="{{ route('show.cart') }}">
            <img class="mycart" src="{{ asset('assets/icon_mycart.png') }}" alt="mycart">
        </a>

        @if($cartItemCount > 0 && $cartRestaurant)
        <span class="cart-badge">{{ $cartItemCount}}</span>
        <div class="cart-resto-badge" style="z-index: 5; bottom: 50px; right: 120px; ">
            <p class="mb-2">{{ $cartRestaurant->name}}</p>
            <a href="{{ route('resto.show', $cartRestaurant->id) }}" class="btn"
                style="background:#D9534F; color: white; font-size: 12px; border-radius: 15px;">{{ __('foods.visit') }}
                RESTO</a>
        </div>
        @else
        <span class="cart-badge">0</span>
        @endif

    </div>
    @endif


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>


    @include('layout.footer')
    @stack('scripts')
    <script>
        window.addEventListener('load', function () {
            const alerts = document.querySelectorAll('.alert');

            if (alerts.length > 0) {
                alerts.forEach(function (alert) {
                    setTimeout(function () {
                        alert.classList.add('show');
                    },);

                    setTimeout(function () {
                        alert.classList.remove('show');

                        setTimeout(function () {
                            if (alert.parentNode) {
                                alert.parentNode.removeChild(alert);
                            }
                        }, 1000);

                    }, 3000);
                });
            }
        });
    </script>

</body>

</html>