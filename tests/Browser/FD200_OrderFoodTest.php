<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FD200_OrderFoodTest extends DuskTestCase
{
    // TC1 – Add food to cart from /foods page
    public function test_customer_can_add_food_to_cart_from_foods_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->first())
                ->visit('/foods')
                ->waitFor('@add-to-cart-1')
                ->press('@add-to-cart-1')
                ->pause(200)
                ->visit('/cart')
                ->assertPathIs('/cart')
                ->assertSeeIn('.added-to-cart-container', 'Grilled Chicken Satay'); // Update with expected food name
        });
    }

    // TC2 – Add food to cart from /resto/{id} page
    public function test_customer_can_add_food_to_cart_from_restaurant_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->skip(1)->first())
                ->visit('/foods/resto/1')
                ->waitFor('@add-to-cart-2')
                ->press('@add-to-cart-2')
                ->pause(200)
                ->visit('/cart')
                ->assertPathIs('/cart')
                ->assertSeeIn('.added-to-cart-container', 'Spiced Beef Burger');
        });
    }

    // TC3 – Add multiple items from same restaurant
    public function test_customer_can_add_multiple_items_from_same_restaurant()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->skip(2)->first())
                ->visit('/foods/resto/1')
                ->press('@add-to-cart-2')
                ->waitFor('@add-to-cart-2')
                ->pause(200)
                ->waitFor('@add-to-cart-1')
                ->press('@add-to-cart-1')
                ->pause(200)
                ->visit('/cart')
                ->assertSeeIn('.added-to-cart-container', 'Grilled Chicken Satay');
        });
    }

    // TC4 – Try to add food from different restaurant
    public function test_customer_cannot_add_food_from_different_restaurant()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->skip(3)->first())
                ->visit('/foods/resto/1')
                ->waitFor('@add-to-cart-2')
                ->press('@add-to-cart-2')
                ->pause(200)
                ->visit('/foods/resto/2')
                ->waitFor('@add-to-cart-10')
                ->press('@add-to-cart-10')
                ->pause(1000)
                ->waitForText('You can only order from one restaurant')
                ->assertSee('You can only order from one restaurant');
        });
    }

    // TC5 – Successfully checkout with valid cart
    public function test_customer_can_checkout_with_valid_cart()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->skip(4)->first())
                ->visit('/foods')
                ->waitFor('@add-to-cart-1')
                ->press('@add-to-cart-1')
                ->pause(200)
                ->waitFor('.mycart')
                ->click('.mycart')
                ->pause(200)
                ->waitFor('.checkout-btn')
                ->press('.checkout-btn')
                ->waitFor('#checkoutModal')
                ->radio('paymentMethod', 'qris')
                ->waitFor('#proceedToPaymentBtn')
                ->press('#proceedToPaymentBtn')
                ->waitFor('#confirmPaymentForm')
                ->press('#confirmPaymentForm button[type=submit]')
                ->waitForText('PICK UP LOCATION')
                ->assertSee('PICK UP LOCATION');
        });
    }

    // TC6 – Attempt checkout with empty cart
    public function test_customer_cannot_checkout_with_empty_cart()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->skip(5)->first())
                ->visit('/cart')
                ->waitFor('.checkout-btn')
                ->press('.checkout-btn')
                ->waitFor('#checkoutModal')
                ->radio('paymentMethod', 'qris')
                ->waitFor('#proceedToPaymentBtn')
                ->press('#proceedToPaymentBtn')
                ->waitFor('#confirmPaymentForm')
                ->press('#confirmPaymentForm button[type=submit]')
                ->pause(200)
                ->waitForText('Your cart is empty.')
                ->assertSee('Your cart is empty.');
        });
    }

    // TC7 – Click “Cancel” from cart page
    public function test_customer_can_cancel_cart()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->skip(6)->first())
                ->visit('/foods')
                ->waitFor('@add-to-cart-1')
                ->press('@add-to-cart-1')
                ->pause(500)
                ->visit('/cart')
                ->waitFor('.cancel-order-btn')
                ->press('.cancel-order-btn')
                ->acceptDialog() // <--- This line is essential to handle JS alert
                ->waitForLocation('/foods')
                ->assertPathIs('/foods')
                ->assertSee('Your cart has been cleared.');
        });
    }

    // TC8 – Abandon cart after adding food
    public function test_customer_can_abandon_cart_and_return_later()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->skip(7)->first())
                ->visit('/foods')
                ->waitFor('@add-to-cart-1')
                ->press('@add-to-cart-1')
                ->pause(500)
                ->visit('/foods')
                ->assertSeeIn('.cart-resto-badge', 'VISIT RESTO');
        });
    }
}
