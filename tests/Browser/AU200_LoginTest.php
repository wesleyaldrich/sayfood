<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AU200_LoginTest extends DuskTestCase
{
    /** @test */
    public function admin_can_login_with_existing_account()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login-customer')
                ->type('username', 'admin')        
                ->type('password', 'adminnnn')            
                ->press('login')
                ->waitForLocation('/')
                ->assertPathIs('/')
                ->waitForText('Welcome', 5)
                ->assertSee('WELCOME');

            $browser->visit('/logout')
                ->waitForLocation('/');
        });
    }

    /** @test */
    public function customer_can_login_with_existing_account()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login-customer')
                ->type('username', 'customer1')    
                ->type('password', 'customer1')
                ->press('login')
                ->waitForLocation('/')
                ->assertPathIs('/')
                ->waitForText('Welcome', 5)
                ->assertSee('WELCOME');

            $browser->visit('/logout')
                ->waitForLocation('/');
        });
    }

    /** @test */
    public function restaurant_can_login_with_existing_account()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login-restaurant')
                ->type('username', 'restaurant1')  
                ->type('password', 'restaurant1')
                ->press('login')
                ->waitForLocation('/restaurant-home')
                ->assertPathIs('/restaurant-home')
                ->waitForText('Total Orders Today', 10)
                ->assertSee('Total Orders Today');

            $browser->visit('/logout')
                ->waitForLocation('/');
        });
    }

    /** @test */
    public function invalid_user_cannot_login()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login-customer')
                ->type('username', 'invalid@example.com')
                ->type('password', 'wrongpassword')
                ->press('login')
                ->waitForLocation('/login-customer')
                ->assertPathIs('/login-customer')
                ->waitForText('The provided credentials do not match our records.', 15)
                ->assertSee('The provided credentials do not match our records.');

             $browser->visit('/logout');
        });
    }

    /** @test */
    public function invalid_customer_cannot_login_to_restraurant()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login-restaurant')
                ->type('username', 'customer1')
                ->type('password', 'customer1')
                ->press('login')
                ->waitForLocation('/login-restaurant')
                ->assertPathIs('/login-restaurant')
                ->waitForText('You do not have a restaurant account.')
                ->assertSee('You do not have a restaurant account.');
        });
    }
}
