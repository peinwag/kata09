<?php

namespace Kata09\Decorator;

use Kata09\Purchasable;

abstract class AbstractPurchasableDecorator implements Purchasable
{
    /**
     * @var Purchasable
     */
    protected $purchasable;

    /**
     * AbstractPurchasableDecorator constructor.
     * @param Purchasable $purchasable
     */
    public function __construct(Purchasable $purchasable)
    {
        $this->purchasable = $purchasable;
    }

    public function getBasePrice()
    {
        return $this->purchasable->getBasePrice();
    }

    public function getSku()
    {
        return $this->purchasable->getSku();
    }

    public function getQty()
    {
        return $this->purchasable->getQty();
    }

    public function incrementQty($qty)
    {
        $this->purchasable->incrementQty($qty);
    }

    public function decrementQty($qty)
    {
        $this->purchasable->incrementQty($qty);
    }
}
