@extends('layout.app')
@section('title')
    Admin Manage Events Page
@endsection

<style>
    .title{
        font-family: Oswald;
        color: #234C4C;
        font-weight: bold;
        font-size: 30px;
    }


    .table{
        font-size: 14px;    
    }

    /* .filter-btn{
        font-family: oswald;
        border-radius: 20px;
        color: white;
        background-color: #234C4C;
    } */

    .status-badge{
        font-size: 17px;
    }

    .tab-control .nav-tabs .nav-link {
        font-family: oswald;
        color: white;
        background-color: #234C4C;  
        border-radius: 1rem;
    }

    .tab-control .nav-tabs .nav-link.active {
        background-color: orange;
        color: black;
        font-weight: bold;
        border-radius: 1rem;
    }
    .table-hover tbody tr:hover {
        cursor: pointer;
        background-color: #f8f9fa; /* Warna latar saat hover */
    }
</style>

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center m-3">
            <h1 class="title">EVENTS</h1>
            <div class="d-flex">
                <form class="d-flex me-3" role="search">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search"/>
                    <button class="btn btn-warning" type="submit">
                        <img class="p-0" src="{{asset('assets/icon_search.png')}}" width="20">
                    </button>
                </form>
                <div class="create-btn">
                    <a href="#" class="btn btn-success text-light" style="font-weight: bold; background-color: darkgreen;">+ Create</a>
                </div>
            </div>
        </div>
        <div class="tab-control m-3">
           <ul class="nav nav-tabs">
                <li class="nav-item m-1">
                    <a class="nav-link {{ !request('status') || request('status') == 'All' ? 'active' : '' }}" 
                       href="{{ route('show.manage.events', ['status' => 'All']) }}">
                       All
                    </a>
                </li>

                @foreach ($statuses as $status)
                <li class="nav-item m-1">
                    <a class="nav-link {{ request('status') == $status ? 'active' : '' }}" 
                       href="{{ route('show.manage.events', ['status' => $status]) }}">
                       {{ $status }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="container-fluid px-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">ID</th>
                    <th scope="col">Event Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Creator</th>
                    <th scope="col">Date</th>
                    <th scope="col">Location</th>
                    <th scope="col">Category</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                    <tr onclick="window.location='{{ route('show.manage.events.detail', $event->id) }}';">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ Str::limit($event->description, 90) }}</td>
                        <td>{{ $event->creator->user->username ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}</td>
                        <td>{{ $event->location ?? 'N/A' }}</td>
                        <td>{{ $event->category->name ?? 'N/A' }}</td>
                        <td class="status-badge">
                            @php
                                    $statusClass = 'bg-secondary'; // Default color
                                    if($event->status == 'Pending') $statusClass = 'bg-warning text-dark';
                                    if($event->status == 'Coming Soon') $statusClass = 'bg-info text-light';
                                    if($event->status == 'On Going') $statusClass = 'bg-primary text-light';
                                    if($event->status == 'Completed') $statusClass = 'bg-success text-light';
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ $event->status }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No events found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection