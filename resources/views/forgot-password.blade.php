@extends('layout.auth')
@section('title', 'Sayfood | Forgot Password Page')
@section('content')	
    <div class="auth-form-container d-flex align-items-center justify-content-center flex-column p-3" >
        <div class="container d-flex justify-content-center">
            <img src="{{ asset('assets/sayfood.png') }}" alt="Sayfood Logo" class="logo">
        </div>
        
        <h2 class="oswald mt-3 mb-2">PASSWORD RESET FORM</h2>

        <div class="container">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group mb-2">
                    <label for="email" class="oswald">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="container d-flex justify-content-center pt-3">
                    <button type="submit" class="btn btn-primary oswald auth-button ">Send Reset Link</button>
                </div>

                @if ($errors->has('error'))
                    <div class="alert alert-danger">{{ $errors->first('error') }}</div>
                @endif
                @if(session('status'))
                    <div class="alert alert-success mt-3">
                        {{ session('status') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection