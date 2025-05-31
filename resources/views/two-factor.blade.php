@extends('layout.auth')
@section('title', 'Sayfood | Register Page')
@section('content')	
    <div class="auth-form-container d-flex align-items-center justify-content-center flex-column p-3" >
        <div class="container d-flex justify-content-center">
            <img src="{{ asset('assets/sayfood.png') }}" alt="Sayfood Logo" class="logo">
        </div>
        
        <h2 class="oswald mt-3 mb-2">REGISTER</h2>

        <div class="container">
            <form action=" {{ route('twofactor.submit') }} " method="POST">
                @csrf

                <div class="form-group mb-2">
                    <label for="otp" class="oswald">OTP CODE</label>
                    <input type="text" class="form-control" id="otp" name="otp" maxlength="6" required>
                </div>

                <div class="container d-flex justify-content-center pt-3">
                    <button type="submit" class="btn btn-primary oswald auth-button ">Register</button>
                </div>
            </form>

            {{-- Resend OTP --}}
            <div class="container d-flex justify-content-center pt-3">
                <form id="resend-otp-form" action="{{ route('twofactor.resend') }}" method="POST" style="display: inline;">
                    @csrf
                    <a href="#" class="oswald" onclick="event.preventDefault(); document.getElementById('resend-otp-form').submit();">Resend OTP</a>
                </form>
            </div>
        </div>
    </div>
@endsection
