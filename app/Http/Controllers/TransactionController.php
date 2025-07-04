<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
