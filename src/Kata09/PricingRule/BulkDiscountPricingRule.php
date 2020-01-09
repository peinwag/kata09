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
     *
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
     * @return mixed
     */
    public function getMinQty()
    {
        return $this->minQty;
    }


    /**
     * @return mixed
     */
    public function getMinPrice()
    {
        return $this->minPrice;
    }
}
