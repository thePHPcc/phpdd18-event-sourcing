<?php declare(strict_types=1);

namespace Eventsourcing;

class CartItemListProjectionRenderer
{
    public function render(CartItemCollection $cartItems): CartItemListProjection
    {
        $output = '';

        foreach ($cartItems as $cartItem) {
            /** @var CartItem $cartItem */
            $output .= sprintf("%s: %s - %s \n", $cartItem->getId(), $cartItem->getDescription(), $cartItem->getPrice());
        }

        return new CartItemListProjection($output);
    }
}
