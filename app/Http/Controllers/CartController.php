<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request, Food $food)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $userId = Auth::id();
        
        $cartItem = Cart::where('user_id', $userId)->where('food_id', $food->id)->first();
        
        if($cartItem){
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'food_id'=> $food->id,
                'quantity'=> $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Item successfully added to cart!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('food.restaurant')->get();
        
        $restaurant = null;

        if ($cartItems->isNotEmpty()) {
        $restaurant = $cartItems->first()->food->restaurant;
        }

        return view('layout.cart', compact('cartItems', 'restaurant'));
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
