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

    private $data = []; // used for storing values between steps, like no of votes before and after


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
        // @todo enable once seeding will be quicker
//        Artisan::call('migrate');
//        Artisan::call('db:seed');
    }

    /**
     * @AfterSuite
     */
    public static function cleanup(AfterSuiteScope $afterSuiteScope)
    {
//        Artisan::call('migrate:rollback');
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
        $this->attachFileToField('upload_file', base_path() . '/features/files/' . $arg1);
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

    /**
     * @When I am on my profile page of :arg1
     */
    public function iAmOnMyProfilePageOf($arg1)
    {
        $this->visit('/u/' . $arg1);
    }


    /**
     * voting.feature
     */

    /**
     * @When I am on a single image
     */
    public function iAmOnASingleImage()
    {
        $this->visit('/i/qbvsoa');
    }

    /**
     * @When I should see voting options
     */
    public function iShouldSeeVotingOptions()
    {
        $this->assertPageContainsText('upvote');
        $this->assertPageContainsText('downvote');

        $this->assertPageContainsText('points');

        // @todo abstract this a little bit since we are using this also below
        $page = $this->getSession()->getPage();
        $score = $page->find('css', '.score');

        if (null === $score) {
            throw new \LogicException('Could not find the element');
        }

        if (!$score->isVisible()) {
            throw new \LogicException('Element is not visible');
        }

        $this->data['score'] = (int) $score->getHtml();

    }

    /**
     * @Then I should click :arg1 link
     */
    public function iShouldClickLink($arg1)
    {
        $this->clickLink($arg1);
    }

    /**
     * @Then I should have score higher with :arg1 point
     */
    public function iShouldHaveScoreHigherWithPoint($arg1)
    {

        // @todo abstract
        $page = $this->getSession()->getPage();
        $score = $page->find('css', '.score');

        if (null === $score) {
            throw new \LogicException('Could not find the element');
        }

        if (!$score->isVisible()) {
            throw new \LogicException('Element is not visible');
        }

        if ((int) ($score->getHtml()) != $this->data['score'] + $arg1 ) {
            throw new \LogicException('Score was not updated ');
        }

    }


    /**
     * @Then I should have score lower with :arg1 point
     */
    public function iShouldHaveScoreLowerWithPoint($arg1)
    {

        // @todo abstract
        $page = $this->getSession()->getPage();
        $score = $page->find('css', '.score');

        if (null === $score) {
            throw new \LogicException('Could not find the element');
        }

        if (!$score->isVisible()) {
            throw new \LogicException('Element is not visible');
        }

        if ((int) ($score->getHtml()) != $this->data['score'] - $arg1 ) {
            throw new \LogicException('Score was not updated ');
        }

    }

}
