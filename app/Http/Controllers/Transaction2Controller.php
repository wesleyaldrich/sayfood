<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Food;
use App\Models\Order;
use App\Models\Transaction2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Transaction2Controller extends Controller
{
    public function confirmPayment(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('food')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('show.cart')->withErrors(['error' => 'Your cart is empty.']);
        }

        $restaurantId = $cartItems->first()->food->restaurant_id;

        // Use a database transaction to ensure all operations succeed or none do.
        try {
            DB::transaction(function () use ($user, $cartItems, $restaurantId, $request) {
                // 1. Validate stock before proceeding
                foreach ($cartItems as $item) {
                    if ($item->quantity > $item->food->stock) {
                        // If stock is insufficient, the transaction will be rolled back.
                        throw new \Exception('Stock for ' . $item->food->name . ' is not sufficient.');
                    }
                }
                
                // 2. Create a new Order record
                $order = Order::create([
                    'customer_id' => $user->id,
                    'restaurant_id' => $restaurantId,
                    'status' => 'Order Created', // Set status directly to successful
                    'payment_method' => $request->input('payment_method_final', 'Unknown'), // Optional: save the mock payment method
                    'rating' => null,
                ]);

                // 3. Move items from cart to transactions table & decrease stock
                foreach ($cartItems as $item) {
                    // Create a transaction record for each item
                    Transaction2::create([
                        'order_id' => $order->id,
                        'food_id' => $item->food_id,
                        'quantity' => $item->quantity,
                        'price' => $item->food->price,
                        'notes' => $item->notes,
                    ]);

                    // Decrease the food stock
                    $food = Food::find($item->food_id);
                    $food->decrement('stock', $item->quantity);
                }

                // 4. Clear the user's cart
                Cart::where('user_id', $user->id)->delete();
            });

        } catch (\Exception $e) {
            // If any error occurs (like the stock issue), redirect back with the error message.
            return redirect()->route('show.cart')->withErrors(['error' => $e->getMessage()]);
        }

        // If everything is successful, redirect to the activity page.
        return redirect()->route('activity')->with('status', 'Payment confirmed successfully! Your order is being processed.');
    }
}
