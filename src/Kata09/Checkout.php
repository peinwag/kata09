<?php

namespace Kata09;

use Kata09\Factory\PurchaseItemFactory;

/**
 * Class Checkout
 * @package Kata09
 */
class Checkout
{
    /**
     * @var Purchase
     */
    private $purchase;

    /**
     * @var PurchaseItemFactory
     */
    private $purchaseItemFactory;


    /**
     * Checkout constructor.
     * @param Purchase $purchase
     * @param PurchaseItemFactory $purchaseItemFactory
     */
    public function __construct(
        Purchase $purchase,
        PurchaseItemFactory $purchaseItemFactory
    ) {
        $this->purchase = $purchase;
        $this->purchaseItemFactory = $purchaseItemFactory;
    }

    /**
     * Calculates the total of the current purchase
     *
     * @return mixed
     */
    public function getTotal()
    {
        $sum = 0;
        foreach ($this->purchase->getPurchaseItems() as $purchaseItem) {
            $sum += $purchaseItem->getPrice();
        }

        return $sum;
    }

    /**
     * Scans a given product and adds it to the purchase.
     *
     * @param $productId
     *
     * @throws \InvalidArgumentException if the product does not exist
     */
    public function scan($productId)
    {
        $purchaseItem = $this->purchaseItemFactory->create($productId);
        if (null !== $purchaseItem) {
            $this->purchase->addItem($purchaseItem);
        } else {
            throw new \InvalidArgumentException(sprintf("Product with id '%s' does not exist", $productId));
        }
    }
}
