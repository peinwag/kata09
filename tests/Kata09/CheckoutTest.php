<?php

namespace Tests\Kata09;

use Kata09\Checkout;
use Kata09\Dao\PricingRuleDao;
use Kata09\Dao\ProductDao;
use Kata09\DataObject\PricingRule;
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
    /**
     * Covers the total test required by the kata
     */
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

    /**
     * Covers the the incremental tests required by the kata
     */
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
     * This is just a proof of concept as it was not required by the kata itself.
     *
     * As we are using the decorator pattern to apply the pricing rules, the order might be important
     * depending on the business case.
     * This test assumes that the PricingRuleDao returns the rules in the required order.
     */
    public function testCombinedPricingRules()
    {
        $pricingRules = [
            new PricingRule('A', PricingRuleFactory::PRICING_RULE_TYPE_BULK_DISCOUNT, '3 for 130'),
            new PricingRule('A', PricingRuleFactory::PRICING_RULE_TYPE_PERCENTAGE_DISCOUNT, '10% off'),
        ];

        $pricingRuleDaoStub = $this->createMock(PricingRuleDao::class);
        $pricingRuleDaoStub
            ->method('findBySku')
            ->with($this->equalTo('A'))
            ->willReturn($pricingRules);

        $checkout = $this->getCheckout(null, $pricingRuleDaoStub);

        $checkout->scan('A');
        $checkout->scan('A');
        $checkout->scan('A');
        $this->assertEquals(117, $checkout->getTotal());
    }

    /**
     * Helper method for testing sequence
     *
     * @param string $items
     * @return mixed
     */
    private function getPurchasePrice(string $items)
    {
        $checkout = $this->getCheckout();

        foreach (str_split($items) as $item) {
            if ('' !== $item) {
                $checkout->scan($item);
            }
        }

        return $checkout->getTotal();

    }

    /**
     * Creates a checkout instance, if needed with stubbed Daos
     *
     * @param null $productDaoStub
     * @param null $pricingRuleDaoStub
     * @return Checkout
     */
    private function getCheckout($productDaoStub = null, $pricingRuleDaoStub = null)
    {
        $purchaseItemFactory = new PurchaseItemFactory(
            $productDaoStub ?? new ProductDao(),
            $pricingRuleDaoStub ?? new PricingRuleDao(),
            new PricingRuleFactory()
        );
        return new Checkout(new Purchase(), $purchaseItemFactory);
    }
}