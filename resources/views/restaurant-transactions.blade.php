@extends('layout.app')

@section('title', "Sayfood | Restaurant Transaction Report")

@section('content')
    <div class="container-fluid px-5 mb-5">
        <h2 class="oswald mb-4" style="font-size: 40px; font-weight: 600; color: #063434;">TRANSACTION REPORT</h2>

        <table class="table w-100">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Date</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Food Name</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Payment Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>01/01/2001</td>
                    <td>Naufal Dimas Azizan</td>
                    <td>Nasi Telur Tahu Tempe</td>
                    <td>2</td>
                    <td>Rp10.000,00</td>
                    <td>Rp20.000,00</td>
                    <td>Completed</td>
                </tr>
                
            </tbody>
        </table>
    </div>
@endsection