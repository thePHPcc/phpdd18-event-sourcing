<?php declare(strict_types=1);

namespace Eventsourcing;

class Checkout
{

    /**
     * @var EventLog
     */
    private $eventLog;

    /**
     * @var bool
     */
    private $hasBeenStarted = false;

    /**
     * @var CartItemCollection
     */
    private $cartItems;

    public function __construct()
    {
        $this->eventLog = new EventLog();
    }

    public function startCheckout(CartItemCollection $cartItems)
    {
        if ($this->hasBeenStarted) {
            throw new CheckoutAlreadyStartedException();
        }
        $event = new CheckoutStartedEvent($cartItems, new \DateTimeImmutable());
        $this->recordEvent($event);
    }

    public function getRecordedEvents(): EventLog
    {
        return $this->eventLog;
    }

    private function recordEvent(Event $event)
    {
        $this->eventLog->append($event);
        $this->applyEvent($event);
    }

    private function applyEvent(Event $event)
    {
        switch (true) {
            case $event->getTopic()->equals(new CheckoutStartedTopic()):
                /** @var CheckoutStartedEvent $event */
                $this->applyCheckoutStartedEvent($event);
                break;
        }
    }

    private function applyCheckoutStartedEvent(CheckoutStartedEvent $event)
    {
        $this->hasBeenStarted = true;
        $this->cartItems = $event->getCartItems();
    }
}
