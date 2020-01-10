<?php


namespace Tests\Kata09\PricingRule;


use Kata09\DataObject\Product;
use Kata09\PricingRule\PercentageDiscountPricingRule;
use Kata09\PurchaseItem;
use PHPUnit\Framework\TestCase;

/**
 * Class PercentageDiscountPricingRuleTest
 * @package Tests\Kata09\PricingRule
 *
 * @group PercentageDiscountPricingRuleTest
 */
class PercentageDiscountPricingRuleTest extends TestCase
{
    public function testDslParserValidDsl()
    {
        $discount = new PercentageDiscountPricingRule('30% off');
        $this->assertEquals(30, $discount->getDiscount());
    }

    public function testDslParserInvalidDsl()
    {
        $invalidDsl = 'this is not right';
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage(
            sprintf("'%s' is not a valid dsl for this pricing rule: '%s'", $invalidDsl, PercentageDiscountPricingRule::class)
        );

        new PercentageDiscountPricingRule($invalidDsl);
    }

    public function testDiscountCalculation()
    {
        $pricingRule = new PercentageDiscountPricingRule('10% off');

        $this->assertEquals(90, $pricingRule->getPrice(new PurchaseItem(new Product('A', 50), 2)));
    }
}