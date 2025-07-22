<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Food;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();

        if (!$currentUser){
            return redirect()->route('selection.login');
        }
        
        $currentUser = User::find($currentUser->id);

        if ($currentUser->role === 'restaurant'){
            $transactions = $currentUser->restaurant
                ->orders()
                ->whereIn('status', ['Order Completed', 'Order Reviewed'])
                ->with('transactions')
                ->get()
                ->pluck('transactions')
                ->flatten();

            return view('restaurant-transactions', compact('transactions'));
        }
        else {
            return redirect()->back()->withErrors('error', 'You do not have permission to access this page.');
        }
    }

    public function filter(Request $request)
    {
        $currentUser = Auth::user();

        if (!$currentUser){
            return redirect()->route('selection.login');
        }
        
        $currentUser = User::find($currentUser->id);

        if ($currentUser->role === 'restaurant'){
            $transactions = $currentUser->restaurant
                ->orders()
                ->whereIn('status', ['Order Completed', 'Order Reviewed'])
                ->with('transactions')
                ->get()
                ->pluck('transactions')
                ->flatten();

            $minDate = $request->query('start_date');
            $maxDate = $request->query('end_date');

            if ($minDate && $maxDate){
                $minDate = Carbon::parse($minDate)->startOfDay();
                $maxDate = Carbon::parse($maxDate)->endOfDay();

                $filteredTransactions = $transactions->filter(function ($transaction) use ($minDate, $maxDate) {
                    return $transaction->created_at >= $minDate && $transaction->created_at <= $maxDate;
                });

                $transactions = $filteredTransactions;
            }

            return view('restaurant-transactions', compact('transactions'));
        }
        else {
            return redirect()->back()->withErrors('error', 'You do not have permission to access this page.');
        }
    }

    public function manageOrders()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'restaurant') {
            return redirect('/')->withErrors(['error' => 'Unauthorized access']);
        }

        $orders = $user->restaurant->orders()
            ->with(['customer', 'transactions.food'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('restaurant-orders', compact('orders'));
    }

    public function updateStatus($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status === 'Order Created') {
            $order->status = 'Ready to Pickup'; 
        } elseif ($order->status === 'Ready to Pickup') {
            $order->status = 'Order Completed';
        }

        $order->save();

        return redirect()->back();
    }

    public function customerActivities()
{
    $user = Auth::user();

    if (!$user || !$user->customer) {
        return redirect('/')->withErrors(['error' => 'Unauthorized access']);
    }

    $orders = $user->customer->orders()
        ->with(['restaurant', 'transactions.food'])
        ->orderByDesc('created_at')
        ->get();

    $totalDonated = 0;
    $orderStatuses = [];

    foreach ($orders as $order) {
    foreach ($order->transactions as $transaction) {
        $totalDonated += $transaction->food->price * $transaction->qty;
    }

    // Mapping status ke key untuk timeline
    $statusKey = match ($order->status) {
        'Order Created' => 'order_created',
        'Ready to Pickup' => 'ready_to_pickup',
        'Order Completed' => 'order_completed',
        'Order Reviewed' => 'review_order',
        default => 'order_created',
    };

    // Buat list item makanannya
    $items = [];
    foreach ($order->transactions as $transaction) {
        $items[] = [
            'name' => $transaction->food->name,
            'qty' => $transaction->qty,
            'price' => 'Rp' . number_format($transaction->food->price, 0, ',', '.'),
        ];
    }

    $total = 0;
    foreach ($order->transactions as $transaction) {
        $total += $transaction->food->price * $transaction->qty;
    }


    $orderStatuses[] = [
        'orderId' => $order->id,
        'status' => $statusKey,
        'orderPlacedLabel' => 'ORDER PLACED',
        'orderPlacedDate' => $order->created_at->format('d M Y'),
        'total' => 'Rp' . number_format($total, 0, ',', '.'),
        'restoName' => $order->restaurant->name,
        'restoLocation' => $order->restaurant->address ?? 'Unknown Location',
        'readyPickupText' => match ($order->status) {
            'Order Created' => 'Waiting for Confirmation',
            'Ready to Pickup' => 'Ready to Pick Up',
            'Order Completed' => 'Completed',
            'Order Reviewed' => 'Reviewed',
            default => '',
        },
        'items' => $items,
        'reviewButtonText' => match ($order->status) {
            'Order Reviewed' => null, // Tombol tidak muncul
            'Order Completed' => 'Review Order',
            default => null,
        },
    ];
}

    return view('activity', compact('orders', 'totalDonated', 'orderStatuses'));
}

public function rate(Request $request, $id)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $order = Order::findOrFail($id);

    $order->rating = $request->input('rating');
    $order->status = 'Order Reviewed'; // Pastikan kapital-nya sesuai DB kamu
    $order->save();

    $restaurant = Restaurant::find($order->restaurant_id);
    if ($restaurant) {
        $avg = Order::where('restaurant_id', $restaurant->id)
            ->whereNotNull('rating')
            ->avg('rating');

        $restaurant->avg_rating = $avg;
        $restaurant->save();
    }

    return redirect()->back()->with('success', 'Thanks for your review!');
}



    public function download(Request $request)
    {
        $currentUser = Auth::user();

        if (!$currentUser) {
            return redirect()->route('selection.login');
        }

        $currentUser = User::find($currentUser->id);

        if ($currentUser->role !== 'restaurant') {
            return redirect()->back()->withErrors(['error' => 'You do not have permission to access this.']);
        }

        // Get transactions
        $transactions = $currentUser->restaurant
            ->orders()
            ->whereIn('status', ['Order Completed', 'Order Reviewed'])
            ->with(['transactions.order.customer', 'transactions.food'])
            ->get()
            ->pluck('transactions')
            ->flatten();

        $minDate = $request->query('start_date');
        $maxDate = $request->query('end_date');

        if ($minDate && $maxDate) {
            $minDate = Carbon::parse($minDate)->startOfDay();
            $maxDate = Carbon::parse($maxDate)->endOfDay();

            $transactions = $transactions->filter(function ($transaction) use ($minDate, $maxDate) {
                return $transaction->created_at >= $minDate && $transaction->created_at <= $maxDate;
            });
        }

        // Generate CSV filename
        $filename = 'transactions_' . now()->format('Ymd_His') . '.csv';
        $filepath = 'tmp/' . $filename;

        if (!Storage::exists('tmp')) {
            Storage::makeDirectory('tmp');
        }

        $fullPath = Storage::path($filepath);
        $handle = fopen($fullPath, 'w');
        fputcsv($handle, ['No', 'Order ID', 'Date', 'Customer Name', 'Food Name', 'Qty', 'Price', 'Total Price']);

        foreach ($transactions as $index => $transaction) {
            fputcsv($handle, [
                $index + 1,
                $transaction->order_id ?? 'N/A',
                $transaction->created_at->format('Y-m-d'),
                $transaction->order->customer->username ?? 'N/A',
                $transaction->food->name ?? 'N/A',
                $transaction->qty,
                number_format($transaction->food->price, 2),
                number_format($transaction->food->price * $transaction->qty, 2),
            ]);
        }

        fclose($handle);

        return Storage::download($filepath, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function restaurantActivity(Request $request)
{
    $user = Auth::user();

    if (!$user || $user->role !== 'restaurant') {
        return redirect('/')->withErrors(['error' => 'Unauthorized access']);
    }

    $query = $user->restaurant->orders()
        ->with(['customer'])
        ->whereNotNull('rating');

    if ($request->has('rating')) {
        $query->where('rating', $request->rating);
    }

    $orders = $query->orderBy('created_at', 'desc')->get();


    return view('restaurant-activity', compact('orders'));
}

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
                Transaction::create([
                    'order_id' => $order->id,
                    'food_id' => $item->food_id,
                    'qty' => $item->quantity,
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

