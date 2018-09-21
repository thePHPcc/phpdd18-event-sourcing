<?php declare(strict_types=1);

namespace Eventsourcing;
class EventLog
{
    /**
     * @var Event[]
     */
    private $events = [];

    public function append(Event $event) {
        $this->events[] = $event;
    }
}
