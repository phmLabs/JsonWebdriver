<?php

namespace phmLabs\JsonWebdriver\Command;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use phmLabs\JsonWebdriver\Target\Target;

class ClickAndWait implements Command
{
    private $waitTimeInSeconds = 2;
    private $target;

    public function __construct(Target $target, $value = null)
    {
        $this->target = $target;
    }

    public function setWaitTime($timeInSeconds)
    {
        $this->waitTimeInSeconds = $timeInSeconds;
    }

    public function run(RemoteWebDriver $webDriver)
    {
        $element = $webDriver->findElement($this->target->getWebdriverSelector());
        $element->click();
        sleep($this->waitTimeInSeconds);
    }
}
