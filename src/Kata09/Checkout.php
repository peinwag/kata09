<?php


namespace Kata09;

use Kata09\Dao\ProductDao;

class Checkout
{
    /**
     * @var Purchase
     */
    protected $purchase;

    /**
     * @var ProductDao
     */
    protected $productDao;

    /**
     * Checkout constructor.
     * @param Purchase $purchase
     * @param ProductDao $productDao
     */
    public function __construct(
        Purchase $purchase,
        ProductDao $productDao
    ) {
        $this->purchase = $purchase;
        $this->productDao = $productDao;
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
        $product = $this->productDao->findOneById($productId);
        if (null !== $product) {
            $item = new PurchaseItem($product);
            $this->purchase->addItem($item);
        }
        // @TODO: handle the product not found case
    }
}
