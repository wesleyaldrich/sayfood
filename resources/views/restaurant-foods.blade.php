@extends('layout.app')
@section('title')
    Restaurant Manage Food Page
@endsection

<script src="{{ asset('js/resto-food-filter.js') }}" defer></script>

@section('content')
<link rel="stylesheet" href="{{ asset('css/resto-food.css') }}">

<div class="upper-section d-flex">
    <div class="title">
        <h1>LET'S MANAGE YOUR FOOD!</h1>
    </div>
    <div class="search-bar d-flex">
        {{-- <form class="d-flex" role="search"> --}}
            <button class="btn btn-warning" type="button">
                <img src="assets/icon_search.png" alt="search" class="w-5">
            </button>
            <input class="form-control" id="searchInput" type="search" placeholder="Search food name..." aria-label="Search"/>
        {{-- </form> --}}
    </div>
</div>

<p class="subtitle ml-4">
    {{$restaurant->name}}'s food list
</p>
<div class="tab-control d-flex mx-4 my-2">
    <button class="filter-btn mr-1 active" type="button" data-category="all">All</button>
    @foreach ($categories as $category)
        <button class="filter-btn mx-1" type="button" data-category="{{ $category->name }}">{{ $category->name }}</button>
    @endforeach
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
            <button type="button" class="add-btn btn-success w-75" data-toggle="modal" data-target="#addFoodModal">+ Add Food</button>
        </th>
    </tr>
</thead>
<tbody class="tbody">
    @foreach ($foods as $food)
        <tr data-category="{{$food->category->name}}">
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$food->name}}</td>
        <td>{{$food->description}}</td>
        <td>{{$food->exp_datetime}}</td>
        <td>{{$food->category->name}}</td>
        <td>{{$food->stock}}</td>
        <td>{{$food->status}}</td>
        <td>
            <div class="manage-button d-flex">
                <button type="button" class="edit-btn btn-warning mx-1" data-toggle="modal" data-target="#editFoodModal">Edit</button>
                <button type="button" class="delete-btn btn-danger mx-1" data-toggle="modal" data-target="#deleteFoodModal">Delete</button>
            </div>
        </td>
        </tr>
    @endforeach
</tbody>
</table>

<x-popup-modal id="addFoodModal" title="Add Food">
    <form action="{{route('create.food.restaurant')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="addName">Food Name</label>
            <input type="text" class="form-control" id="addName" name="name" required>
        </div>
        <div class="form-group">
            <label for="addCategory">Category</label>
            <select class="form-control" id="addCategory" name="category_id" required>
                <option selected disabled value="">Choose category...</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="addDescription">Food Description</label>
            <textarea class="form-control" id="addDescription" name="description" rows="3" required></textarea>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="addExpDate">Expiration Date</label>
                <input type="date" class="form-control" id="addExpDate" name="exp_date" required>
            </div>
            <div class="form-group col-md-6">
                <label for="addExpTime">Expiration Time</label>
                <input type="time" class="form-control" id="addExpTime" name="exp_time" required>
            </div>
        </div>
         <div class="form-group">
            <label for="addStock">Stock</label>
            <input type="number" class="form-control" id="addStock" name="stock" required min="0">
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="addStatus" name="status" value="available" checked>
            <label class="form-check-label" for="addStatus">Available</label>
        </div>
        
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" form="addFoodModal">Submit</button>
        </x-slot>
    </form>
</x-popup-modal>

<x-popup-modal id="editFoodModal" title="Edit Food">
    <form id="editFoodForm" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="editName" class="form-label">Food Name</label>
            <input type="text" class="form-control" id="editName" name="name" required>
        </div>
        <div class="mb-3">
            <label for="editCategory" class="form-label">Category</label>
            <select class="form-select" id="editCategory" name="category_id" required>
                <option disabled value="">Choose category...</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="editDescription" class="form-label">Food Description</label>
            <textarea class="form-control" id="editDescription" name="description" rows="3" required></textarea>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="editExpDate" class="form-label">Expiration Date</label>
                <input type="date" class="form-control" id="editExpDate" name="exp_date" required>
            </div>
            <div class="col">
                <label for="editExpTime" class="form-label">Expiration Time</label>
                <input type="time" class="form-control" id="editExpTime" name="exp_time" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="editStock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="editStock" name="stock" required min="0">
        </div>
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" role="switch" id="editStatus" name="status" value="available">
            <label class="form-check-label" for="editStatus">Available</label>
        </div>
        
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </x-slot>
    </form>
</x-popup-modal>

<x-popup-modal id="deleteFoodModal" title="Delete Confirmation">
    <p>Are you sure you want to delete this food item: <strong id="deleteFoodName"></strong>?</p>
    <p class="text-danger">This action cannot be undone.</p>
    
    <form id="deleteFoodForm" method="">
        @csrf
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
        </x-slot>
    </form>
</x-popup-modal>
@endsection
