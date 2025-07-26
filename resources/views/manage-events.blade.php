@extends('layout.app')
@section('title', __('admin.admin_manage_events_title'))

<style>
    .title {
        font-family: Oswald;
        color: #234C4C;
        font-weight: bold;
        font-size: 30px;
    }

    .table {
        font-size: 14px;
    }

    .status-badge {
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
        background-color: #f8f9fa;
    }

    .modal-content.popupmodal {
        background-color: white;
        border-radius: 1.5rem;
    }

    .modal-title {
        font-family: "Oswald";
        font-size: 20px;
        font-weight: bold;
        color: white;
    }

    .modal-header {
        background-color: #234C4C;
        border-top-left-radius: 1.5rem;
        border-top-right-radius: 1.5rem;
    }

    .modal-body {
        font-family: "Lato";
        font-size: 15px;
        font-weight: bold;
    }
</style>

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center m-3">
            <h1 class="title">{{ __('admin.events_heading') }}</h1>
            <div class="d-flex">
                <form class="d-flex me-3" role="search">
                    <input type="hidden" name="status" value="{{ request('status', 'All') }}">
                    <input class="form-control" type="search" placeholder="{{ __('admin.search_event_placeholder') }}" name="search"
                        value="{{ request('search') }}" aria-label="Search" />
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

    <div class="container-fluid px-4">
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
                                $statusClass = 'bg-secondary'; // Default color
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
                        <td colspan="7" class="text-center">{{ __('admin.no_events_found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $events->appends(request()->query())->links() }}
    </div>


    <form action="{{route("admin.create.event")}}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-popup-modal id="createEventModal" title="{{ __('admin.create_event_modal_title') }}">
            <div class="row">
                {{-- Event Name --}}
                <div class="col-12 mb-3">
                    <label for="name" class="form-label">{{ __('admin.event_name_modal_label') }}</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                {{-- Description --}}
                <div class="col-12 mb-3">
                    <label for="description" class="form-label">{{ __('admin.description_modal_label') }}</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>

                {{-- Date --}}
                <div class="col-md-6 mb-3">
                    <label for="date" class="form-label">{{ __('admin.date_modal_label') }}</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>

                {{-- Location --}}
                <div class="col-md-6 mb-3">
                    <label for="location" class="form-label">{{ __('admin.location_address_modal_label') }}</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>

                {{-- Category --}}
                <div class="col-md-6 mb-3">
                    <label for="event_category_id" class="form-label">{{ __('admin.category_modal_label') }}</label>
                    <select class="form-select border border-secondary" id="event_category_id" name="event_category_id"
                        required>
                        <option selected disabled value="">{{ __('admin.choose_option') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Status --}}
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">{{ __('admin.status_modal_label') }}</label>
                    <select class="form-select border border-secondary" id="status" name="status" required>
                        <option selected value="Coming Soon">{{ __('admin.coming_soon_status') }}</option>
                        <option value="Ongoing">{{ __('admin.ongoing_status') }}</option>
                        <option value="Completed">{{ __('admin.completed_status') }}</option>
                        <option value="Pending">{{ __('admin.pending_status') }}</option>
                    </select>
                </div>

                {{-- Group Link --}}
                <div class="col-12 mb-3">
                    <label for="group_link" class="form-label">{{ __('admin.group_link_modal_label') }}</label>
                    <input type="url" class="form-control" id="group_link" name="group_link"
                        placeholder="https://chat.whatsapp.com/...">
                </div>

                {{-- Event Image --}}
                <div class="col-md-6 mb-3">
                    <label for="image_url" class="form-label">{{ __('admin.event_image_modal_label') }}</label>
                    <input class="form-control" type="file" id="image_url" name="image_url" accept="image/*">
                </div>
            </div>

            {{-- Modal Footer --}}
            <x-slot name="footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('admin.cancel_button') }}</button>
                <button type="submit" class="btn btn-primary"
                    style="background-color: darkgreen; border-color: darkgreen;">{{ __('admin.create_event_button') }}</button>
            </x-slot>
        </x-popup-modal>
    </form>

@endsection