<?php

namespace Kata09\Decorator;

use Kata09\Purchasable;

abstract class AbstractPurchasableDecorator implements Purchasable
{
    /**
     * @var Purchasable
     */
    protected $purchasable;

    public function __construct(Purchasable $purchasable)
    {
        $this->purchasable = $purchasable;
    }
}
