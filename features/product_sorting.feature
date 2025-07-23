Feature: Product Sorting

  Scenario: Sort products by name (Z to A)
    Given I am on the Swag Labs homepage
    When I sort the products by name in descending order
    Then the products should be displayed from Z to A

  Scenario: Verify product sorting order
    Given I am on the Swag Labs homepage
    When I sort the products by name in descending order
    Then the first product should be "Sauce Labs Fleece Jacket"
    And the last product should be "Sauce Labs Backpack"

  Scenario: Validate sorting functionality
    Given I am on the Swag Labs homepage
    When I sort the products by price in ascending order
    Then the first product should be "Sauce Labs Onesie"
    And the last product should be "Sauce Labs Backpack"