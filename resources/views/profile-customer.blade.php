@extends('layout.app')
@section('title', __('profile.customer_profile_page_title'))
@section('content')
    {{-- {{$user}} --}}

    <div class="d-flex flex-column mb-5">
        <div class="container-fluid profile-heading"></div>
        <div class="profile-content d-flex flex-column align-items-center">
            <div class="profile-image-container mb-4">
                <form action="{{ route('update.profile.image') }}" method="POST" enctype="multipart/form-data" id="profile-image-form">
                    @csrf
                    <label for="profile-image-input" style="cursor:pointer;">
                        <img class="profile-image" src="{{ $user->profile_image ? asset('' . $user->profile_image) : asset('assets/example/sayfood_profile.png') }}" alt="{{ __('profile.profile_image_alt') }}" id="profile-image-preview">
                        <input type="file" name="profile_image" id="profile-image-input" accept="image/*" style="display:none;" onchange="document.getElementById('profile-image-form').submit();">
                    </label>
                </form>
            </div>
            <div class="profile-details container-fluid flex-1 flex-column align-items-center justify-content-center">
                @error('profile_image')
                    <div class="text-danger text-center">{{ $message }}</div>
                @enderror
                <form action=" {{ route('update.profile') }} " method="POST" class="d-flex flex-column justify-content-between align-items-center">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="username" class="oswald">{{ __('profile.username_label') }}</label>
                        <input type="text" class="oswald form-control" id="username" name="username" autocomplete="on" required value="{{ $user->username }}">
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if (Auth::user()->role === 'customer')
                        <div class="form-group mb-3">
                            <label for="dob" class="oswald">{{ __('profile.dob_label') }}</label>
                            <input type="date" class="oswald form-control" id="dob" name="dob" autocomplete="on" value="{{ $user->customer->dob }}">
                            @error('dob')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="address" class="oswald">{{ __('profile.address_label') }}</label>
                            <input type="text" class="oswald form-control" id="address" name="address" autocomplete="on" value="{{ $user->customer->address }}">
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    @error('profile-update')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="profile-update-btn-container d-flex flex-row justify-content-center align-items-center py-3">
                        <div class="row justify-content-around">
                            <a href="{{ route('profile') }}" class="col-sm-5 btn oswald profile-update-btn" dusk="cancel-changes-btn">{{ __('profile.cancel_changes_button') }}</a>
                            <button type="submit" class="col-sm-5 btn oswald profile-update-btn" dusk="save-changes-btn">{{ __('profile.save_changes_button') }}</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="container-fluid d-flex justify-content-center align-items-center">
                @if (Auth::user()->role === 'customer')
                    <div class="profile-options justify-content-around row mt-5">
                        <form id="login-as-restaurant-form" method="POST" action="{{ route('login.as.restaurant') }}" style="display: none;">@csrf</form>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">@csrf</form>
                        <form id="delete-account-form" method="POST" action="{{ route('delete.account') }}" style="display: none;">@csrf</form>

                        <a href="{{ route('login.as.restaurant') }}"
                        onclick="
                            event.preventDefault();
                            document.getElementById('login-as-restaurant-form').submit();"
                        class="profile-option mb-2 col-md-5 d-flex flex-row align-items-center justify-content-start px-0">
                            <img src="{{ asset('assets/profile_option_login_as_restaurant.png') }}" class="p-2" alt="icon">
                            <p class="oswald">{{ __('profile.login_as_restaurant_button') }}</p>
                        </a>
                        <a href="{{ route('logout') }}"
                        onclick="
                            event.preventDefault();
                            document.getElementById('logout-form').submit();"
                        class="profile-option mb-2 col-md-5 d-flex flex-row align-items-center justify-content-start px-0" dusk="logout-btn">
                            <img src="{{ asset('assets/profile_option_logout.png') }}" class="p-2" alt="icon">
                            <p class="oswald">{{ __('profile.logout_button') }}</p>
                        </a>
                        <a href="{{ route('password.request') }}"
                        class="profile-option mb-2 col-md-5 d-flex flex-row align-items-center justify-content-start px-0">
                            <img src="{{ asset('assets/profile_option_reset_password.png') }}" class="p-2" alt="icon">
                            <p class="oswald">{{ __('profile.reset_password_button') }}</p>
                        </a>
                        <a href="{{ route('delete.account') }}"
                        onclick="
                            event.preventDefault();
                            document.getElementById('delete-account-form').submit()"
                        class="profile-option mb-2 col-md-5 d-flex flex-row align-items-center justify-content-start px-0">
                            <img src="{{ asset('assets/profile_option_delete.png') }}" class="p-2" alt="icon" dusk="delete-account-btn">
                            <p class="oswald">{{ __('profile.delete_account_button') }}</p>
                        </a>
                    </div>
                @else
                    <div class="profile-options justify-content-around row mt-5">
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">@csrf</form>
                        <a href="{{ route('logout') }}"
                        onclick="
                            event.preventDefault();
                            document.getElementById('logout-form').submit();"
                        class="profile-option mb-2 col-md-5 d-flex flex-row align-items-center justify-content-start px-0">
                            <img src="{{ asset('assets/profile_option_logout.png') }}" class="p-2" alt="icon">
                            <p class="oswald">{{ __('profile.logout_button') }}</p>
                        </a>
                        <a href="{{ route('password.request') }}"
                        class="profile-option mb-2 col-md-5 d-flex flex-row align-items-center justify-content-start px-0">
                            <img src="{{ asset('assets/profile_option_reset_password.png') }}" class="p-2" alt="icon">
                            <p class="oswald">{{ __('profile.reset_password_button') }}</p>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush