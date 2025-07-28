@extends('layout.app')
@section('title', __('admin.admin_manage_events_title'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/manage-events.css') }}">
@endpush


@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center m-3">
            <h1 class="title">{{ __('admin.events_heading') }}</h1>
            <div class="d-flex">
                <form class="d-flex me-3" role="search">
                    <input type="hidden" name="status" value="{{ request('status', 'All') }}">
                    <input class="form-control" type="search" placeholder="{{ __('admin.search_event_placeholder') }}"
                        name="search" value="{{ request('search') }}" aria-label="Search" />
                    <button class="btn btn-warning" type="submit">
                        <img class="p-0" src="{{asset('assets/icon_search.png')}}" width="20">
                    </button>
                </form>
                <div class="create-btn">
                    <a href="#" class="btn btn-success text-light" style="font-weight: bold; background-color: darkgreen;"
                        data-bs-target="#createEventModal" data-bs-toggle="modal">{{ __('admin.create_button') }}</a>
                </div>
            </div>
        </div>
        <div class="tab-control m-3">
            <ul class="nav nav-tabs">
                <li class="nav-item m-1">
                    <a class="nav-link {{ !request('status') || request('status') == 'All' ? 'active' : '' }}"
                        href="{{ route('show.manage.events', ['status' => 'All', 'search' => request('search')]) }}">
                        {{ __('admin.all_filter') }}
                    </a>
                </li>

                @foreach ($statuses as $status)
                    <li class="nav-item m-1">
                        <a class="nav-link {{ request('status') == $status ? 'active' : '' }}"
                            href="{{ route('show.manage.events', ['status' => $status]) }}">
                            @if ($status === 'On Going')
                                {{ __('admin.on_going') }}
                            @elseif ($status === 'Pending')
                                {{ __('admin.pending') }}
                            @elseif ($status === 'Coming Soon')
                                {{ __('admin.coming_soon') }}
                            @elseif ($status === 'Canceled')
                                {{ __('admin.canceled') }}
                            @elseif ($status === 'Completed')
                                {{ __('admin.completed') }}
                            @else
                                {{ $status }}
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="container-fluid px-4 table-responsive-wrapper">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">{{ __('admin.no_label') }}</th>
                        <th scope="col">{{ __('admin.id_label') }}</th>
                        <th scope="col">{{ __('admin.event_name_label') }}</th>
                        <th scope="col">{{ __('admin.description_label') }}</th>
                        <th scope="col">{{ __('admin.creator_label') }}</th>
                        <th scope="col">{{ __('admin.date_label') }}</th>
                        <th scope="col">{{ __('admin.location_label') }}</th>
                        <th scope="col">{{ __('admin.category_label') }}</th>
                        <th scope="col">{{ __('admin.status_label') }}</th>
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
                                    $statusClass = 'bg-secondary';
                                    if ($event->status == 'Pending')
                                        $statusClass = 'bg-warning text-dark';
                                    if ($event->status == 'Coming Soon')
                                        $statusClass = 'bg-info text-light';
                                    if ($event->status == 'On Going')
                                        $statusClass = 'bg-primary text-light';
                                    if ($event->status == 'Completed')
                                        $statusClass = 'bg-success text-light';
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

    <div class="d-flex justify-content-center">
        {{ $events->appends(request()->query())->links() }}
    </div>


    <form action="{{ route('admin.create.event') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-popup-modal id="createEventModal" title="Create New Event">

            {{-- Event Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Event Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    required>{{ old('description') }}</textarea>
            </div>

            <div class="row">
                {{-- Category --}}
                <div class="col-md-6 mb-3">
                    <label for="event_category_id" class="form-label">Category</label>
                    <select class="form-select bordered" id="event_category_id" name="event_category_id" required>
                        <option selected disabled value="">Choose...</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('event_category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Status --}}
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select bordered" id="status" name="status" required>
                        <option value="Coming Soon" {{ old('status') == 'Coming Soon' ? 'selected' : '' }}>Coming Soon
                        </option>
                        <option value="On Going" {{ old('status') == 'On Going' ? 'selected' : '' }}>On Going</option>
                        <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Canceled" {{ old('status') == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>
            </div>

            <div class="row">
                {{-- Date --}}
                <div class="col-md-6 mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
                </div>

                {{-- Location --}}
                <div class="col-md-6 mb-3">
                    <label for="location" class="form-label">Location / Address</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}"
                        required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Start Time</label>
                    <div class="d-flex gap-2">
                        <input type="number" class="form-control" name="start_hour" placeholder="HH" min="1" max="12"
                            value="{{ old('start_hour') }}" required>
                        <span class="fw-bold fs-5 align-self-center">:</span>
                        <input type="number" class="form-control" name="start_minute" placeholder="MM" min="0" max="59"
                            value="{{ old('start_minute') }}" required>
                        <select class="form-select bordered" name="start_ampm" required>
                            <option {{ old('start_ampm') == 'AM' ? 'selected' : '' }}>AM</option>
                            <option {{ old('start_ampm') == 'PM' ? 'selected' : '' }}>PM</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">End Time</label>
                    <div class="d-flex gap-2">
                        <input type="number" class="form-control" name="end_hour" placeholder="HH" min="1" max="12"
                            value="{{ old('end_hour') }}" required>
                        <span class="fw-bold fs-5 align-self-center">:</span>
                        <input type="number" class="form-control" name="end_minute" placeholder="MM" min="0" max="59"
                            value="{{ old('end_minute') }}" required>
                        <select class="form-select bordered" name="end_ampm" required>
                            <option {{ old('end_ampm') == 'AM' ? 'selected' : '' }}>AM</option>
                            <option {{ old('end_ampm') == 'PM' ? 'selected' : '' }}>PM</option>
                        </select>
                    </div>
                </div>
            </div>
            {{-- Group Link --}}
            <div class="mb-3">
                <label for="group_link" class="form-label">Group Link</label>
                <input type="url" class="form-control" id="group_link" name="group_link" value="{{ old('group_link') }}"
                    placeholder="https://chat.whatsapp.com/..." required>
            </div>

            {{-- Event Image --}}
            <div class="mb-3">
                <label for="image_url" class="form-label">Event Image</label>
                <input class="form-control" type="file" id="image_url" name="image_url" accept="image/*" required>
            </div>

            {{-- Modal Footer --}}
            <x-slot name="footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary"
                    style="background-color: darkgreen; border-color: darkgreen;">Create Event</button>
            </x-slot>
        </x-popup-modal>
    </form>

@endsection