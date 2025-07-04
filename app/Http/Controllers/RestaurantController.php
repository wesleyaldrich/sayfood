<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function show($id)
        {
            $restaurant = Restaurant::with('foods')->findOrFail($id);
            $mainCourses = Food::where('restaurant_id', $id)->where('category_id', 1)->get();
            $desserts    = Food::where('restaurant_id', $id)->where('category_id', 2)->get();
            $drinks      = Food::where('restaurant_id', $id)->where('category_id', 3)->get();
            $snacks      = Food::where('restaurant_id', $id)->where('category_id', 4)->get();
            return view('restaurantmenu-customer', compact('restaurant','mainCourses', 'desserts', 'snacks', 'drinks'));
        }

}
