<?php

namespace phmLabs\JsonWebdriver\Command;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use phmLabs\JsonWebdriver\Target\Target;

class Type implements Command
{
    private $target;
    private $value;

    public function __construct(Target $target, $value = null)
    {
        $this->target = $target;
        $this->value = $value;
    }

    public function run(RemoteWebDriver $webDriver)
    {
        $element = $webDriver->findElement($this->target->getWebdriverSelector());
        $element->sendKeys($this->value);
    }
}
