<?php

namespace phmLabs\JsonWebdriver\Target;

use Facebook\WebDriver\WebDriverBy;

class Target
{
    private $targetString;

    public function __construct($targetString = null)
    {
        $this->targetString = $targetString;
    }

    /**
     * @return WebDriverBy
     */
    public function getWebdriverSelector()
    {
        if (strpos($this->targetString, 'link=') === 0) {
            $linkText = substr($this->targetString, 5);
            return WebDriverBy::linkText($linkText);
        } elseif (strpos($this->targetString, 'id=') === 0) {
            $id = substr($this->targetString, 3);
            return WebDriverBy::id($id);
        } elseif (strpos($this->targetString, 'css=') === 0) {
            $css = substr($this->targetString, 4);
            return WebDriverBy::cssSelector($css);
        } else {
            return WebDriverBy::xpath($this->targetString);
        }
    }
}
