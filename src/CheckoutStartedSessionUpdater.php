<?php declare(strict_types=1);

namespace Eventsourcing;

class CheckoutStartedSessionUpdater implements EventHandler
{
    /**
     * @var Session
     */
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function handle(Event $event): void
    {
        /** @var CheckoutStartedEvent $event */
        $this->session->setCheckoutId($event->getEmitterId());
    }
}
