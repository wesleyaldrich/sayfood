<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
   public function manageFood(){
    $restaurantId = Auth::user()->restaurant->id;
    $restaurant = Restaurant::with('foods')->findOrFail($restaurantId);
    $foods = $restaurant->food;

    
    
    return view('restaurant-foods', compact('restaurant', 'foods'));
   }
}
