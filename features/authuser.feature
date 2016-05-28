Feature: As a user I want to browse, view and search for images

  Background: Logged in
    Given I am logged in

  Scenario: Viewing uploaded images on profile
    When I am on my profile page of "tester"
    Then I should see list of images
