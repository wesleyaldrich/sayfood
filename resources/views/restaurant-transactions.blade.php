@extends('layout.app')

@section('title', "Sayfood | Restaurant Transaction Report")

@section('content')
    <div class="container-fluid px-5 mb-5">
        <h2 class="oswald mb-4" style="font-size: 40px; font-weight: 600; color: #063434;">TRANSACTION REPORT</h2>

        <table class="table w-100">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Order ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Food Name</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $i)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $i->order_id }}</td>
                        <td>{{ $i->created_at }}</td>
                        <td>{{ $i->order->customer->username }}</td>
                        <td>{{ $i->food->name }}</td>
                        <td>{{ $i->qty }}</td>
                        <td>{{ 'Rp' . $i->food->price . ',00'}}</td>
                        <td>{{ 'Rp' . $i->qty * $i->food->price . ',00'}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection