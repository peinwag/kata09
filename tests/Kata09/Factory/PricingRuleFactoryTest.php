<?php

namespace Tests\Kata09\Factory;

use Kata09\DataObject\PricingRule;
use Kata09\Factory\PricingRuleFactory;
use Kata09\PricingRule\BulkDiscountPricingRule;
use Kata09\PricingRule\PercentageDiscountPricingRule;
use PHPUnit\Framework\TestCase;

/**
 * Class PricingRuleFactoryTest
 * @package Tests\Kata09\Factory
 */
class PricingRuleFactoryTest extends TestCase
{

    /**
     * @var PricingRuleFactory
     */
    private $pricingRuleFactory;

    public function setUp()
    {
        $this->pricingRuleFactory = new PricingRuleFactory();
    }

    public function testProperClassCreation()
    {
        $bulkDiscountPricingRuleDataObject = new PricingRule('A', PricingRuleFactory::PRICING_RULE_TYPE_BULK_DISCOUNT, '3 for 150');
        $percentageDiscountPricingRuleDataObject = new PricingRule('B', PricingRuleFactory::PRICING_RULE_TYPE_PERCENTAGE_DISCOUNT, '10% off');

        $this->assertInstanceOf(BulkDiscountPricingRule::class, $this->pricingRuleFactory->create($bulkDiscountPricingRuleDataObject));
        $this->assertInstanceOf(PercentageDiscountPricingRule::class, $this->pricingRuleFactory->create($percentageDiscountPricingRuleDataObject));
    }

    public function testCorrectExceptionIsThrownOnInvalidType()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage(
           "Pricing rule: 'wrong' is not implemented"
        );

        $this->pricingRuleFactory->create(new PricingRule('ABC', 'wrong', 'wrong'));
    }
}