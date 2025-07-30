<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AC300_RestaurantActivityTest extends DuskTestCase
{
    // TC1 – View all customer reviews
    public function test_restaurant_can_view_all_customer_reviews()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'restaurant')->first();

            $browser->loginAs($user)
                ->visit('/restaurant-activity')
                ->waitFor('@filter-rating-1')
                ->waitFor('@filter-rating-2')
                ->waitFor('@filter-rating-3')
                ->waitFor('@filter-rating-4')
                ->waitFor('@filter-rating-5')
                ->assertSee('Rating');
        });
    }

    // TC2 – View only 5-star reviews
    public function test_restaurant_can_filter_5_star_reviews()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'restaurant')->first();

            $browser->loginAs($user)
                ->visit('/restaurant-activity')
                ->waitFor('@filter-rating-4')
                ->click('@filter-rating-4')
                ->waitFor('@nostar-5')
                ->assertPresent('@nostar-5')
                ->assertPresent('@star-4');
        });
    }
}
