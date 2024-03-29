<?php

namespace Kata09\PricingRule;

use Kata09\Purchasable;

/**
 * Class MultiPricedPricingRule
 * @package Kata09\PricingRule
 */
class BulkDiscountPricingRule extends AbstractPricingRule
{
    /**
     * Defines the domain specific language for this pricing rule
     *
     * <minQty>_for_<minPrice>
     */
    const DSL_REGEX = '#(\d+)\sfor\s(\d+)#';

    /**
     * @var int
     */
    private $minQty;

    /**
     * @var int
     */
    private $minPrice;


    /**
     * Dsl parsing
     *
     * @throws \InvalidArgumentException if the dsl is not valid
     */
    public function parseDsl()
    {
        preg_match_all(self::DSL_REGEX, $this->dsl, $matches);
        if (!isset($matches[1][0]) || !isset($matches[2][0])) {
            throw new \InvalidArgumentException(
                sprintf("'%s' is not a valid dsl for this pricing rule: '%s'", $this->dsl, __CLASS__)
            );
        }

        $this->minQty = $matches[1][0];
        $this->minPrice = $matches[2][0];
    }

    /**
     * Executes the price calculation based on the business rule.
     *
     * In this case applies a bulk discount e.g. 3 for 130
     *
     * @param Purchasable $purchasable
     * @return float|int
     */
    public function getPrice(Purchasable $purchasable)
    {
        $regularPrice = $purchasable->getQty() * $purchasable->getBasePrice();

        if ($purchasable->getQty() < $this->minQty) {
            return $regularPrice;
        }

        $discountMultiplier = intdiv($purchasable->getQty(), $this->minQty);
        $discountableQty = $discountMultiplier * $this->minQty;
        $discountableAmount = $discountMultiplier * $this->minPrice;
        $discount = ($discountableQty * $purchasable->getBasePrice()) - $discountableAmount;

        return $regularPrice - $discount;
    }

    /**
     * @return int
     */
    public function getMinQty()
    {
        return $this->minQty;
    }


    /**
     * @return int
     */
    public function getMinPrice()
    {
        return $this->minPrice;
    }
}
