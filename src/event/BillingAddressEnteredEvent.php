<?php declare(strict_types=1);

namespace Eventsourcing;

class BillingAddressEnteredEvent implements Event
{
    /**
     * @var \DateTimeImmutable
     */
    private $occuredAt;

    /**
     * @var EmitterId
     */
    private $emitterId;

    /**
     * @var BillingAddress
     */
    private $billingAddress;

    public function __construct(\DateTimeImmutable $occuredAt, EmitterId $emitterId, BillingAddress $billingAddress)
    {
        $this->occuredAt = $occuredAt;
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

    public function getOccuredAt(): \DateTimeImmutable
    {
        return $this->occuredAt;
    }

    public function getTopic(): Topic
    {
        return new BillingAddressEnteredTopic();
    }
}
