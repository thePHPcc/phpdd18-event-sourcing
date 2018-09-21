<?php declare(strict_types=1);

namespace Eventsourcing;

class CartItemCollection implements \IteratorAggregate, \Countable
{

    /**
     * @var CartItem[]
     */
    private $items = [];

    public function add(CartItem $cartItem)
    {
        $this->items[] = $cartItem;
    }

    public function count(): int
    {
        return \count($this->items);
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->items);
    }
}
