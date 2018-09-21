<?php declare(strict_types=1);

namespace Eventsourcing;

interface Event
{
    public function getTopic(): Topic;
}
