<?php

namespace Tests\Helpers;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class WebDriverHelper
{
    private $driver;

    public function __construct($host = 'http://localhost:4444/wd/hub')
    {
        $this->driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
    }

    public function navigateTo($url)
    {
        $this->driver->get($url);
    }

    public function getDriver()
    {
        return $this->driver;
    }

    public function close()
    {
        $this->driver->quit();
    }

    public function waitForElement($cssSelector, $timeout = 10)
    {
        $this->driver->wait($timeout)->until(
            \Facebook\WebDriver\WebDriverExpectedCondition::visibilityOfElementLocated(\Facebook\WebDriver\WebDriverBy::cssSelector($cssSelector))
        );
    }

    public function clickElement($cssSelector)
    {
        $element = $this->driver->findElement(\Facebook\WebDriver\WebDriverBy::cssSelector($cssSelector));
        $element->click();
    }

    public function fillField($cssSelector, $value)
    {
        $element = $this->driver->findElement(\Facebook\WebDriver\WebDriverBy::cssSelector($cssSelector));
        $element->clear();
        $element->sendKeys($value);
    }

    public function getElementText($cssSelector)
    {
        return $this->driver->findElement(\Facebook\WebDriver\WebDriverBy::cssSelector($cssSelector))->getText();
    }
}