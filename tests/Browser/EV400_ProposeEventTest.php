<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EV400_ProposeEventTest extends DuskTestCase
{
    // TC1 – Admin submits a valid proposed event
    public function test_admin_can_filter_and_search_events()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('role', 'admin')->first();

            $browser->loginAs($admin)
                ->visit('/admin/manage-events')

                // Open modal
                ->waitFor('@open-create-event-modal')
                ->click('@open-create-event-modal')
                ->waitFor('#createEventModal')

                // Fill the form
                ->type('#name', 'SayFood Fair 2025')
                ->type('#description', 'A great food fair for awareness')
                ->select('#event_category_id', '1')
                ->type('#date', now()->addDays(5)->format('m-d-Y'))
                ->type('#location', 'Jakarta Food Center')
                ->type('[name="start_hour"]', '9')
                ->type('[name="start_minute"]', '0')
                ->select('[name="start_ampm"]', 'AM')
                ->type('[name="end_hour"]', '11')
                ->type('[name="end_minute"]', '30')
                ->select('[name="end_ampm"]', 'AM')
                ->type('#group_link', 'https://chat.whatsapp.com/abc123')
                ->attach('#image_url', __DIR__ . '/files/event_cover.jpg')

                // Submit form
                ->press('@create-event-btn')
                ->waitForText('SayFood Fair 2025')
                ->assertSeeIn('@event-table', 'SayFood Fair 2025');
        });
    }
    
    // TC2 – Admin submits event with missing fields
    public function test_admin_submit_event_with_missing_fields()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('role', 'admin')->first();

            $browser->loginAs($admin)
                ->visit('/admin/manage-events')

                // Open modal
                ->waitFor('@open-create-event-modal')
                ->click('@open-create-event-modal')
                ->waitFor('#createEventModal')

                // Fill the form
                ->press('@create-event-btn')
                ->assertPathIs('/admin/manage-events')
                ->type('#name', 'SayFood Fair 2025')
                ->type('#description', 'A great food fair for awareness')
                ->select('#event_category_id', '1')
                ->type('#date', '10-10-2020')
                ->type('#location', 'Jakarta Food Center')
                ->type('[name="start_hour"]', '9')
                ->type('[name="start_minute"]', '0')
                ->select('[name="start_ampm"]', 'AM')
                ->type('[name="end_hour"]', '8')
                ->type('[name="end_minute"]', '30')
                ->select('[name="end_ampm"]', 'AM')
                ->type('#group_link', 'https://chat.whatsapp.com/abc123')
                ->attach('#image_url', __DIR__ . '/files/event_cover.jpg')

                // Submit form
                ->press('@create-event-btn')
                ->waitForText('End time must be after the start time.')
                ->assertSee('The event date cannot be in the past.')
                ->assertSee('End time must be after the start time.');
        });
    }
}
