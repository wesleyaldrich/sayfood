@extends('layout.app')

@section('title', "Sayfood Admin | Manage Restaurants")

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
            <h2 class="oswald" style="font-size: 40px; font-weight: 600; color: #063434;">RESTAURANTS</h2>
        </div>

        <div class="mb-4">
            <div class="d-flex row w-100 gap-4 mx-0">
                <div class="row mx-0" style="gap: 6px;">
                    <a href="{{ route('show.manage.restaurants') }}" style="height: 40px;"
                        class="oswald filter-button {{ !(request()->query('status')) ? 'active' : '' }}">Operational</a>
                    <a href="{{ route('show.manage.restaurants', ['status' => 'pending']) }}" style="height: 40px;"
                        class="oswald filter-button {{ (request()->query('status') == 'pending') ? 'active' : '' }}">Pending</a>
                    <a href="{{ route('show.manage.restaurants', ['status' => 'rejected']) }}" style="height: 40px;"
                        class="oswald filter-button {{ (request()->query('status') == 'rejected') ? 'active' : '' }}">Rejected</a>
                </div>
                <div class="d-flex ms-auto mt-auto">
                    <form class="d-flex" role="search">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-warning" type="submit">
                            <img class="p-0" src="{{asset('assets/icon_search.png')}}" width="20">
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table class="table w-100">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
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
        </div>
        <div class="mt-4">
            {{ $restaurant_registrations->links() }}
        </div>
    </div>
@endsection