<?php

namespace App\Http\Controllers;

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
}
