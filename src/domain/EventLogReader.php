<?php declare(strict_types=1);

namespace Eventsourcing;

interface EventLogReader
{
    public function read(): EventLog;
}
