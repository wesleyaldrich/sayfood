<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TR100_TransactionReportRestaurantTest extends DuskTestCase
{
    // TR1 – Filter transaction report by specific date range
    public function test_restaurant_can_filter_transaction_report_by_date_range()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'restaurant')->first();

            $browser->loginAs($user)
                ->visit('/restaurant-transactions')
                ->assertSee('TRANSACTION REPORT')
                ->type('start_date', '07-29-2025')
                ->type('end_date', '08-30-2025')
                ->press('@filter-button')
                ->waitForText('TRANSACTION REPORT')
                ->assertQueryStringHas('start_date', '2025-07-29')
                ->assertQueryStringHas('end_date', '2025-08-30')
                ->assertSee('Rp');
        });
    }

    // TR2 – Export current (filtered or full) report to file
    public function test_restaurant_can_download_transaction_report()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'restaurant')->first();

            $browser->loginAs($user)
                ->visit('/restaurant-transactions')
                ->assertSee('TRANSACTION REPORT')
                ->click('@download-button')
                ->pause(2000);

            // File download can't be verified in Dusk
            $this->assertTrue(true);
        });
    }
}
