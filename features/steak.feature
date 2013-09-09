Feature: Steak House
    As steak house owner
    I want waiters to servce customers, when steak is on stock

    Scenario: Steak on stock and Waiter serves
        Given there are "6" steak on stock
        When I order a steack
        Then the waiter serves me a steak

    Scenario: No Steak on stock and Waiter serves
        Given there are "0" steak on stock
        When I order a steack
        Then the waiter serves me a steak
