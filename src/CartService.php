<?php declare(strict_types=1);

namespace Eventsourcing;

class CartService
{

    public function getCartItems(SessionId $sessionId): CartItemCollection
    {
        switch ($sessionId->asString()) {
            case 'ihgorhmtcvo3qmd5as2oi7thpf':
                $numberOfItems = 1;
                break;
            case 'has4t1glskcktjh4ujs9eet26u':
                $numberOfItems = 5;
                break;
            case '10603jjdasv8vpid64t214762l':
                $numberOfItems = 25;
                break;

            default: throw new CartNotFoundException();
        }

        $items = new CartItemCollection();
        for ($i = 0; $i < $numberOfItems; $i++) {
            $price = rand(10, 9999);
            $items->add(new CartItem($i + 1, 'Product ' . rand(0, 999), $price));
        }

        return $items;
    }
}
