<?php

namespace phmLabs\JsonWebdriver\Command;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use phmLabs\JsonWebdriver\Target\Target;

class CommandChain
{
    /**
     * @var Command[]
     */
    private $commands = [];

    public static function createCommandClass($command, $target, $value)
    {
        switch ($command) {
            case 'clickAndWait':
                return new ClickAndWait(new Target($target));
            case 'click':
                return new Click(new Target($target));
            case 'type':
                return new Type(new Target($target), $value);
            default:
                $e = new UnknownCommandException('The given command (' . $command . ') is not known.');
                $e->setCommandName($command);
                throw $e;
        }
    }

    public function addCommand(Command $command)
    {
        $this->commands[] = $command;
    }

    public function run(RemoteWebDriver $webDriver)
    {
        foreach ($this->commands as $command) {
            $command->run($webDriver);
        }
    }
}
