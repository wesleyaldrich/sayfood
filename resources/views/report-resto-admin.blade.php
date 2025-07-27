@extends('layout.app')

@section('title', __("admin.manage_reports_title"))

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
            <h2 class="oswald" style="font-size: 40px; font-weight: 600; color: #063434;">{{ __('admin.reports_heading') }}</h2>
        </div>

        <div class="mb-4">
            <div class="row w-100 gap-4 mx-0">
                <div class="d-flex flex-row" style="gap: 6px; height: 40px;">
                    <a href="{{ route('show.manage.reports', array_merge(request()->query(), ['status' => null])) }}"
                    class="oswald filter-button {{ !(request()->query('status')) ? 'active' : '' }}">
                        {{ __('admin.filter_pending_button') }}
                    </a>
                    <a href="{{ route('show.manage.reports', array_merge(request()->query(), ['status' => 'Resolved'])) }}"
                    class="oswald filter-button {{ request()->query('status') == 'Resolved' ? 'active' : '' }}">
                        {{ __('admin.filter_resolved_button') }}
                    </a>
                </div>  
                <div class="d-flex ms-auto mt-auto">
                    <form class="d-flex" role="search">
                        {{-- Preserve the current status filter --}}
                        @if(request()->has('status'))
                            <input type="hidden" name="status" value="{{ request()->query('status') }}">
                        @endif
                        <input class="form-control" name="query" type="search" value="{{ request('query') }}" placeholder="{{ __('admin.search_placeholder') }}" aria-label="{{ __('admin.search_placeholder') }}">
                        <button class="btn btn-warning" type="submit">
                            <img class="p-0" src="{{asset('assets/icon_search.png')}}" width="20">
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table class="table w-100" style="max-width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">{{ __('admin.no_label') }}</th>
                        <th scope="col">{{ __('admin.customer_id_label') }}</th>
                        <th scope="col">{{ __('admin.customer_name_label') }}</th>
                        <th scope="col">{{ __('admin.restaurant_id_label') }}</th>
                        <th scope="col">{{ __('admin.restaurant_name_label') }}</th>
                        <th scope="col">{{ __('admin.status_label') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $i)
                        <tr class="table-row-entry" onclick="window.location='{{ route('show.manage.reports.detail', $i->id) }}'" style="cursor: pointer;">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $i->customer->id }}</td>
                            <td>{{ $i->customer->user->username }}</td>
                            @if ($i->restaurant)
                                <td>{{ $i->restaurant->id }}</td>
                                <td>{{ $i->restaurant->name }}</td>
                            @else
                                <td>{{ $i->suspended_restaurant->id }}</td>
                                <td>{{ $i->suspended_restaurant->name }}</td>
                            @endif
                            <td>{{ $i->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $reports->links() }}
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}"> {{-- Assuming profile.css is still relevant here --}}
@endpush