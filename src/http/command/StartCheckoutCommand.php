<?php declare(strict_types=1);

namespace Eventsourcing\Http;

use Eventsourcing\CartService;

class StartCheckoutCommand
{
    /**
     * @var CartService
     */
    private $cartService;

    /**
     * @var CheckoutService
     */
    private $checkoutService;

    public function __construct(CartService $cartService, CheckoutService $checkoutService)
    {
        $this->cartService = $cartService;
        $this->checkoutService = $checkoutService;
    }

    /**
     * @throws \Eventsourcing\CartNotFoundException
     */
    public function execute(): void
    {
        $this->checkoutService->start($this->cartService->getCartItems());
    }
}
