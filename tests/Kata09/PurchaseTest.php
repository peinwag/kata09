<?php


namespace Tests\Kata09;

use Kata09\Purchase;
use Kata09\PurchaseItem;
use Kata09\DataObject\Product;
use PHPUnit\Framework\TestCase;

/**
 * Class PurchaseTest
 * @package Tests\Kata09
 */
class PurchaseTest extends TestCase
{

    public function testItemQuantity()
    {
        $purchase = new Purchase();

        $purchase->addItem(new PurchaseItem(new Product('A', 100)));
        $purchase->addItem(new PurchaseItem(new Product('A', 100)));
        $purchase->addItem(new PurchaseItem(new Product('A', 100)));
        $purchase->addItem(new PurchaseItem(new Product('A', 100)));
        $purchase->addItem(new PurchaseItem(new Product('A', 100), 2));

        $this->assertEquals(6, $purchase->getPurchaseItems()['A']->getQty());
    }
}