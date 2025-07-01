<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layout.cart');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $foodItem = Food::first(); 

        // // kalau tidak ada makanan sama sekali di database, buat objek dummy
        // if (!$foodItem) {
        //     $foodItem = (object)[
        //         'id' => 0,
        //         'image_url' => 'assets/default.png',
        //         'name' => 'No Food Found',
        //         'price' => 0,
        //         'exp_datetime' => now()
        //     ];
        // }
        return view('layout.cart', ['item'=>$foodItem]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
