@extends('layout.auth')
@section('title', 'Sayfood | Restaurant Login Page')
@section('content')	
    <div class="auth-form-container d-flex align-items-center justify-content-center flex-column p-3" >
        <div class="container d-flex justify-content-center">
            <img src="{{ asset('assets/sayfood.png') }}" alt="Sayfood Logo" class="logo">
        </div>
        
        <h2 class="oswald mt-3 mb-2">LOGIN</h2>

        <div class="container">
            <form action=" {{ route('login.restaurant') }} " method="POST">
                @csrf

                <div class="form-group mb-2">
                    <label for="name" class="oswald">Restaurant Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="form-group mb-2">
                    <label for="password" class="oswald">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="container d-flex justify-content-center pt-3">
                    <button type="submit" class="btn btn-primary oswald auth-button ">Log in</button>
                </div>
            </form>

            <div class="container d-flex justify-content-center mt-3">
                <p class="oswald m-0" style="font-weight: 400">Don't have an account? <a href="{{ route('show.register.restaurant') }}">Register</a></p>
            </div>
        </div>
    
    </div>
@endsection
