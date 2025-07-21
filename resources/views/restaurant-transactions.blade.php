@extends('layout.app')

@section('title', "Sayfood | Restaurant Transaction Report")

@section('content')
    <style>
        .filter-button {
            height: 30px;
            padding: 0 1.2rem;
            background-color: #234C4C;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 40px;
            border: none;
        }
        .filter-button:hover {
            background-color: #347171;
        } 
        .download-button {
            height: 30px;
            padding: 0 1.2rem;
            background-color: #FEA322;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 40px;
            border: none;
        }
        .download-button:hover {
            background-color: #ffc70e;
        }
        .back-button {
            display: flex;
            height: 40px;
            aspect-ratio: 1/1;
            background-color: #FFFFFF;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 1.6rem;
            font-weight: 700;
            line-height: 1rem;
            text-decoration: none;
            border: 1px solid #234C4C;
        }
        .back-button:hover {
            background-color: aliceblue;
            text-decoration: none;
        }
    </style>
    <div class="container-fluid px-5 mb-5">

        <div class="d-flex flex-row mb-4 align-items-center">
            <a href="javascript:history.back()" class="back-button">
                <
            </a>
            <h2 class="ms-3 oswald" style="font-size: 40px; font-weight: 600; color: #063434;">TRANSACTION REPORT</h2>
        </div>

        <div class="mb-4">
            <div class="d-flex flex-row w-100">
                <form action="{{ route('restaurant-transactions.filter') }}" method="GET" class="d-flex flex-row">
                    @php
                        $startDate = request('start_date') ?? \Carbon\Carbon::now()->subWeek()->format('Y-m-d');
                        $endDate = request('end_date') ?? \Carbon\Carbon::now()->format('Y-m-d');
                    @endphp
                    <div class="d-flex flex-column mr-3">
                        <h6 class="oswald mb-1" style="font-weight: 500; font-size: 1.2rem; color: #063434">Date Start</h6>
                        <input type="date" name="start_date" id="start_date" value="{{ $startDate }}">
                    </div>
                    <div class="d-flex flex-column">
                        <h6 class="oswald mb-1" style="font-weight: 500; font-size: 1.2rem; color: #063434">Date End</h6>
                        <input type="date" name="end_date" id="end_date" value="{{ $endDate }}">
                    </div>
                    <div class="ml-3 d-flex flex-column align-items-center justify-content-end">
                        <button type="submit" class="filter-button btn btn-primary d-flex justify-content-center align-items-center">Filter</button>
                    </div>
                </form>
                <div class="d-flex ms-auto mt-auto">
                    <a href="{{ route('restaurant-transactions.download', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="download-button btn btn-primary d-flex justify-content-center align-items-center">Download Report</a>
                </div>
            </div>
        </div>

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
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $i->order_id }}</td>
                        <td>{{ $i->created_at }}</td>
                        <td>{{ $i->order->customer->user->username }}</td>
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