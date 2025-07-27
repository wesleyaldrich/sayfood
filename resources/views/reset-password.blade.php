@extends('layout.auth')
@section('title', __('profile.forgot_password_title'))
@section('content')
    <div class="auth-form-container d-flex align-items-center justify-content-center flex-column p-3" >
        <div class="container d-flex justify-content-center">
            <img src="{{ asset('assets/sayfood.png') }}" alt="Sayfood Logo" class="logo">
        </div>

        <h2 class="oswald mt-3 mb-2">{{ __('profile.password_reset_form_heading') }}</h2>

        <div class="container">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="form-group mb-2">
                    <label for="password" class="oswald">{{ __('profile.new_password_label') }}</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="confirmPassword" class="oswald">{{ __('profile.confirm_password_label') }}</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>

                <div class="container d-flex justify-content-center pt-3">
                    <button type="submit" class="btn btn-primary oswald auth-button ">{{ __('profile.reset_password_button') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection