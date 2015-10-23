<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Testwork\Hook\Scope\AfterSuiteScope;
use Behat\Testwork\Tester\Result\TestResults;


use Behat\Mink\Mink,
    Behat\Mink\Session,
    Behat\Mink\Driver\Selenium2Driver;

use Selenium\Client as SeleniumClient;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

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
    public function __construct($wd_host = "http://127.0.0.1:4444/wd/hub", $browser = "firefox")
    {
        $mink = new Mink(array('selenium2' => new Session(new Selenium2Driver($browser, null, $wd_host))));
        $this->gui = $mink->getSession('selenium2');
    }
    /**
     * @AfterStep
     */
//    public function printRequestAndResponseWhenStepWasFailed(\Behat\Behat\Hook\Scope\AfterStepScope $scope)
//    {
//        if (TestResults::FAILED === $scope->getTestResult()->getResultCode()) {
//            $this->printDebug($scope->getTestResult()->getResultCode());
//        }
//    }
    /**
     * Prints debug string.
     *
     * @param string $string debug string
     */
    public function printDebug($string)
    {
        echo "\n\033[36m|  " . strtr($string, ["\n" => "\n|  "]) . "\033[0m\n\n";
    }
    /**
     * @Given I am on :web
     */
    public function iAmOn($web)
    {
        $this->gui->start();
        $this->gui->visit($web);
    }

    /**
     * @Given I set :id in :field
     */
    public function iSetIn($id, $field)
    {
        $page = $this->gui->getPage();
        $page->fillField($field,$id);
    }

    /**
     * @When I press :text_button button
     */
    public function iPressButton($text_button)
    {
        //$this->gui->wait(1000);
        $page = $this->gui->getPage();
        $button = $page->find("named",array("button",$text_button))->click();
//        if( $button != null){
//            $button->click();
//        }
//        else{
//            var_dump("Not found " + $text_button + " button.");
//        }
    }

    /**
     * @Then I should see :message_text
     */
    public function iShouldSee($message_text)
    {
        $this->gui->wait(1000);
        $page = $this->gui->getPage();
        //$text = $page->find("named", array("content", $message_text))->getText();
        //$text = $page->find("named", array("content", $message_text));
        $text = $page->find('css', '.message-wrapper')->getText();
        assertEquals($message_text,$text);
        //var_dump($text2);
        //$result = assertEquals("x","y");
        //var_dump(assertEquals("x","y"));
//        if($text == null){
//            throw new \Exception('The element is not found');
//        }
//        else{
//            assertEquals($message_text, $text->getText());
//        }
//        if($text != null){
//            assertEquals($message_text, $text->getText());
//        }
//        else{
//            var_dump("Not found " + $message_text + " on page.");
//        }
        $this->gui->stop();
    }
}
