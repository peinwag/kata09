<?php

namespace Kata09\Factory;

use Kata09\DataObject\PricingRule;
use Kata09\PricingRule\BulkDiscountPricingRule;

class PricingRuleFactory
{
    const PRICING_RULE_TYPE_BULK_DISCOUNT = 'bulk-discount';

    private static $pricingRuleTypeMapping = [
        self::PRICING_RULE_TYPE_BULK_DISCOUNT => BulkDiscountPricingRule::class
    ];

    public function create(PricingRule $pricingRule)
    {
        if (array_key_exists($pricingRule->getType(), self::$pricingRuleTypeMapping)) {
            return new self::$pricingRuleTypeMapping[$pricingRule->getType()]($pricingRule->getDsl());
        }
    }
}
