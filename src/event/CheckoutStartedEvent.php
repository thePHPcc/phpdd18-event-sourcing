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

    public function __construct(CartItemCollection $cartItems, \DateTimeImmutable $occuredAt)
    {
        $this->cartItems = $cartItems;
        $this->occuredAt = $occuredAt;
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
