<?php

namespace Kata09\Decorator;

use Kata09\Purchasable;

/**
 * Class AbstractPurchasableDecorator
 * @package Kata09\Decorator
 */
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

    /**
     * @return int
     */
    public function getBasePrice()
    {
        return $this->purchasable->getBasePrice();
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->purchasable->getSku();
    }

    /**
     * @return int
     */
    public function getQty()
    {
        return $this->purchasable->getQty();
    }

    /**
     * @param int $qty
     */
    public function incrementQty(int $qty)
    {
        $this->purchasable->incrementQty($qty);
    }

    /**
     * @param int $qty
     */
    public function decrementQty(int $qty)
    {
        $this->purchasable->incrementQty($qty);
    }
}
