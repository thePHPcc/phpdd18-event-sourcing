<?php declare(strict_types=1);

namespace Eventsourcing;

class BillingAddressEnteredEvent implements Event
{
    /**
     * @var \DateTimeImmutable
     */
    private $occurredAt;

    /**
     * @var EmitterId
     */
    private $emitterId;

    /**
     * @var BillingAddress
     */
    private $billingAddress;

    public function __construct(\DateTimeImmutable $occurredAt, EmitterId $emitterId, BillingAddress $billingAddress)
    {
        $this->occurredAt = $occurredAt;
        $this->emitterId = $emitterId;
        $this->billingAddress = $billingAddress;
    }

    public function getBillingAddress(): BillingAddress
    {
        return $this->billingAddress;
    }

    public function getEmitterId(): EmitterId
    {
        return $this->emitterId;
    }

    public function getOccurredAt(): \DateTimeImmutable
    {
        return $this->occurredAt;
    }

    public function getTopic(): Topic
    {
        return new BillingAddressEnteredTopic();
    }
}
