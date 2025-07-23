<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $cartItemCount = 0;
        $cartRestaurant = null;

        if (Auth::check()) {
            $cartItemCount = Cart::where('user_id', Auth::id())->sum('quantity');

            if ($cartItemCount > 0) {
                $firstItemCart = Cart::where('user_id', Auth::id())->with('food.restaurant')->first();

                if ($firstItemCart && $firstItemCart->food && $firstItemCart->food->restaurant) {
                    $cartRestaurant = $firstItemCart->food->restaurant;
                }
            }
        }
        
        $view->with('cartItemCount', $cartItemCount)
             ->with('cartRestaurant', $cartRestaurant);
    }
}