<?php

namespace Tests\Browser;

use App\Models\Category;
use App\Models\Food;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FD400_ManageFoodTest extends DuskTestCase
{
    // TC1 – Create new food item (valid input)
    public function test_restaurant_can_create_new_food_item_with_valid_input()
    {
        $this->browse(function (Browser $browser) {
            $restaurant = User::where('role', 'restaurant')->first();

            $browser->loginAs($restaurant)
                ->visit('/restaurant-foods')
                ->waitFor('@open-add-food-modal')
                ->press('@open-add-food-modal')
                ->waitFor('#addFoodModal')
                ->waitFor('#addName')
                ->type('#addName', 'Test Food')
                ->attach('#addPhoto', __DIR__ . '/files/foodimage_test.jpg')
                ->select('#addCategory', Category::first()->id)
                ->type('#addDescription', 'Delicious test food item.')
                ->type('#addPrice', '12000')
                ->type('#addExpDate', now()->addDays(1)->format('m-d-Y'))
                ->type('#addExpTime', '18:00')
                ->type('#addStock', 10)
                ->check('#addStatus')
                ->press('@submit-create-food')
                ->waitForText('Test Food')
                ->assertSee('Test Food');
        });
    }

    // TC2 – Create new food item (invalid/missing input)
    public function test_restaurant_cannot_create_food_item_with_invalid_input()
    {
        $this->browse(function (Browser $browser) {
            $restaurant = User::where('role', 'restaurant')->first();

            $browser->loginAs($restaurant)
                ->visit('/restaurant-foods')
                ->press('@open-add-food-modal')
                ->waitFor('#addFoodModal')
                ->type('#addName', '') // Required field left empty
                ->type('#addExpDate', '') // Another required field left empty
                ->press('@submit-create-food') // Submit without filling required fields
                ->assertPathIs('/restaurant-foods'); // Still on the same page
        });
    }

    // TC3 – Update existing food item
    public function test_restaurant_can_edit_existing_food_item()
    {
        $this->browse(function (Browser $browser) {
            $restaurant = User::where('role', 'restaurant')->first();
            $food = Food::find(1);

            $browser->loginAs($restaurant)
                ->visit('/restaurant-foods')
                ->press("@edit-food-button-{$food->id}")
                ->waitFor('#editFoodModal')
                ->clear('#editName')
                ->type('#editName', 'Updated Food Name')
                ->clear('#editStock')
                ->type('#editStock', 2000)
                ->press('@submit-edit-food')
                ->waitForText('Updated Food Name')
                ->assertSee('Updated Food Name');
        });
    }

    // TC4 – Delete a food item
    public function test_restaurant_can_delete_food_item()
    {
        $this->browse(function (Browser $browser) {
            $restaurant = User::where('role', 'restaurant')->first();
            $food = Food::where('name', 'Test Food')->first();

            $browser->loginAs($restaurant)
                ->visit('/restaurant-foods')
                ->waitFor("@delete-food-button-{$food->id}")
                ->press("@delete-food-button-{$food->id}")
                ->waitFor('#deleteFoodModal')
                ->press('@submit-delete-food')
                ->pause(500)
                ->assertDontSee('Test Food');
        });
    }

    // TC5 – Import food items from file (valid file)
    public function test_import_food_items_with_valid_file()
    {
        $this->browse(function (Browser $browser) {
            $restaurant = User::where('role', 'restaurant')->skip(1)->first();

            $browser->loginAs($restaurant)
                ->visit('/restaurant-foods')
                ->waitFor('@import-button')
                ->click('@import-button')
                ->whenAvailable('#uploadCsv', function ($modal) {
                    $modal->attach('zip_file', __DIR__ . '/files/import_foods_test.zip')
                        ->press('@submit-upload');
                })
                ->waitForText('Pizza Margherita')
                ->assertSee('Pizza Margherita');
        });
    }

    // TC6 – Import food items (invalid or malformed file)
    public function test_import_food_items_with_invalid_file()
    {
        $this->browse(function (Browser $browser) {
            $restaurant = User::where('role', 'restaurant')->first();

            $browser->loginAs($restaurant)
                ->visit('/restaurant-foods')
                ->waitFor('@import-button')
                ->click('@import-button')
                ->whenAvailable('#uploadCsv', function ($modal) {
                    $modal->attach('zip_file', __DIR__ . '/files/profile_test.jpg')
                        ->press('@submit-upload');
                });
        });
    }

    // TC7 – Search food items by name (exact match)
    public function test_search_food_items_by_exact_name()
    {
        $this->browse(function (Browser $browser) {
            $restaurant = User::where('role', 'restaurant')->first();

            $browser->loginAs($restaurant)
                ->visit('/restaurant-foods')
                ->type('#searchInput', 'Spiced Beef Burger')
                ->pause(500)
                ->assertSeeIn('@food-list', 'Spiced Beef Burger');
        });
    }

    // TC8 – Search food items by partial name
    public function test_search_food_items_by_partial_name()
    {
        $this->browse(function (Browser $browser) {
            $restaurant = User::where('role', 'restaurant')->first();

            $browser->loginAs($restaurant)
                ->visit('/restaurant-foods')
                ->type('#searchInput', 'cake')
                ->pause(500)
                ->assertSeeIn('@food-list', 'Chocolate Lava Cake');
        });
    }

    // TC9 – Search food items with no match
    public function test_search_food_items_with_no_match()
    {
        $this->browse(function (Browser $browser) {
            $restaurant = User::where('role', 'restaurant')->first();

            $browser->loginAs($restaurant)
                ->visit('/restaurant-foods')
                ->type('#searchInput', 'ldfhdskafla;dalfjlsd;')
                ->pause(500)
                ->assertDontSeeIn('@food-list', 'Delete');
        });
    }
}
