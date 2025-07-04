<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();
        $currentUser = User::find($currentUser->id);

        if ($currentUser->role === 'restaurant'){
            $transactions = $currentUser->restaurant->orders->flatMap->transactions;

            // dd($transactions);

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

    public function acceptOrder($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status === 'Order Created') {
            $order->status = 'Ready to Pickup';
            $order->save();
        }

        return redirect()->back();
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

            foreach ($orders as $order) {
                foreach ($order->transactions as $transaction) {
                    $totalDonated += $transaction->food->price * $transaction->qty;
                }
            }



            return view('activity', compact('orders', 'totalDonated'));
        }


}
