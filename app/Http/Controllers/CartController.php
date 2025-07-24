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

        $customerId = Auth::user()->customer->id;
        
        $existingCartItems = Cart::where('customer_id', $customerId)->with('food')->get();

        if ($existingCartItems->isNotEmpty()) {
            $currentRestaurantId = $existingCartItems->first()->food->restaurant_id;

            if ($food->restaurant_id !== $currentRestaurantId) {
                return redirect()->back()->withErrors(['error'=> 'Anda hanya bisa memesan dari satu restoran dalam satu waktu. Silakan kosongkan keranjang Anda terlebih dahulu.']);
            }
        }
        
        $cartItem = Cart::where('customer_id', $customerId)->where('food_id', $food->id)->first();
        
        if($cartItem){
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'customer_id' => $customerId,
                'food_id'=> $food->id,
                'quantity'=> $request->quantity,
            ]);
        }

        return redirect()->back()->with('status', 'Item successfully added!');
    }


    /**
     * Display the specified resource.
     */
    public function show()
    {
        $cartItems = Cart::where('customer_id', Auth::user()->customer->id)->with('food.restaurant')->get();
        
        $restaurant = null;

        if ($cartItems->isNotEmpty()) {
        $restaurant = $cartItems->first()->food->restaurant;
        }

        return view('layout.cart', compact('cartItems', 'restaurant'));
    }

    public function increase(Cart $cart)
    {
        // Validasi: Pastikan user hanya bisa mengubah keranjangnya sendiri
        if ($cart->customer_id !== Auth::user()->customer->id) {
            return redirect()->back()->withErrors(['error' => 'Action not allowed!']);
        }

        // Validasi: Cek stok makanan
        if ($cart->quantity < $cart->food->stock) {
            $cart->quantity++;
            $cart->save();
            return redirect()->back()->with('status', 'Quantity increased successfully!');
        } else {
            return redirect()->back()->withErrors(['error' => 'Not enough stock!']);
        }
    }

    /**
     * Mengurangi kuantitas item di keranjang.
     */
    public function decrease(Cart $cart)
    {
        // Validasi: Pastikan user hanya bisa mengubah keranjangnya sendiri
        if ($cart->customer_id !== Auth::user()->customer->id) {
            return redirect()->back()->withErrors(['error' => 'Action not allowed!']);
        }

        // Jika kuantitas lebih dari 1, kurangi
        if ($cart->quantity > 1) {
            $cart->quantity--;
            $cart->save();
            return redirect()->back()->with('status', 'Quantity decreased successfully!');
        } else {
            // Jika kuantitas adalah 1, hapus item dari keranjang
            $cart->delete();
            return redirect()->back()->with('status', 'Item deleted from cart');
        }
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

    public function updateNote(Request $request, Cart $cart){
        if ($cart->customer_id !== Auth::user()->customer->id) {
            return redirect()->back()->withErrors(['error' => 'Action not allowed!']);
        }

        $request->validate([
            'notes' => 'nullable|string|max:255'
        ]);

        $cart->notes = $request->input('notes');
        $cart->save();

        return redirect()->route('show.cart')->with('status', 'Notes successfully updated!');
    }

    public function cancelCart()
    {
        Cart::where('customer_id', Auth::user()->customer->id)->delete();

        return redirect()->route('foods')->with('status', 'Your cart has been cleared.');
    }

    public function clearCart(){
        $customerId = Auth::user()->customer->id;

        Cart::where('customer_id', $customerId)->delete(); 
        return redirect('/foods')->with('status', 'Your cart is empty');
    }
}
