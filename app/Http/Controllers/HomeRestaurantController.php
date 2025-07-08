<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeRestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
        {
        $user = Auth::user();
        if (!$user || $user->role !== 'restaurant') {
            return redirect()->route('selection.login');
        }

        $restaurant = $user->restaurant;

        // Get all orders today for this restaurant
        $todayOrders = $restaurant->orders()
            ->whereDate('created_at', Carbon::today())
            ->whereIn('status', ['Order Completed', 'Order Reviewed'])
            ->with('transactions.food')
            ->get();

        // Total orders today
        $totalOrdersToday = $todayOrders->count();

        // Today's income (sum of all food price × quantity)
        $todaysIncome = 0;
        $foodCounts = [];

        foreach ($todayOrders as $order) {
            foreach ($order->transactions as $transaction) {
                $income = $transaction->qty * $transaction->food->price;
                $todaysIncome += $income;

                // Count most purchased food
                $foodName = $transaction->food->name;
                if (!isset($foodCounts[$foodName])) {
                    $foodCounts[$foodName] = 0;
                }
                $foodCounts[$foodName] += $transaction->qty;
            }
        }

        // Get the most purchased food today
        arsort($foodCounts); // Sort descending
        $mostPurchased = array_key_first($foodCounts) ?? 'N/A';

        // Get Orders
        $orders = $user->restaurant->orders()
        ->whereIn('status', ['Order Created', 'Ready to Pickup'])
        ->with(['customer', 'transactions.food.category'])
        ->orderBy('created_at', 'desc')
        ->get();

        // Get Reviewed Orders
        $reviewedOrders = $user->restaurant->orders()
        ->whereIn('status', ['Order Reviewed'])
        ->with(['customer', 'transactions.food.category'])
        ->orderBy('updated_at', 'desc')
        ->take(5)
        ->get();

        // Define the start of this week (Monday)
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // Get all orders for this week
        $weeklyOrders = $restaurant->orders()
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->whereIn('status', ['Order Completed', 'Order Reviewed'])
            ->with('transactions.food.category')
            ->get();

        // Initialize category counts
        $categoryCounts = [
            'Main Course' => 0,
            'Dessert'     => 0,
            'Snacks'       => 0,
            'Drinks'       => 0,
        ];

        foreach ($weeklyOrders as $order) {
            foreach ($order->transactions as $transaction) {
                $categoryName = $transaction->food->category->name ?? null;
                if (isset($categoryCounts[$categoryName])) {
                    $categoryCounts[$categoryName] += $transaction->qty;
                }
            }
        }

        return view('restaurant-home', compact(
            'totalOrdersToday',
            'todaysIncome',
            'mostPurchased', 
            'orders', 
            'reviewedOrders', 
            'categoryCounts'
        ));
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
    public function show(string $id)
    {
        //
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
