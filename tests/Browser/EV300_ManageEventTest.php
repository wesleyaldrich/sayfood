<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EV300_ManageEventTest extends DuskTestCase
{
    // TC1 – Admin filters or searches events
    public function test_admin_can_filter_and_search_events()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('role', 'admin')->first();

            $browser->loginAs($admin)
                ->visit('/admin/manage-events')

                // Filter by "Completed"
                ->waitFor('@filter-completed')
                ->click('@filter-completed')
                ->assertSeeIn('@event-table', 'Completed')

                // Search by keyword
                ->type('@search-bar', 'ramadan')
                ->keys('@search-bar', '{enter}')
                ->waitForText('Ascott Takes Part Ramadan 2025')
                ->assertSee('Ascott Takes Part Ramadan 2025');
        });
    }

    // TC2 – Admin views and takes action on event
    public function test_admin_can_view_and_approve_or_reject_events()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('role', 'admin')->first();

            $browser->loginAs($admin)
                ->visit('/admin/manage-events')

                ->waitFor('@filter-pending')
                ->click('@filter-pending')
                ->waitFor('@event-2')
                ->click('@event-2')
                ->waitFor('@btn-approve')
                ->click('@btn-approve')
                ->waitForText('Customer Name')
                ->assertSee('Coming Soon')
                ->assertDontSee('Pending')
                
                ->click('@btn-back')
                ->click('@filter-pending')
                ->waitFor('@event-8')
                ->click('@event-8')
                ->waitFor('@btn-reject')
                ->click('@btn-reject')
                ->waitForText('Canceled')
                ->assertSee('Canceled')
                ->assertDontSee('Pending');
        });
    }
}
