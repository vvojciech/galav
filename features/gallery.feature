Feature: As a user I want to browse, view and search for images

  Scenario: Index page
    When I am on the homepage
    Then I should see list of images

  Scenario: Search result
    When I am on the homepage
    And I search for "funny cat"
    Then I should see results of "funny cat"
    And I should see list of images

  Scenario: Viewing single image
    When I am on the homepage
      And I click on any available image
    Then I should see gallery page
