# Swag Labs Behat Tests

This project contains automated tests for the Swag Labs e-commerce platform using Behat and Selenium. The tests are structured to follow Behavior Driven Development (BDD) principles, ensuring clear and understandable scenarios for testing key functionalities of the platform.

## Project Structure

```
swag-labs-behat-tests
├── features
│   ├── bootstrap
│   │   └── FeatureContext.php
│   ├── login.feature
│   ├── product_sorting.feature
│   └── checkout.feature
├── tests
│   └── helpers
│       └── WebDriverHelper.php
├── behat.yml
├── composer.json
└── README.md
```

## Requirements
- PHP >= 8.0
- Composer
- Selenium Server (running at http://localhost:4444/wd/hub)
- Chrome or Firefox browser

## Setup Instructions

1. **Clone the repository:**
   ```
   git clone <repository-url>
   cd swag-labs-behat-tests
   ```

2. **Install dependencies:**
   Ensure you have Composer installed, then run:
   ```
   composer install
   ```

3. **Configure Selenium:**
   Make sure you have Selenium Server running. You can download it from the [Selenium website](https://www.selenium.dev/downloads/).

4. **Start the Selenium Server:**
   ```
   java -jar selenium-server-standalone-x.xx.x.jar
   ```

## Running Tests

To execute the tests, use the following command:
```
vendor/bin/behat
```

This will run all the scenarios defined in the feature files located in the `features` directory.

## Test Scenarios

- **Login Functionality:**
  - Test valid and invalid login attempts.
  - Verify error messages for locked-out users.

- **Product Sorting:**
  - Test sorting products by name (Z to A).
  - Validate the sorting order of products.

- **Checkout Process:**
  - Test adding items to the cart and verifying total prices.
  - Validate the completion of the checkout process with user information.

## Additional Notes

- Ensure that the browser drivers (e.g., ChromeDriver, GeckoDriver) are installed and accessible in your system's PATH.
- Modify the `behat.yml` configuration file as needed to suit your testing environment.
