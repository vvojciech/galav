<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Testwork\Hook\Scope\AfterSuiteScope;
use Behat\Testwork\Hook\Scope\BeforeSuiteScope;
use Laracasts\Behat\Context\Migrator;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends Behat\MinkExtension\Context\MinkContext implements Context, SnippetAcceptingContext
{
    use Migrator;

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

    /**
     * @BeforeSuite
     */
    public static function prepare(BeforeSuiteScope $beforeSuiteScope)
    {
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    /**
     * @AfterSuite
     */
    public static function cleanup(AfterSuiteScope $afterSuiteScope)
    {
        echo 'rollback';
        Artisan::call('migrate:rollback');
    }

    /**
     * @Then I should see list of images
     */
    public function iShouldSeeListOfImages()
    {
        $this->assertElementOnPage(".gallery-item");
    }

    /**
     * @When I search for :arg1
     */
    public function iSearchFor($arg1)
    {
        $this->fillField('.search-query', $arg1);
        $this->pressButton('.search');
    }

    /**
     * @Then I should see results of :arg1
     */
    public function iShouldSeeResultsOf($arg1)
    {
        $this->assertElementContainsText("h1", $arg1);
    }

    /**
     * @When I click on any available image
     */
    public function iClickOnAnyAvailableImage()
    {
        $this->clickLink('.gallery-item');
    }

    /**
     * @Then I should see gallery page
     */
    public function iShouldSeeGalleryPage()
    {
        $this->assertElementOnPage('.single-gallery');
    }

}
