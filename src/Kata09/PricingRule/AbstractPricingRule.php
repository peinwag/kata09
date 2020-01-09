<?php

namespace Kata09\PricingRule;

abstract class AbstractPricingRule implements PricingRuleInterface
{
    /**
     * @var string
     */
    protected $dsl;

    public function __construct(string $dsl)
    {
        $this->dsl = $dsl;
        $this->parseDsl();
    }
}
