<?php declare(strict_types=1);

namespace Eventsourcing;
class CheckoutStartedTopic extends Topic
{
    public function asString(): string
    {
        return 'checkout-started';
    }
}
