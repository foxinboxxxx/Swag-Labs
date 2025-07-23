<?php

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;

class FeatureContext extends MinkContext implements Context
{
    /**
     * Initializes context.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am on the login page
     */
    public function iAmOnTheLoginPage()
    {
        $this->visitPath('/');
    }

    /**
     * @When I fill in the username with :username
     */
    public function iFillInTheUsernameWith($username)
    {
        $this->fillField('user-name', $username);
    }

    /**
     * @When I fill in the password with :password
     */
    public function iFillInThePasswordWith($password)
    {
        $this->fillField('password', $password);
    }

    /**
     * @When I press the login button
     */
    public function iPressTheLoginButton()
    {
        $this->pressButton('login-button');
    }

    /**
     * @Then I should see an error message :message
     */
    public function iShouldSeeAnErrorMessage($message)
    {
        $this->assertPageContainsText($message);
    }

    /**
     * @Given I am logged in as :username with password :password
     */
    public function iAmLoggedInAsWithPassword($username, $password)
    {
        $this->iAmOnTheLoginPage();
        $this->iFillInTheUsernameWith($username);
        $this->iFillInThePasswordWith($password);
        $this->iPressTheLoginButton();
        $this->assertPageContainsText('Products');
    }

    /**
     * @Given I am on the products page
     */
    public function iAmOnTheProductsPage()
    {
        $this->visitPath('/inventory.html');
    }

    /**
     * @When I sort products by name in descending order
     */
    public function iSortProductsByNameInDescendingOrder()
    {
        $this->selectFieldOption('product_sort_container', 'Name (Z to A)');
    }

    /**
     * @Then I should see products sorted by name
     */
    public function iShouldSeeProductsSortedByName()
    {
        $page = $this->getSession()->getPage();
        $productNames = $page->findAll('css', '.inventory_item_name');
        $names = [];
        foreach ($productNames as $product) {
            $names[] = $product->getText();
        }
        $sorted = $names;
        rsort($sorted, SORT_STRING);
        if ($names !== $sorted) {
            throw new Exception('Products are not sorted by name Z to A');
        }
    }

    /**
     * @Given I have items in my cart
     */
    public function iHaveItemsInMyCart()
    {
        $this->iAmOnTheProductsPage();
        $page = $this->getSession()->getPage();
        // Add Backpack
        $backpackBtn = $page->findButton('add-to-cart-sauce-labs-backpack');
        if ($backpackBtn) {
            $backpackBtn->click();
        }
        // Add Bike Light
        $bikeLightBtn = $page->findButton('add-to-cart-sauce-labs-bike-light');
        if ($bikeLightBtn) {
            $bikeLightBtn->click();
        }
    }

    /**
     * @When I proceed to checkout
     */
    public function iProceedToCheckout()
    {
        $this->visitPath('/cart.html');
        $this->pressButton('checkout');
    }

    /**
     * @Then I should see the total price as :total
     */
    public function iShouldSeeTheTotalPriceAs($total)
    {
        $page = $this->getSession()->getPage();
        $totalElement = $page->find('css', '.summary_total_label');
        if (!$totalElement) {
            throw new Exception('Total price element not found');
        }
        if (strpos($totalElement->getText(), $total) === false) {
            throw new Exception("Expected total price {$total} not found");
        }
    }

    /**
     * @When I complete the checkout process with first name :first last name :last and postal code :postal
     */
    public function iCompleteTheCheckoutProcessWithNameAndPostal($first, $last, $postal)
    {
        $this->fillField('firstName', $first);
        $this->fillField('lastName', $last);
        $this->fillField('postalCode', $postal);
        $this->pressButton('continue');
        $this->pressButton('finish');
    }

    /**
     * @Then I should see the order confirmation
     */
    public function iShouldSeeTheOrderConfirmation()
    {
        $this->assertPageContainsText('Thank you for your order');
    }

    /**
     * @Then I should see tax amount as :tax
     */
    public function iShouldSeeTaxAmountAs($tax)
    {
        $page = $this->getSession()->getPage();
        $taxElement = $page->find('css', '.summary_tax_label');
        if (!$taxElement) {
            throw new Exception('Tax element not found');
        }
        if (strpos($taxElement->getText(), $tax) === false) {
            throw new Exception("Expected tax amount {$tax} not found");
        }
    }
}
?>