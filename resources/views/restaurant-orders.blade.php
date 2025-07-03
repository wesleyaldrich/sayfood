@extends('layout.app')

@section('title', 'Orders Page')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@section('content')
    <div class="container-fluid my-2 px-4">
        <div class="header">
            <h1>LETS MANAGE YOUR ORDERS!</h1>
        </div>
        
        <div class="body mt-3">
        <table class="table table-bordered text-center align-middle custom-table" style="vertical-align: middle;">
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
                    $orders = [
                        [
                            'transaction_id' => 'TX001',
                            'customer_name' => 'Siti Nurhaliza',
                            'order_date' => '01/07/25',
                            'status' => 'pending',
                            'items' => [
                                ['food_name' => 'Ayam Bakar Madu Spesial', 'qty' => 2],
                                ['food_name' => 'Nasi Uduk', 'qty' => 2],
                                ['food_name' => 'Es Teh Manis', 'qty' => 2],
                            ]
                        ],
                        [
                            'transaction_id' => 'TX002',
                            'customer_name' => 'Andi Pratama',
                            'order_date' => '01/07/25',
                            'status' => 'accepted',
                            'items' => [
                                ['food_name' => 'Sate Ayam', 'qty' => 10],
                                ['food_name' => 'Lontong', 'qty' => 5],
                            ]
                        ],
                        [
                            'transaction_id' => 'TX003',
                            'customer_name' => 'Rina Marlina',
                            'order_date' => '02/07/25',
                            'status' => 'pending',
                            'items' => [
                                ['food_name' => 'Bakso Urat', 'qty' => 3],
                                ['food_name' => 'Es Jeruk', 'qty' => 2],
                            ]
                        ],
                        [
                            'transaction_id' => 'TX004',
                            'customer_name' => 'Joko Susilo',
                            'order_date' => '02/07/25',
                            'status' => 'accepted',
                            'items' => [
                                ['food_name' => 'Mie Ayam', 'qty' => 2],
                            ]
                        ],
                        [
                            'transaction_id' => 'TX005',
                            'customer_name' => 'Dewi Lestari',
                            'order_date' => '03/07/25',
                            'status' => 'pending',
                            'items' => [
                                ['food_name' => 'Rendang Padang', 'qty' => 4],
                                ['food_name' => 'Nasi Putih', 'qty' => 4],
                                ['food_name' => 'Kerupuk Udang', 'qty' => 2],
                                ['food_name' => 'Es Campur', 'qty' => 2],
                            ]
                        ],
                        [
                            'transaction_id' => 'TX006',
                            'customer_name' => 'Agus Santoso',
                            'order_date' => '03/07/25',
                            'status' => 'accepted',
                            'items' => [
                                ['food_name' => 'Soto Betawi', 'qty' => 3],
                                ['food_name' => 'Nasi Putih', 'qty' => 3],
                            ]
                        ],
                        [
                            'transaction_id' => 'TX007',
                            'customer_name' => 'Melisa Indah',
                            'order_date' => '03/07/25',
                            'status' => 'pending',
                            'items' => [
                                ['food_name' => 'Nasi Goreng Spesial', 'qty' => 2],
                                ['food_name' => 'Telur Dadar', 'qty' => 1],
                                ['food_name' => 'Teh Tarik', 'qty' => 2],
                            ]
                        ],
                        [
                            'transaction_id' => 'TX008',
                            'customer_name' => 'Budi Hartono',
                            'order_date' => '04/07/25',
                            'status' => 'accepted',
                            'items' => [
                                ['food_name' => 'Ikan Bakar', 'qty' => 2],
                                ['food_name' => 'Sambal Matah', 'qty' => 1],
                            ]
                        ],
                        [
                            'transaction_id' => 'TX009',
                            'customer_name' => 'Raisa Andriana',
                            'order_date' => '04/07/25',
                            'status' => 'pending',
                            'items' => [
                                ['food_name' => 'Capcay Kuah', 'qty' => 1],
                                ['food_name' => 'Bakwan Jagung', 'qty' => 2],
                                ['food_name' => 'Air Mineral', 'qty' => 2],
                            ]
                        ],
                        [
                            'transaction_id' => 'TX010',
                            'customer_name' => 'Doni Saputra',
                            'order_date' => '05/07/25',
                            'status' => 'pending',
                            'items' => [
                                ['food_name' => 'Rawon Daging', 'qty' => 2],
                                ['food_name' => 'Kerupuk Udang', 'qty' => 2],
                            ]
                        ],
                    ];
                    $no = 1;
                @endphp

                @foreach($orders as $oIndex => $order)
                    @php 
                        $rowspan = count($order['items']); 
                        $isLastOrder = $loop->last; 
                    @endphp
                    @foreach($order['items'] as $index => $item)
                        @php 
                            $rowClass = '';
                            if ($index === 0) $rowClass .= 'border-top-thick ';
                            if ($isLastOrder && $index === $rowspan - 1) $rowClass .= 'border-bottom-thick';
                        @endphp
                        <tr class="{{ trim($rowClass) }}">
                            @if ($index === 0)
                                <td rowspan="{{ $rowspan }}">{{ $no++ }}</td>
                                <td rowspan="{{ $rowspan }}">{{ $order['transaction_id'] }}</td>
                                <td rowspan="{{ $rowspan }}">{{ $order['customer_name'] }}</td>
                            @endif
                            <td>{{ $item['food_name'] }}</td>
                            <td>{{ $item['qty'] }}</td>
                            @if ($index === 0)
                                <td rowspan="{{ $rowspan }}">{{ $order['order_date'] }}</td>
                                <td rowspan="{{ $rowspan }}">
                                    @if ($order['status'] === 'pending')
                                        <button class="btn btn-sm" style="background-color: #007771; ">Accept</button>
                                    @else
                                        <button class="btn btn-sm" disabled style="background-color: #4D4D4C;">Accepted!</button>
                                    @endif
                                    
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/restaurant-orders.css') }}">
@endpush
