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

    public function setPricingRule(PricingRuleInterface $pricingRule)
    {
        $this->pricingRule = $pricingRule;
    }

    public function getBasePrice()
    {
        return $this->purchasable->getBasePrice();
    }

    public function getSku()
    {
        return $this->purchasable->getSku();
    }

    public function getQty()
    {
        return $this->purchasable->getQty();
    }

    public function incrementQty($qty)
    {
        $this->purchasable->incrementQty($qty);
    }

    public function decrementQty($qty)
    {
        $this->purchasable->incrementQty($qty);
    }
}
