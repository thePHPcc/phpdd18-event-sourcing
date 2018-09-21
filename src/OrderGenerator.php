<?php declare(strict_types=1);

namespace Eventsourcing;

class OrderGenerator
{
    public function generate(BillingAddress $billingAddress, CartItemCollection $cartItems)
    {
        return new Order(
            new OrderNumber(),
            $billingAddress,
            $this->map($cartItems)
        );
    }

    private function map(CartItemCollection $cartItems): OrderItemCollection
    {
        $orderItems = new OrderItemCollection();
        foreach ($cartItems as $cartItem) {
            /** @var CartItem $cartItem */
            $orderItems->add(
                new OrderItem(
                    $cartItem->getId(),
                    $cartItem->getDescription(),
                    $cartItem->getPrice()
                )
            );
        }

        return $orderItems;
    }
}
