@extends('layout.auth')
@section('title', 'Sayfood | Customer Login Page')
@section('content')	
    <div class="auth-form-container d-flex align-items-center justify-content-center flex-column p-3" >
        <div class="container d-flex justify-content-center">
            <img src="{{ asset('assets/sayfood.png') }}" alt="Sayfood Logo" class="logo">
        </div>
        
        <h2 class="oswald mt-3 mb-2">LOGIN</h2>

        <div class="container">
            <form action=" {{ route('login') }} " method="POST">
                @csrf

                <div class="form-group mb-2">
                    <label for="name" class="oswald">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                    @error('username')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="password" class="oswald">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                @error('credentials')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="container d-flex justify-content-center pt-3">
                    <button type="submit" class="btn btn-primary oswald auth-button ">Log in</button>
                </div>

                <div class="container d-flex justify-content-center mt-3">
                    <a href="{{ route('auth.google.redirect') }}">
                        <div class="d-flex flex-row align-items-center google-auth-button p-1 pr-3">
                            <div class="google-icon-container d-flex justify-content-center align-items-center">
                                <img src="{{ asset('assets/google_icon.png') }}" alt="Google Icon" class="google-icon">
                            </div>
                            <p class="oswald m-0 ml-2">Sign in with Google</p>
                        </div>
                    </a>
                </div>
            </form>
            
            <div class="container d-flex justify-content-center mt-3">
                <p class="oswald m-0" style="font-weight: 400"><a href="{{ route('password.request') }}">Forgot password?</a></p>
            </div>

            <div class="container d-flex justify-content-center">
                <p class="oswald m-0" style="font-weight: 400">Don't have an account? <a href="{{ route('show.register') }}">Register</a></p>
            </div>
        </div>
    </div>
@endsection
