<?php declare(strict_types=1);

namespace Eventsourcing;

class EventStream
{

    /**
     * @var EventStreamReader
     */
    private $reader;

    public function __construct(EventStreamReader $reader)
    {
        $this->reader = $reader;
    }

    public function getNext(): Event
    {
        while (true) {
            if ($this->reader->hasEvents()) {
                return $this->reader->read();
            }
            usleep(1500);
        }
    }
}
