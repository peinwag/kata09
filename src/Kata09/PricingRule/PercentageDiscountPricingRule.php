<?php


namespace Kata09\PricingRule;

use Kata09\Purchasable;

/**
 * Class PercentageDiscountPricingRule
 * @package Kata09\PricingRule
 */
class PercentageDiscountPricingRule extends AbstractPricingRule
{
    /**
     * @var int
     */
    private $discount;

    /**
     * Defines the domain specific language for this pricing rule
     *
     * <percentage>%_off
     */
    const DSL_REGEX = '#(\d[1-100])%\soff#';

    /**
     * Executes the price calculation based on the business rule.
     *
     * In this case applies a percentage discount e.g. 10% off
     *
     * @param Purchasable $purchasable
     * @return float|int
     */
    public function getPrice(Purchasable $purchasable)
    {
        return $purchasable->getPrice() - (($purchasable->getPrice()/100) * $this->discount);
    }

    /**
     * Dsl parsing
     */
    public function parseDsl()
    {
        preg_match_all(self::DSL_REGEX, $this->dsl, $matches);
        if (!isset($matches[1][0])) {
            throw new \InvalidArgumentException(
                sprintf("'%s' is not a valid dsl for this pricing rule: '%s'", $this->dsl, __CLASS__)
            );
        }

        $this->discount = $matches[1][0];
    }

    /**
     * @return int
     */
    public function getDiscount()
    {
        return $this->discount;
    }
}
