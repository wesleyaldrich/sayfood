<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EV100_JoinEventTest extends DuskTestCase
{
    // TC1 – Join upcoming event with valid phone number
    public function test_customer_can_submit_report_for_restaurant()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->skip(5)->first())
                ->visit('/events')
                ->waitFor('.event-card')
                ->press('@join-event-btn')
                ->waitFor('#joinFormModal')
                ->type('#phoneNumber', '081273236490')
                ->press('@submit-join-event-btn')
                ->waitForText('Successfully joined the event!')
                ->assertSee('Successfully joined the event!');
        });
    }

    // TC2 – Attempt to join event with invalid phone number
    public function test_customer_cannot_join_event_with_invalid_phone()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->skip(6)->first())
                ->visit('/events')
                ->waitFor('.event-card')
                ->press('@join-event-btn')
                ->waitFor('#joinFormModal')
                ->type('#phoneNumber', '') // empty field
                ->press('@submit-join-event-btn')
                ->waitForText('The phone number field is required.')
                ->assertSee('The phone number field is required.')
                ->waitFor('.event-card')
                ->press('@join-event-btn')
                ->waitFor('#joinFormModal')
                ->type('#phoneNumber', '123') // incorrect length of phone number
                ->press('@submit-join-event-btn')
                ->waitForText('The phone number field must be between 10 and 15 digits.')
                ->assertSee('The phone number field must be between 10 and 15 digits.');
        });
    }

    // TC3 – Attempt to join same event twice
    public function test_customer_cannot_join_same_event_twice()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->skip(7)->first())
                ->visit('/events')
                ->waitFor('.event-card')
                ->press('@join-event-btn')
                ->waitFor('#joinFormModal')
                ->type('#phoneNumber', '081273236490')
                ->press('@submit-join-event-btn')
                ->waitForText('Successfully joined the event!')
                ->assertSee('Successfully joined the event!')
                ->visit('/events')
                ->waitFor('.event-card')
                ->press('@join-event-btn')
                ->waitFor('#joinFormModal')
                ->type('#phoneNumber', '081273236490')
                ->press('@submit-join-event-btn')
                ->waitForText('You have already joined this event.')
                ->assertSee('You have already joined this event.');
        });
    }
}
