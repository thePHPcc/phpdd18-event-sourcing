<?php declare(strict_types=1);

namespace Eventsourcing;

class BillingAddressEnteredTopic extends Topic
{
    public function asString(): string
    {
        return 'billing-address-entered';
    }
}
