<?php declare(strict_types=1);

namespace Eventsourcing;

class BillingAddressProjector implements EventHandler
{
    /**
     * @var BillingAddressProjectionRenderer
     */
    private $renderer;
    /**
     * @var ProjectionWriter
     */
    private $projectionWriter;

    public function __construct(BillingAddressProjectionRenderer $renderer, ProjectionWriter $projectionWriter)
    {
        $this->renderer = $renderer;
        $this->projectionWriter = $projectionWriter;
    }

    public function handle(Event $event)
    {
        /** @var BillingAddressEnteredEvent $event */
        $projection = $this->renderer->render($event->getBillingAddress());
        $this->projectionWriter->write($event->getEmitterId(), $projection);
    }
}
