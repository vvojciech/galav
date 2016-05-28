Feature: As a user I want to browse, view and search for images

  Background: Logged in
    Given I am logged in

  Scenario: Upload of image
    When I am on upload page
    And I set title as "Funny Cat"
    And I set file as "funnycats1.jpg"
    And I upload an image
    Then I file should be uploaded correctly
    And I should see uploaded image "Funny Cat"

  Scenario: Viewing uploaded images on profile
    When I am on my profile page of "tester"
    Then I should see list of images
