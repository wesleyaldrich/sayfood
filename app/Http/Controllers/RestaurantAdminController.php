<?php

namespace App\Http\Controllers;

use App\Models\RestaurantRegistration;
use Illuminate\Http\Request;

class RestaurantAdminController extends Controller
{
    public function index()
    {
        $targetStatus = request()->query('status', 'operational');

        $restaurant_registrations = RestaurantRegistration::query()->where('status', $targetStatus)
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('admin-manage-restaurants', compact('restaurant_registrations'));
    }
}
