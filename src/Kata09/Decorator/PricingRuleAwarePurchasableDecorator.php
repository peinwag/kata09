<?php

namespace Kata09\Decorator;

use Kata09\PricingRule\PricingRuleInterface;

/**
 * Class PricingRuleAwarePurchasableDecorator
 * @package Kata09\Decorator
 */
class PricingRuleAwarePurchasableDecorator extends AbstractPurchasableDecorator
{
    /**
     * @var PricingRuleInterface
     */
    private $pricingRule;

    /**
     * Returns the price based on the pricing rule
     *
     * @return mixed
     */
    public function getPrice()
    {
        return $this->pricingRule->getPrice($this->purchasable);
    }

    /**
     * @param PricingRuleInterface $pricingRule
     */
    public function setPricingRule(PricingRuleInterface $pricingRule)
    {
        $this->pricingRule = $pricingRule;
    }
}
