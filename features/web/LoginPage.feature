@LoginPage

Feature: Login page works correctly and handle errors message

  Scenario: Log in with empty password causes error message shows
    Given I am on "http://trans-inkasso-web.rc-trans.rst.com.pl/user-panel.html#/cases"
     And I set "51-27" in "TransId"
    When I press "Log in" button
    Then I should see "Both fields are required."

  Scenario: FAKE Log in with empty password causes error message shows
    Given I am on "http://trans-inkasso-web.rc-trans.rst.com.pl/user-panel.html#/cases"
    And I set "51-27" in "TransId"
    When I press "Log in" button
    Then I should see "Both fields are required.."