<?php declare(strict_types=1);

namespace Eventsourcing;

class Factory
{
    /**
     * @var SessionId
     */
    private $sessionId;

    public function __construct(SessionId $sessionId)
    {
        $this->sessionId = $sessionId;
    }

    public function createCartItemListProjector(): CartItemListProjector
    {
        return new CartItemListProjector(
            $this->createCartItemListProjectionRenderer(),
            $this->createProjectionWriter()
        );
    }


    public function createCheckout(): Checkout
    {
        return new Checkout($this->createEventLogReader()->read());
    }


    public function createCartService(): CartService
    {
        return new CartService();
    }

    public function createEventLogWriter(): PdoEventLogWriter
    {
        return new PdoEventLogWriter($this->createPdo());
    }

    public function createCartItemListProjectionRenderer(): CartItemListProjectionRenderer
    {
        return new CartItemListProjectionRenderer();
    }

    public function createEventListener(): EventListener
    {
        return new EventListener($this->createEventHandlerRegistry());
    }

    public function createBillingAddressProjector(): BillingAddressProjector
    {
        return new BillingAddressProjector($this->createBillingAddressProjectionRenderer(), $this->createProjectionWriter());
    }

    private function createEventLogReader(): PdoEventLogReader
    {
        return new PdoEventLogReader($this->createSession(), $this->createPdo());
    }

    private function createEventHandlerRegistry(): EventHandlerRegistry
    {
        return new EventHandlerRegistry($this);
    }

    private function createProjectionWriter(): ProjectionWriter
    {
        return new ProjectionWriter($this->sessionId);
    }

    private function createPdo(): \PDO
    {
        return new \PDO('sqlite:' . __DIR__ . '/../var/events.db');
    }

    private function createSession(): Session
    {
        return new Session();
    }

    private function createBillingAddressProjectionRenderer(): BillingAddressProjectionRenderer
    {
        return new BillingAddressProjectionRenderer();
    }
}
