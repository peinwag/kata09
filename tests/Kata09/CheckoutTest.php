<?php

namespace Tests\Kata09;

use Kata09\Checkout;
use Kata09\Dao\PricingRuleDao;
use Kata09\Dao\ProductDao;
use Kata09\Factory\PricingRuleFactory;
use Kata09\Factory\PurchaseItemFactory;
use Kata09\Purchase;
use PHPUnit\Framework\TestCase;

/**
 * Class CheckoutTest
 * @package Tests\Kata09
 *
 * @group CheckoutTest
 */
class CheckoutTest extends TestCase
{
    public function testTotals()
    {
        $this->assertEquals(0, $this->getPurchasePrice(''));
        $this->assertEquals(50, $this->getPurchasePrice('A'));
        $this->assertEquals(80, $this->getPurchasePrice('AB'));
        $this->assertEquals(115, $this->getPurchasePrice('CDBA'));

        $this->assertEquals(100, $this->getPurchasePrice('AA'));
        $this->assertEquals(130, $this->getPurchasePrice('AAA'));
        $this->assertEquals(180, $this->getPurchasePrice('AAAA'));
        $this->assertEquals(230, $this->getPurchasePrice('AAAAA'));
        $this->assertEquals(260, $this->getPurchasePrice('AAAAAA'));

        $this->assertEquals(160, $this->getPurchasePrice('AAAB'));
        $this->assertEquals(175, $this->getPurchasePrice('AAABB'));
        $this->assertEquals(190, $this->getPurchasePrice('AAABBD'));
        $this->assertEquals(190, $this->getPurchasePrice('DABABA'));
    }

    public function testIncremental()
    {
        $checkout = $this->getCheckout();

        $this->assertEquals(0, $checkout->getTotal());
        $checkout->scan('A');
        $this->assertEquals(50, $checkout->getTotal());
        $checkout->scan('B');
        $this->assertEquals(80, $checkout->getTotal());
        $checkout->scan('A');
        $this->assertEquals(130, $checkout->getTotal());
        $checkout->scan('A');
        $this->assertEquals(160, $checkout->getTotal());
        $checkout->scan('B');
        $this->assertEquals(175, $checkout->getTotal());
    }

    /**
     * @param string $items
     * @return mixed
     */
    private function getPurchasePrice(string $items)
    {
        $checkout = $this->getCheckout();

        foreach (str_split($items) as $item) {
            $checkout->scan($item);
        }

        return $checkout->getTotal();

    }

    /**
     * @return Checkout
     */
    private function getCheckout()
    {
        $purchaseItemFactory = new PurchaseItemFactory(
            new ProductDao(),
            new PricingRuleDao(),
            new PricingRuleFactory()
        );
        return new Checkout(new Purchase(), $purchaseItemFactory);
    }
}