<?php

namespace Tests\Browser;

use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FD100_FoodDiscoveryAndFilteringTest extends DuskTestCase
{
    // TC1 – Search food by exact name
    public function test_customer_can_search_food_by_exact_name()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->first())
                ->visit('/foods')
                ->type('input[name="q"]', 'Matcha Green Tea Cake')
                ->keys('input[name="q"]', '{enter}')
                ->waitForLocation('/foods')
                ->assertSeeIn('.container-food', 'Matcha Green Tea Cake');
        });
    }

    // TC2 – Search food by partial name
    public function test_customer_can_search_food_by_partial_name()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->first())
                ->visit('/foods')
                ->type('input[name="q"]', 'cake')
                ->keys('input[name="q"]', '{enter}')
                ->waitForLocation('/foods')
                ->assertSee('Matcha Green Tea Cake');
        });
    }

    // TC3 – Search restaurant by exact name
    public function test_customer_can_search_restaurant_by_exact_name()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->first())
                ->visit('/foods')
                ->type('input[name="q"]', 'Sana Sini Restaurant')
                ->keys('input[name="q"]', '{enter}')
                ->waitForLocation('/foods')
                ->assertSee('Mini Choux Citrus Cream');
        });
    }

    // TC4 – Search restaurant by partial name
    public function test_customer_can_search_restaurant_by_partial_name()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->first())
                ->visit('/foods')
                ->type('input[name="q"]', 'sini')
                ->keys('input[name="q"]', '{enter}')
                ->waitForLocation('/foods')
                ->assertSee('Mini Choux Citrus Cream');
        });
    }

    // TC5 – Search with no matching results
    public function test_customer_search_with_no_matching_results()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->first())
                ->visit('/foods')
                ->type('input[name="q"]', 'asdfghjklqwerty')
                ->keys('input[name="q"]', '{enter}')
                ->waitForLocation('/foods')
                ->assertSee('No food items found.');
        });
    }

    // TC6 – Sort restaurants by distance (inside modal)
    public function test_customer_can_sort_restaurants_by_distance()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->first())
                ->visit('/foods')
                ->waitFor('@sort-nearby-button')
                ->click('@sort-nearby-button') // click “Nearby”
                ->pause(1000) // allow sort to happen
                ->click('@main-course-view-more') // click “View More” to open modal
                ->waitFor('.modal', 10); // wait up to 10s for modal

            $distances = [];

            foreach ($browser->elements('.modal .container-food') as $card) {
                $text = $card->getText();
                if (preg_match('/([0-9.]+)\s*km/', $text, $match)) {
                    $distances[] = (float) $match[1];
                }
            }

            $sorted = $distances;
            sort($sorted);
            $this->assertEquals($sorted, $distances, 'Restaurants are not sorted by distance');
        });
    }

    // TC7 – Sort restaurants by rating (inside modal)
    public function test_customer_can_sort_restaurants_by_rating()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->first())
                ->visit('/foods')
                ->click('@sort-popular-button') // click “Most Popular”
                ->pause(1000)
                ->click('@main-course-view-more')
                ->waitFor('.modal', 10); // wait longer

            $ratings = [];

            foreach ($browser->elements('.modal .container-food') as $card) {
                $text = $card->getText();
                if (preg_match('/([0-9.]+)★/', $text, $match)) {
                    $ratings[] = (float) $match[1];
                }
            }

            $sorted = $ratings;
            rsort($sorted);
            $this->assertEquals($sorted, $ratings, 'Restaurants are not sorted by rating');
        });
    }

    // TC8 – Filter food items by maximum price
    public function test_customer_can_filter_foods_by_max_price()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->first())
                ->visit('/foods')
                ->click('#filterBtn')
                ->pause(500)
                ->script([
                    "document.getElementById('priceRange').value = 20000;",
                    "document.getElementById('priceRange').dispatchEvent(new Event('input'));"
                ]);

            $browser->click('#applyFilter')
                ->waitForLocation('/foods');

            $prices = [];

            foreach ($browser->elements('.container-food') as $card) {
                $text = $card->getText();
                if (preg_match('/Rp\s*([\d.]+)/', $text, $match)) {
                    // Remove thousand separators like Rp 20.000 → 20000
                    $cleaned = str_replace('.', '', $match[1]);
                    $prices[] = (int) $cleaned;
                }
            }

            foreach ($prices as $price) {
                $this->assertLessThanOrEqual(20000, $price, "Found price above 20000: Rp $price");
            }
        });
    }

    // TC9 – Filter restaurants by minimum rating
    public function test_customer_can_filter_restaurants_by_min_rating()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->first())
                ->visit('/foods')
                ->click('#filterBtn')
                ->pause(500)
                ->script([
                    "document.getElementById('ratingRange').value = 4;",
                    "document.getElementById('ratingRange').dispatchEvent(new Event('input'));"
                ]);

            $browser->click('#applyFilter')
                ->waitForLocation('/foods');

            $ratings = [];

            foreach ($browser->elements('.container-food') as $card) {
                $text = $card->getText();
                if (preg_match('/([0-5](?:\.\d)?)\s*★/', $text, $match)) {
                    $ratings[] = (float) $match[1];
                }
            }

            foreach ($ratings as $rating) {
                $this->assertGreaterThanOrEqual(4.0, $rating, "Found restaurant rating below 4.0: $rating");
            }
        });
    }

    // TC10 – Filter returns no matching food items
    public function test_customer_sees_empty_state_when_no_filter_results()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->first())
                ->visit('/foods')
                ->click('#filterBtn')
                ->pause(500)
                ->script([
                    "document.getElementById('priceRange').value = 1000;", // Lower than minimum price
                    "document.getElementById('priceRange').dispatchEvent(new Event('input'));"
                ]);

            $browser->click('#applyFilter')
                ->waitForLocation('/foods')
                ->assertSee('No food items found.'); // adjust to match your actual empty message
        });
    }

    // TC11 – Search + Sort + Filter
    public function test_combined_search_sort_and_filter_shows_expected_results()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->first())
                ->visit('/foods')
                ->type('input[name="q"]', 'lamb')
                ->keys('input[name="q"]', '{enter}')
                ->waitForLocation('/foods')
                ->click('@sort-nearby-button')
                ->waitForLocation('/foods')
                ->click('#filterBtn')
                ->pause(500)
                ->script([
                    "document.getElementById('priceRange').value = 35000;",
                    "document.getElementById('priceRange').dispatchEvent(new Event('input'));",
                    "document.getElementById('ratingRange').value = 4;",
                    "document.getElementById('ratingRange').dispatchEvent(new Event('input'));"
                ]);

            $browser->click('#applyFilter')
                ->waitForLocation('/foods');

            $cards = $browser->elements('.container-food');
            $found = false;

            foreach ($cards as $card) {
                $text = strtolower($card->getText());

                if (str_contains($text, 'lamb')) {
                    $found = true;

                    if (preg_match('/Rp\s*([\d.]+)/', $text, $match)) {
                        $price = (int) str_replace('.', '', $match[1]);
                        $this->assertLessThanOrEqual(35000, $price);
                    }

                    if (preg_match('/Rating:\s*([0-9.]+)/i', $text, $match)) {
                        $rating = (float) $match[1];
                        $this->assertGreaterThanOrEqual(4.0, $rating);
                    }
                }
            }

            $this->assertTrue($found, 'Expected to find at least one food card containing the word "lamb" with price ≤ 35,000 and rating ≥ 4.');
        });
    }


    // TC12 – Combine All Filters with No Match
    public function test_combined_filters_with_no_match_shows_empty_state()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'customer')->first())
                ->visit('/foods')
                ->type('input[name="q"]', 'unmatchablekeyword')
                ->keys('input[name="q"]', '{enter}')
                ->waitForLocation('/foods')
                ->click('@sort-nearby-button')
                ->waitForLocation('/foods')
                ->click('#filterBtn')
                ->pause(500)
                ->script([
                    "document.getElementById('priceRange').value = 5000;",
                    "document.getElementById('priceRange').dispatchEvent(new Event('input'));",
                    "document.getElementById('ratingRange').value = 5;",
                    "document.getElementById('ratingRange').dispatchEvent(new Event('input'));"
                ]);

            $browser->click('#applyFilter')
                ->waitForLocation('/foods')
                ->assertSee('No food items found.'); // Change to your localized empty state message if needed
        });
    }
}
