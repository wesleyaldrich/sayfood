@extends('layout.app')
@section('title')
    Restaurant Manage Food Page
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('css/resto-food.css') }}">

<div class="upper-section d-flex">
    <div class="title">
        <h1>LET'S MANAGE YOUR FOOD!</h1>
    </div>
    <div class="search-bar">
        <form class="d-flex" role="search">
            <button class="btn btn-warning" type="submit">
                <img src="assets/icon_search.png" alt="search" class="w-5">
            </button>
            <input class="form-control" type="search" placeholder="Search" aria-label="Search"/>
        </form>
    </div>
</div>

<p class="subtitle ml-4">
    {{$restaurant->name}}'s food list
</p>
<div class="d-flex mx-4 my-2">
    <button class="filter-btn mr-1" type="submit">All</button>
    <button class="filter-btn mx-1" type="submit">Main Course</button>
    <button class="filter-btn mx-1" type="submit">Dessert</button>
    <button class="filter-btn mx-1" type="submit">Snack</button>
    <button class="filter-btn mx-1" type="submit">Drink</button>
</div>
<table class="table">
  <thead class="thead">
    <tr>
        <th scope="col">No</th>
        <th scope="col">Food Name</th>
        <th scope="col">Food Description</th>
        <th scope="col">Expiration Time</th>
        <th scope="col">Category</th>
        <th scope="col">Stock</th>
        <th scope="col">Status</th>
        <th scope="col">
            <button type="button" class="add-btn btn-success w-75">+ Add Food</button>
        </th>
    </tr>
</thead>
<tbody class="tbody">
    @foreach ($foods as $food)
        <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$food->name}}</td>
        <td>{{$food->description}}</td>
        <td>{{$food->exp_datetime}}</td>
        <td>{{$food->category->name}}</td>
        <td>{{$food->stock}}</td>
        <td>{{$food->status}}</td>
        <td>
            <div class="manage-button d-flex">
                <button type="button" class="edit-btn btn-warning mx-1">Edit</button>
                <button type="button" class="delete-btn btn-danger mx-1">Delete</button>
            </div>
        </td>
        </tr>
    @endforeach
</tbody>
</table>
@endsection
