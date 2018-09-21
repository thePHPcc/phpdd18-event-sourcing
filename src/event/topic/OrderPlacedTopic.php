<?php declare(strict_types=1);

namespace Eventsourcing;

class OrderPlacedTopic extends Topic
{
    public function asString(): string
    {
        return 'order-placed';
    }
}
