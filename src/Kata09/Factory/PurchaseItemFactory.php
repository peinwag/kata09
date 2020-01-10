<?php

namespace Kata09\Factory;

use Kata09\Dao\PricingRuleDao;
use Kata09\Dao\ProductDao;
use Kata09\DataObject\PricingRule;
use Kata09\Decorator\PricingRuleAwarePurchasableDecorator;
use Kata09\PurchaseItem;

/**
 * Class PurchaseItemFactory
 * @package Kata09\Factory
 *
 * Responsible for creating PurchaseItem instances or their decorators
 */
class PurchaseItemFactory
{
    /**
     * @var ProductDao
     */
    private $productDao;

    /**
     * @var PricingRuleDao
     */
    private $pricingRuleDao;

    /**
     * @var PricingRuleFactory
     */
    private $pricingRuleFactory;

    /**
     * PurchaseItemFactory constructor.
     *
     * @param ProductDao $productDao
     * @param PricingRuleDao $pricingRuleDao
     * @param PricingRuleFactory $pricingRuleFactory
     */
    public function __construct(
        ProductDao $productDao,
        PricingRuleDao $pricingRuleDao,
        PricingRuleFactory $pricingRuleFactory
    ) {
        $this->productDao = $productDao;
        $this->pricingRuleDao = $pricingRuleDao;
        $this->pricingRuleFactory = $pricingRuleFactory;
    }

    /**
     * Returns a PurchaseItem or one of its decorators
     *
     * @param string $productId
     * @return PurchaseItem|null
     */
    public function create(string $productId)
    {
        $product = $this->productDao->findOneById($productId);

        if (null === $product) {
            return null;
        }


        $pricingRules = $this->pricingRuleDao->findBySku($product->getId());
        $purchaseItem = new PurchaseItem($product);

        foreach ($pricingRules as $pricingRule) {
            /* @var PricingRule $pricingRule */
            $purchaseItem = new PricingRuleAwarePurchasableDecorator($purchaseItem);
            $concretePricingRule = $this->pricingRuleFactory->create($pricingRule);
            $purchaseItem->setPricingRule($concretePricingRule);
        }

        return $purchaseItem;
    }
}
