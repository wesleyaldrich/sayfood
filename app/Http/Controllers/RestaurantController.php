<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
   public function manageFood(){
    $restaurantId = Auth::user()->restaurant->id;
    $restaurant = Restaurant::with('food')->findOrFail($restaurantId);
    $foods = Food::where('restaurant_id', $restaurantId)->get();
    $categories = Category::all();
    
    return view('restaurant-foods', compact('restaurant', 'foods', 'categories'));
   }

   public function store(Request $request){
      dd($request->all());
      $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id', 
        'description' => 'required|string',
        'exp_date' => 'required|date',
        'exp_time' => 'required|date_format:H:i', 
        'stock' => 'required|integer|min:0'
    ]);

      $restaurantId = Auth::user()->restaurant->id;

      $expDatetime = Carbon::parse($validatedData['exp_date'].''.$validatedData['exp_time']);
      
      $status = $request->has('status')?'available':'unavailable';

      Food::create([
         'restaurant_id'=>$restaurantId,
         'name'=>$validatedData['name'],
         'category_id'=>$validatedData['category_id'],
         'description'=>$validatedData['description'],
         'exp_datetime'=>$expDatetime,
         'stock'=>$validatedData['stock'],
         'status'=>$status,
      ]);

      return redirect()->back()->with('success', 'Food item has been added successfully!');
   }
}
