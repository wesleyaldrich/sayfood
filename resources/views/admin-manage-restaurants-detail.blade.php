@extends('layout.app')

@section('title', __("admin.manage_restaurants_title"))

@section('content')
    <style>
        .back-button {
            border: 2px solid #4dabab;
            background-color: #234C4C;
            padding: 4px 32px;
            border-radius: 8px;
            font-weight: 400;
            letter-spacing: 1px;
            font-size: 1.2rem;
            color: #FFFFFF;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #4dabab;
            color: #FFFFFF;
            text-decoration: none;
        }
        .restaurant-image {
            width: 150px;
            aspect-ratio: 1/1;
            border: 4px solid #234C4C;
            border-radius: 50%;
            margin-right: 28px;
        }
        .side {
            height: 80px;
        }
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
        .operational {
            background-color: #234C4C;
        }
        .pending {
            background-color: #fea322;
        }
        .rejected {
            background-color: #333333;
        }
        .left-detail-section {
            max-width: 400px;
        }
        .right-detail-section {
            flex: 1;
            overflow-x: auto;
        }
        .btn-reject {
            background-color: #c94c4c;
            padding: 20px 24px;
            color: rgb(255, 255, 255, 0.7);
            font-family: 'Lato';
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50%;
        }
        .btn-reject:hover {
            text-decoration: none;
            color: rgb(255, 255, 255, 0.7);
            background-color: #ff6e6e;
        }
        .btn-export {
            background-color: #234C4C;
            padding: 20px 24px;
            color: rgb(255, 255, 255, 0.7);
            font-family: 'Lato';
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50%;
        }
        .btn-export:hover {
            text-decoration: none;
            color: rgb(255, 255, 255, 0.7);
            background-color: #4dabab;
        }
    </style>
    <div class="container-fluid px-5 mb-5">
        <div class="d-flex flex-row mt-3">
            <a href="javascript:history.back()" class="back-button oswald">
                {{ __('admin.back_button') }}
            </a>
        </div>
        <div class="d-flex flex-row mt-4 align-items-center">
            @if ($restaurant_registration->status == 'operational')
                @if ($restaurant_registration->restaurant && $restaurant_registration->restaurant->image_url_resto)
                    <img src="{{ asset($restaurant_registration->restaurant->image_url_resto) }}" class="restaurant-image" alt="restaurant image">
                @else
                    <img src="{{ asset('assets/example/profile.jpg') }}" class="restaurant-image" alt="restaurant image">
                @endif
            @endif
            <div class="d-flex flex-column">
                @if ($restaurant_registration->restaurant)
                    <h2 class="oswald" style="font-size: 40px; font-weight: 600; color: #063434;">{{ $restaurant_registration->restaurant->name }}</h2>
                @else
                    <h2 class="oswald" style="font-size: 40px; font-weight: 600; color: #063434;">{{ $restaurant_registration->name }}</h2>
                @endif
                <h2 class="oswald" style="font-size: 32px; font-weight: 400; color: #063434;">{{ __('admin.restaurant_id_prefix') }} {{ $restaurant_registration->id }}</h2>
            </div>
            <div class="side d-flex flex-row ms-auto gap-4">
                @if ($restaurant_registration->status != 'rejected')
                    @if ($restaurant_registration->status == 'operational')
                        <form id="download-btn" action="{{ route('show.manage.restaurants.detail.export', $restaurant_registration->id) }}" method="POST" hidden>@csrf</form>
                        <a href="{{ route('show.manage.restaurants.detail.export', $restaurant_registration->id) }}" class="btn btn-export my-auto" onclick="
                            event.preventDefault();
                            document.getElementById('download-btn').submit();
                        ">{{ __('admin.export_button') }}</a>
                    @else
                        <form id="approve-btn" action="{{ route('show.manage.restaurants.detail.approve', $restaurant_registration->id) }}" method="POST" hidden>@csrf</form>
                        <form id="reject-btn" action="{{ route('show.manage.restaurants.detail.reject', $restaurant_registration->id) }}" method="POST" hidden>@csrf</form>
                        <a href="{{ route('show.manage.restaurants.detail.reject', $restaurant_registration->id) }}" class="btn btn-reject my-auto" onclick="
                            event.preventDefault();
                            document.getElementById('reject-btn').submit();
                        ">{{ __('admin.reject_button') }}</a>
                        <a href="{{ route('show.manage.restaurants.detail.approve', $restaurant_registration->id) }}" class="btn btn-export my-auto" onclick="
                            event.preventDefault();
                            document.getElementById('approve-btn').submit();
                        ">{{ __('admin.approve_button') }}</a>
                    @endif
                @endif
            </div>
        </div>
        <div class="d-flex flex-row mt-4">
            <div class="left-detail-section d-flex flex-column">
                <h3 class="detail-header oswald">{{ __('admin.restaurant_details_heading') }}</h3>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">{{ __('admin.status_label') }}</h3>
                    <h3 class="oswald status-label {{ $restaurant_registration->status }}">{{ $restaurant_registration->status }}</h3>
                </div>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">{{ __('admin.email_label') }}</h3>
                    <h3 class="oswald">{{ $restaurant_registration->email }}</h3>
                </div>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">{{ __('admin.address_label') }}</h3>
                    <h4 class="oswald">{{ $restaurant_registration->restaurant->address ?? $restaurant_registration->address }}</h4>
                </div>
                @if ($restaurant_registration->status == 'operational')
                    <div class="detail-group d-flex flex-column mt-4">
                        <h3 class="detail-header oswald mb-1">{{ __('admin.description_label') }}</h3>
                        <h4 class="oswald">{{ $restaurant_registration->restaurant->description }}</h4>
                    </div>
                    <div class="detail-group d-flex flex-column mt-4">
                        <h3 class="detail-header oswald mb-1">{{ __('admin.avg_rating_label') }}</h3>
                        <h3 class="oswald">{{ $restaurant_registration->restaurant->avg_rating . ' / 5' }}</h3>
                    </div>
                @endif
            </div>
            @if ($restaurant_registration->status == 'operational')
                <div class="right-detail-section d-flex flex-column">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('admin.no_label') }}</th>
                                <th scope="col">{{ __('admin.order_id_label') }}</th>
                                <th scope="col">{{ __('admin.customer_name_label') }}</th>
                                <th scope="col">{{ __('admin.status_label') }}</th>
                                <th scope="col">{{ __('admin.total_label') }}</th>
                                <th scope="col">{{ __('admin.date_label') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($restaurant_registration->restaurant->orders as $i)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $i->id }}</td>
                                    <td>{{ $i->customer->user->username }}</td>
                                    <td>{{ $i->status }}</td>
                                    <td>{{ $i->total_price }}</td>
                                    <td>{{ $i->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection