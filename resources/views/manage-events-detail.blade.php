@extends('layout.app')
@section('title')
    {{ __('admin.event_detail_title') }} {{ $event->name }}
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
                <i class="fas fa-arrow-left me-1"></i> {{ __('admin.back_to_list_button') }}
            </a>
        </div>
        <div class="header-section">
            <h1 class="event-title">{{ $event->name }}</h1>

            @if ($event->status == 'Pending')
                <div class="action-buttons">
                    <form action="{{ route('admin.reject.event', $event->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="fas fa-times-circle me-1"></i> {{ __('admin.reject_event_button') }}</button>
                    </form>
                    <form action="{{ route('admin.approve.event', $event->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success"><i class="fas fa-check-circle me-1"></i> {{ __('admin.approve_event_button') }}</button>
                    </form>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="details-card">
                    @if($event->image_url)
                        <img src="{{ asset('storage/' . $event->image_url) }}" class="event-photo" alt="[Photo of {{ $event->name }}]">
                    @endif

                    <div class="card-body">
                        <h5>{{ __('admin.event_details_heading') }}</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <i class="fas fa-flag"></i>
                                    <div><strong>{{ __('admin.status_label') }}</strong><br>
                                        @php
                                            $statusClass = 'bg-secondary'; // Default color
                                            if ($event->status == 'Pending')
                                                $statusClass = 'bg-warning text-dark';
                                            if ($event->status == 'Coming Soon')
                                                $statusClass = 'bg-info';
                                            if ($event->status == 'Completed')
                                                $statusClass = 'bg-success';
                                            if ($event->status == 'Canceled')
                                                $statusClass = 'bg-danger';
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ $event->status }}</span>
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-user-edit"></i>
                                    <div><strong>{{ __('admin.creator_info_label') }}</strong><br>
                                        {{ $event->creator->user->username ?? 'Creator Name' }} ({{ __('admin.creator_id_prefix') }}
                                        {{ $event->creator_id }})
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-envelope"></i>
                                    <div><strong>{{ __('admin.creator_email_label') }}</strong><br>{{ $event->creator->user->email ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <div>
                                        <strong>{{ __('admin.date_label') }}</strong><br>{{ \Carbon\Carbon::parse($event->date)->format('d F Y') }} | {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div><strong>{{ __('admin.address_detail_label') }}</strong><br>{{ $event->location }}</div>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-tag"></i>
                                    <div><strong>{{ __('admin.category_label') }}</strong><br>{{ $event->category->name }}</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="detail-item">
                            <i class="fas fa-align-left"></i>
                            <div><strong>{{ __('admin.description_label') }}</strong><br>{{ $event->description }}</div>
                        </div>

                        @if(in_array($event->status, ['Coming Soon', 'On Going', 'Completed']))
                            <div class="detail-item">
                                <i class="fas fa-users"></i>
                                <div><strong>{{ __('admin.group_link_detail_label') }}</strong><br>
                                    @if($event->group_link)
                                        <a href="{{ $event->group_link }}" target="_blank"
                                            rel="noopener noreferrer">{{ $event->group_link }}</a>
                                    @else
                                        <span class="text-muted">{{ __('admin.not_available_yet') }}</span>
                                    @endif
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                @if(in_array($event->status, ['Coming Soon', 'On Going', 'Completed']))
                    <div class="participants-card">
                        <div class="card-body">
                            <h5>{{ __('admin.participants_heading') }}</h5>
                            <div class="participants-count">
                                <div class="count">{{ $event->participants->count() }}</div>
                                <div>{{ __('admin.total_participants_label') }}</div>
                            </div>
                            <div class="participants-list">
                                <table class="table table-borderless table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('admin.id_label') }}</td>
                                            <th scope="col">{{ __('admin.customer_name_label') }}</td>
                                            <th scope="col">{{ __('admin.phone_number_label') }}</td>
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
                                                <td colspan="3" class="text-center">{{ __('admin.no_participants_yet') }}</td>
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