<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RR100_ReportRestaurantTest extends DuskTestCase
{
    // TC1 – Submit a report for a restaurant
    public function test_customer_can_submit_report_for_restaurant()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->first())
                ->visit('/foods/resto/2')
                ->waitFor('.report-resto')
                ->press('.report-resto')
                ->waitFor('#reportModal')
                ->type('#otherTextarea', 'Rude service bro')
                ->press('@submit-report-button')
                ->waitForText('Your report has been submitted.')
                ->assertSee('Your report has been submitted.');
        });

        $this->assertDatabaseHas('reports', [
            'restaurant_id' => 2,
            'description' => 'Rude service bro'
        ]);
    }

    // TC2 – Prevent report submission without reason
    public function test_customer_cannot_submit_report_without_reason()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->skip(1)->first())
                ->visit('/foods/resto/2')
                ->waitFor('.report-resto')
                ->press('.report-resto')
                ->waitFor('#reportModal')
                ->type('#otherTextarea', '')
                ->press('@submit-report-button')
                ->waitForText('Please select a reason or write a report.')
                ->assertSee('Please select a reason or write a report.');
        });
    }
}
