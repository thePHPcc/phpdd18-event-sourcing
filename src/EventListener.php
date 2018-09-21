<?php declare(strict_types=1);

namespace Eventsourcing;

class EventListener
{
    /**
     * @var EventHandlerRegistry
     */
    private $registry;

    public function __construct(EventHandlerRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function handle(EventLog $eventLog): void
    {
        foreach ($eventLog as $event) {
            /**@var \Eventsourcing\Event $event */
            foreach ($this->registry->get($event->getTopic()) as $eventHandler) {
                /** @var EventHandler $eventHandler */
                $eventHandler->handle($event);
            }
        }
    }
}
