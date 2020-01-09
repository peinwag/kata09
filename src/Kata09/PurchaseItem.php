<?php

namespace Kata09;

use Kata09\DataObject\Product;

class PurchaseItem implements Purchasable
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var
     */
    private $sku;

    /**
     * @var int
     */
    private $qty;

    /**
     * @var
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

    public function incrementQty($qty)
    {
        $this->qty += $qty;
    }

    public function decrementQty($qty)
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

    public function getBasePrice()
    {
        return $this->basePrice;
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }
}
