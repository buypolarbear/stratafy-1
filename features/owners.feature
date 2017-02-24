Feature: Owner Records
    As a strata administrator
    I want to maintain a list of owners
    So I can keep track of their votes

    Scenario: Add owner
        Given I am an administrator
        When I add an owner for unit "808"
        Then the owner record is saved

    Scenario: List all owners
        Given I am an administrator
        And there are owners on file
        When I retrieve a list of owners
        Then all owners should be listed
