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

    .filter-btn{
        font-family: oswald;
        border-radius: 20px;
        color: white;
        background-color: #234C4C;
    }

    .status-badge{
        font-size: 17px;
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
            <button class="filter-btn px-3 py-1">All</button>
            @foreach ($statuses as $status)
                <button class="filter-btn px-3 py-1">{{$status}}</button>
            @endforeach
        </div>
    </div>

    <div class="container-fluid px-4">
        <table class="table table-hover">
            <thead>
                <tr>
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
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->creator->user->username ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}</td>
                        <td>{{ $event->location ?? 'N/A' }}</td>
                        <td>{{ $event->category->name ?? 'N/A' }}</td>
                        <td class="status-badge">
                            @if($event->status == 'Pending')
                                <span class="badge bg-warning">{{ $event->status }}</span>
                            @elseif($event->status == 'Coming Soon')
                                <span class="badge bg-info text-light">{{ $event->status }}</span>
                            @elseif ($event->status == 'On Going')
                                <span class="badge bg-primary text-light">{{ $event->status }}</span>
                            @elseif($event->status == 'Completed')
                                <span class="badge bg-success text-light">{{ $event->status }}</span>
                            @else
                                <span class="badge bg-secondary text-light">{{ $event->status }}</span>
                            @endif
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