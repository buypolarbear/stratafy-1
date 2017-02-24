Feature: Resolutions
    As a strata administrator
    I want to maintain a list of resolutions
    So the owners can decide on what to do with their building

    Scenario: Add Resolution
        Given I am an administrator
        When I add a resolution for "Reinforce doors $100 for each unit"
        Then the resolution record is saved

    Scenario: List all resolutions
        Given I am an administrator
        And there are resolutions on file
        When I retrieve the list of resolutions
        Then all resolutions should be listed
