<?php

include_once __DIR__ . '/../vendor/autoload.php';

$options = new \Facebook\WebDriver\Chrome\ChromeOptions();

$caps = \Facebook\WebDriver\Remote\DesiredCapabilities::chrome();
$caps->setCapability(\Facebook\WebDriver\Chrome\ChromeOptions::CAPABILITY, $options);
$driver = \Facebook\WebDriver\Remote\RemoteWebDriver::create('http://localhost:4444/wd/hub', $caps);

$runner = new \phmLabs\JsonWebdriver\Runner($driver);

$jsonObject = json_decode(file_get_contents(__DIR__ . '/simple.json'), true);

try {
    $runner->run(new \whm\Html\Uri('https://www.leankoala.com'), $jsonObject['Commands']);
} catch (\Facebook\WebDriver\Exception\NoSuchElementException $e) {
    echo "Element not found: " . $e->getMessage();
}

$driver->close();