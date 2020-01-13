<?php

namespace Kata09\Factory;

use Kata09\DataObject\PricingRule;
use Kata09\PricingRule\BulkDiscountPricingRule;
use Kata09\PricingRule\PercentageDiscountPricingRule;

/**
 * Class PricingRuleFactory
 * @package Kata09\Factory
 *
 * Pricing rule factory which creates pricing rules based on the $pricingRuleTypeMapping, every new
 * pricing rule needs to be registered here in order to be used.
 */
class PricingRuleFactory
{
    const PRICING_RULE_TYPE_BULK_DISCOUNT = 'bulk-discount';
    const PRICING_RULE_TYPE_PERCENTAGE_DISCOUNT = 'percentage-discount';

    /**
     * @var array
     */
    private static $pricingRuleTypeMapping = [
        self::PRICING_RULE_TYPE_BULK_DISCOUNT => BulkDiscountPricingRule::class,
        self::PRICING_RULE_TYPE_PERCENTAGE_DISCOUNT => PercentageDiscountPricingRule::class
    ];

    /**
     * Creates concrete pricing rules based on the given DataObject and the mapping
     *
     * @param PricingRule $pricingRule
     * @return mixed
     *
     * @throws \InvalidArgumentException if the given pricing rule is not implemented
     */
    public function create(PricingRule $pricingRule)
    {
        if (array_key_exists($pricingRule->getType(), self::$pricingRuleTypeMapping)) {
            return new self::$pricingRuleTypeMapping[$pricingRule->getType()]($pricingRule->getDsl());
        }

        throw new \InvalidArgumentException(sprintf("Pricing rule: '%s' is not implemented", $pricingRule->getType()));
    }
}
