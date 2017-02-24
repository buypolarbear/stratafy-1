<?php

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{
    protected $data = [];
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        Artisan::call('migrate:refresh');
    }

    /**
     * @Given I am an administrator
     */
    public function iAmAnAdministrator()
    {
    }

    /**
     * @When I add an owner for unit :arg1
     */
    public function iAddAnOwnerByUnitId($unit)
    {
        $this->data['unit'] = $unit;
        \App\Owner::add($unit);
    }

    /**
     * @Then the owner record is saved
     */
    public function theOwnerRecordIsSaved()
    {
        if (!\App\Owner::where(['unit' => $this->data['unit']])->exists()) {
            throw new \Exception('not saved');
        }
    }

    /**
     * @Given there are owners on file
     */
    public function thereAreOwnersOnFile()
    {
        \App\Owner::add("888");
    }

    /**
     * @When I retrieve a list of owners
     */
    public function retrieveAListOfOwners()
    {
    }

    /**
     * @Then all owners should be listed
     */
    public function allOwnersShouldBeListed()
    {
        if (!\App\Owner::exists()) {
            throw new \Exception('nothing found');
        }
    }


    /**
     * @When I add a resolution for :arg1
     */
    public function iAddAResolutionFor($arg1)
    {
        \App\Resolution::add($arg1);
        $this->data['description'] = $arg1;
    }

    /**
     * @Then the resolution record is saved
     */
    public function theResolutionRecordIsSaved()
    {
        if (!\App\Resolution::where('description', $this->data['description'])->exists()) {
            throw new \Exception('Resolution record is not saved');
        }
    }

    /**
     * @Given there are resolutions on file
     */
    public function thereAreResolutionsOnFile()
    {
    }

    /**
     * @When I retrieve the list of resolutions
     */
    public function iRetrieveTheListOfResolutions()
    {

    }

    /**
     * @Then all resolutions should be listed
     */
    public function allResolutionsShouldBeListed()
    {
    }
}
