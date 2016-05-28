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
        Artisan::call('migrate:rollback');
    }

    /**
     * @Then /^I click on "([^"]*)"$/
     */
    public function iClickOn($element)
    {
        $page = $this->getSession()->getPage();
        $findName = $page->find("css", $element);
        if (!$findName) {
            throw new Exception($element . " could not be found");
        } else {
            $findName->click();
        }
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
        $this->fillField('search-query', $arg1);
        $this->pressButton('search-invoke');
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
        $this->iClickOn('.gallery-item');
    }

    /**
     * @Then I should see gallery page
     */
    public function iShouldSeeGalleryPage()
    {
        $this->assertElementOnPage('.single-gallery');
    }

    /**
     * @Given I am logged in
     */
    public function iAmLoggedIn()
    {
        $this->visit('/login');
        $this->fillField('email', 'tester@test.com');
        $this->fillField('password', 'Test#@!1235');
        $this->pressButton('Login');
    }

    /**
     * @When I am on upload page
     */
    public function iAmOnUploadPage()
    {
        $this->visit('/upload');

    }

    /**
     * @When I set title as :arg1
     */
    public function iSetTitleAs($arg1)
    {
        $this->fillField('title', $arg1);
    }

    /**
     * @When I set file as :arg1
     */
    public function iSetFileAs($arg1)
    {
        $this->attachFileToField('upload_file', __DIR__ . '/features/files/' . $arg1);
    }

    /**
     * @When I upload an image
     */
    public function iUploadAnImage()
    {
        $this->pressButton('Upload');
    }

    /**
     * @Then I should see uploaded image
     */
    public function iShouldSeeUploadedImage()
    {
        $this->assertPageContainsText('test');
    }

    /**
     * @Then I file should be uploaded correctly
     */
    public function iFileShouldBeUploadedCorrectly()
    {
        $this->assertPageContainsText('Image uploaded successfully');
    }

    /**
     * @Then I should see uploaded image :arg1
     */
    public function iShouldSeeUploadedImage2($arg1)
    {
        $this->assertElementContainsText("h1", $arg1);
    }

}
