<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AC200_EventActivityTest extends DuskTestCase
{
    // TC1 – Display created events with status
    public function test_created_events_are_listed_with_status()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'customer')->skip(0)->first();

            $browser->loginAs($user)
                ->visit('/activity')
                ->waitFor('#charity-tab')
                ->click('#charity-tab')
                ->waitFor('.created-event-wrapper')
                ->click('.created-events-card')
                ->waitForText('Pending')
                ->assertSee('Pending');
        });
    }

    // TC2 – Display joined ongoing events
    public function test_joined_ongoing_events_are_listed()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'customer')->skip(0)->first();

            $browser->loginAs($user)
                ->visit('/activity')
                ->waitFor('#charity-tab')
                ->click('#charity-tab')
                ->waitFor('.event-cards-wrapper')
                ->click('@event-card.upcoming')
                ->waitFor('#eventModal0')
                ->assertSee('Community');
        });
    }

    // TC3 - Display joined past events
    public function test_customer_sees_joined_past_events()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'customer')->skip(3)->first();

            $browser->loginAs($user)
                ->visit('/activity')
                ->waitFor('#charity-tab')
                ->click('#charity-tab')
                ->waitFor('.event-grid')
                ->assertSeeIn('@past-events-card', 'participants');
        });
    }

    // TC4 – Show empty state if no created or joined events exist
    public function test_customer_sees_empty_state_if_no_created_or_joined_events()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'customer')->skip(7)->first();

            $browser->loginAs($user)
                ->visit('/activity')
                ->waitFor('#charity-tab')
                ->click('#charity-tab')
                ->waitForText('No completed events yet.')
                ->assertSee('No completed events yet.');
        });
    }
}
