@extends('layout.app')

@section('title', "Sayfood Admin | Manage Reports")

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
            padding: 16px 20px;
            color: rgb(255, 255, 255, 0.7);
            font-family: 'Lato';
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50%;
        }
        .btn-suspend:hover {
            text-decoration: none;
            color: rgb(255, 255, 255, 0.7);
            background-color: #ff6e6e;
        }
        .btn-safe {
            background-color: #234C4C;
            padding: 16px 20px;
            color: rgb(255, 255, 255, 0.7);
            font-family: 'Lato';
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50%;
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
        <div class="d-flex flex-row mt-4 align-items-center">
            {{-- @if ($restaurant_registration->status == 'operational')
                @if ($restaurant_registration->restaurant && $restaurant_registration->restaurant->image_url_resto)
                    <img src="{{ asset($restaurant_registration->restaurant->image_url_resto) }}" class="restaurant-image" alt="restaurant image">
                @else
                    <img src="{{ asset('assets/example/profile.jpg') }}" class="restaurant-image" alt="restaurant image">
                @endif
            @endif --}}
            <div class="d-flex flex-column">
                <h2 class="oswald" style="font-size: 40px; font-weight: 600; color: #063434;">{{ 'Report ID: ' . $report->id }}</h2>
                <h2 class="oswald" style="font-size: 32px; font-weight: 400; color: #063434;">{{ $report->customer->user->username . ' to ' . $report->restaurant->name }}</h2>
            </div>
            <div class="side d-flex flex-row ms-auto gap-4">
                {{-- ITEM --}}
                @if ($report->status == 'Pending')
                    <form id="suspend-btn" action="{{ route('show.manage.reports.detail.suspend', $report->id) }}" method="POST" hidden>@csrf</form>
                    <form id="safe-btn" action="{{ route('show.manage.reports.detail.safe', $report->id) }}" method="POST" hidden>@csrf</form>
                    <a href="{{ route('show.manage.reports.detail.suspend', $report->id) }}" class="btn btn-suspend my-auto" onclick="
                        event.preventDefault();
                        document.getElementById('suspend-btn').submit();
                    ">Suspend Restaurant</a>
                    <a href="{{ route('show.manage.reports.detail.safe', $report->id) }}" class="btn btn-safe my-auto" onclick="
                        event.preventDefault();
                        document.getElementById('safe-btn').submit();
                    ">Mark as Safe</a>
                @endif
            </div>
        </div>
        <div class="d-flex flex-row mt-4">
            <div class="left-detail-section d-flex flex-column">
                <h3 class="detail-header oswald">Report Details</h3>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">Status</h3>
                    <h3 class="oswald status-label {{ $report->status }}">{{ $report->status }}</h3>
                </div>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">Description</h3>
                    <h3 class="oswald">{{ $report->description}}</h3>
                </div>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">Customer ID</h3>
                    <h3 class="oswald">{{ $report->customer->id }}</h3>
                </div>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">Customer Name</h3>
                    <h3 class="oswald">{{ $report->customer->user->username }}</h3>
                </div>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">Customer Email</h3>
                    <h3 class="oswald">{{ $report->customer->user->email }}</h3>
                </div>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">Restaurant ID</h3>
                    <h3 class="oswald">{{ $report->restaurant->id }}</h3>
                </div>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">Restaurant Name</h3>
                    <h3 class="oswald">{{ $report->restaurant->name }}</h3>
                </div>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">Restaurant Email</h3>
                    <h3 class="oswald">{{ $report->restaurant->user->email }}</h3>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container mx-4 mb-5">
        <div class="row align-items-center">
            <div class="navigation-buttons mb-3">
                <a href="javascript:history.back()" class="nav-btn">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <button class="nav-btn ms-3" onclick="goUp()">
                    <i class="fas fa-chevron-up"></i>
                </button>
                <button class="nav-btn" onclick="goDown()">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div> --}}

            {{-- Kolom Kiri: Profile --}}
            {{-- <div class="col-md-9 d-flex align-items-center">
                <div class="profile-report">
                    <img src="{{ asset('assets/icon_profile.png') }}" alt="profile_img"
                        style="width: 100px; height: 100px;">
                </div>
                <div class="ms-3">
                    <h1 class="fw-bold mb-0" style="color: #234C4C;">Upin Cucu Opah</h1>
                    <h5 class="text-muted mb-0 my-1">123455678</h5>
                </div>
            </div> --}}

            {{-- Kolom Kanan: Tombol --}}
            {{-- <div class="col-md-3 text-md-end text-start mt-3 mt-md-0">
                <button class="btn"
                    style="background-color: #234C4C; color: white; border-radius: 6px; padding: 6px 12px;">
                    <i class="bi bi-check-lg me-2"></i> In Review
                </button>
            </div>
        </div>
    </div> --}}

    {{-- <div class="mx-5 mt-5">
        <h3 class="report-details fw-bold" style="color: #234C4C; font-size: 20px;">Report Details</h3>
        <div class="row mt-3">
            <div class="col-12">
                <div class="row mb-3">
                    <div class="col">
                        <p class="mb-1">
                            <strong><i class="fas fa-bell me-2" style="color: #234C4C;"></i>Status:</strong>
                        </p>
                        <span class="badge text-white"
                            style="background: #FEA322; width: 100px; height: 25px;">Pending</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <p class="mb-1">
                            <strong><i class="fas fa-envelope me-2" style="color: #234C4C;"></i>Email:</strong>
                        </p>
                        <p>upin123@gmail.com</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <p class="mb-1">
                            <strong><i class="fas fa-circle-info me-2" style="color: #234C4C;"></i>Description:</strong>
                        </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pulvinar urna eu ante
                            dignissim aliquet. Nam orci erat, laoreet ut laoreet vitae, elementum vitae lectus. Aliquam
                            et
                            tincidunt tellus. Nulla mollis viverra consectetur. Aliquam luctus maximus felis, vel
                            placerat augue
                            auctor ac. Donec hendrerit dolor in ante condimentum vestibulum. Quisque scelerisque, erat
                            sed
                            vehicula gravida, nisl lorem volutpat lectus, in aliquam odio diam nec massa. Suspendisse
                            tempus
                            viverra fermentum. Fusce fermentum enim quam, quis scelerisque metus lacinia vel. Morbi
                            placerat mi
                            in nulla ultricies feugiat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/report-detail.css') }}">
@endpush