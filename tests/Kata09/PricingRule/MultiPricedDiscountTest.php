<?php

namespace Tests\Kata09\PricingRule;


use Kata09\DataObject\Product;
use Kata09\PricingRule\BulkDiscountPricingRule;
use Kata09\PurchaseItem;
use PHPUnit\Framework\TestCase;

/**
 * Class MultiPricedDiscountTest
 * @package Tests\Kata09\Discount
 *
 * @group MultiPricedDiscountTest
 */
class MultiPricedDiscountTest extends TestCase
{

    public function testDslParserValidDsl()
    {
        $discount = new BulkDiscountPricingRule('3 for 130');
        $this->assertEquals($discount->getMinQty(), 3);
        $this->assertEquals($discount->getMinPrice(), 130);
    }

    public function testDslParserInvalidDsl()
    {
        $invalidDsl = 'this is not right';
        $this->expectException(
            'InvalidArgumentException',
            sprintf("'%s' is not a valid dsl for this pricing rule: '%s'", $invalidDsl, BulkDiscountPricingRule::class)
        );

        new BulkDiscountPricingRule($invalidDsl);
    }

    public function testDiscountCalculation()
    {
        $pricingRule = new BulkDiscountPricingRule('3 for 130');

        $this->assertEquals(100, $pricingRule->getPrice(new PurchaseItem(new Product('A', 50), 2)));
        $this->assertEquals(130, $pricingRule->getPrice(new PurchaseItem(new Product('A', 50), 3)));
        $this->assertEquals(180, $pricingRule->getPrice(new PurchaseItem(new Product('A', 50), 4)));
        $this->assertEquals(260, $pricingRule->getPrice(new PurchaseItem(new Product('A', 50), 6)));
        $this->assertEquals(310, $pricingRule->getPrice(new PurchaseItem(new Product('A', 50), 7)));
    }

}