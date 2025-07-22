@extends('layout.app')

@section('title', "Sayfood Admin | Manage Restaurants")

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
        .operational {
            color: #FFFFFF;
            display: flex;
            padding-left: 16px;
            align-items: center;
            width: 200px;
            height: 40px;
            background-color: #234C4C;
            border-radius: 32px;
        }
        .left-detail-section {
            max-width: 400px;
        }
        .right-detail-section {
            flex: 1;
            /* background-color: #4dabab; */
            overflow-x: auto;
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
                Back
            </a>
        </div>
        <div class="d-flex flex-row mt-4 align-items-center">
            <img src="{{ $restaurant_registration->restaurant->image_url_resto ? asset('' . $restaurant_registration->restaurant->image_url_resto) : asset('assets/example/profile.jpg') }}" class="restaurant-image" alt="restaurant image">
            <div class="d-flex flex-column">
                <h2 class="oswald" style="font-size: 40px; font-weight: 600; color: #063434;">{{ $restaurant_registration->restaurant->name }}</h2>
                <h2 class="oswald" style="font-size: 32px; font-weight: 400; color: #063434;">{{ 'ID: ' . $restaurant_registration->restaurant->id }}</h2>
            </div>
            <div class="side d-flex flex-row ms-auto gap-4">
                {{-- ITEM --}}
                <div class="d-flex flex-row align-items-center gap-3 oswald pr-3" style="background-color: #FFFFFF; border-radius: 6px; font-size: 1.5rem;">
                    <span style="height: 100%; width: 8px; background-color: #fea322; border-radius: 6px 0 0 6px;"></span>
                    <span>{{ 'Rp' . $restaurant_registration->restaurant->total_donation . ',-' }}</span>
                    <span style="font-size: 1.3rem; opacity: 0.5;">Donated</span> 
                </div>
                <div class="d-flex flex-row align-items-center gap-3 oswald pr-3" style="background-color: #FFFFFF; border-radius: 6px; font-size: 1.5rem;">
                    <span style="height: 100%; width: 8px; background-color: #fea322; border-radius: 6px 0 0 6px;"></span>
                    <span>{{ $restaurant_registration->restaurant->total_orders }}</span>
                    <span style="font-size: 1.3rem; opacity: 0.5;">Completed Orders</span> 
                </div>
                <form id="download-btn" action="{{ route('show.manage.restaurants.detail.export', $restaurant_registration->id) }}" method="POST" hidden>@csrf</form>
                <a href="{{ route('show.manage.restaurants.detail.export', $restaurant_registration->id) }}" class="btn btn-export my-auto" onclick="
                    event.preventDefault();
                    document.getElementById('download-btn').submit();
                ">Export</a>
            </div>
        </div>
        <div class="d-flex flex-row mt-4">
            <div class="left-detail-section d-flex flex-column">
                <h3 class="detail-header oswald">Restaurant Details</h3>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">Status</h3>
                    <h3 class="oswald operational">{{ $restaurant_registration->status }}</h3>
                </div>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">Email</h3>
                    <h3 class="oswald">{{ $restaurant_registration->restaurant->address }}</h3>
                </div>
                <div class="detail-group d-flex flex-column mt-4">
                    <h3 class="detail-header oswald mb-1">Address</h3>
                    <h4 class="oswald">{{ $restaurant_registration->restaurant->address }}</h4>
                </div>
                @if ($restaurant_registration->status == 'operational')
                    <div class="detail-group d-flex flex-column mt-4">
                        <h3 class="detail-header oswald mb-1">Description</h3>
                        <h4 class="oswald">{{ $restaurant_registration->restaurant->description }}</h4>
                    </div>
                    <div class="detail-group d-flex flex-column mt-4">
                        <h3 class="detail-header oswald mb-1">Average Rating</h3>
                        <h3 class="oswald">{{ $restaurant_registration->restaurant->avg_rating . ' / 5' }}</h3>
                    </div>
                @endif
            </div>
            <div class="right-detail-section d-flex flex-column">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Total</th>
                            <th scope="col">Date</th>
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
        </div>
    </div>
@endsection