<?php declare(strict_types=1);

namespace Eventsourcing;

use Eventsourcing\Http\AddressPageQuery;
use Eventsourcing\Http\CheckoutService;
use Eventsourcing\Http\ConfirmationPageQuery;
use Eventsourcing\Http\StartCheckoutCommand;
use Slim\Views\PhpRenderer;

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
        return new CartService($this->sessionId);
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

    public function createStartCheckoutCommand(): StartCheckoutCommand
    {
        return new StartCheckoutCommand(
            $this->createCartService(),
            $this->createCheckoutService()
        );
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
        return new ProjectionWriter();
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

    private function createCheckoutService(): CheckoutService
    {
        return new CheckoutService(
            $this->createEventLogReader(),
            $this->createEventLogWriter(),
            $this->createEventListener()
        );
    }

    public function createAddressPageQuery(): AddressPageQuery
    {
        return new AddressPageQuery(
            $this->createSession(),
            $this->createTemplateRenderer()
        );
    }

    public function createCheckoutStartedSessionUpdater(): CheckoutStartedSessionUpdater
    {
        return new CheckoutStartedSessionUpdater($this->createSession());
    }

    public function createConfirmationPageQuery(): ConfirmationPageQuery
    {
        return new ConfirmationPageQuery(
            $this->createSession(),
            $this->createTemplateRenderer()
        );
    }

    private function createTemplateRenderer(): PhpRenderer
    {
        return new PhpRenderer(__DIR__ . '/projection/templates');
    }
}
