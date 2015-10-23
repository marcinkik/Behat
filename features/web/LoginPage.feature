@LoginPage

Feature: Login page works correctly and handle errors message

  Scenario: FAKE Log in with empty password causes error message shows
    Given I am on "http://trans-inkasso-web.rc-trans.rst.com.pl/user-panel.html#/cases"
     And I set "51-27" in "TransId"
    When I press "Log in" button
    Then I should see "errors" message with "Both fields are required.."

  Scenario:  Log in with empty password causes error message shows
    Given I am on "http://trans-inkasso-web.rc-trans.rst.com.pl/user-panel.html#/cases"
    And I set "51-27" in "TransId"
    When I press "Log in" button
    Then I should see "error" message with "Both fields are required."

  Scenario: Log in with incorrect password causes display error message
    Given I am on "http://trans-inkasso-web.rc-trans.rst.com.pl/user-panel.html#/cases"
    And I set "51-27" in "TransId"
    And I set "incorrect password" in "Password"
    When I press "Log in" button
    Then I should see "error" message with "Invalid credentials" after "1000" time