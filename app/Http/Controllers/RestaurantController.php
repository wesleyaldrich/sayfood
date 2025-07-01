<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
   public function manageFood(){
    $restaurantId = Auth::user()->restaurant->id;
    $restaurant = Restaurant::with('food')->findOrFail($restaurantId);
    $foods = Food::where('restaurant_id', $restaurantId)->get();

    
    return view('restaurant-foods', compact('restaurant', 'foods'));
   }
}
