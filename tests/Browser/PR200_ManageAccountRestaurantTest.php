<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PR200_ManageAccountRestaurantTest extends DuskTestCase
{
    // TC1 – Upload valid profile picture
    public function test_restaurant_can_upload_valid_profile_picture()
    {
        $this->browse(function (Browser $browser) {
            $filePath = __DIR__ . '/files/profileresto_test.jpg';

            $browser->loginAs(User::where('role', 'restaurant')->first())
                ->visit('/profile')
                ->waitFor('#profile-image-form')
                ->pause(500)
                ->attach('#profile-image-input', $filePath)
                ->waitFor('#profile-image-preview')
                ->assertVisible('#profile-image-preview')
                ->assertSee('Successfully updated profile image!');
        });
    }

    // TC2 – Display default profile picture (requires manual testing)

    // TC3 – Upload invalid profile picture
    public function test_restaurant_cannot_upload_invalid_profile_picture()
    {
        $this->browse(function (Browser $browser) {
            $filePath = __DIR__ . '/files/invalid.xlsx';

            $browser->loginAs(User::where('role', 'restaurant')->skip(1)->first())
                ->visit('/profile')
                ->waitFor('#profile-image-form')
                ->pause(500)
                ->attach('#profile-image-input', $filePath)
                ->waitFor('#profile-image-preview')
                ->waitForText('The profile image field must be an image.')
                ->assertSee('The profile image field must be an image.');
        });
    }

    // TC4 – Update name and address with valid data
    public function test_restaurant_can_update_profile_with_valid_data()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'restaurant')->first();

            $browser->loginAs($user)
                ->visit('/profile')
                ->waitFor('#username')
                ->type('#username', 'restaurant_first')
                ->waitFor('#restaurant_name')
                ->type('#restaurant_name', 'Updated Resto Name')
                ->waitFor('#address')
                ->type('#address', 'Jalan Merdeka No. 12, Jakarta')
                ->press('@save-changes-btn')
                ->waitForText('Profile successfully updated!')
                ->assertSee('Profile successfully updated!')
                ->assertInputValue('#username', 'restaurant_first')
                ->assertInputValue('#restaurant_name', 'Updated Resto Name')
                ->assertInputValue('#address', 'Jalan Merdeka No. 12, Jakarta');
        });
    }

    // TC5 – Attempt profile update with invalid data
    public function test_restaurant_sees_validation_errors_on_invalid_profile_update()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'restaurant')->skip(1)->first();

            $browser->loginAs($user)
                ->visit('/profile')
                ->waitFor('#username')
                ->clear('#username')
                ->type('#username', '')
                ->press('@save-changes-btn')
                ->assertPathIs('/profile')
                ->clear('#restaurant_name')
                ->type('#restaurant_name', '')
                ->press('@save-changes-btn')
                ->assertPathIs('/profile')
                ->clear('#address')
                ->type('#address', '')
                ->press('@save-changes-btn')
                ->assertPathIs('/profile');
        });
    }

    // TC6 – Cancel profile edits
    public function test_restaurant_cancel_profile_edit_discard_changes()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'restaurant')->skip(1)->first();

            $browser->loginAs($user)
                ->visit('/profile')
                ->waitFor('#username')
                ->type('#username', 'username_new')
                ->waitFor('#restaurant_name')
                ->type('#restaurant_name', 'Updated Resto Name')
                ->waitFor('#address')
                ->type('#address', 'Jalan Merdeka No. 12, Jakarta')
                ->press('@cancel-changes-btn')
                ->assertInputValue('#username', 'restaurant2')
                ->assertInputValue('#restaurant_name', 'Sana Sini Restaurant')
                ->assertInputValue('#address', 'Pullman Jakarta Indonesia, Jl. M.H. Thamrin 59, Thamrin, Jakarta');
        });
    }

    // TC7 – Log out from account
    public function test_restaurant_can_logout_from_profile()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'restaurant')->skip(3)->first();

            $browser->loginAs($user)
                ->visit('/profile')
                ->waitFor('@logout-btn')
                ->press('@logout-btn')
                ->waitFor('#logoutModal')
                ->press('@btn-logout')
                ->pause(500)
                ->assertPathIs('/')
                ->assertGuest();
        });
    }

    // TC8 – Delete account
    public function test_restaurant_can_delete_account()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'restaurant')->skip(4)->first();

            $browser->loginAs($user)
                ->visit('/profile')
                ->waitFor('@delete-account-btn')
                ->press('@delete-account-btn')
                ->pause(500)
                ->waitFor('#deleteAccountModal')
                ->press('@btn-delete-account')
                ->pause(500)
                ->assertPathIs('/')
                ->assertGuest();
        });
    }
}
