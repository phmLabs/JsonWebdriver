<?php

namespace phmLabs\JsonWebdriver\Command;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use phmLabs\JsonWebdriver\Target\Target;

class Open implements Command
{
    private $url;

    public function __construct(Target $target, $value = null)
    {
        $this->url = $value;
    }

    public function run(RemoteWebDriver $webDriver)
    {
        $webDriver->get($this->url);
    }
}
