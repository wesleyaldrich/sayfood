<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EV200_ProposeEventTest extends DuskTestCase
{
    // TC1 – Successfully propose an event with valid fields
    public function test_customer_can_propose_event_with_valid_fields()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'customer')->skip(4)->first();

            $browser->loginAs($user)
                ->visit('/activity')
                ->waitFor('#charity-tab')
                ->click('#charity-tab')
                ->waitFor('.create-event')
                ->press('.btn-propose-event')
                ->waitFor('#proposeEventModal')
                ->type('@event-name-input', 'Makan Kuy Festival')
                ->select('@event-category-input', '1')
                ->type('@event-description-input', 'An event to share leftover meals with the community.')
                ->type('@event-participants-input', '50')
                ->type('@event-link-input', 'https://chat.whatsapp.com/abc123')
                ->attach('@event-cover-input', __DIR__ . '/files/event_cover.jpg')
                ->attach('@event-proposal-input', __DIR__ . '/files/proposal.csv')
                ->type('@event-location-input', 'Lapangan Merdeka, Jakarta')
                ->type('@event-date-input', '10/30/2025')
                ->type('start_hour', '10')
                ->type('start_minute', '00')
                ->select('start_ampm', 'AM')
                ->type('end_hour', '01')
                ->type('end_minute', '00')
                ->select('end_ampm', 'PM')
                ->type('organizer_name', 'Kalista Gabriela')
                ->type('organizer_phone', '081234567890')
                ->type('organizer_email', 'kalista@example.com')
                ->press('.btn-terms')
                ->pause('1000')
                ->waitFor('#termsAndConditionsModal')
                ->click('#agreeTermsCheckBox')
                ->pause('1000')
                ->waitFor('#proposeEventModal')
                ->press('@submit-propose-btn')
                ->assertPathIs('/activity');
        });
    }

    // TC2 – Attempt to propose event with invalid input
    public function test_customer_cannot_propose_event_with_invalid_fields()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'customer')->skip(4)->first();

            $browser->loginAs($user)
                ->visit('/activity')
                ->click('#charity-tab')
                ->waitFor('.create-event')
                ->press('.btn-propose-event')
                ->waitFor('#proposeEventModal')

                // Fill invalid / empty data
                ->type('@event-name-input', '') // Leave empty
                ->select('@event-category-input', '') // Invalid option
                ->type('@event-description-input', '') // Leave empty
                ->type('@event-participants-input', '') // Leave empty
                ->type('@event-link-input', '') // Leave empty
                // No file attachments
                ->type('@event-location-input', '') // Leave empty
                ->type('@event-date-input', '') // Leave empty
                ->type('start_hour', '') // Leave empty
                ->type('start_minute', '') // Leave empty
                ->type('end_hour', '') // Leave empty
                ->type('end_minute', '') // Leave empty
                ->type('organizer_name', '') // Leave empty
                ->type('organizer_phone', '') // Leave empty
                ->type('organizer_email', '') // Leave empty
                // Do not agree to terms
                ->press('@submit-propose-btn')

                // Assert error messages are shown
                ->waitForText('The agree terms field must be accepted.')
                ->assertSee('The name field is required.')
                ->assertSee('The event category id field is required.')
                ->assertSee('The description field is required.')
                ->assertSee('The estimated participants field is required.')
                ->assertSee('The group link field is required.')
                ->assertSee('The image field is required.')
                ->assertSee('The location field is required.')
                ->assertSee('The date field is required.')
                ->assertSee('The start hour field is required.')
                ->assertSee('The start minute field is required.')
                ->assertSee('The end hour field is required.')
                ->assertSee('The end minute field is required.')
                ->assertSee('The organizer name field is required.')
                ->assertSee('The organizer phone field is required.')
                ->assertSee('The organizer email field is required.')
                ->assertSee('The agree terms field must be accepted.')

                ->waitForText('Event Details')
                ->type('@event-date-input', '01/01/2020')
                ->type('start_hour', '2')
                ->type('start_minute', '02')
                ->select('start_ampm', 'AM')
                ->type('end_hour', '1')
                ->type('end_minute', '01')
                ->select('end_ampm', 'AM')
                ->press('@submit-propose-btn')

                ->waitForText('Event Details')
                ->assertSee('The date field must be a date after or equal to today.')
                ->assertSee('End time must be after start time.');
        });
    }

    // TC3 – Ensure proposed event is marked as "Pending"
    public function test_proposed_event_is_saved_with_pending_status()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'customer')->skip(5)->first();

            $browser->loginAs($user)
                ->visit('/activity')
                ->waitFor('#charity-tab')
                ->click('#charity-tab')
                ->waitFor('.create-event')
                ->press('.btn-propose-event')
                ->waitFor('#proposeEventModal')
                ->type('@event-name-input', 'Makan Kuy Festival')
                ->select('@event-category-input', '1')
                ->type('@event-description-input', 'An event to share leftover meals with the community.')
                ->type('@event-participants-input', '50')
                ->type('@event-link-input', 'https://chat.whatsapp.com/abc123')
                ->attach('@event-cover-input', __DIR__ . '/files/event_cover.jpg')
                ->attach('@event-proposal-input', __DIR__ . '/files/proposal.csv')
                ->type('@event-location-input', 'Lapangan Merdeka, Jakarta')
                ->type('@event-date-input', '10/30/2025')
                ->type('start_hour', '10')
                ->type('start_minute', '00')
                ->select('start_ampm', 'AM')
                ->type('end_hour', '01')
                ->type('end_minute', '00')
                ->select('end_ampm', 'PM')
                ->type('organizer_name', 'Kalista Gabriela')
                ->type('organizer_phone', '081234567890')
                ->type('organizer_email', 'kalista@example.com')
                ->press('.btn-terms')
                ->pause('1000')
                ->waitFor('#termsAndConditionsModal')
                ->click('#agreeTermsCheckBox')
                ->pause('1000')
                ->waitFor('#proposeEventModal')
                ->press('@submit-propose-btn')
                ->assertPathIs('/activity')
                
                ->waitFor('#charity-tab')
                ->click('#charity-tab')
                ->waitFor('.created-event-wrapper')
                ->click('.created-events-card')
                ->waitForText('Pending')
                ->assertSee('Pending');
        });
    }
}
