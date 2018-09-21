<?php declare(strict_types=1);

namespace Eventsourcing;

class CartItemListProjectionRenderer
{
    public function render(CartItemCollection $cartItems): CartItemListProjection
    {
        $items = '';
        $itemTemplate = file_get_contents(__DIR__ . '/templates/checkoutCartItem.html');
        $template = file_get_contents(__DIR__ . '/templates/checkoutCartItemList.html');

        $count = 0;
        $total = 0;
        foreach ($cartItems as $cartItem) {
            $count++;
            $items .= str_replace(
                ['%%ID%%', '%%PRICE%%'],
                [$cartItem->getId(), $this->formatPrice($cartItem->getPrice())],
                $itemTemplate
            );
            $total += $cartItem->getPrice();
        }

        return new CartItemListProjection(
            str_replace(
                ['%%ITEMS%%', '%%ITEM_COUNT%%', '%%CART_ITEMS_TOTAL%%'],
                [$items, $count, $this->formatPrice($total)],
                $template
            )
        );
    }

    private function formatPrice(int $price): string
    {
        return number_format($price / 100, 2, ',', '.') . '&nbsp;EUR';
    }
}
