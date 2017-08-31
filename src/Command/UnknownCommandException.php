<?php

namespace phmLabs\JsonWebdriver\Command;

class UnknownCommandException extends \RuntimeException
{
    private $commandName;

    public function setCommandName($commandName)
    {
        $this->commandName = $commandName;
    }

    public function getCommandName()
    {
        return $this->commandName;
    }
}