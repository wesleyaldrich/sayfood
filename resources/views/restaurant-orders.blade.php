@extends('layout.app')

@section('title', 'Orders Page')

@section('content')
<div class="container-fluid my-2 px-4">
    <div class="header">
        <h1>LETS MANAGE YOUR ORDERS!</h1>
    </div>

    <div class="body mt-3">
        <table class="table table-bordered text-center align-middle custom-table">
            <thead class="custom-thead">
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Food Name</th>
                    <th>Qty</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;

                    /** @var \App\Models\Order[] $orders */ // biar tidak warning aja
                    /** @var \App\Models\Order $order */ // biar tidak warning aja
                    /** @var \App\Models\Transaction $item */ // biar tidak warning aja

                @endphp
                @foreach ($orders as $order)
                    @php $rowspan = $order->transactions->count(); @endphp
                    @foreach ($order->transactions as $index => $item)
                        <tr>
                            @if ($index === 0)
                                <td rowspan="{{ $rowspan }}">{{ $no++ }}</td>
                                <td rowspan="{{ $rowspan }}">ORD{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td rowspan="{{ $rowspan }}">{{ $order->customer->username }}</td>
                            @endif
                            <td>{{ $item->food->name }}</td>
                            <td>{{ $item->qty }}</td>
                            @if ($index === 0)
                                <td rowspan="{{ $rowspan }}">{{ $order->created_at->format('d/m/y') }}</td>
                                <td rowspan="{{ $rowspan }}">
                                    <form action="{{ route('restaurant-orders.update-status', $order->id) }}" method="POST">
                                        @csrf
                                        @if ($order->status === 'Order Created')
                                            <button class="btn btn-sm" style="background-color: #007771;">Accept</button>
                                        @elseif ($order->status === 'Ready to Pickup')
                                            <button class="btn btn-warning btn-sm" style="background-color: #FEA322;">Accepted</button>
                                        @elseif ($order->status === 'Order Completed' || $order->status === 'Order Reviewed')
                                            <button class="btn btn-secondary btn-sm" disabled style="background-color: #4D4D4C;">Completed</button>
                                        @endif
                                    </form>
                                </td>


                            @endif
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/restaurant-orders.css') }}">
@endpush
