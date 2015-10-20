<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;



/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {

    }

    public function iAmOn($path){
        $this->gui->start();
        $this->gui->visit($path);
        $this->gui->wait(10000);
        $this->gui->stop();
    }

    public function iSearchFor($text){
        $page = $this->gui->getPage();
        $page->fillField("lst-ib",$text);
        $page->find("css",".jsb input[name=btnk']")->click();
    }

    public function iShouldSeeAsTheFirstResult($goal){
        $text = $this->gui->getPage()->find('css',"h3 a")->getText();
        assert($text, $goal);
        $this->gui->stop();
    }
}
