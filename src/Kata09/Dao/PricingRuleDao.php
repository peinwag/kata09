<?php


namespace Kata09\Dao;

use Kata09\DataObject\PricingRule;
use Kata09\Factory\PricingRuleFactory;

class PricingRuleDao implements DaoInterface
{
    /**
     * static price rules store just for the purpose of this kata, otherwise this data would come from a database
     *
     * @var array
     */
    private $pricingRules;

    public function __construct()
    {
        $this->pricingRules = [
            new PricingRule('A', PricingRuleFactory::PRICING_RULE_TYPE_BULK_DISCOUNT, '3 for 130'),
            new PricingRule('B', PricingRuleFactory::PRICING_RULE_TYPE_BULK_DISCOUNT, '2 for 45'),
        ];
    }

    /**
     * @return array|mixed
     */
    public function findAll()
    {
        return $this->pricingRules;
    }

    /**
     * @param $sku
     * @return array
     */
    public function findBySku($sku)
    {
        return array_filter($this->pricingRules, function (PricingRule $rule) use ($sku) {
            return $rule->getSku() === $sku;
        });
    }
}
