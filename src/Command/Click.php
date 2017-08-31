<?php

namespace phmLabs\JsonWebdriver\Command;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use phmLabs\JsonWebdriver\Target\Target;

class Click implements Command
{
    private $target;

    public function __construct(Target $target, $value = null)
    {
        $this->target = $target;
    }

    public function run(RemoteWebDriver $webDriver)
    {
        $element = $webDriver->findElement($this->target->getWebdriverSelector());
        $element->click();
    }
}
