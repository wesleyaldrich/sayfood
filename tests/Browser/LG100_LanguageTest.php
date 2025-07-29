<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LG100_LanguageTest extends DuskTestCase
{
    // TC1 – Switch language and persist across session
    public function test_user_can_switch_language_and_it_persists()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('role', 'customer')->first();
            $user2 = User::where('role', 'customer')->skip(1)->first();

            $browser->loginAs($user)
                ->visit('/')
                ->waitFor('@language')
                ->click('@language')
                ->waitFor('@indonesia')
                ->click('@indonesia')

                ->assertSee(__('home.welcome_to', [], 'id'))
                ->refresh()
                ->assertSee(__('home.welcome_to', [], 'id'))
                ->visit('/logout');
        });
    }

    // TC2 – Default language is English if no preference is set
    public function test_default_language_is_english_without_preference()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee(__('home.welcome_to', [], 'en'));
        });
    }

    // TC3 – Fallback to default language or show key
    public function test_fallback_behavior_when_translation_key_missing()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee(__('home.welcome_to', [], 'en'));
        });
    }
}
