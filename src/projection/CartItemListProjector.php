<?php declare(strict_types=1);

namespace Eventsourcing;

class CartItemListProjector implements EventHandler
{
    /**
     * @var CartItemListProjectionRenderer
     */
    private $renderer;

    /**
      * @var ProjectionWriter
      */
    private $projectionWriter;

    public function __construct(CartItemListProjectionRenderer $renderer, ProjectionWriter $projectionWriter)
    {
        $this->renderer = $renderer;
        $this->projectionWriter = $projectionWriter;
    }

    public function handle(Event $event): void
    {
        /**@var CheckoutStartedEvent $event */
        $projection = $this->renderer->render($event->getCartItems());
        $this->projectionWriter->write($event->getEmitterId(), $projection);
    }
}
