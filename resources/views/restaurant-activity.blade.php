@extends('layout.app')

@section('title', __('restaurant.activity_page_title'))

@section('content')
<div class="container-fluid my-2 px-4">
    <div class="header">
        <h1>{{ __('restaurant.activity_heading') }}</h1>
    </div>

    <div class="body mt-3">
        <div class="mb-3 d-flex gap-2">
            @php $selectedRating = request('rating'); @endphp

            <a href="{{ route('restaurant-activity') }}"
            class="btn {{ $selectedRating === null ? 'btn-active' : 'btn-tab' }}">
                {{ __('restaurant.all_ratings_filter') }}
            </a>

            @for ($i = 1; $i <= 5; $i++)
                <a href="{{ route('restaurant-activity', ['rating' => $i]) }}"
                class="btn {{ $selectedRating == $i ? 'btn-active' : 'btn-tab' }}">
                    <i class="fas fa-star text-warning"></i> {{ $i }}
                </a>
            @endfor
        </div>

        <table class="table table-bordered text-center align-middle custom-table">
            <thead class="custom-thead">
                <tr>
                    <th>{{ __('restaurant.table_header_no') }}</th>
                    <th>{{ __('restaurant.table_header_id') }}</th>
                    <th>{{ __('restaurant.table_header_order_date') }}</th>
                    <th>{{ __('restaurant.table_header_customer_name') }}</th>
                    <th>{{ __('restaurant.table_header_rating') }}</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @php /** @var \App\Models\Order $order */ @endphp {{-- biar tidak warning aja --}}
                @foreach ($orders as $order)
                    @if ($order->rating !== null && (request('rating') === null || $order->rating == request('rating')))
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d/m/y') }}</td>
                            <td>{{ optional($order->customer)->user->username ?? __('restaurant.unknown_customer') }}</td>
                            <td>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $order->rating)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="far fa-star text-muted"></i>
                                    @endif
                                @endfor
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/restaurant-activity.css') }}">
@endpush