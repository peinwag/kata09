<?php

namespace Kata09\PricingRule;

/**
 * Class AbstractPricingRule
 * @package Kata09\PricingRule
 */
abstract class AbstractPricingRule implements PricingRuleInterface
{
    /**
     * Domain specific language representation of the pricing rule
     *
     * @var string
     */
    protected $dsl;

    /**
     * AbstractPricingRule constructor which enforces parsing of the given dsl
     *
     * @param string $dsl
     */
    public function __construct(string $dsl)
    {
        $this->dsl = $dsl;
        $this->parseDsl();
    }
}
