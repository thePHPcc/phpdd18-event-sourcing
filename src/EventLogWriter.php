<?php declare(strict_types=1);

namespace Eventsourcing;

interface EventLogWriter
{
    public function write(EventLog $eventLog): void;
}
