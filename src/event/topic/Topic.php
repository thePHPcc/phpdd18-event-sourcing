<?php declare(strict_types=1);

namespace Eventsourcing;

abstract class Topic
{
    public function equals(Topic $topic): bool
    {
        return $topic->asString() === $this->asString();
    }

    abstract public function asString(): string;
}
