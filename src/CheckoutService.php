<?php declare(strict_types=1);

namespace Eventsourcing\Http;

use Eventsourcing\CartItemCollection;
use Eventsourcing\Checkout;
use Eventsourcing\EventListener;
use Eventsourcing\EventLog;
use Eventsourcing\EventLogReader;
use Eventsourcing\EventLogWriter;

class CheckoutService
{
    /**
     * @var EventLogReader
     */
    private $eventLogReader;

    /**
     * @var EventLogWriter
     */
    private $eventLogWriter;

    /**
     * @var EventListener
     */
    private $eventListener;

    public function __construct(
        EventLogReader $eventLogReader,
        EventLogWriter $eventLogWriter,
        EventListener $eventListener
    ) {
        $this->eventLogReader = $eventLogReader;
        $this->eventLogWriter = $eventLogWriter;
        $this->eventListener = $eventListener;
    }

    /**
     * @throws \Eventsourcing\CheckoutAlreadyStartedException
     */
    public function start(CartItemCollection $cartItems): void
    {
        $checkout = new Checkout(new EventLog());
        $checkout->startCheckout($cartItems);
        $this->processEvents($checkout->getRecordedEvents());
    }

    private function processEvents(EventLog $recordedEvents): void
    {
        $this->eventLogWriter->write($recordedEvents);
        $this->eventListener->handle($recordedEvents);
    }
}
