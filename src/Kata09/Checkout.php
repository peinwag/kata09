<?php

namespace Kata09;

use Kata09\Factory\PurchaseItemFactory;

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
     * Convenience function wrapper for the purchase
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
     * @param $productId
     */
    public function scan($productId)
    {
        $purchaseItem = $this->purchaseItemFactory->create($productId);
        if (null !== $purchaseItem) {
            $this->purchase->addItem($purchaseItem);
        } else {
            // handle this
        }
    }
}
