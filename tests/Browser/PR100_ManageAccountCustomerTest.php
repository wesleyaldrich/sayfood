<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PR100_ManageAccountCustomerTest extends DuskTestCase
{
    // TC1 – Upload valid profile picture
    public function test_customer_can_upload_valid_profile_picture()
    {
        $this->browse(function (Browser $browser) {
            $filePath = __DIR__ . '/files/profile_test.jpg';

            $browser->loginAs(User::where('role', 'customer')->first())
                ->visit('/profile')
                ->waitFor('#profile-image-form') // wait for outer form first
                ->pause(500); // short delay just in case

            // Unhide file input using JavaScript
            // ->script("document.getElementById('profile-image-input').style.display = 'flex';");

            $browser->attach('#profile-image-input', $filePath)
                ->waitFor('#profile-image-preview')
                ->assertVisible('#profile-image-preview')
                ->assertSee('Successfully updated profile image!');
        });
    }

    // TC2 – Display default profile picture
    public function test_new_customer_sees_default_profile_picture()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->skip(5)->first())
                ->visit('/profile')
                ->waitFor('#profile-image-form')
                ->pause(500)
                ->waitFor('.profile-image')
                ->assertAttributeContains('.profile-image', 'src', 'assets/example/profile.jpg');
        });
    }

    // TC3 – Upload invalid profile picture
    public function test_customer_cannot_upload_invalid_profile_picture()
    {
        $this->browse(function (Browser $browser) {
            $filePath = __DIR__ . '/files/invalid.xlsx';

            $browser->loginAs(User::where('role', 'customer')->skip(1)->first())
                ->visit('/profile')
                ->waitFor('#profile-image-form')
                ->pause(500)

                ->attach('#profile-image-input', $filePath)
                ->waitFor('#profile-image-preview')
                ->waitForText('The profile image field must be a file of type: jpeg, png, jpg, gif.')
                ->assertSee('The profile image field must be a file of type: jpeg, png, jpg, gif.');
        });
    }

    // TC4 – Update username, DOB, and address with valid data
    public function test_customer_can_update_profile_with_valid_data()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'customer')->first();

            $browser->loginAs($user)
                ->visit('/profile')
                ->waitFor('#username')
                ->type('#username', 'Updated Name')
                ->type('#dob', '10/05/1999')
                ->type('#address', 'Jl. Test No. 123, Jakarta')
                ->press('@save-changes-btn')
                ->waitForText('Profile successfully updated!')
                ->assertSee('Profile successfully updated!')
                ->assertInputValue('#username', 'Updated Name')
                ->assertInputValue('#dob', '1999-10-05')
                ->assertInputValue('#address', 'Jl. Test No. 123, Jakarta');
        });
    }

    // TC5 – Attempt profile update with invalid data
    public function test_customer_sees_validation_errors_on_invalid_profile_update()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'customer')->skip(1)->first();

            $browser->loginAs($user)
                ->visit('/profile')
                ->waitFor('#username')
                ->clear('#username')
                ->type('#username', '') // empty name
                ->assertPathIs('/profile')
                ->type('#username', 'New Username')
                ->type('#dob', '10/05/3000') // future DOB
                ->type('#address', '')
                ->press('@save-changes-btn')
                ->pause(500)
                ->assertSee('The dob field must be a date before or equal to');
        });
    }

    // TC6 – Cancel profile edits
    public function test_customer_cancel_profile_edit_discard_changes()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'customer')->skip(1)->first();

            $browser->loginAs($user)
                ->visit('/profile')
                ->waitFor('#username')
                ->type('#username', 'Updated Name')
                ->type('#dob', '10/05/1999')
                ->type('#address', 'Jl. Test No. 123, Jakarta')
                ->press('@cancel-changes-btn')
                ->assertInputValue('#username', 'customer2')
                ->assertInputValue('#dob', '')
                ->assertInputValue('#address', '');
        });
    }

    // TC7 – Log out from account
    public function test_customer_can_logout_from_profile()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'customer')->skip(3)->first();

            $browser->loginAs($user)
                ->visit('/profile')
                ->waitFor('@logout-btn')
                ->press('@logout-btn')
                ->pause(500)
                ->assertPathIs('/') // redirected to homepage
                ->assertGuest();    // session destroyed
        });
    }

    // TC8 – Delete account
    public function test_customer_can_delete_account()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'customer')->skip(4)->first();

            $browser->loginAs($user)
                ->visit('/profile')
                ->waitFor('@delete-account-btn')
                ->press('@delete-account-btn')
                ->pause(500)
                ->assertPathIs('/')
                ->assertGuest();
        });
    }
}
