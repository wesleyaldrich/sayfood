<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AC100_FoodActivityTest extends DuskTestCase
{
    // TC1 – View order history with correct details
    public function test_customer_can_view_order_history_with_correct_details()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->first())
                ->visit('/activity')
                ->waitFor('.activity-list')
                ->assertSeeIn('.activity-list:first-child', 'ORDER PLACED')
                ->assertSeeIn('.activity-list:first-child', 'TOTAL')
                ->assertSeeIn('.activity-list:first-child', 'PICK UP LOCATION')
                ->assertSeeIn('.activity-list:first-child', 'See Details');
        });
    }

    // TC2 – Submit a review for a completed order
    public function test_customer_can_submit_review_for_completed_order()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->skip(1)->first())
                ->visit('/activity')
                ->waitFor('.dropdown-toggle')
                ->press('.dropdown-toggle')
                ->waitFor('.dropdown-toggle')
                ->press('.review-order-btn')
                ->waitFor('.custom-review-modal')
                ->waitFor('.star-rating')
                ->click('@star-5')
                ->press('@submit-review-btn')
                ->waitForText('Order Reviewed')
                ->assertSeeIn('.activity-list:first-child', 'Order Reviewed')
                ->assertMissing('.star-rating:nth-child(5)'); // Make sure the button is gone
        });
    }

    // TC3 – Prevent duplicate reviews
    public function test_customer_cannot_review_already_reviewed_order()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->skip(1)->first())
                ->visit('/activity')
                ->pause(500)
                ->waitFor('.dropdown-toggle')
                ->press('.dropdown-toggle')
                ->waitForText('DETAILS')
                ->assertMissing('.review-order-btn'); // Button should not exist
        });
    }
}
