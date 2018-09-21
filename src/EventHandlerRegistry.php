<?php declare(strict_types=1);

namespace Eventsourcing;

class EventHandlerRegistry
{
    /**
     * @var Factory
     */
    private $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function get(Topic $topic): EventHandlerCollection
    {
        $eventHandlers = new EventHandlerCollection();

        switch (true) {
            case $topic->equals(new CheckoutStartedTopic()):
                $this->addCheckoutStartedEventHandlers($eventHandlers);
                break;
            case $topic->equals(new BillingAddressEnteredTopic()):
                $this->addBillingAddressEnteredEventHandlers($eventHandlers);
                break;
        }

        return $eventHandlers;
    }

    private function addBillingAddressEnteredEventHandlers(EventHandlerCollection $eventHandler)
    {
        $eventHandler->add($this->factory->createBillingAddressProjector());
    }

    private function addCheckoutStartedEventHandlers(EventHandlerCollection $eventHandlers)
    {
        $eventHandlers->add($this->factory->createCheckoutStartedSessionUpdater());
        $eventHandlers->add($this->factory->createCartItemListProjector());
    }
}
