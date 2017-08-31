<?php

namespace phmLabs\JsonWebdriver\Command;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use phmLabs\JsonWebdriver\Target\Target;

/**
 * Created by PhpStorm.
 * User: nils.langner
 * Date: 31.08.17
 * Time: 09:16
 */
interface Command
{
    public function __construct(Target $target, $value = null);

    public function run(RemoteWebDriver $webDriver);
}