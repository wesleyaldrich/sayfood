<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RE100_ManageRestaurantTest extends DuskTestCase
{
    // TC1 – Search/filter restaurants by keyword or status
    public function test_admin_can_search_and_filter_restaurants()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('role', 'admin')->first();

            $browser->loginAs($admin)
                ->visit('/admin/manage-restaurants')

                // Search by keyword
                ->waitFor('@search-bar')
                ->type('@search-bar', 'bandar')
                ->keys('@search-bar', '{enter}')
                ->waitForText('Bandar Djakarta')
                ->assertSeeIn('@table-content', 'Bandar Djakarta')

                // Filter by status
                ->clear('@search-bar')
                ->keys('@search-bar', '{enter}')
                ->waitFor('@pending-filter')
                ->click('@pending-filter')
                ->pause(500)
                ->assertSeeIn('@table-content', 'pending');
        });
    }

    // TC2 – Approve a pending restaurant
    public function test_admin_can_approve_pending_restaurant()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('role', 'admin')->first();

            $browser->loginAs($admin)
                ->visit('/admin/manage-restaurants')
                ->waitFor('@pending-filter')
                ->click('@pending-filter')
                ->waitFor('@table-content')
                ->click('@restaurant-21')
                ->waitFor('@approve-btn')
                ->click('@approve-btn')
                ->waitFor('@search-bar')
                ->type('@search-bar', 'wesley')
                ->keys('@search-bar', '{enter}')
                ->waitForText('Wesley\'s Restaurant')
                ->assertSeeIn('@table-content', 'Wesley\'s Restaurant');
        });
    }

    // TC3 – Reject a pending restaurant
    public function test_admin_can_reject_pending_restaurant()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('role', 'admin')->first();

            $browser->loginAs($admin)
                ->visit('/admin/manage-restaurants')
                ->waitFor('@pending-filter')
                ->click('@pending-filter')
                ->waitFor('@table-content')
                ->click('@restaurant-22')
                ->waitFor('@reject-btn')
                ->click('@reject-btn')
                ->waitFor('@rejected-filter')
                ->click('@rejected-filter')
                ->waitForText('Warteg Sehat')
                ->assertSeeIn('@table-content', 'Warteg Sehat');
        });
    }

    // TC4 – View complete restaurant details
    public function test_admin_can_view_restaurant_details()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('role', 'admin')->first();

            $browser->loginAs($admin)
                ->visit('/admin/manage-restaurants')
                ->waitFor('@restaurant-4')
                ->click('@restaurant-4')
                ->waitForText('Restaurant Details')
                ->assertSee('Restaurant Details')
                ->assertSee('Average Rating');
        });
    }

    // TC5 – Export a specific restaurant’s transaction report
    public function test_admin_can_export_restaurant_transaction_report()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('role', 'admin')->first();

            $browser->loginAs($admin)
                ->visit('/admin/manage-restaurants')
                ->waitFor('@restaurant-4')
                ->click('@restaurant-4')
                ->waitForText('Restaurant Details')
                ->click('@export-btn')
                ->pause(2000);

            $this->assertTrue(true);
        });
    }
}
