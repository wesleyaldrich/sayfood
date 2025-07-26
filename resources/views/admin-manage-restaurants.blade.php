@extends('layout.app')

@section('title', __("admin.manage_restaurants_title"))

@section('content')
    <style>
        .filter-button {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0 28px;
            color: #FFFFFF;
            border-radius: 32px;
            background-color: #234C4C;
            font-weight: 500;
            line-height: 1rem;
            font-size: 1.1rem;
            text-decoration: none;
        }
        .filter-button:hover {
            background-color: #4dabab;
            color: #FFFFFF;
            text-decoration: none;
        }
        .active {
            background-color: #4dabab;
        }
        .table-row-entry:hover {
            background-color: #00eeff15;
        }
    </style>
    <div class="container-fluid px-5 mb-5">
        <div class="d-flex flex-row my-4 align-items-center">
            <h2 class="oswald" style="font-size: 40px; font-weight: 600; color: #063434;">{{ __('admin.restaurants_heading') }}</h2>
        </div>

        <div class="mb-4">
            <div class="d-flex flex-row w-100" style="gap: 6px;">
                <a href="{{ route('show.manage.restaurants') }}"
                    class="oswald filter-button {{ !(request()->query('status')) ? 'active' : '' }}">{{ __('admin.filter_operational_button') }}</a>
                <a href="{{ route('show.manage.restaurants', ['status' => 'pending']) }}"
                    class="oswald filter-button {{ (request()->query('status') == 'pending') ? 'active' : '' }}">{{ __('admin.filter_pending_restaurants_button') }}</a>
                <a href="{{ route('show.manage.restaurants', ['status' => 'rejected']) }}"
                    class="oswald filter-button {{ (request()->query('status') == 'rejected') ? 'active' : '' }}">{{ __('admin.filter_rejected_restaurants_button') }}</a>
                <div class="d-flex ms-auto mt-auto">
                    <form class="d-flex" role="search">
                        <input class="form-control" type="search" placeholder="{{ __('admin.search_placeholder') }}" aria-label="{{ __('admin.search_placeholder') }}">
                        <button class="btn btn-warning" type="submit">
                            <img class="p-0" src="{{asset('assets/icon_search.png')}}" width="20">
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <table class="table w-100">
            <thead>
                <tr>
                    <th scope="col">{{ __('admin.no_label') }}</th>
                    <th scope="col">{{ __('admin.id_label') }}</th>
                    <th scope="col">{{ __('admin.name_label') }}</th>
                    <th scope="col">{{ __('admin.email_label') }}</th>
                    <th scope="col">{{ __('admin.status_label') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($restaurant_registrations as $i)
                    <tr class="table-row-entry" onclick="window.location='{{ route('show.manage.restaurants.detail', $i->id) }}'" style="cursor: pointer;">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $i->id }}</td>
                        <td>{{ $i->name }}</td>
                        <td>{{ $i->email }}</td>
                        <td>{{ $i->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $restaurant_registrations->links() }}
        </div>
    </div>
@endsection