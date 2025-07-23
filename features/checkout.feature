Feature: Checkout Process

  Scenario: Add items to the cart and verify total price
    Given I am on the Swag Labs homepage
    When I add "Sauce Labs Backpack" to the cart
    And I add "Sauce Labs Bike Light" to the cart
    Then the cart should contain 2 items
    And the total price should be calculated correctly

  Scenario: Complete the checkout process
    Given I have items in my cart
    When I proceed to checkout
    And I enter my personal information
      | firstName | lastName | postalCode |
      | John      | Doe      | 12345      |
    And I complete the checkout
    Then I should see the confirmation message
    And the final price should include tax

  Scenario: Validate order completion
    Given I have completed the checkout process
    When I view my order history
    Then I should see my recent order listed
    And the order status should be "Complete"