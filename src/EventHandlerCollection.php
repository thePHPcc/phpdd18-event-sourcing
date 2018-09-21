<?php declare(strict_types=1);

namespace Eventsourcing;

class EventHandlerCollection implements \IteratorAggregate
{

    /**
     * @var EventHandler[]
     */
    private $eventHandlers = [];

    public function add(EventHandler $eventHandler)
    {
        $this->eventHandlers[] = $eventHandler;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->eventHandlers);
    }
}
