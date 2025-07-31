<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

@extends('layout.app')
@section('title', __('restaurant.manage_food_title'))

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('js/resto-food-filter.js') }}" defer></script>

@section('content')
<link rel="stylesheet" href="{{ asset('css/resto-food.css') }}">

<div class="upper-section d-flex">
    <div class="title">
        <h1>{{ __('restaurant.manage_food_heading') }}</h1>
        <p class="subtitle">
            {{ __('restaurant.food_list_subtitle', ['restaurant_name' => $restaurant->name]) }}
        </p>
    </div>
    <div class="search-bar d-flex">
        <input class="form-control" id="searchInput" type="search" placeholder="{{ __('restaurant.search_food_placeholder') }}" aria-label="Search"/>
        <button class="btn btn-warning" type="button">
            <img src="assets/icon_search.png" alt="search" class="w-5">
        </button>
    </div>
</div>

<div class="middle-section d-flex">
    <div class="tab-control d-flex mx-4 my-2">
        <button class="filter-btn mr-1 active" type="button" data-category="all">{{ __('restaurant.all_categories_filter') }}</button>
        @foreach ($categories as $category)
            <button class="filter-btn mx-1" type="button" data-category="{{ $category->name }}">{{ $category->name }}</button>
        @endforeach
    </div>
    <div class="upload-csv d-flex">
        <p class="csv-instruction">{{ __('restaurant.upload_csv_instruction_1') }}</p>
        <img class="arrow" src="assets/arrow.svg" alt="">
        <button class="csv-btn btn m-0" data-bs-target="#uploadCsv" data-bs-toggle="modal">{{ __('restaurant.upload_csv_import_button') }}</button>
    </div>
</div>
<div class="table-responsive-wrapper">
    <table class="table">
      <thead class="thead">
        <tr>
            <th scope="col">{{ __('restaurant.table_header_no') }}</th>
            <th scope="col">{{ __('restaurant.table_header_image') }}</th>
            <th scope="col">{{ __('restaurant.table_header_food_name') }}</th>
            <th scope="col">{{ __('restaurant.table_header_food_description') }}</th>
            <th scope="col">{{ __('restaurant.table_header_food_price') }}</th>
            <th scope="col">{{ __('restaurant.table_header_expiration_time') }}</th>
            <th scope="col">{{ __('restaurant.table_header_category') }}</th>
            <th scope="col">{{ __('restaurant.table_header_stock') }}</th>
            <th scope="col">{{ __('restaurant.table_header_status') }}</th>
            <th scope="col">
                <button type="button" class="add-btn btn-success w-75" data-bs-toggle="modal" data-bs-target="#addFoodModal">{{ __('restaurant.add_food_button') }}</button>
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
                    <span>{{ __('restaurant.no_image_text') }}</span>
                @endif
            </td>
            <td>{{$food->name}}</td>
            <td>{{$food->description}}</td>
            <td>{{ 'Rp' . $food->price . ',00'}}</td>
            <td>{{$food->exp_datetime}}</td>
            <td>{{$food->category->name}}</td>
            <td>{{$food->stock}}</td>
            <td>{{$food->status}}</td>
            <td>
                <div class="manage-button d-flex">
                    <button type="button" class="edit-btn btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#editFoodModal">{{ __('restaurant.edit_button') }}</button>
                    <button type="button" class="delete-btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#deleteFoodModal" data-food-id="{{ $food->id }}" data-food-name="{{ $food->name }}">{{ __('restaurant.delete_button') }}</button>
                </div>
            </td>
            </tr>
        @endforeach
    </tbody>
    </table>
</div>

<form action="{{route('create.food.restaurant')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <x-popup-modal id="addFoodModal" title="{{ __('restaurant.add_food_modal_title') }}">
            <div class="form-group">
                <label for="addName">{{ __('restaurant.add_food_name_label') }}</label>
                <input type="text" class="form-control" id="addName" name="name" required>
            </div>
            <div class="form-group mt-2">
                <label for="addPhoto">{{ __('restaurant.add_food_image_label') }}</label>
                <input type="file" class="form-control" id="addPhoto" name="image_url">
            </div>
            <div class="form-group">
                <label for="addCategory">{{ __('restaurant.add_category_label') }}</label>
                <select class="form-control" id="addCategory" name="category_id" required>
                    <option selected disabled value="">{{ __('restaurant.add_category_placeholder') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="addDescription">{{ __('restaurant.add_food_description_label') }}</label>
                <textarea class="form-control" id="addDescription" name="description" rows="3" required></textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="addExpDate">{{ __('restaurant.add_expiration_date_label') }}</label>
                    <input type="date" class="form-control" id="addExpDate" name="exp_date" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="addExpTime">{{ __('restaurant.add_expiration_time_label') }}</label>
                    <input type="time" class="form-control" id="addExpTime" name="exp_time" required>
                </div>
            </div>
            <div class="form-group">
                <label for="addStock">{{ __('restaurant.add_stock_label') }}</label>
                <input type="number" class="form-control" id="addStock" name="stock" required min="0">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="addStatus" name="status" value="available" checked>
                <label class="form-check-label" for="addStatus">{{ __('restaurant.add_status_available') }}</label>
            </div>

            <x-slot name="footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('restaurant.close_button') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('restaurant.submit_button') }}</button>
            </x-slot>
        </x-popup-modal>
</form>

<form id="editFoodForm" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <x-popup-modal id="editFoodModal" title="{{ __('restaurant.edit_food_modal_title') }}">
        <div class="mb-3">
            <label for="editName" class="form-label">{{ __('restaurant.edit_food_name_label') }}</label>
            <input type="text" class="form-control" id="editName" name="name" required>
        </div>
        <div class="mb-3">
            <label for="editPhoto" class="form-label">{{ __('restaurant.edit_food_image_label') }}</label>
            <input type="file" class="form-control" id="editPhoto" name="image_url">
            <small class="form-text text-muted">{{ __('restaurant.edit_image_hint') }}</small>
        </div>
        <div class="mb-3">
            <label for="editCategory" class="form-label">{{ __('restaurant.edit_category_label') }}</label>
            <select class="form-select" id="editCategory" name="category_id" required>
                <option disabled value="">{{ __('restaurant.edit_category_placeholder') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="editDescription" class="form-label">{{ __('restaurant.edit_food_description_label') }}</label>
            <textarea class="form-control" id="editDescription" name="description" rows="3" required></textarea>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="editExpDate" class="form-label">{{ __('restaurant.edit_expiration_date_label') }}</label>
                <input type="date" class="form-control" id="editExpDate" name="exp_date" required>
            </div>
            <div class="col">
                <label for="editExpTime" class="form-label">{{ __('restaurant.edit_expiration_time_label') }}</label>
                <input type="time" class="form-control" id="editExpTime" name="exp_time" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="editStock" class="form-label">{{ __('restaurant.edit_stock_label') }}</label>
            <input type="number" class="form-control" id="editStock" name="stock" required min="0">
        </div>
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" role="switch" id="editStatus" name="status" value="available">
            <label class="form-check-label" for="editStatus">{{ __('restaurant.edit_status_available') }}</label>
        </div>

        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('restaurant.close_button') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('restaurant.save_changes_button') }}</button>
        </x-slot>
    </x-popup-modal>
</form>

<form id="deleteFoodForm" method="POST" action="">
@csrf
@method('DELETE')
    <x-popup-modal id="deleteFoodModal" title="{{ __('restaurant.delete_confirm_modal_title') }}">
        <p>{!! __('restaurant.delete_confirm_message', ['food_name' => '<strong id="deleteFoodName"></strong>']) !!}</p>
        <p class="text-danger">{{ __('restaurant.delete_undo_warning') }}</p>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('restaurant.cancel_button') }}</button>
            <button type="submit" class="btn btn-danger">{{ __('restaurant.yes_delete_button') }}</button>
        </x-slot>
    </x-popup-modal>
</form>

<form action="{{ route('foods.upload.process') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <x-popup-modal id="uploadCsv" title="{{ __('restaurant.upload_csv_modal_title') }}">
        <div class="popup_instructions container alert-info">
            <strong>{{ __('restaurant.csv_instruction_heading') }}</strong>
            <ol class="mt-2">
                <li>{{ __('restaurant.csv_instruction_1') }}</li>
                <li>{{ __('restaurant.csv_instruction_2') }}</li>
                <li>{{ __('restaurant.csv_instruction_3') }}</li>
                <li>{{ __('restaurant.csv_instruction_4') }}</li>
                <li>{{ __('restaurant.csv_instruction_5') }}</li>
                <li>{{ __('restaurant.csv_instruction_6') }}</li>
                <li>{{ __('restaurant.csv_instruction_7') }}</li>
                <li>{{ __('restaurant.csv_instruction_8') }}</li>
            </ol>
            <a href="{{ route('foods.template.download') }}" class="btn btn-secondary mt-2">
                {{ __('restaurant.download_csv_template_button') }}
            </a>
        </div>

        <div class="container mb-3 mt-4">
            <label for="zip_file" class="form-label">{{ __('restaurant.choose_zip_file_label') }}</label>
            <input type="file" class="form-control" id="zip_file" name="zip_file" required accept=".zip">
        </div>

        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('restaurant.close_button') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('restaurant.upload_and_proceed_button') }}</button>
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