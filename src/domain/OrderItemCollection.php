<?php declare(strict_types=1);

namespace Eventsourcing;

class OrderItemCollection implements \IteratorAggregate, \Countable
{

    /**
     * @var OrderItem[]
     */
    private $items = [];

    public function add(OrderItem $orderItem)
    {
        $this->items[] = $orderItem;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->items);
    }
}
