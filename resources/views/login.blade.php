@extends('layout.empty')
@section('title', 'Sayfood | Login Selection Page')
@section('content')	
    <div class="top-decor d-flex flex-direction-row justify-content-between">
        <div class="decor">
            <img src="{{ asset('assets/circles-top-left.png') }}" alt="decor top left">
        </div>
        <div class="decor">
            <img src="{{ asset('assets/circles-top-right.png') }}" alt="decor top right">
        </div>
    </div>
    
    <div class="master-container d-flex justify-content-around align-items-center flex-column">
        <div class="mb-5 logo-container d-flex justify-content-center align-items-center">
            <img src="{{ asset('assets/sayfood.png') }}" alt="Sayfood Logo" class="logo">
        </div>
        <div class="container-lg">
            <div class="box-selection mb-5 d-flex flex-row justify-content-center align-items-center flex-wrap">
                <a href=" {{ route('show.login') }}">
                    <div class="auth-box d-flex justify-content-center align-items-center flex-column">
                        <img src="{{ asset('assets/login_customer_icon.png') }}" alt="customer login icon">
                        <h3 class="text-center oswald">{{ __('profile.login_as_customer') }}</h3>
                    </div>
                </a>
                <a href=" {{ route('show.login.restaurant') }}">
                    <div class="auth-box d-flex justify-content-center align-items-center flex-column">
                        <img src="{{ asset('assets/login_restaurant_icon.png') }}" alt="restaurant login icon">
                        <h3 class="text-center oswald">{{ __('profile.login_as_restaurant') }}</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
