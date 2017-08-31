<?php

namespace phmLabs\JsonWebdriver;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use phmLabs\JsonWebdriver\Command\CommandChain;
use phmLabs\JsonWebdriver\Command\Open;
use phmLabs\JsonWebdriver\Command\UnknownCommandException;
use phmLabs\JsonWebdriver\Target\Target;
use Psr\Http\Message\UriInterface;

class Runner
{
    private $webdriver;

    public function __construct(RemoteWebDriver $webdriver)
    {
        $this->webdriver = $webdriver;
    }

    public function run(UriInterface $baseUrl, $jsonString)
    {
        if (!is_array($jsonString)) {
            $commandArray = json_decode($jsonString, true);
        } else {
            $commandArray = $jsonString;
        }

        $commandChain = $this->createCommandChain($baseUrl, $commandArray);
        $commandChain->run($this->webdriver);
    }

    private function createCommandChain(UriInterface $baseUrl, $commandArray)
    {
        $commandChain = new CommandChain();

        $commandChain->addCommand(new Open(new Target(), (string)$baseUrl));

        foreach ($commandArray as $commandElement) {
            try {
                $command = CommandChain::createCommandClass(
                    $commandElement['Command'],
                    $commandElement['Target'],
                    $commandElement['Value']);
                $commandChain->addCommand($command);
            } catch (UnknownCommandException $e) {
                echo "\nSkipping unknown command '" . $e->getCommandName() . "'\n";
            }
        }

        return $commandChain;
    }
}
