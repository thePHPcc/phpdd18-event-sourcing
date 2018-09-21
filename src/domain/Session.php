<?php declare(strict_types=1);

namespace Eventsourcing;

class Session
{
    /**
     * @throws NoCheckoutIdFoundException
     */
    public function getCheckoutId(): EmitterId
    {
        if ($this->hasCheckoutId()) {
            return new EmitterId($_SESSION['checkout_id']);
        }
        throw new NoCheckoutIdFoundException();
    }

    public function hasCheckoutId(): bool
    {
        return isset($_SESSION['checkout_id']);
    }

    public function setCheckoutId(EmitterId $checkoutId): void
    {
        $_SESSION['checkout_id'] = $checkoutId->asString();
    }
}
