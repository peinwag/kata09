<?php

namespace Kata09;

use Kata09\DataObject\Product;

/**
 * Class PurchaseItem
 * @package Kata09
 */
class PurchaseItem implements Purchasable
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $sku;

    /**
     * @var int
     */
    private $qty;

    /**
     * @var int
     */
    private $basePrice;

    /**
     * PurchaseItem constructor.
     * @param Product $product
     * @param int $qty
     */
    public function __construct(Product $product, $qty = 1)
    {
        $this->id = uniqid('kata09');
        $this->sku = $product->getId();
        $this->basePrice = $product->getPrice();
        $this->qty = $qty;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return int
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @param int $qty
     */
    public function setQty($qty)
    {
        $this->qty = $qty;
    }

    /**
     * @param int $qty
     */
    public function incrementQty(int $qty)
    {
        $this->qty += $qty;
    }

    /**
     * @param int $qty
     */
    public function decrementQty(int $qty)
    {
        $this->qty -= $qty;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->basePrice * $this->qty;
    }

    /**
     * @return int|mixed
     */
    public function getBasePrice()
    {
        return $this->basePrice;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }
}
