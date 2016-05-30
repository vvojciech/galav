Feature: As a user I want to vote on images

  Background: Logged in
    Given I am logged in

  Scenario: Upvoting an image
    When I am on a single image
    And I should see voting options
    Then I should click "upvote" link
    And I should have score higher with 1 point

  Scenario: Downvoting an image
    When I am on a single image
    And I should see voting options
    Then I should click "downvote" link
    And I should have score lower with 1 point
