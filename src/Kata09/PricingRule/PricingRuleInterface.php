<?php

namespace Kata09\PricingRule;

use Kata09\Purchasable;

/**
 * Interface PricingRuleInterface
 * @package Kata09\PricingRule
 */
interface PricingRuleInterface
{
    /**
     * PricingRuleInterface constructor.
     * @param string $dsl
     */
    public function __construct(string $dsl);

    /**
     * @return void
     */
    public function parseDsl();

    /**
     * @param Purchasable $purchasable
     * @return mixed
     */
    public function getPrice(Purchasable $purchasable);
}
