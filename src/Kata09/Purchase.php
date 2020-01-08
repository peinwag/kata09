<?php


namespace Kata09;

class Purchase
{

    /**
     * @var array
     */
    protected $purchaseItems = [];


    public function addItem(PurchaseItem $item)
    {
        if (array_key_exists($item->getSku(), $this->purchaseItems)) {
            if (null !== $this->purchaseItems[$item->getSku()]) {
                $this->purchaseItems[$item->getSku()]->incrementQty($item->getQty());
            }
        } else {
            $this->purchaseItems[$item->getSku()] = $item;
        }
    }

    /**
     * @return array
     */
    public function getPurchaseItems()
    {
        return $this->purchaseItems;
    }
}