Feature: Login Functionality

  Scenario: Failed login with invalid credentials
    Given I am on the login page
    When I enter "invalid_user" as username
    And I enter "invalid_password" as password
    And I click on the login button
    Then I should see an error message "Username and password do not match any user in this service"

  Scenario: Failed login with a locked-out user
    Given I am on the login page
    When I enter "locked_out_user" as username
    And I enter "secret_sauce" as password
    And I click on the login button
    Then I should see an error message "Sorry, this user has been locked out."

  Scenario: Successful login
    Given I am on the login page
    When I enter "standard_user" as username
    And I enter "secret_sauce" as password
    And I click on the login button
    Then I should be redirected to the products page
    And I should see the title "PRODUCTS"