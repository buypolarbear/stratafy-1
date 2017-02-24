Feature: Owner voting
    As a unit owner
    I want to vote on resolutions
    So I can have a say in my building

    @important
    Scenario: List resolutions that owner has a ballot
        Given I am the owner of unit "808"
        And there is a resolution for "Fix bike room"
        When I query the stratafy homepage
        Then I should be able to vote on "Fix bike room"

    @important
    Scenario: List resolutions that owner has no ballot
        Given there is a resolution for "Fix community room"
        And there is a resolution for "Fix garbage room"
        And I am the owner for unit "909" which is not part of the "Fix garbage room" resolution
        When I query the stratafy homepage
        Then I should not be able to vote on "Fix garbage room"
