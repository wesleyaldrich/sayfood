<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

@extends('layout.app')
@section('title')
    Restaurant Manage Food Page
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('js/resto-food-filter.js') }}" defer></script>

@section('content')
<link rel="stylesheet" href="{{ asset('css/resto-food.css') }}">

<div class="upper-section d-flex">
    <div class="title">
        <h1>LET'S MANAGE YOUR FOOD!</h1>
        <p class="subtitle">
            {{$restaurant->name}}'s food list
        </p>
    </div>
    <div class="search-bar d-flex">
        {{-- <form class="d-flex" role="search"> --}}
            <input class="form-control" id="searchInput" type="search" placeholder="Search food name..." aria-label="Search"/>
            <button class="btn btn-warning" type="button">
                <img src="assets/icon_search.png" alt="search" class="w-5">
            </button>
        {{-- </form> --}}
    </div>
</div>

<div class="middle-section d-flex">
    <div class="tab-control d-flex mx-4 my-2">
        <button class="filter-btn mr-1 active" type="button" data-category="all">All</button>
        @foreach ($categories as $category)
            <button class="filter-btn mx-1" type="button" data-category="{{ $category->name }}">{{ $category->name }}</button>
        @endforeach
    </div>
    <div class="upload-csv d-flex">
        <p class="csv-instruction">You can also upload in a csv format file! Click here</p>
        <img class="arrow" src="assets/arrow.svg" alt="">
        <button class="csv-btn btn m-0" data-bs-target="#uploadCsv" data-bs-toggle="modal">Import</button>
    </div>
</div>
<div class="table-responsive-wrapper">
    <table class="table">
      <thead class="thead">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Image</th>
            <th scope="col">Food Name</th>
            <th scope="col">Food Description</th>
            <th scope="col">Expiration Time</th>
            <th scope="col">Category</th>
            <th scope="col">Stock</th>
            <th scope="col">Status</th>
            <th scope="col">
                <button type="button" class="add-btn btn-success w-75" data-bs-toggle="modal" data-bs-target="#addFoodModal">+ Add Food</button>
            </th>
        </tr>
    </thead>
    <tbody class="tbody">
        @foreach ($foods as $food)
            <tr data-category="{{$food->category->name}}" data-food='@json($food)'> {{-- Menyimpan data food sebagai JSON --}}
            <th scope="row">{{$loop->iteration}}</th>
            <td>
                {{-- Tampilkan Gambar --}}
                @if($food->image_url)
                <img src="{{ asset('storage/' . $food->image_url) }}" alt="{{ $food->name }}" width="100" style="border-radius: 8px;">
                @else
                    <span>No Image</span>
                @endif
            </td>
            <td>{{$food->name}}</td>
            <td>{{$food->description}}</td>
            <td>{{$food->exp_datetime}}</td>
            <td>{{$food->category->name}}</td>
            <td>{{$food->stock}}</td>
            <td>{{$food->status}}</td>
            <td>
                <div class="manage-button d-flex">
                    <button type="button" class="edit-btn btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#editFoodModal">Edit</button>
                    <button type="button" class="delete-btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#deleteFoodModal" data-food-id="{{ $food->id }}" data-food-name="{{ $food->name }}">Delete</button>
                </div>
            </td>
            </tr>
        @endforeach
    </tbody>
    </table>
</div>

<form action="{{route('create.food.restaurant')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <x-popup-modal id="addFoodModal" title="AddFood">
            <div class="form-group">
                <label for="addName">Food Name</label>
                <input type="text" class="form-control" id="addName" name="name" required>
            </div>
            <div class="form-group mt-2">
                <label for="addPhoto">Food Image</label>
                <input type="file" class="form-control" id="addPhoto" name="image_url">
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </x-slot>
        </x-popup-modal>
</form>

<form id="editFoodForm" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <x-popup-modal id="editFoodModal" title="Edit Food">
        <div class="mb-3">
            <label for="editName" class="form-label">Food Name</label>
            <input type="text" class="form-control" id="editName" name="name" required>
        </div>
        <div class="mb-3">
            <label for="editPhoto" class="form-label">New Food Image (Optional)</label>
            <input type="file" class="form-control" id="editPhoto" name="image_url">
            <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
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
    </x-popup-modal>
</form>

<form id="deleteFoodForm" method="POST" action="">
@csrf
@method('DELETE')
    <x-popup-modal id="deleteFoodModal" title="Delete Confirmation">
        <p>Are you sure you want to delete this food item: <strong id="deleteFoodName"></strong>?</p>
        <p class="text-danger">This action cannot be undone.</p>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
        </x-slot>
    </x-popup-modal>
</form>

<form action="{{ route('foods.upload.process') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <x-popup-modal id="uploadCsv" title="Upload CSV File">
        <div class="popup_instructions container alert-info">
            <strong>Instructions:</strong>
            <ol class="mt-2">
                <li>1. Download the provided CSV template.</li>
                <li>2. Fill in your food data according to the example, then save the file.</li>
                <li>3. Place the saved CSV file and all corresponding image files into a single folder.</li>
                <li>4. Make sure the image file names in the folder exactly match the names in the `image_url` column of your CSV.</li>
                <li>5. The `category_name` must be one of the following: <strong>Main Course, Dessert, Drinks, Snacks</strong>.</li>
                <li>6. The `exp_datetime` must follow the format: <strong>YYYY-MM-DD HH:MM:SS</strong> (e.g., 2025-12-31 23:59:00).</li>
                <li>7. Compress the entire folder into a single <strong>.zip</strong> file.</li>
                <li>8. Upload the .zip file below.</li>
            </ol>
            <a href="{{ route('foods.template.download') }}" class="btn btn-secondary mt-2">
                📥 Download CSV Template
            </a>
        </div>

        <div class="container mb-3 mt-4">
            <label for="zip_file" class="form-label">Choose .zip file</label>
            <input type="file" class="form-control" id="zip_file" name="zip_file" required accept=".zip">
        </div>

        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload and Proceed</button>
        </x-slot>
    </x-popup-modal>
</form>

<script>
$(document).ready(function() {
    // Handle Edit Modal
    $('.edit-btn').on('click', function() {
        // Ambil data food dari attribute `data-food` di <tr>
        var food = $(this).closest('tr').data('food');
        
        // Buat URL untuk action form
        var actionUrl = "{{ url('restaurant-foods/update') }}/" + food.id;
        $('#editFoodForm').attr('action', actionUrl);
        
        // Isi semua field di form edit
        $('#editName').val(food.name);
        $('#editCategory').val(food.category_id);
        $('#editDescription').val(food.description);
        $('#editStock').val(food.stock);
        
        // Pisahkan tanggal dan waktu
        var expDatetime = new Date(food.exp_datetime);
        var date = expDatetime.toISOString().split('T')[0];
        var time = expDatetime.toTimeString().split(' ')[0].substring(0, 5);
        
        $('#editExpDate').val(date);
        $('#editExpTime').val(time);

        // Atur status checkbox
        if (food.status.toLowerCase() === 'available') {
            $('#editStatus').prop('checked', true);
        } else {
            $('#editStatus').prop('checked', false);
        }
    });

    // Handle Delete Modal
    $('.delete-btn').on('click', function() {
        var foodId = $(this).data('food-id');
        var foodName = $(this).data('food-name');
        
        // Buat URL untuk action form
        var actionUrl = "{{ url('restaurant-foods/delete') }}/" + foodId;
        $('#deleteFoodForm').attr('action', actionUrl);
        
        // Tampilkan nama makanan yang akan dihapus
        $('#deleteFoodName').text(foodName);
    });
});
</script>

@endsection
