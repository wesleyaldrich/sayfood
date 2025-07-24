@extends('layout.app')
@section('title')
    Event Detail: {{ $event->name }}
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background-color: #f4f7f6;
    }

    .main-content {
        padding: 2rem;
    }

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e0e0e0;
    }

    .event-title {
        font-weight: bold;
        font-size: 2rem;
        color: #333;
    }

    .action-buttons form {
        display: inline-block;
    }

    .details-card,
    .participants-card {
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        overflow: hidden;
        /* Add this to prevent image overflow on border-radius */
    }

    .details-card .card-body,
    .participants-card .card-body {
        padding: 1.5rem;
    }

    .details-card h5,
    .participants-card h5 {
        font-weight: bold;
        color: darkgreen;
        margin-bottom: 1.5rem;
    }

    .detail-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1rem;
        color: #333;
    }

    .detail-item i {
        color: darkgreen;
        width: 20px;
        margin-right: 15px;
        margin-top: 4px;
    }

    .participants-count {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .participants-count .count {
        font-size: 2.5rem;
        font-weight: bold;
        color: darkgreen;
    }

    .participants-list {
        max-height: 400px;
        overflow-y: auto;
    }

    .event-photo {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
    }
</style>

@section('content')

    <div class="container-fluid main-content">
        <div class="mb-3">
            <a href="{{ route('show.manage.events') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>
        <!-- Header: Event Name and Action Buttons -->
        <div class="header-section">
            <h1 class="event-title">{{ $event->name }}</h1>

            @if ($event->status == 'Pending')
                <div class="action-buttons">
                    <form action="{{ route('admin.reject.event', $event->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="fas fa-times-circle me-1"></i> Reject</button>
                    </form>
                    <form action="{{ route('admin.approve.event', $event->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success"><i class="fas fa-check-circle me-1"></i> Approve</button>
                    </form>
                </div>
            @endif
        </div>

        <div class="row">
            <!-- Left Column: Event Details -->
            <div class="col-lg-8">
                <div class="details-card">
                    @if($event->image_url)
                        <img src="{{ asset('storage/' . $event->image_url) }}" class="event-photo" alt="[Photo of {{ $event->name }}]">
                    @endif

                    <div class="card-body">
                        <h5>Event Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <i class="fas fa-flag"></i>
                                    <div><strong>Status</strong><br>
                                        @php
                                            $statusClass = 'bg-secondary';
                                            if ($event->status == 'Pending')
                                                $statusClass = 'bg-warning text-dark';
                                            if ($event->status == 'Coming Soon')
                                                $statusClass = 'bg-info';
                                            if ($event->status == 'On Going')
                                                $statusClass = 'bg-primary';
                                            if ($event->status == 'Completed')
                                                $statusClass = 'bg-success';
                                            if ($event->status == 'Rejected')
                                                $statusClass = 'bg-danger';
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ $event->status }}</span>
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-user-edit"></i>
                                    <div><strong>Creator</strong><br>
                                        {{ $event->creator->user->username ?? 'Creator Name' }} (ID:
                                        {{ $event->creator_id }})
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-envelope"></i>
                                    <div><strong>Creator Email</strong><br>{{ $event->creator->user->email ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <div>
                                        <strong>Date</strong><br>{{ $event->date}} | {{ $event->start_time}} - {{ $event->end_time}}
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div><strong>Address</strong><br>{{ $event->location }}</div>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-tag"></i>
                                    <div><strong>Category</strong><br>{{ $event->category->name }}</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="detail-item">
                            <i class="fas fa-align-left"></i>
                            <div><strong>Description</strong><br>{{ $event->description }}</div>
                        </div>

                        @if(in_array($event->status, ['Coming Soon', 'On Going', 'Completed']))
                            <div class="detail-item">
                                <i class="fas fa-users"></i>
                                <div><strong>Group Link</strong><br>
                                    @if($event->group_link)
                                        <a href="{{ $event->group_link }}" target="_blank"
                                            rel="noopener noreferrer">{{ $event->group_link }}</a>
                                    @else
                                        <span class="text-muted">Not available yet.</span>
                                    @endif
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <!-- Right Column: Participants -->
            <div class="col-lg-4">
                @if(in_array($event->status, ['Coming Soon', 'On Going', 'Completed']))
                    <div class="participants-card">
                        <div class="card-body">
                            <h5>Participants</h5>
                            <div class="participants-count">
                                <div class="count">{{ $event->participants->count() }}</div>
                                <div>Total Participants</div>
                            </div>
                            <div class="participants-list">
                                <table class="table table-borderless table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</td>
                                            <th scope="col">Username</td>
                                            <th scope="col">Phone Number</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($event->participants as $participant)
                                            <tr>
                                                <td>{{ $participant->id }}</td>
                                                <td>{{ $participant->user->username ?? 'Participant Name' }}</td>
                                                <td>{{ $participant->pivot->phone_number ?? 'N/A' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center">No participants yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection