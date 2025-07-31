@extends('layout.app')

@section('title', __("admin.report_detail_title"))

@section('content')
    <style>
        h3 {
            font-size: 1.5rem;
            font-weight: 400;
            color: #063434;
        }
        h4 {
            font-size: 1.2rem;
            font-weight: 400;
            color: #063434;
        }
        .detail-header {
            letter-spacing: 1px;
            font-weight: 500;
        }
        .status-label {
            color: #FFFFFF;
            display: flex;
            padding-left: 16px;
            align-items: center;
            width: 200px;
            height: 40px;
            border-radius: 32px;
        }
        .Resolved {
            background-color: #234C4C;
        }
        .Pending {
            background-color: #fea322;
        }
        .left-detail-section {
            max-width: 400px;
        }
        .btn-suspend {
            background-color: #c94c4c;
            padding: 10px 20px;
            color: rgb(255, 255, 255, 0.7);
            font-family: 'Lato';
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 80%;
        }
        .btn-suspend:hover {
            text-decoration: none;
            color: rgb(255, 255, 255, 0.7);
            background-color: #ff6e6e;
        }
        .btn-safe {
            background-color: #234C4C;
            padding: 10px 20px;
            color: rgb(255, 255, 255, 0.7);
            font-family: 'Lato';
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 80%;
        }
        .btn-safe:hover {
            text-decoration: none;
            color: rgb(255, 255, 255, 0.7);
            background-color: #4dabab;
        }
    </style>
    <div class="container-fluid px-5 mb-5">
        <div class="d-flex flex-row mt-3">
            <a href="javascript:history.back()" class="nav-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="row mt-4 align-items-center gap-4 mx-0">
            <div class="d-flex flex-column p-0" style="width: fit-content;">
                <h2 class="oswald" style="font-size: 40px; font-weight: 600; color: #063434;">{{ __('admin.report_id_prefix') }} {{ $report->id }}</h2>
                <h2 class="oswald" style="font-size: 32px; font-weight: 400; color: #063434;">{{ $report->customer->user->username . ' ' . __('admin.to_label') . ' ' . ($report->restaurant->name ?? $report->suspended_restaurant->name) }}</h2>
            </div>
            <div class="side d-flex flex-row ms-auto gap-4 p-0" style="min-height: 60px; width: fit-content;">
                {{-- ITEM --}}
                @if ($report->status == 'Pending')
                    <form id="suspend-btn" action="{{ route('show.manage.reports.detail.suspend', $report->id) }}" method="POST" hidden>@csrf</form>
                    <form id="safe-btn" action="{{ route('show.manage.reports.detail.safe', $report->id) }}" method="POST" hidden>@csrf</form>
                    <a href="{{ route('show.manage.reports.detail.suspend', $report->id) }}" class="btn btn-suspend" onclick="
                        event.preventDefault();
                        document.getElementById('suspend-btn').submit();
                    " dusk="suspend-btn">{{ __('admin.suspend_restaurant_button') }}</a>
                    <a href="{{ route('show.manage.reports.detail.safe', $report->id) }}" class="btn btn-safe" onclick="
                        event.preventDefault();
                        document.getElementById('safe-btn').submit();
                    " dusk="safe-btn">{{ __('admin.mark_as_safe_button') }}</a>
                @endif
            </div>
        </div>
        <div class="d-flex flex-row mt-4">
            <div class="left-detail-section d-flex flex-column">
                <h3 class="detail-header oswald">{{ __('admin.report_details_heading') }}</h3>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">{{ __('admin.status_label') }}</h3>
                    <h3 class="oswald status-label {{ $report->status }}">{{ $report->status }}</h3>
                </div>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">{{ __('admin.description_label') }}</h3>
                    <h3 class="oswald">{{ $report->description}}</h3>
                </div>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">{{ __('admin.customer_id_label') }}</h3>
                    <h3 class="oswald">{{ $report->customer->id }}</h3>
                </div>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">{{ __('admin.customer_name_label') }}</h3>
                    <h3 class="oswald">{{ $report->customer->user->username }}</h3>
                </div>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">{{ __('admin.customer_email_label') }}</h3>
                    <h3 class="oswald">{{ $report->customer->user->email }}</h3>
                </div>
                @if ($report->restaurant)
                    <div class="detail-group d-flex flex-column mt-4">
                        <h3 class="detail-header oswald mb-1">{{ __('admin.restaurant_id_label') }}</h3>
                        <h3 class="oswald">{{ $report->restaurant->id }}</h3>
                    </div>
                    <div class="detail-group d-flex flex-column mt-4">
                        <h3 class="detail-header oswald mb-1">{{ __('admin.restaurant_name_label') }}</h3>
                        <h3 class="oswald">{{ $report->restaurant->name }}</h3>
                    </div>
                    <div class="detail-group d-flex flex-column mt-4">
                        <h3 class="detail-header oswald mb-1">{{ __('admin.restaurant_email_label') }}</h3>
                        <h3 class="oswald">{{ $report->restaurant->user->email }}</h3>
                    </div>
                @else
                    <div class="detail-group d-flex flex-column mt-4">
                        <h3 class="detail-header oswald mb-1">{{ __('admin.restaurant_id_label') }}</h3>
                        <h3 class="oswald">{{ $report->suspended_restaurant->id }}</h3>
                    </div>
                    <div class="detail-group d-flex flex-column mt-4">
                        <h3 class="detail-header oswald mb-1">{{ __('admin.restaurant_name_label') }}</h3>
                        <h3 class="oswald">{{ $report->suspended_restaurant->name }}</h3>
                    </div>
                    <div class="detail-group d-flex flex-column mt-4">
                        <h3 class="detail-header oswald mb-1">{{ __('admin.restaurant_email_label') }}</h3>
                        <h3 class="oswald">{{ $report->suspended_restaurant->email }}</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/report-detail.css') }}">
@endpush