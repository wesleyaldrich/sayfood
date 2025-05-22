@extends('layout.app')
@section('title', 'Home Page')
@section('content')	
<div class="container-fluid">
    {{-- BAGIAN HERO SECTION --}}
    <div class="row gx-5">
        {{-- disini coding sebelah kiri --}}
        <div class="col-8">
            <div class="home-header">
                <h1 class="oswald">WELCOME TO</h1>
                <h1 class="oswald">
                    <span style="color: #FEA322;">SAY</span>FOOD
                </h1>
                <p class="lato-bold-italic">Good food, better cause.</p>
                <p class="lato-regular">Get affordable rescued meals and fight food waste!</p>
                <p class="lato-regular">Join us as a volunteer to share meals and share kindness.</p>
                <div class="link-button-home">
                    <a href="{{ url('/foods') }}" class="oswald btn btn-custom-menu rounded-pill btn-lg">SEE MENUS</a>
                    <a href="{{ url('/charity') }}" class="oswald btn btn-custom-join rounded-pill btn-lg">JOIN EVENT</a>
                </div>
            </div>
        </div>
        {{-- disini coding sebelah kanan --}}
        <div class="col-4">
            <h1>GAMBAR DISINI</h1>
        </div>
    </div>
</div>
    @endsection
