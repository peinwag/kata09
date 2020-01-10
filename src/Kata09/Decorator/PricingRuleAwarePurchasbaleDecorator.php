<?php

namespace Kata09\Decorator;

use Kata09\PricingRule\PricingRuleInterface;

class PricingRuleAwarePurchasbaleDecorator extends AbstractPurchasableDecorator
{
    /**
     * @var PricingRuleInterface
     */
    private $pricingRule;

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
