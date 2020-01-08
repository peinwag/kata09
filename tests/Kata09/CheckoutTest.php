<?php
use PHPUnit\Framework\TestCase;
use Kata09\Checkout;
use Kata09\Purchase;
use Kata09\Dao\ProductDao;

class CheckoutTest extends TestCase
{
    public function testTotals()
    {
        $this->assertEquals(0, $this->getPurchasePrice(''));
        $this->assertEquals(50, $this->getPurchasePrice('A'));
        $this->assertEquals(80, $this->getPurchasePrice('AB'));
        $this->assertEquals(115, $this->getPurchasePrice('CDBA'));

        $this->assertEquals(100, $this->getPurchasePrice('AA'));
        #$this->assertEquals(130, $this->getPurchasePrice('AAA'));
        #$this->assertEquals(180, $this->getPurchasePrice('AAAA'));
        #$this->assertEquals(230, $this->getPurchasePrice('AAAAA'));
        #$this->assertEquals(230, $this->getPurchasePrice('AAAAAA'));
    }

    public function testIncremental()
    {
        $checkout = new Checkout(new Purchase(), new ProductDao());

        $this->assertEquals(0, $checkout->getTotal());
        $checkout->scan('A');
        $this->assertEquals(50, $checkout->getTotal());
        $checkout->scan('B');
        $this->assertEquals(80, $checkout->getTotal());
        $checkout->scan('A');
        $this->assertEquals(130, $checkout->getTotal());
    }

    /**
     * @param string $items
     * @return mixed
     */
    private function getPurchasePrice(string $items)
    {
        $checkout = new Checkout(new Purchase(), new ProductDao());

        foreach (str_split($items) as $item) {
            $checkout->scan($item);
        }

        return $checkout->getTotal();

    }
}