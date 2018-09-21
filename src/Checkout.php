<?php declare(strict_types=1);

namespace Eventsourcing;

class Checkout
{

    /**
     * @var EventLog
     */
    private $eventLog;

    /**
     * @var EmitterId
     */
    private $emitterId;

    /**
     * @var CartItemCollection
     */
    private $cartItems;

    public function __construct(EventLog $history)
    {
        $this->replay($history);
        $this->eventLog = new EventLog();
    }

    public function startCheckout(CartItemCollection $cartItems)
    {
        if ($this->emitterId !== null) {
            throw new CheckoutAlreadyStartedException();
        }
        $event = new CheckoutStartedEvent(new EmitterId(), $cartItems, new \DateTimeImmutable());
        $this->recordEvent($event);
    }

    public function getRecordedEvents(): EventLog
    {
        return $this->eventLog;
    }

    private function replay(EventLog $eventLog)
    {
        foreach ($eventLog as $event) {
            $this->applyEvent($event);
        }
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
        $this->emitterId = $event->getEmitterId();
        $this->cartItems = $event->getCartItems();
    }
}
