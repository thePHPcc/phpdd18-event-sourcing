<?php declare(strict_types=1);

namespace Eventsourcing;

interface Event
{
    public function getEmitterId(): EmitterId;

    public function getOccuredAt(): \DateTimeImmutable;

    public function getTopic(): Topic;
}
