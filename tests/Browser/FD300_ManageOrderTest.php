<?php

namespace Tests\Browser;

use App\Models\Food;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FD300_ManageOrderTest extends DuskTestCase
{
    private function createOrderWithStatus(string $status): Order
    {
        $customer = User::where('role', 'customer')->first();
        $restaurant = Restaurant::first();
        $food = Food::where('restaurant_id', $restaurant->id)->first();

        if (!$customer || !$restaurant || !$food) {
            throw new \Exception("Required test data (customer, restaurant, or food) is missing.");
        }

        $order = Order::create([
            'customer_id' => $customer->id,
            'restaurant_id' => $restaurant->id,
            'status' => $status,
            'rating' => null,
        ]);

        Transaction::create([
            'food_id' => $food->id,
            'order_id' => $order->id,
            'qty' => 1,
            'notes' => 'Test note',
        ]);

        return $order;
    }

    // TC1 – Accept new order
    public function test_restaurant_can_accept_new_order()
    {
        $order = $this->createOrderWithStatus('Order Created');
        $restaurantUser = User::where('role', 'restaurant')->first();

        $this->browse(function (Browser $browser) use ($restaurantUser, $order) {
            $browser->loginAs($restaurantUser)
                ->visit('/restaurant-orders')
                ->waitFor("@accept-btn-{$order->id}")
                ->press("@accept-btn-{$order->id}")
                ->assertSeeIn("@accepted-btn-{$order->id}", 'Accepted');
        });

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'Ready to Pickup',
        ]);
    }

    // TC2 – Complete accepted order
    public function test_restaurant_can_complete_accepted_order()
    {
        $order = $this->createOrderWithStatus('Order Created');
        $restaurantUser = User::where('role', 'restaurant')->first();

        $this->browse(function (Browser $browser) use ($restaurantUser, $order) {
            $browser->loginAs($restaurantUser)
                ->visit('/restaurant-orders')
                ->waitFor("@accept-btn-{$order->id}")
                ->press("@accept-btn-{$order->id}")
                ->waitFor("@accepted-btn-{$order->id}")
                ->press("@accepted-btn-{$order->id}")
                ->waitFor("@completed-btn-{$order->id}")
                ->assertSeeIn("@completed-btn-{$order->id}", 'Completed');
        });

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'Order Completed',
        ]);
    }

    // TC3 – Prevent skipping steps (Complete without Accept)
    public function test_restaurant_cannot_complete_without_accepting()
    {
        $order = $this->createOrderWithStatus('Order Created');
        $restaurantUser = User::where('role', 'restaurant')->first();

        $this->browse(function (Browser $browser) use ($restaurantUser, $order) {
            $browser->loginAs($restaurantUser)
                ->visit('/restaurant-orders')
                ->waitFor("@accept-btn-{$order->id}")
                ->press("@accept-btn-{$order->id}")
                ->assertSeeIn("@accepted-btn-{$order->id}", 'Accepted')
                ->assertMissing("@completed-btn-{$order->id}");
        });
    }
}
