@extends('layout.auth')
@section('title', 'Sayfood | Restaurant Register Page')
@section('content')	
    <div class="auth-form-container d-flex align-items-center justify-content-center flex-column p-3" >
        <div class="container d-flex justify-content-center">
            <img src="{{ asset('assets/sayfood.png') }}" alt="Sayfood Logo" class="logo">
        </div>
        
        <h2 class="oswald mt-3 mb-2">REGISTER</h2>

        <div class="container">
            <form action=" {{ route('register.restaurant') }} " method="POST">
                @csrf

                <div class="form-group mb-2">
                    <label for="name" class="oswald">Restaurant Name</label>
                    <input type="text" class="form-control" id="restaurant-name" name="name" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- long input for address --}}
                <div class="form-group mb-2">
                    <label for="address" class="oswald">Restaurant Address</label>
                    <input type="text" class="form-control" id="restaurant-address" name="address" required>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="email" class="oswald">Contact E-mail</label>
                    <input type="email" class="form-control" id="restaurant-email" name="email" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="container d-flex justify-content-center pt-3">
                    <button type="submit" class="btn btn-primary oswald auth-button ">Register</button>
                </div>
            </form>

            <div class="container d-flex justify-content-center mt-3">
                <p class="oswald m-0" style="font-weight: 400">Already have an account? <a href="{{ route('show.login.restaurant') }}">Login</a></p>
            </div>
        </div>
    </div>
@endsection
