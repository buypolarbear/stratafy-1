<?php

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Laracasts\Behat\Context\Migrator;

/**
 * Defines application features from the specific context.
 */
class WebContext extends MinkContext implements Context
{

    protected $data = [];

    public function __construct()
    {
        Artisan::call('migrate:refresh');
    }


    /** @BeforeScenario */
    public function clearData(BeforeScenarioScope $scope)
    {
        $this->data = [];
    }

    /**
     * @Given I am the owner of unit :arg1
     */
    public function iAmTheOwnerOfUnit($arg1)
    {
        $this->data['owner'] = \App\Owner::add($arg1);
    }

    /**
     * @Given there is a resolution for :arg1
     */
    public function thereIsAResolutionFor($arg1)
    {
        $this->data['resolution'] = \App\Resolution::add($arg1);
    }

    /**
     * @When I query the stratafy homepage
     */
    public function iQueryTheStratafyHomepage()
    {
        $this->iAmOnHomepage();
        $this->fillField('unit', $this->data['owner']->unit);
        $this->pressButton('submit');
    }

    /**
     * @Then I should be able to vote on :arg1
     */
    public function iShouldBeAbleToVoteOn($arg1)
    {
        $this->clickLink($this->data['resolution']->description);
        $this->assertPageContainsText('Your vote for Unit '.$this->data['owner']->unit);
    }

    /**
     * @Given I am the owner for unit :arg1 which is not part of the :arg2 resolution
     */
    public function iAmTheOwnerForUnitWhichIsNotPartOfTheResolution($arg1, $arg2)
    {
        $this->data['owner'] = \App\Owner::add($arg1);
    }

    /**
     * @Then I should not be able to vote on :arg1
     */
    public function iShouldNotBeAbleToVoteOn($arg1)
    {
        $this->assertPageNotContainsText($this->data['resolution']->description);
    }
}
