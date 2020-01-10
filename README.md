# Kata09

This repo refers to [this](http://codekata.com/kata/kata09-back-to-the-checkout/) CodeKata.

#### Objectives

>To some extent, this is just a fun little problem. But underneath the covers, it’s a stealth exercise
in decoupling. The challenge description doesn’t mention the format of the pricing rules. 
How can these be specified in such a way that the checkout doesn’t know about particular items and 
their pricing strategies? How can we make the design flexible enough so that we can add 
new styles of pricing rule in the future?


#### Solution

My solution focuses on these parts: 
- Decoupling of the pricing rule execution from the checkout by using decorators for a `Purchasable` interface
- Decoupling of the rule creation + assignment to certain items by using a factory
- Adding flexibility by using interfaces for purchasables and pricing rules
- As decorators can embedded others it's already possible to run more than 1 pricing rule on one item
see: https://github.com/peinwag/kata09/blob/master/tests/Kata09/CheckoutTest.php#L71
- New pricing rules can be created easily by extending from the `AbstractPricingRule` and implementing the `getPrice` method which can
work with every `Purchasable` see: https://github.com/peinwag/kata09/blob/master/tests/Kata09/PricingRule/PercentageDiscountPricingRuleTest.php
- Price rules make use of a simple dsl*ish definition which can be parsed by every concrete implementation

#### Remarks
I changed the interface of the checkout proposed by codekata.com a bit by not passing
all pricing rules in the constructor. I rather retrieve them on the fly for every item, to always have the latest
pricing rule for it.


#### Requirements
- PHP 7.1.23 (cli)

#### Install
```
git clone git@github.com:peinwag/kata09.git
cd kata09
php composer.phar update
```

#### Run tests
`php composer.phar test`
