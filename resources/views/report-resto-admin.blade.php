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
            <h2 class="oswald" style="font-size: 40px; font-weight: 600; color: #063434;">REPORTS</h2>
        </div>

        <div class="mb-4">
            <div class="d-flex flex-row w-100" style="gap: 6px;">
                <a href="{{ route('show.manage.reports') }}"
                    class="oswald filter-button {{ !(request()->query('status')) ? 'active' : '' }}">Pending</a>
                <a href="{{ route('show.manage.reports', ['status' => 'Resolved']) }}"
                    class="oswald filter-button {{ (request()->query('status') == 'Resolved') ? 'active' : '' }}">Resolved</a>
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

        <table class="table w-100">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Customer ID</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Restaurant ID</th>
                    <th scope="col">Restaurant Name</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $i)
                    <tr class="table-row-entry" onclick="window.location='{{ route('show.manage.reports.detail', $i->id) }}'" style="cursor: pointer;">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $i->customer->id }}</td>
                        <td>{{ $i->customer->user->username }}</td>
                        <td>{{ $i->restaurant->id }}</td>
                        <td>{{ $i->restaurant->name }}</td>
                        <td>{{ $i->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{-- {{ $restaurant_registrations->links() }} --}}
        </div>
    </div>
@endsection