<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RR200_ReviewReportTest extends DuskTestCase
{
    // TC1 – Admin views and filters customer reports
    public function test_admin_can_filter_customer_reports_by_status()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('role', 'admin')->first();

            $browser->loginAs($admin)
                ->visit('/admin/manage-reports')
                ->waitForText('REPORTS')
                ->assertSee('REPORTS')
                ->assertPresent('.table-row-entry')
                ->click('@filter-pending')
                ->assertSee('Pending')
                ->click('@report-1')
                ->waitFor('@safe-btn')
                ->click('@safe-btn')
                ->waitFor('@filter-resolved')
                ->click('@filter-resolved')
                ->waitForText('Resolved')
                ->assertSeeIn('.table', 'Resolved');
        });
    }

    // TC2 – Admin searches and manages a report
    public function test_admin_can_search_and_manage_reports()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('role', 'admin')->first();

            $browser->loginAs($admin)
                ->visit('/admin/manage-reports')
                ->waitFor('@search-bar')
                ->type('@search-bar', 'kaum')
                ->keys('@search-bar', '{enter}')
                ->assertSee('KAUM')
                ->click('@report-2')
                ->waitFor('@suspend-btn')
                ->click('@suspend-btn')
                ->waitForText('Successfully suspend reported restaurant!')
                ->assertSee('Successfully suspend reported restaurant!');
        });
    }
}
