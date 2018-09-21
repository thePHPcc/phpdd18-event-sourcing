<?php declare(strict_types=1);

namespace Eventsourcing;

class CheckoutStartedEvent implements Event
{

    /**
     * @var CartItemCollection
     */
    private $cartItems;

    /**
     * @var \DateTimeImmutable
     */
    private $occuredAt;

    /**
     * @var EmitterId
     */
    private $emitterId;

    public function __construct(EmitterId $emitterId, CartItemCollection $cartItems, \DateTimeImmutable $occuredAt)
    {
        $this->cartItems = $cartItems;
        $this->occuredAt = $occuredAt;
        $this->emitterId = $emitterId;
    }

    public function getEmitterId(): EmitterId
    {
        return $this->emitterId;
    }

    public function getTopic(): Topic
    {
        return new CheckoutStartedTopic();
    }

    public function getCartItems(): CartItemCollection
    {
        return $this->cartItems;
    }

    public function getOccuredAt(): \DateTimeImmutable
    {
        return $this->occuredAt;
    }
}
