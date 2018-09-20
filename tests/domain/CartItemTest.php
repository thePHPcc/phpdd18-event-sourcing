<?php declare(strict_types=1);

namespace Eventsourcing;
use PHPUnit\Framework\TestCase;

class CartItemTest extends TestCase
{

    public function testGetters()
    {
        $item = new CartItem(12, 'some item', 3999);
        $this->assertSame(12, $item->getId());
        $this->assertSame('some item', $item->getDescription());
        $this->assertSame(3999, $item->getPrice());
    }

}
