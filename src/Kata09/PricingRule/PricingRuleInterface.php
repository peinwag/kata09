<?php

namespace Kata09\PricingRule;

use Kata09\Purchasable;

interface PricingRuleInterface
{
    public function __construct(string $dsl);
    public function parseDsl();
    public function getPrice(Purchasable $purchasable);
}
