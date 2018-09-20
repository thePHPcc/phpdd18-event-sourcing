<?php declare(strict_types=1);

namespace Eventsourcing;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CartItemCollectionTest extends TestCase
{

    public function testIsCountable()
    {
        $collection = new CartItemCollection();
        $this->assertCount(0, $collection);
        $collection->add($this->createCartItemMock());
        $this->assertCount(1, $collection);
        $collection->add($this->createCartItemMock());
        $collection->add($this->createCartItemMock());
        $this->assertCount(3, $collection);
    }

    public function testIsIterable()
    {
        $collection = new CartItemCollection();
        $item1 = $this->createCartItemMock();
        $item2 = $this->createCartItemMock();
        $collection->add($item1);
        $collection->add($item2);

        $actual = [];

        $expected = [$item1, $item2];
        foreach ($collection as $item) {
            $actual[] = $item;
        }

        $this->assertSame($expected, $actual);
    }

    /**
     * @return MockObject|CartItem
     */
    private function createCartItemMock()
    {
        return $this->createMock(CartItem::class);
    }

}
