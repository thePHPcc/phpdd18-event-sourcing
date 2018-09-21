<?php declare(strict_types=1);

namespace Eventsourcing;
class EventLogWriter
{

    public function write(EventLog $eventLog): void
    {
        file_put_contents(__DIR__ . '/../var/events.log', serialize($eventLog));
    }

}
