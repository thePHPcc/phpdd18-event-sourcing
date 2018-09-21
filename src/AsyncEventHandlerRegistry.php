<?php declare(strict_types=1);

namespace Eventsourcing;

class AsyncEventHandlerRegistry
{
    /**
     * @var ConsumeFactory
     */
    private $factory;

    public function __construct(ConsumeFactory $factory)
    {
        $this->factory = $factory;
    }

    public function get(Topic $topic): EventHandlerCollection
    {
        $eventHandlers = new EventHandlerCollection();

        switch (true) {
            case $topic->equals(new OrderPlacedTopic()):
                $this->addOrderPlacedEventHandlers($eventHandlers);
                break;
        }

        return $eventHandlers;
    }

    private function addOrderPlacedEventHandlers(EventHandlerCollection $eventHandlers): void
    {
        $eventHandlers->add($this->factory->createOrderPlacedEmailConfirmationSender());
    }
}
